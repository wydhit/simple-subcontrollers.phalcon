<?php
// +----------------------------------------------------------------------
// | Swoole Timer 测试 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/2/23 Time: 下午2:39
// +----------------------------------------------------------------------
declare(ticks = 1);
namespace MyApp\Tasks\Async;

use Phalcon\Cli\Task;
use limx\phalcon\Cli\Color;

class ProcessTask extends Task
{
    public function mainAction()
    {
        pcntl_signal(SIGCHLD, [$this, "signalHandler"]);
        for ($i = 0; $i < 1000; $i++) {
            $process = new \swoole_process([$this, 'task']);
            $date = uniqid();
            $process->write($date);
            $process->start();
            sleep(10);
        }
    }

    public function task(\swoole_process $worker)
    {
        $data = $worker->read();
        echo Color::colorize($data, Color::FG_RED) . PHP_EOL;
        $worker->exit(0);
    }

    /**
     * @desc 信号处理方法 回收已经dead的子进程
     * @author limx
     * @param $signo
     */
    private function signalHandler($signo)
    {
        switch ($signo) {
            case SIGCHLD:
                while ($ret = \swoole_process::wait(false)) {
                    echo Color::colorize("kill deadprocess successful!", Color::FG_LIGHT_RED) . PHP_EOL;
                }
        }
    }
}