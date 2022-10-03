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
 * @ControllerAnnotation(title="项目管理")
 */
class Projects extends AdminController
{

    use \app\admin\traits\Curd;

    protected $sort = [
        'id' => 'desc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new Collection();
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
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $rule = [
                'blockchain|鏈' => 'require',
                'name|項目' => 'require',
                'contract|合約' => 'require',
                'item_qty|總數' => 'require',
                'valid|狀態' => 'require',
                'process|審核' => 'require',
            ];
            $this->validate($post, $rule);

            //转化标签
            if($post['category']) {
                $post['category'] = implode(',', $post['category']);
            }

            //去掉没有的值
            foreach ($post as $key => $item) {
                if(empty($item)) {
                    unset($post[$key]);
                }
            }

            try {
                $post['createName'] = session('admin.username');
                $save = $this->model->save($post);
            } catch (\Exception $e) {
//                var_dump($e->getMessage());
                $this->error('保存失败' . $e->getMessage());
            }
            if ($save) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        $this->assign('id', $id);
        $this->assign('date', date('Y-m-d'));
        $this->assign('list', []);
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
                'blockchain|鏈' => 'require',
                'name|項目' => 'require',
                'contract|合約' => 'require',
                'item_qty|總數' => 'require',
                'valid|狀態' => 'require',
                'process|審核' => 'require',
            ];
            $this->validate($post, $rule);
            try {
                $post['editName'] = session('admin.username');
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


        if($row['category']) {
            $row['category'] = explode(',' , $row['category']);
        }


        $this->assign([
            'id' => $id,
            'row' => $row,
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

    public function updateNft($id)
    {
        $this->checkPostRequest();
        $row = $this->model->find($id);
        empty($row) && $this->error('数据不存在');
        try {
            $save = $row->save(['bot_process' => 1]);
        } catch (\Exception $e) {
            $this->error('更新NFT資訊失败');
        }

        if ($save) {
            $this->success('更新NFT資訊成功');
        } else {
            $this->error('更新NFT資訊失败');
        }
    }



}