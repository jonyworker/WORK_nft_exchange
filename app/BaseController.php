<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

    /** * Desc: * Created by Joker * Date: 2019/7/3 * Time: 10:36
     * @param $text 翻译为中文
     * @param string $to zh-CN:翻译为中文 en:翻译为英文
     * @return string
     */
    // 谷歌翻译
    protected function google($text=array(),$lan=1) {
        print_r($text);exit;
        // 1:繁體中文 2:簡體中文 3:英文   4:日   5:韓
        $target = ['zh-TW','zh-CN','en','ja','ko'];
        $apiKey = config('google.apiKey');
        $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&source=&target='.$target[$lan];
        $key = array();
        foreach ($text as $k => $v) {
            $url .= '&q=' . rawurlencode($v);
            $key[] = $k;
        }

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);
        $responseDecoded = json_decode($response, true);
        curl_close($handle);

        $data = array();
        foreach ($responseDecoded['data']['translations'] as $k => $v) {
            $data[$key[$k]] = $v;
        }

        return $data;
    }
}
