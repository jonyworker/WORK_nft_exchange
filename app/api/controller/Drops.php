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
//                ->where('date','>=',date('Y-m-d H:i:s'))
                ->where($where)
                ->field($field)
                ->limit($offset,$length)
                ->order('date asc')
                ->select()
                ->toArray();

            return success2('banners',$data);
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return error2($e->getMessage());
        }
    }


    // 谷歌翻译
    protected function google() {
        $apiKey = config('google.private_key_id');
        $text = 'Hello world!';
        $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target=fr';
        print_r($url);exit;
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);
        $responseDecoded = json_decode($response, true);
        curl_close($handle);

        echo 'Source: ' . $text . '<br>';
        echo 'Translation: ' . $responseDecoded['data']['translations'][0]['translatedText'];
        exit;
    }


    // 谷歌翻译
    public function google2($text = '你好',$to='zh-CN') {
        $entext = urlencode($text);
        $url = 'https://translate.google.cn/translate_a/single?client=gtx&dt=t&ie=UTF-8&oe=UTF-8&sl=auto&tl='.$to.'&q='.$entext;
        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS,20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 40);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        if(!empty($result)){
            foreach($result[0] as $k){
                $v[] = $k[0];
            }
            return implode(" ", $v);
        }
    }
}