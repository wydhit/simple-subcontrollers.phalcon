<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/1/17 Time: 下午3:01
// +----------------------------------------------------------------------
namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;

class SortTask extends Task
{
    const NUM = 1000;

    public function mainAction()
    {
        $arr = [];
        for ($i = 0; $i < self::NUM; $i++) {
            $arr[] = rand(1, self::NUM);
        }
        $num = self::NUM - 1;
        $time = time() + microtime();
//        sort($arr);
//        $arr = $this->sort($arr);
        $this->qsort($arr, 0, $num);
//        $arr = \Demo\Hello::sort($arr);

//        $demo = new \Demo\Hello();
//        $demo->qsortInit($arr);
//        $demo->qsort(0, $num);
//        $arr = $demo->output();

        echo time() + microtime() - $time;
//        echo PHP_EOL;
//        print_r($arr);
    }

    private function sort($arr)
    {
        $count = count($arr);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count; $j++) {
                if ($arr[$j] > $arr[$i]) {
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
        return $arr;
    }

    private function qsort(&$arr, $start, $end)
    {
        if ($start >= $end) {
            return;
        }
        $index = $start;
        $index2 = $end;
        while ($start < $end) {
            if ($arr[$end] < $arr[$index]) {
                if ($arr[$start] >= $arr[$index]) {
                    $this->exchange($arr, $end, $start);
                } else {
                    $start++;
                }
            } else {
                $end--;
            }

        }
        $this->exchange($arr, $index, $start);
        $this->qsort($arr, $index, $start);
        $this->qsort($arr, $start + 1, $index2);
    }

    private function exchange(&$arr, $i, $j)
    {
        $temp = $arr[$j];
        $arr[$j] = $arr[$i];
        $arr[$i] = $temp;
    }
}