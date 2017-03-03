<?php
// +----------------------------------------------------------------------
// | MathTask php 数学运算测试 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/3/3 Time: 上午9:43
// +----------------------------------------------------------------------
namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;
use limx\phalcon\Cli\Color;

class MathTask extends Task
{
    public function mainAction()
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  PHP数学运算测试') . PHP_EOL . PHP_EOL;

        echo Color::head('Usage:') . PHP_EOL;
        echo Color::colorize('  php run Test\\\\Math [action]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Actions:') . PHP_EOL;
        echo Color::colorize('  floor [num]     取整测试', Color::FG_GREEN) . PHP_EOL;
    }

    public function floorAction($params)
    {
        foreach ($params as $num) {
            echo Color::colorize("取整数字为{$num}", Color::FG_LIGHT_RED) . PHP_EOL;
            echo Color::colorize("  floor 舍去法       " . floor($num)) . PHP_EOL;
            echo Color::colorize("  ceil  进一法       " . ceil($num)) . PHP_EOL;
            echo Color::colorize("  round 四舍五入     " . round($num)) . PHP_EOL;
            echo PHP_EOL;
        }
    }
}