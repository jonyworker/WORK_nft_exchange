<?php


namespace app\news\model;

use think\Model;

class News extends Model
{
    public function getNewsPlan($search)
    {
        $field = 'id,title,sub_title,content,start_date,large_photo_url,middle_photo_url,smal_photo_url,source,valid,createName,create_time,editTime';
        $list = $this->field($field)
            ->where([
                ['ind', '=', 3],
                ['title', 'like', $search['title'] . '%%'],
                ['sub_title', 'like', $search['sub_title'] . '%%'],
                ['content', 'like', $search['content'] . '%%'],
                ['valid', '=', $search['valid']],
            ])
            ->order('id desc')
            ->select();
        return $list;
    }

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
}