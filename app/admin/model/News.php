<?php


namespace app\admin\model;

use think\Model;

class News extends Model
{
    //查找企劃
    public function getNewsPlan($searchParams,$data)
    {
        $field = 'id,title,sub_title,content,start_date,large_photo_url,middle_photo_url,smal_photo_url,source,valid,createName,create_time,editTime';

        $where = [];
        $where[] = array('ind','=',3);
        if (!empty($searchParams['title'])){
            $where[] = array('title','like',$searchParams['title'] . '%%');
        }
        if (!empty($searchParams['sub_title'])){
            $where[] = array('sub_title','like',$searchParams['sub_title'] . '%%');
        }
        if (!empty($searchParams['content'])){
            $where[] = array('sub_title','like',$searchParams['sub_title'] . '%%');
        }
        if (!empty($searchParams['valid'])){
            $where[] = array('valid','=',$searchParams['valid']);
        }

        $list = $this->field($field)
            ->where($where)
            ->page($data['page'])
            ->order('id desc')
            ->paginate($data['count']);
        return $list;
    }

    //查找新聞
    public function getNews($searchParams,$data)
    {
        $field = 'id,title,sub_title,content,start_date,smal_photo_url,source,valid,createName,create_time,editTime';
        $where = [];
        $where[] = array('ind','=',1);
        if (!empty($searchParams['title'])){
            $where[] = array('title','like',$searchParams['title'] . '%%');
        }
        if (!empty($searchParams['sub_title'])){
            $where[] = array('sub_title','like',$searchParams['sub_title'] . '%%');
        }
        if (!empty($searchParams['content'])){
            $where[] = array('sub_title','like',$searchParams['sub_title'] . '%%');
        }
        if (!empty($searchParams['valid'])){
            $where[] = array('valid','=',$searchParams['valid']);
        }

        $list = $this->field($field)
            ->where($where)
            ->page($data['page'])
            ->order('id desc')
            ->paginate($data['count']);
        return $list;
    }

    //查找專欄
    public function getColumn($search,$data)
    {
        $field = 'id,title,sub_title,content,start_date,large_photo_url,smal_photo_url,source,valid,createName,create_time,editTime';
        $where = [];
        $where[] = array('ind','=',2);
        if (!empty($searchParams['title'])){
            $where[] = array('title','like',$searchParams['title'] . '%%');
        }
        if (!empty($searchParams['sub_title'])){
            $where[] = array('sub_title','like',$searchParams['sub_title'] . '%%');
        }
        if (!empty($searchParams['content'])){
            $where[] = array('sub_title','like',$searchParams['sub_title'] . '%%');
        }
        if (!empty($searchParams['valid'])){
            $where[] = array('valid','=',$searchParams['valid']);
        }

        $list = $this->field($field)
            ->where($where)
            ->page($data['page'])
            ->order('id desc')
            ->paginate($data['count']);
        return $list;
    }

    //添加更新企劃數據
    public function savePlanData($data, $username)
    {
        $data['ind'] = 3;
        if (!empty($data['valid'])){
            $data['valid'] = 1;
        }else{
            $data['valid'] = 2;
        }
        if (!empty($data['id'])) {
            $data['editTime'] = date('Y-m-d H:i:s', time());
            $data['editName'] = $username;
            $res = $this->update($data);
            return $res;
        } else {
            $data['createName'] = $username;
            $res = $this->save($data);
            return $res;
        }
    }

    //添加更新新聞數據
    public function saveNewsData($data, $username)
    {
        $data['ind'] = 1;
        if (!empty($data['valid'])){
            $data['valid'] = 1;
        }else{
            $data['valid'] = 2;
        }
        if (!empty($data['id'])) {
            $data['editTime'] = date('Y-m-d H:i:s', time());
            $data['editName'] = $username;
            $res = $this->update($data);
            return $res;
        } else {
            $data['createName'] = $username;
            $res = $this->save($data);
            return $res;
        }
    }

    //添加更新專欄數據
    public function saveColumnData($data, $username)
    {
        $data['ind'] = 2;
        dump($data);die();
        if (!empty($data['valid'])){
            $data['valid'] = 1;
        }else{
            $data['valid'] = 2;
        }
        if (!empty($data['id'])) {
            $data['editTime'] = date('Y-m-d H:i:s', time());
            $data['editName'] = $username;
            $res = $this->update($data);
            return $res;
        } else {
            $data['createName'] = $username;
            $res = $this->save($data);
            return $res;
        }
    }
}