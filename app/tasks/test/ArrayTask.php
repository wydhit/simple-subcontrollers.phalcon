<?php

namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;
use limx\phalcon\Cli\Color;

class ArrayTask extends Task
{
    public function mainAction()
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  Array函数测试') . PHP_EOL . PHP_EOL;

        echo Color::head('Usage:') . PHP_EOL;
        echo Color::colorize('  php run Test\\\\Array [action]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Actions:') . PHP_EOL;
        echo Color::colorize('  chunk                   数组重新分组', Color::FG_GREEN) . PHP_EOL;
        echo Color::colorize('  case    [upper|lower]   修改键名为全大写或小写', Color::FG_GREEN) . PHP_EOL;

    }

    public function caseAction($params)
    {
        if (count($params) == 0) {
            echo Color::error("请输入参数！upper|lower");
            return;
        }
        $type = $params[0] == 'upper' ? CASE_UPPER : CASE_LOWER;
        $data = ['test' => 'tt', 'Tes' => 123, 'AA' => 'sdf'];
        echo Color::head("原数组：") . PHP_EOL;
        echo Color::colorize("  " . json_encode($data), Color::FG_LIGHT_GREEN) . PHP_EOL;
        echo Color::head("array_change_key_case(data,type)") . PHP_EOL;
        echo Color::colorize("  " . json_encode(array_change_key_case($data, $type)), Color::FG_LIGHT_GREEN) . PHP_EOL;
    }

    public function chunkAction()
    {
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        echo Color::head("原数组：") . PHP_EOL;
        echo Color::colorize("  " . json_encode($arr), Color::FG_LIGHT_GREEN) . PHP_EOL;
        $res = array_chunk($arr, 3);
        echo Color::head("3个一组分组：") . PHP_EOL;
        echo Color::colorize("  " . json_encode($res), Color::FG_LIGHT_GREEN) . PHP_EOL;
        $res = array_chunk($arr, 20);
        echo Color::head("20个一组分组：") . PHP_EOL;
        echo Color::colorize("  " . json_encode($res), Color::FG_LIGHT_GREEN) . PHP_EOL;
    }


}