<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/12/26 Time: 9:51
// +----------------------------------------------------------------------
namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;

class Test2Task extends Task
{
    public function mainAction($params = [])
    {
        echo "test2" . PHP_EOL;
        print_r($params);
    }
}