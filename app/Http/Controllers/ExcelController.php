<?php

namespace App\Http\Controllers;

use App\Imports\TransImport;
use App\Models\Trans;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //
    public function import()
    {
        $path = storage_path().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.'interest_repeat.xlsx';
        $array = Excel::toArray(new TransImport, 'interest_repeat.xlsx');
        dd($array[0][1]);
        foreach ($array[0] as $index => $item) {
            if($index == 0) {
                continue;
            }

            $trans = Trans::findData($item[0]);
            if($trans) {
                $trans->itrans_amount = $trans->itrans_amount+$item[3];
                $trans->save();
            } else {
                $trans = new Trans();
                $trans->id_num = $item[0];
                $trans->itrans_amount = $item[3];
            }
            
        }


       // Excel::import(new TransImport, 'interest_repeat.xlsx');

        //return redirect('/')->with('success', 'All good!');
    }

    public function test(){
        $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'20181006_err_with_hf.txt';
        $main_arr= $this->readConfirmFile($path);
        var_dump($main_arr[0]);
        $path1 = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'20181010_interest_detail.csv';
        $child_arr= $this->readConfirmFile($path1);
        foreach ($child_arr as $index => $item) {
            $i = $item[0];
            $child[$i] = $item;
        }

        $do_child = [];
        $list[]        = ['id_num', 'hf_amount', 'local_amount', 'diff_amount'];
        foreach ($main_arr as $index => $item) {
            $id_num      = $item[0];
            $main_amount = abs($item[3]);

            if (isset($child[$id_num]) && !empty($child[$id_num][1])) {
                $child_amount = (int)$child[$id_num][1];
                $diff_amount  = $main_amount - $child_amount;
                $str          = [$id_num, $main_amount, $child_amount, $diff_amount];

                $do_child[] = $id_num;
            } else {
                $str = [$id_num, $main_amount, 0, $main_amount];
            }
            $list[] = $str;
        }
        $this->writeCSV($list);

    }

    public function writeCSV($list){
        $path = storage_path().DIRECTORY_SEPARATOR.'20181010_interest_diff.csv';

        $fp = fopen($path, 'w');

        foreach ($list as $line) {
            fputcsv($fp, $line);
        }

        fclose($fp);
    }

    public function readConfirmFile($filePath)
    {
        $file = fopen($filePath, 'r');
        //首行是处理条数
//        if (!feof($file)) {
//            fgets($file);
//        } else {
//            throw new \Exception('文件解析异常，无法获取总条数');
//        }
        $flowItems = [];
        while (!feof($file)) {
            $line = fgets($file);

            if (!$line) {
                throw new \Exception('文件' . $filePath . '格式不对，存在空白行或没有END结束符！');
            }
            //END是确认文件的结束标志
            if ($line === 'END') {
                break;
            }
            //去除换行符，并把字符串转换为数组
            $arr = explode(',', str_replace(PHP_EOL, '', $line));
            if (!$arr) {
                throw new \Exception('格式不对，无法解析');
            }
            array_push($flowItems, $arr);
        }
        fclose($file);

        return $flowItems;
    }


}
