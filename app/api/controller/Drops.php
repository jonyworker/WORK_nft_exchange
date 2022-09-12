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

        $offset = ($request['page'] - 1) * $request['count'];
        $length = $request['count'];

        $background = [
            '/nftotal/image/random_1.png',
            '/nftotal/image/random_2.png',
            '/nftotal/image/random_3.png'
        ];

        // 傳入lan=1, introduction取drops.introduction
        //          member取drops.member
        //          roadmap取drops.roadmap
        //    傳入lan =2, introduction 取drops.introduction_cn
        //          member取drops.member_cn
        //          roadmap取drops.roadmap_cn
        //    傳入lan =3, introduction 取drops. introduction_en
        //          member 取drops.member_en
        //          roadmap取drops.roadmap_en
        //    傳入lan =4,  introduction 取drops.introduction_jp
        //                member 取drops. member_jp
        //                roadmap取drops.roadmap_jp
        //傳入lan =5,  introduction 取drops.introduction_ko
        //                member 取drops. member_ko
        //                roadmap取drops.roadmap_ko
        $field = 'id,collection_url,collection,tag,price,blockchain,total,date,website,twitter,discord,mint_url';
        if ($request['lan'] == 1) {
            $field .= ',introduction,member,roadmap';
        } elseif ($request['lan'] == 2) {
            $field .= ',introduction_cn as introduction,member_cn as member,roadmap_cn as roadmap';
        } elseif ($request['lan'] == 3) {
            $field .= ',introduction_en as introduction,member_en as member,roadmap_en as roadmap';
        } elseif ($request['lan'] == 4) {
            $field .= ',introduction_jp as introduction,member_jp as member,roadmap_jp as roadmap';
        } elseif ($request['lan'] == 5) {
            $field .= ',introduction_ko as introduction,member_ko as member,roadmap_ko as roadmap';
        }

        try {
            // 这里是主体代码
            $data = DropsModel::where('valid',1)
                ->where('date >= "'.date('Y-m-d H:i:s').'" OR is_tba = 2')
                ->whereNotNull('date')
                ->where($where)
                ->field($field)
                ->limit($offset,$length)
                ->order('date asc')
                ->select()
                ->toArray();

//            if ($data) {
//                $translate = [
//                    'introduction' => array(),
//                    'member' => array(),
//                    'roadmap' => array()
//                ];
//                foreach ($data as $k => $v) {
//                    $data[$k]['background'] = $background[shuffle($background)];
//                    foreach ($translate as $k_t => $v_t) {
//                        if ($v[$k_t]) {
//                            $translate[$k_t][$k] = $v[$k_t];
//                        }
//                    }
//                }
//
//                foreach ($translate as $k => $v) {
//                    if ($v) {
//                        $google = $this->google2($v,$request['lan']);
//
//                        foreach ($google as $k_g => $v_g) {
//                            $data[$v_g['key']][$k] = $v_g['translations'];
//                        }
//                    }
//                }
//            }

            return success2('data',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }
}