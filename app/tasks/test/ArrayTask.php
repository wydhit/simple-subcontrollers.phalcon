<?php

namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{
    public static $tasks = [
        ['task' => 'System\\Init', 'action' => 'storage', 'params' => []]
    ];

    public function mainAction()
    {
        foreach (self::$tasks as $task) {
            $this->console->handle($task);
        }
    }

}