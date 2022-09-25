<?php


namespace app\admin\controller\business;


use app\common\controller\AdminController;
use EasyAdmin\annotation\NodeAnotation;
use EasyAdmin\annotation\ControllerAnnotation;
use think\App;
use app\admin\model\News as NewsModel;


/**
 * Class Admin
 * @package app\admin\controller\business
 * @ControllerAnnotation(title="新聞管理")
 */
class News extends AdminController
{

    use \app\admin\traits\Curd;

    protected $sort = [
        'id' => 'asc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new NewsModel();
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

//            $where[] = ['valid', '=', 1];
            $where[] = ['ind', '=', $this->model::Types['news']];
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
                'title|主標' => 'require',
                'content|內文' => 'require',
            ];
            $this->validate($post, $rule);
            try {
                $post['valid'] = $post['valid'] == 'on' ? 1 : 2;
                $post['ind'] = $this->model::Types['news'];
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
                'title|主標' => 'require',
                'content|內文' => 'require',
            ];
            $this->validate($post, $rule);
            try {
                $post['valid'] = $post['valid'] == 'on' ? 1 : 2;
                $post['ind'] = $this->model::Types['news'];
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
        $this->assign([
            'id' => $id,
            'pidMenuList' => [],
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
}