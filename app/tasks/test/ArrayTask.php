<?php

namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;

class ArrayTask extends Task
{
    public function mainAction()
    {
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $res = array_chunk($arr, 3);
        print_r($res);
        $res = array_chunk($arr, 20);
        print_r($res);
    }

}