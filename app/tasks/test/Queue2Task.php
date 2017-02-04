<?php
// +----------------------------------------------------------------------
// | 主线程阻塞的消息队列 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/2/4 Time: 上午10:00
// +----------------------------------------------------------------------
declare(ticks = 1);
namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;
use limx\tools\LRedis;

class Queue2Task extends Task
{
    private $maxProcesses = 500;
    private $child = 0;
    private $close = 0;
    private $masterRedis;
    private $redis_queue = 'phalcon:test:queue';

    public function mainAction()
    {
        if (!extension_loaded('swoole')) {
            echo "没有安装swoole扩展" . PHP_EOL;
            return;
        }
        // install signal handler for dead kids
        pcntl_signal(SIGCHLD, [$this, "sig_handler"]);
        set_time_limit(0);
//        ini_set('default_socket_timeout', -1); //队列处理不超时,解决redis报错:read error on connection

        while (true) {
            echo "当前进程数:", $this->child, " SIGCHLD次数:", $this->close, PHP_EOL;
            if ($this->child < $this->maxProcesses) {
                $rds = $this->redis_client();
                $data_pop = $rds->brpop($this->redis_queue, 3);//无任务时,阻塞等待
                if (!$data_pop) {
                    continue;
                }
                echo "开始任务-当前进程数：", $this->child, PHP_EOL;
                $this->child++;
                $process = new \swoole_process([$this, 'process']);
                $process->write(json_encode($data_pop));
                $pid = $process->start();
            } else {
                sleep(1);
            }
        }
    }

    public function testAction()
    {
        $redis = $this->redis_client();
        for ($i = 0; $i < 3000; $i++) {
            $data = [
                'abc' => $i,
                'timestamp' => time() . rand(100, 999)
            ];
            $redis->lpush($this->redis_queue, json_encode($data));
        }
//        exit;
    }

    public function process(\swoole_process $worker)
    {
        // 第一个处理
//        $GLOBALS['worker'] = $worker;
//        swoole_event_add($worker->pipe, function ($pipe) {
//            $worker = $GLOBALS['worker'];
//            $recv = $worker->read();            //send data to master
//            sleep(1);
//            echo "数据包: ", $recv . PHP_EOL;
//            $worker->exit(0);
//        });
        $recv = $worker->read();
        sleep(1);
        echo "数据包: ", $recv . PHP_EOL;
        $worker->exit(0);
    }


    private function redis_client()
    {
        $config = [
            'host' => '127.0.0.1',
            'auth' => '',
            'port' => '6379',
        ];
        $redis = LRedis::getInstance($config);
        return $redis;
    }

    private function sig_handler($signo)
    {
        switch ($signo) {
            case SIGCHLD:
                while ($ret = \swoole_process::wait(false)) {
                    //echo "PID={$ret['pid']}\n";
                    $this->child--;
                    $this->close++;
                }
        }
    }
}