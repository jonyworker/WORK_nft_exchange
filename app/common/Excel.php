<?php
//导出excel表格

namespace app\common;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use think\facade\Db;

class Excel
{
    /** 导出表格
     * @param array $data   導出數據
     * @param array $field_title  字段含義
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function export(array $data = [],array $field_title = [])
    {
        //获取要传参的字段
        $i = 0;
        $fields = [];
        foreach ($data[0] as $key => $val){
            $fields[$i] = $key;
            $i++;
        }

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
        //终止进程
        exit;
    }
}