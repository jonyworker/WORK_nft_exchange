<?php


namespace app\api\controller;


use app\BaseController;
use app\api\model\News as NewModel;
use think\App;
use think\facade\Db;

class News extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function newslist()
    {
        $data = [
            'ind' => $this->request->param('ind',1),
            'count' => $this->request->param('count',40),//每頁多少筆記錄,默認40
            'page' => $page = $this->request->param('page',1),
        ];

        $keyword = $this->request->param('keyword','');

        $model = new NewModel();
        $result = $model->getNews($data,$keyword);
        if (!$result){
            return error("内部异常,请稍后查询");
        }
        return success($result);
    }

    // 新聞&專欄 內容頁
    public function detail()
    {
        $request = [
            // 登入用token   允許空
            'token' => $this->request->param('token',''),
            // 默認1         //1繁體中文 2簡體中文 3:英文   4:日   5:韓
            'lan' => $this->request->param('lan',1),
            // 類型,   // 1: 新聞  2:專欄
            'id' => $this->request->param('id',1)
        ];

        $field = 'id,ind,title,content,author,start_date,photo_url,source,title_en,content_en';

        try {
            $data = NewModel::where('id',$request['id'])
                ->field($field)
                ->find();

            if ($data) {
                // ind=1, title 取news.title   不需調用google api
                //      content 取news.content    不需調用google api
                // ind=2, title 取news.title   需調用google api
                //      content 取news.content    需調用google api
                // ind=3, title 取news.title_en   不需調用google api
                //      content 取news.content_en    不需調用google api
                // ind>=4,  title 取news.title_en   需調用google api
                //      content 取news.content_en    需調用google api
                if ($data['ind'] == 2) {
                    $translate = [
                        'title' => array(),
                        'content' => array()
                    ];
                    foreach ($translate as $k_t => $v_t) {
                        if ($data[$k_t]) {
                            $translate[$k_t][0] = $data[$k_t];
                        }
                    }
                    foreach ($translate as $k => $v) {
                        if ($v) {
                            $google = $this->google($v,$request['lan']);

                            foreach ($google as $k_g => $v_g) {
                                $data[$k] = $v_g['translations'];
                            }
                        }
                    }
                } elseif ($data['ind'] == 3) {
                    $data['title'] = $data['title_en'];
                    $data['content'] = $data['content_en'];
                } elseif ($data['ind'] >= 4) {
                    $data['title'] = $data['title_en'];
                    $data['content'] = $data['content_en'];

                    $translate = [
                        'title' => array(),
                        'content' => array()
                    ];
                    foreach ($translate as $k_t => $v_t) {
                        if ($data[$k_t]) {
                            $translate[$k_t][0] = $data[$k_t];
                        }
                    }
                    foreach ($translate as $k => $v) {
                        if ($v) {
                            $google = $this->google($v,$request['lan']);

                            foreach ($google as $k_g => $v_g) {
                                $data[$k] = $v_g['translations'];
                            }
                        }
                    }
                }

                unset($data['title_en']);
                unset($data['content_en']);
            }

            return success2('data',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }

    // 新聞&專欄 內容頁
    public function list()
    {
        $request = [
            // 登入用token   允許空
            'token' => $this->request->param('token',''),
            //  默認1         //1繁體中文 2簡體中文 3:英文   4:日   5:韓
            'lan' => $this->request->param('lan',1),
            // 類型,   // 1: 新聞  2:專欄
            'ind' => $this->request->param('ind',1),
            // 每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
            'count' => $this->request->param('count',30),
            // 返回第幾頁的數據
            'page' => $this->request->param('page',1)
        ];

        $where = '';
        if ($request['ind']) {
            $where = 'ind = ' . $request['ind'];
        }

        $field = 'id,ind,title,content,author,start_date,photo_url,source,title_en,content_en';
        $offset = ($request['page'] - 1) * $request['count'];
        $length = $request['count'];

        try {
            $data = NewModel::where('valid',1)
                ->where('start_date','<=',date('Y-m-d H:i:s'))
                ->where($where)
                ->field($field)
                ->limit($offset,$length)
                ->order('start_date desc')
                ->select()
                ->toArray();

            if ($data) {
                // ind=1, title 取news.title   不需調用google api
                //      content 取news.content    不需調用google api
                // ind=2, title 取news.title   需調用google api
                //      content 取news.content    需調用google api
                // ind=3, title 取news.title_en   不需調用google api
                //      content 取news.content_en    不需調用google api
                // ind>=4,  title 取news.title_en   需調用google api
                //      content 取news.content_en    需調用google api
                $translate = [
                    'title' => array(),
                    'content' => array()
                ];
                foreach ($data as $k => $v) {
                    if ($v['ind'] == 2) {
                        foreach ($translate as $k_t => $v_t) {
                            if ($v[$k_t]) {
                                $translate[$k_t][$k] = $v[$k_t];
                            }
                        }
                    } elseif ($v['ind'] == 3) {
                        $data[$k]['title'] = $v['title_en'];
                        $data[$k]['content'] = $v['content_en'];
                    } elseif ($v['ind'] >= 4) {
                        $data[$k]['title'] = $v['title_en'];
                        $data[$k]['content'] = $v['content_en'];
                        foreach ($translate as $k_t => $v_t) {
                            if ($v[$k_t]) {
                                $translate[$k_t][$k] = $v[$k_t];
                            }
                        }
                    }

                    unset($data[$k]['title_en']);
                    unset($data[$k]['content_en']);
                }

                foreach ($translate as $k => $v) {
                    $google = $this->google($v,$request['lan']);

                    foreach ($google as $k_g => $v_g) {
                        $data[$v_g['key']][$k] = $v_g['translations'];
                    }
                }
            }

            return success2('data',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }
}