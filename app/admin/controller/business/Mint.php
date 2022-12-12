<?php


namespace app\admin\controller\business;


use app\admin\model\Collection;
use app\api\model\Drops;
use app\common\controller\AdminController;
use EasyAdmin\annotation\NodeAnotation;
use EasyAdmin\annotation\ControllerAnnotation;
use think\App;


/**
 * Class Admin
 * @package app\admin\controller\business
 * @ControllerAnnotation(title="Mint觀測站管理")
 */
class Mint extends AdminController
{

    use \app\admin\traits\Curd;

    protected $sort = [
        'id' => 'desc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new Drops();
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
        //ID			id				必填	新增時候為空，修改時Readonly
        //鏈			blockchain		必填
        //項目			collection		 	必填	輸入框
        //時區(UTC)     utc             必填    菜單 ( -12 -11 ….-1, +0, +1, +2, +3…. +12 )
        //當地時間     ori_date          必填	輸入框
        //時間         date             必填
        if ($this->request->isPost()) {
            $post = $this->request->post();
            if (!empty($post['is_tab'])) {
                $rule = [
                    'blockchain|鏈' => 'require',
                    'collection|項目' => 'require',
//                    'utc|時區(UTC)' => 'require',
                    'valid|狀態' => 'require',
                    'total|項目數' => 'require',
                ];
                if (!$post['utc']) {
                    unset($post['utc']);
                }
                if (!$post['ori_date']) {
                    unset($post['ori_date']);
                }
                if (!$post['date']) {
                    unset($post['date']);
                }
            } else {
                $rule = [
                    'blockchain|鏈' => 'require',
                    'collection|項目' => 'require',
                    'utc|時區(UTC)' => 'require',
                    'ori_date|當地時間' => 'require',
                    'valid|狀態' => 'require',
                    'date|時間' => 'require',
                    'total|項目數' => 'require',
                ];
            }
            $this->validate($post, $rule);

            //转化标签
            if($post['category']) {
                $post['category'] = implode(',', $post['category']);
            }

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

        $utc = [];
        for ($i = -12; $i <= 12; $i++) {
            $utc[] = $i;
        }


        $this->assign('id', $id);
        $this->assign('date', date('Y-m-d'));
        $this->assign('list', []);
        $this->assign('utcList', $utc);
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
            if (!empty($post['is_tab'])) {
                $rule = [
                    'blockchain|鏈' => 'require',
                    'collection|項目' => 'require',
//                    'utc|時區(UTC)' => 'require',
                    'valid|狀態' => 'require',
                    'total|項目數' => 'require',
                ];
                if (!$post['utc']) {
                    unset($post['utc']);
                }
                if (!$post['ori_date']) {
                    unset($post['ori_date']);
                }
                if (!$post['date']) {
                    unset($post['date']);
                }
            } else {
                $rule = [
                    'blockchain|鏈' => 'require',
                    'collection|項目' => 'require',
                    'utc|時區(UTC)' => 'require',
                    'ori_date|當地時間' => 'require',
                    'valid|狀態' => 'require',
                    'date|時間' => 'require',
                    'total|項目數' => 'require',
                ];
            }
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

        $utc = [];
        for ($i = -12; $i <= 12; $i++) {
            $utc[] = $i;
        }

        if($row['category']) {
            $row['category'] = explode(',' , $row['category']);
        }

        $this->assign([
            'id' => $id,
            'row' => $row,
            'utcList' => $utc,
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