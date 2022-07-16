<?php


namespace app\news\model;

use think\Model;

class News extends Model
{
    //查找企劃
    public function getNewsPlan($search)
    {
        $field = 'id,title,sub_title,content,start_date,large_photo_url,middle_photo_url,smal_photo_url,source,valid,createName,create_time,editTime';
        $list = $this->field($field)
            ->where([
                ['ind', '=', 3],
                ['title', 'like', $search['title'] . '%%'],
                ['sub_title', 'like', $search['sub_title'] . '%%'],
                ['content', 'like', $search['content'] . '%%'],
            ])
            ->whereOr('valid',$search['valid'])
            ->order('id desc')
            ->select();

        return $list;
    }

    //查找新聞
    public function getNews($search)
    {
        $field = 'id,title,sub_title,content,start_date,smal_photo_url,source,valid,createName,create_time,editTime';
        $list = $this->field($field)
            ->where([
                ['ind', '=', 1],
                ['title', 'like', $search['title'] . '%%'],
                ['sub_title', 'like', $search['sub_title'] . '%%'],
                ['content', 'like', $search['content'] . '%%'],
            ])
            ->whereOr('valid',$search['valid'])
            ->order('id desc')
            ->select();
        return $list;
    }

    //查找專欄
    public function getColumn($search)
    {
        $field = 'id,title,sub_title,content,start_date,large_photo_url,middle_photo_url,smal_photo_url,source,valid,createName,create_time,editTime';
        $list = $this->field($field)
            ->where([
                ['ind', '=', 2],
                ['title', 'like', $search['title'] . '%%'],
                ['sub_title', 'like', $search['sub_title'] . '%%'],
                ['content', 'like', $search['content'] . '%%'],
            ])
            ->whereOr('valid',$search['valid'])
            ->order('id desc')
            ->select();
        return $list;
    }

    //添加更新企劃數據
    public function savePlanData($data, $id, $username = '')
    {
        $data['ind'] = 3;
        if (!empty($id)) {
            $data['editTime'] = date('Y-m-d H:i:s', time());
            $data['editName'] = $username;
            $res = $this->update($data, ['id' => $id]);

            return $res;
        } else {
            $data['createName'] = $username;
            $res = $this->save($data);
            return $res;
        }
    }

    //添加更新新聞數據
    public function saveNewsData($data, $id, $username = '')
    {
        $data['ind'] = 1;
        if (!empty($id)) {
            $data['editTime'] = date('Y-m-d H:i:s', time());
            $data['editName'] = $username;
            $res = $this->update($data, ['id' => $id]);

            return $res;
        } else {
            $data['createName'] = $username;
            $res = $this->save($data);
            return $res;
        }
    }

    //添加更新新聞數據
    public function saveColumnData($data, $id, $username = '')
    {
        $data['ind'] = 1;
        if (!empty($id)) {
            $data['editTime'] = date('Y-m-d H:i:s', time());
            $data['editName'] = $username;
            $res = $this->update($data, ['id' => $id]);

            return $res;
        } else {
            $data['createName'] = $username;
            $res = $this->save($data);
            return $res;
        }
    }
}