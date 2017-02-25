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
use limx\phalcon\Cli\Color;

class Test2Task extends Task
{
    public function mainAction($params = [])
    {
        $money = 150000 + 200000 - 30000 - 30000;
        $month = 24;
        $sr = 15000 + 4000;
        $res = 0;
        for ($i = 0; $i < $month; $i++) {
            $res += $sr;
        }
        $res = $res - $money;

        echo Color::colorize($res / $month, Color::FG_LIGHT_CYAN);
    }

}