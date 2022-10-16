<?php


namespace app\admin\controller\business;


use app\admin\model\Collection;
use app\common\controller\AdminController;
use EasyAdmin\annotation\NodeAnotation;
use EasyAdmin\annotation\ControllerAnnotation;
use think\App;


/**
 * Class Admin
 * @package app\admin\controller\business
 * @ControllerAnnotation(title="廣告管理")
 */
class Banner extends AdminController
{

    use \app\admin\traits\Curd;

    protected $sort = [
        'id' => 'desc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new \app\api\model\Banner();
    }

    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            if (input('selectFields')) {
                return $this->selectList();
            }

            list($page, $limit, $where) = $this->buildTableParames();
            $where[] = ['valid', '=', 1];

            $count = $this->model
                ->where($where)
                ->count();
            $list = $this->model
                ->where($where)
                ->page($page, $limit)
                ->order($this->sort)
                ->select();

            $data = [
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $list,
            ];
            return json($data);
        }
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="添加")
     */
    public function add($id = null)
    {
        //ID         id              只讀
        //開始日      start_date      必須填寫
        //結束日      end_date        必須填寫
        //廣告圖      banner_url      必須填寫  取出為：顯示縮圖,點了另開新窗看大圖片
        //廣告位置    ind             對應配置banner_ind , 參考底下 說明1
        //廣告文字    description     允許空
        //廣告連結    ext_url         允許空
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $rule = [
                'start_date|開始日' => 'require',
                'end_date|結束日' => 'require',
                'banner_url|廣告圖' => 'require',
                'ind|廣告位置' => 'require',
            ];
            $this->validate($post, $rule);

            try {
                $post['createName'] = session('admin.username');
                $save = $this->model->save($post);
            } catch (\Exception $e) {
                $this->error('保存失败');
            }
            if ($save) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }

        $bannerInd = config('systemSetup.banner_ind');


        $this->assign('id', $id);
        $this->assign('date', date('Y-m-d'));
        $this->assign('list', []);
        $this->assign('bannerInd', $bannerInd);
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="编辑")
     */
    public function edit($id)
    {
        $row = $this->model->find($id);
        empty($row) && $this->error('数据不存在');
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $rule = [
                'start_date|開始日' => 'require',
                'end_date|結束日' => 'require',
                'banner_url|廣告圖' => 'require',
                'ind|廣告位置' => 'require',
            ];
            $this->validate($post, $rule);
            try {
                $post['update_time'] = date('Y-m-d H:i:s');
                $save = $row->save($post);
            } catch (\Exception $e) {
                $this->error('保存失败');
            }
            if ($save) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }

        $bannerInd = config('systemSetup.banner_ind');

        $this->assign([
            'id' => $id,
            'row' => $row,
            'bannerInd' => $bannerInd,
        ]);
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="删除")
     */
    public function delete($id)
    {
        $this->checkPostRequest();
        $row = $this->model->whereIn('id', $id)->select();
        empty($row) && $this->error('数据不存在');
        try {
            $save = $row->delete();
        } catch (\Exception $e) {
            $this->error('删除失败');
        }
        if ($save) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}