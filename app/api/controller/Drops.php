<?php


namespace app\api\controller;


use app\BaseController;
use app\api\model\Drops as DropsModel;
use think\App;
use think\facade\Db;

class Drops extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    // 取得Minting觀測站
    public function index()
    {
        $request = [
            'token' => $this->request->param('token',''),
            'lan' => $this->request->param('lan',1),
            'count' => $this->request->param('count',20),
            'page' => $this->request->param('page',1),
            'date' => $this->request->param('date','')
        ];

        $where = array();
        if ($request['date']) {
            $where['date'] = $request['date'];
        }

        $field = 'id,collection_url,collection,tag,introduction,price,blockchain,total,date,website,twitter,discord,mint_url,member,roadmap';
        $offset = ($request['page'] - 1) * $request['count'];
        $length = $request['count'];

        try {
            // 这里是主体代码
            $data = DropsModel::where('valid',1)
                ->where('date','>=',date('Y-m-d H:i:s'))
                ->where($where)
                ->field($field)
                ->limit($offset,$length)
                ->order('date asc')
                ->select()
                ->toArray();

            if ($data) {
                $translate = [
                    'introduction' => array(),
                    'member' => array(),
                    'roadmap' => array()
                ];
                foreach ($data as $k => $v) {
                    foreach ($translate as $k_t => $v_t) {
                        if ($v[$k_t]) {
                            $translate[$k_t][$k] = $v[$k_t];
                        }
                    }
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