<?php
// +----------------------------------------------------------------------
// | Mongo.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Tasks\Test;

use App\Models\User;
use Phalcon\Cli\Task;

class MongoTask extends Task
{
    public function mainAction()
    {
        // $user = new User();
        // $user->name = "李铭昕";
        // $result = $user->save();

        $user = User::findFirst();
        echo $user->name;
    }

    public function findAction()
    {
        $user = User::findFirst();
        echo $user->name;
    }
}