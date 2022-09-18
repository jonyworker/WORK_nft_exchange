<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\AdminUploadfile;
use app\admin\service\UploadFile;
use app\common\controller\AdminController;
use app\common\service\MenuService;
use think\db\Query;
use think\facade\Cache;

class Ajax extends AdminController
{

    /**
     * 初始化后台接口地址
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function initAdmin()
    {
        $cacheData = Cache::get('initAdmin_' . session('admin.id'));
        if (!empty($cacheData)) {
            return json($cacheData);
        }
        $menuService = new MenuService(session('admin.id'));
        $data = [
            'logoInfo' => [
                'title' => 'NfTotal管理',
                'image' => '/static/admin/images/vite.svg',
                'href' => __url('index/index'),
            ],
            'homeInfo' => $menuService->getHomeInfo(),
            'menuInfo' => $menuService->getMenuTree(),
        ];
        Cache::tag('initAdmin')->set('initAdmin_' . session('admin.id'), $data);
        return json($data);
    }

    /**
     * 清理缓存接口
     */
    public function clearCache()
    {
        Cache::clear();
        $this->success('清理缓存成功');
    }

    /**
     * 上传文件
     */
    public function upload()
    {
        $this->checkPostRequest();
        $data = [
            'upload_type' => 'local',
            'file' => $this->request->file('file'),
        ];
//        $uploadConfig = sysconfig('upload');

        $uploadConfig = [
            'upload_type' => 'local',
            'upload_allow_ext' => 'doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg',
            'upload_allow_size' => '1024000',
            'upload_allow_mime' => 'image/gif,image/jpeg,video/x-msvideo,text/plain,image/png',
            'upload_allow_type' => 'local',
        ];
        $rule = [
            'upload_type|指定上传类型有误' => "in:local",
            'file|文件' => "require|file|fileExt:doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg|fileSize:1024000",
        ];
        $this->validate($data, $rule);
        try {
            $upload = UploadFile::instance()
                ->setUploadType($data['upload_type'])
                ->setUploadConfig($uploadConfig)
                ->setFile($data['file'])
                ->save();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        if ($upload['save'] == true) {
            $this->success($upload['msg'], ['url' => $upload['url']]);
        } else {
            $this->error($upload['msg']);
        }
    }

    /**
     * 上传图片至编辑器
     * @return \think\response\Json
     */
    public function uploadEditor()
    {
        $this->checkPostRequest();

        $uploadConfig = [
            'upload_type' => 'local',
            'upload_allow_ext' => 'doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg',
            'upload_allow_size' => '1024000',
            'upload_allow_mime' => 'image/gif,image/jpeg,video/x-msvideo,text/plain,image/png',
            'upload_allow_type' => 'local',
        ];

        $data = [
            'upload_type' => 'local',
            'file' => $this->request->file('upload'),
        ];

        $rule = [
            'upload_type|指定上传类型有误' => "in:{$uploadConfig['upload_allow_type']}",
            'file|文件' => "require|file|fileExt:{$uploadConfig['upload_allow_ext']}|fileSize:{$uploadConfig['upload_allow_size']}",
        ];
        $this->validate($data, $rule);
        try {
            $upload = Uploadfile::instance()
                ->setTableName('admin_uploadfile')
                ->setUploadType($data['upload_type'])
                ->setUploadConfig($uploadConfig)
                ->setFile($data['file'])
                ->save();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        if ($upload['save'] == true) {
            return json([
                'error' => [
                    'message' => '上传成功',
                    'number' => 201,
                ],
                'fileName' => '',
                'uploaded' => 1,
                'url' => $upload['url'],
            ]);
        } else {
            $this->error($upload['msg']);
        }
    }

    /**
     * 获取上传文件列表
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUploadFiles()
    {
        $get = $this->request->get();
        $page = isset($get['page']) && !empty($get['page']) ? $get['page'] : 1;
        $limit = isset($get['limit']) && !empty($get['limit']) ? $get['limit'] : 10;
        $title = isset($get['title']) && !empty($get['title']) ? $get['title'] : null;
        $this->model = new AdminUploadfile();
        $count = $this->model
            ->where(function (Query $query) use ($title) {
                !empty($title) && $query->where('original_name', 'like', "%{$title}%");
            })
            ->count();
        $list = $this->model
            ->where(function (Query $query) use ($title) {
                !empty($title) && $query->where('original_name', 'like', "%{$title}%");
            })
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

}