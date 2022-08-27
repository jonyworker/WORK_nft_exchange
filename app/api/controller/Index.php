<?php


namespace app\api\controller;


use app\BaseController;
use app\api\model\Banner as BannerModel;
use app\api\model\Collection as CollectionModel;
use app\api\model\Exchange as ExchangeModel;
use think\App;
use think\facade\Db;

class Index extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    // 第一區廣告圖
    public function banner()
    {
        $request = [
            'token' => $this->request->param('token',''),
            'lan' => $this->request->param('lan',1)
        ];

        $field = 'id,banner_url,description,ext_url';

        try {
            $data = BannerModel::where('valid',1)
                ->where('start_date','<=',date('Y-m-d'))
                ->where('end_date','>=',date('Y-m-d'))
                ->field($field)
                ->order('id asc')
                ->select()
                ->toArray();

            if ($data) {
                $translate = [
                    'description' => array()
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
                        $data[$v_g['key']][$k] = $v_g;
                    }
                }
            }

            return success2('banners',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }

    // 第二區熱門排行
    public function hotcollections()
    {
        $request = [
            'token' => $this->request->param('token',''),
            'lan' => $this->request->param('lan',1),
            'ind' => $this->request->param('ind',1)
        ];

        if ($request['ind'] == 1) {
            $order = 'volume_24';
        } elseif ($request['ind'] == 2) {
            $order = 'volume_7d';
        } elseif ($request['ind'] == 3) {
            $order = 'volume_30d';
        }

        $field = 'id,name,photo_url,floor_price,unit,volume_24,volume_24_p,volume_7d,volume_7d_p,volume_30d,volume_30d_p';

        try {
            $data = CollectionModel::where('valid',1)
                ->field($field)
                ->limit(15)
                ->order($order)
                ->select()
                ->toArray();

            foreach ($data as $k => $v) {
                $data[$k]['unit_photo'] = ExchangeModel::where('cur',$v['unit'])
                    ->find()['photo_url'];
            }

            return success2('hot_collections',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }


}