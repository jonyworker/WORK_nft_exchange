<?php
//导出excel表格

namespace app\common;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use think\facade\Db;

class Excel
{

    public function export(array $data = [],array $fields = [])
    {
        if (!is_array($data)){
            return false;
        }

        //获取要传参的字段
        $i = 0;
        foreach ($data[0] as $key => $val){
            $fields[$i] = $key;
            $i++;
        }

        //定义字段的含义(顺序要与data传值字段相同)
        $field_title = [
            'id' => 'ID',
            'title' => '主標',
            'sub_title' => '副標',
            'content' => '內文',
            'start_date' => '上架日',
            'large_photo_url' => '專欄大圖',
            'middle_photo_url' => '專欄中圖',
            'smal_photo_url' => '專欄小圖',
            'source' => '來源',
            'valid' => '狀態',
            'createName' => '建單人員',
            'create_time' => '新增時間',
            'editTime' => '修改時間',
        ];

        $field_res = [];
        //然后根据所需导出的字段组成相应的结果集
        foreach ($fields as $k => $v) {
            $field_res[$k]['title'] = $field_title[$v];
            $field_res[$k]['field'] = $v;
        }


        $spreadsheet = new Spreadsheet();
        //获取活动工作簿
        $sheet = $spreadsheet->getActiveSheet();
        $startRow = 1; // 数据起始行

        foreach ($data as $key => $value) {
            foreach ($field_res as $k => $v) {
                //列数,默认1是A,2是B
                $column = Coordinate::stringFromColumnIndex($k + 1);
                if ($key == 0) {
                    $sheet->setCellValue($column . $startRow, $v['title']);
                    $sheet->getColumnDimension($column)->setWidth(20);
                }
                $i = $key + 2; //表格是从2开始的
                $sheet->setCellValue($column . $i, $value[$v['field']]);
            }
        }

        //表格名称
        $filename = date('YmdHis', time()) . '.xlsx';
        // make file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        header('Pragma: public');
        //生成xlsx文件
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}