<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/2/3 Time: 下午8:48
// +----------------------------------------------------------------------

namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;
use limx\tools\LRedis;

class QueueTask extends Task
{
    public function mainAction()
    {
        $config = [
            'host' => '127.0.0.1',
            'auth' => '',
            'port' => '6379',
        ];
        $redis = LRedis::getInstance($config);
        echo "queue begin" . PHP_EOL;
        while (true) {
            $res = $redis->brpop('phalcon:test:queue', 30);
            if (empty($res)) {
                echo "30s内没有消息进入！" . PHP_EOL;
                continue;
            }
            print_r($res);
        }
    }

}