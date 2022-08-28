<?php


namespace app\api\controller;


use app\BaseController;
use app\api\model\ProfitStat as ProfitStatModel;
use app\api\model\Collection as CollectionModel;
use app\api\model\Exchange as ExchangeModel;
use think\App;
use think\facade\Db;

class Nft extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    // NFT分析-熱門排行
    public function hotcollections()
    {
        $request = [
            // 登入用token   允許空
            'token' => $this->request->param('token',''),
            // 週期, 默認1   // 1: 24h  2:7d   3:30d   允許不傳
            'ind' => $this->request->param('ind',1),
            // 每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
            'count' => $this->request->param('count',30),
            // 返回第幾頁的數據
            'page' => $this->request->param('page',1),
            // 排序, 默認1; 1: volume_24  2: volume_7d   3: volume_30d
            'orderby' => $this->request->param('orderby',1),
            // 排序方向 , 默認1; 1:desc   2:asc
            'orderby_ind' => $this->request->param('orderby_ind',1),
        ];

        $orderby = ['volume_24','volume_7d','volume_30d'];
        $orderby_ind = ['desc','asc'];
        $order = $orderby[$request['orderby'] - 1] . ' ' . $orderby_ind[$request['orderby_ind'] - 1];

        $field = 'id,name,photo_url,floor_price,holders,item_qty,unit,volume_24,volume_24_p,volume_7d,volume_7d_p,volume_30d,volume_30d_p';
        $offset = ($request['page'] - 1) * $request['count'];
        $length = $request['count'];

        // 若>1000 需 * 0.001 取四捨五入小數兩位, 後面加上k , ex : 若1017, 就返回: 1,02k
        $check = ['floor_price', 'item_qty', 'holders', 'volume_24', 'volume_7d', 'volume_30d'];
        // 若為0 就返回 --
        $check2 = ['volume_24_p', 'volume_7d_p'];

        try {
            $data = CollectionModel::where('valid',1)
                ->field($field)
                ->limit($offset,$length)
                ->order($order)
                ->select()
                ->toArray();


            foreach ($data as $k => $v) {
                $data[$k]['unit_photo'] = ExchangeModel::where('cur',$v['unit'])
                    ->find()['photo_url'];
                foreach ($check as $k_f => $v_f) {
                    if ($v[$v_f] > 1000) {
                        $data[$k][$v_f] = round($v[$v_f] * 0.001,2) . 'k';
                    }
                }
                foreach ($check2 as $k_f => $v_f) {
                    if ($v[$v_f] == 0) {
                        $data[$k][$v_f] = '--';
                    }
                }
            }

            return success2('hot_collections',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }

    // NFT分析-高勝率錢包
    public function highprofit()
    {
        $request = [
            // 登入用token   允許空
            'token' => $this->request->param('token',''),
            // 週期, 默認4   // 1: 24h  2:7d   3:30d  4:60d
            'ind' => $this->request->param('ind',4),
            // 每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
            'count' => $this->request->param('count',30),
            // 返回第幾頁的數據
            'page' => $this->request->param('page',1),
            // 排序, 默認1   // 1: win_p  2: win_ct   3: txn_ct
            'orderby' => $this->request->param('orderby',1),
            // 排序方向 , 默認1  //1:desc   2:asc
            'orderby_ind' => $this->request->param('orderby_ind',1),
        ];

        $orderby = ['win_p','win_ct','txn_ct'];
        $orderby_ind = ['desc','asc'];
        $order = $orderby[$request['orderby'] - 1] . ' ' . $orderby_ind[$request['orderby_ind'] - 1];

        $field = 'id,period,address,win_p,txn_ct,win_ct,lost_ct';
        $offset = ($request['page'] - 1) * $request['count'];
        $length = $request['count'];

        // 若為0 就返回 --, 若>0 , 需*100後取四捨五入到小數2位, 加上 %符號 ex: 若返為0.12386 ,返回 +12.39%
        $check = ['win_p'];
        try {
            $data = ProfitStatModel::where('period',$request['ind'])
                ->where('txn_ct','>',5)
                ->field($field)
                ->limit($offset,$length)
                ->order($order)
                ->select()
                ->toArray();

            foreach ($data as $k => $v) {
                $data[$k]['other_txns'] = 'https://etherscan.io/address/'.$v['address'].'#tokentxnsErc721';

                foreach ($check as $k_f => $v_f) {
                    if ($v[$v_f] == 0) {
                        $data[$k][$v_f] = '--';
                    } elseif ($v[$v_f] > 0) {
                        $data[$k][$v_f] = round($v[$v_f] * 100,2) . '%';
                    }
                }
            }

            return success2('high_profit',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }
}