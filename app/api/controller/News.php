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


}