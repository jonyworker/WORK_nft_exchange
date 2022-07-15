<?php


namespace app\news\model;


use think\Exception;
use think\Model;

class News extends Model
{

    public function savePlanData($data,$id,$username='')
    {
        $data['ind'] = 3;
        if (!empty($id)){
            $data['editTime'] = date('Y-m-d H:i:s',time());
            $data['editName'] = $username;
            $res = $this->update($data,['id'=>$id]);

            return $res;
        }else{
            $data['createName'] = $username;
            $res = $this->save($data);
            return $res;
        }
    }
}