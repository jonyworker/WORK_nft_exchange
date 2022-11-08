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

        $ind = ['新聞','專欄'];

        // 傳入lan=1, title 取news.title
        //          content 取news.content
        // 傳入lan =2, title 取news.title_cn
        //          content 取news.content_cn
        // 傳入lan =3, title 取news.title_en
        //          content 取news.content_en
        // 傳入lan =4,  title 取news.title_jp
        //          content 取news.content_jp
        //傳入lan =5,  title 取news.title_ko
        //          content 取news.content_ko
        $field = 'id,ind,author,start_date,photo_url,source,large_photo_url';
        if ($request['lan'] == 1) {
            $field .= ',title,content';
        } elseif ($request['lan'] == 2) {
            $field .= ',title_cn as title,content_cn as content';
        } elseif ($request['lan'] == 3) {
            $field .= ',title_en_public as title,content_en_public as content';
        } elseif ($request['lan'] == 4) {
            $field .= ',title_jp as title,content_jp as content';
        } elseif ($request['lan'] == 5) {
            $field .= ',title_ko as title,content_ko as content';
        }

        try {
            $data = NewModel::where('id',$request['id'])
                ->field($field)
                ->find();

            $data['ind'] = $ind[$data['ind'] - 1];

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

        $ind = ['新聞','專欄'];

        $offset = ($request['page'] - 1) * $request['count'];
        $length = $request['count'];

        // 傳入lan=1, title 取news.title
        //          content 取news.content
        // 傳入lan =2, title 取news.title_cn
        //          content 取news.content_cn
        // 傳入lan =3, title 取news.title_en
        //          content 取news.content_en
        // 傳入lan =4,  title 取news.title_jp
        //          content 取news.content_jp
        //傳入lan =5,  title 取news.title_ko
        //          content 取news.content_ko
        $field = 'id,ind,author,start_date,large_photo_url as photo_url,source';
        if ($request['lan'] == 1) {
            $field .= ',title,content';
        } elseif ($request['lan'] == 2) {
            $field .= ',title_cn as title,content_cn as content';
        } elseif ($request['lan'] == 3) {
            $field .= ',title_en_public as title,content_en_public as content';
        } elseif ($request['lan'] == 4) {
            $field .= ',title_jp as title,content_jp as content';
        } elseif ($request['lan'] == 5) {
            $field .= ',title_ko as title,content_ko as content';
        }


        try {
            $data = NewModel::where('valid',1)
                ->where('start_date','<=',date('Y-m-d H:i:s'))
                ->where($where)
                ->field($field)
                ->limit($offset,$length)
                ->order('start_date desc')
                ->select()
                ->toArray();

            foreach ($data as $k => $v) {
                $data[$k]['ind'] = $ind[$v['ind'] - 1];
            }

            return success2('data',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }
}