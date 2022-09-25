<?php

namespace app\admin\service;

use EasyAdmin\upload\FileBase;
use think\facade\Filesystem;


/**
 * 本地上传
 * Class Local
 * @package EasyAdmin\upload\driver
 */
class Local extends FileBase
{

    /**
     * 上传文件对象
     * @var object
     */
    protected $file;


    /**
     * 重写上传方法
     * @return array|void
     */
    public function save()
    {
        $this->completeFilePath = Filesystem::disk('public')->putFile('upload', $this->file);
        $this->completeFileUrl = request()->domain() . '/storage/' . str_replace(DIRECTORY_SEPARATOR, '/', $this->completeFilePath);

        return [
            'save' => true,
            'msg'  => '上传成功',
            'url'  => $this->completeFileUrl,
        ];
    }

}