<?php


namespace app\api\controller;

use app\admin\service\UploadFile;
use app\BaseController;
use think\App;
use think\response\Json;

class Upload extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function image() :? Json
    {
        $data = [
            'upload_type' => 'local',
            'file' => $this->request->file('file'),
        ];
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
            return json(['state' => 'FAIL', 'message' => '上传文件失败']);
        }
        if ($upload['save']) {
            return json(['state' => 'OK', 'url' => $upload['url']]);
        } else {
            return json(['state' => 'FAIL', 'url' => $upload['msg']]);
        }
    }



}