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

namespace app\admin\service;

use think\File;

class UploadFile
{


    /**
     * 当前实例对象
     * @var object
     */
    protected static $instance;

    /**
     * 上传方式
     * @var string
     */
    protected $uploadType = 'local';

    /**
     * 上传配置文件
     * @var array
     */
    protected $uploadConfig;

    /**
     * 需要上传的文件对象
     * @var File
     */
    protected $file;

    /**
     * 获取对象实例
     * @return object|UploadFile
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }


    /**
     * 设置上传对象
     * @param $value
     * @return UploadFile
     */
    public function setFile($value)
    {
        $this->file = $value;
        return $this;
    }

    /**
     * 设置上传文件
     * @param $value
     * @return $this
     */
    public function setUploadConfig($value)
    {
        $this->uploadConfig = $value;
        return $this;
    }

    /**
     * 设置上传方式
     * @param $value
     * @return $this
     */
    public function setUploadType($value)
    {
        $this->uploadType = $value;
        return $this;
    }


    /**
     * 保存文件
     * @return array|void
     */
    public function save()
    {
        $obj = null;
        if ($this->uploadType == 'local') {
            $obj = new Local();
        }
        $save = $obj->setUploadConfig($this->uploadConfig)
            ->setUploadType($this->uploadType)
            ->setFile($this->file)
            ->save();
        return $save;
    }
}