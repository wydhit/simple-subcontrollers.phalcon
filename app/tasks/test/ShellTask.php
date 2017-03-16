<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/3/16 Time: 下午6:46
// +----------------------------------------------------------------------
namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;
use limx\phalcon\Cli\Color;

class ShellTask extends Task
{
    public function mainAction()
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  Composer测试') . PHP_EOL . PHP_EOL;

        echo Color::head('Usage:') . PHP_EOL;
        echo Color::colorize('  php run Test\\\\Shell [action]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Actions:') . PHP_EOL;
        echo Color::colorize('  download    $num        循环下载phalcon-project', Color::FG_GREEN) . PHP_EOL;
    }

    public function downloadAction($params)
    {
        $num = 10;
        if (count($params) > 0) {
            $num = intval($params[0]);
        }
        $str = "composer create-project --prefer-dist limingxinleo/phalcon-project demo";
        for ($i = 0; $i < $num; $i++) {
            $shell = $str . uniqid();
            system($shell);
        }
    }
}