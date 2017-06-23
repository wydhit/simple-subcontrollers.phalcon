<?php

namespace App\Controllers\Test;

use App\Controllers\Controller;
use App\Models\TestSphinx;

class XunSearchController extends Controller
{
    public function initialize()
    {
        // 默认的 xunsearch 应用配置文件目录为 vendor/hightman/xunsearch/app
        // 如有必要，请通过常量 XS_APP_ROOT 定义
        define('XS_APP_ROOT', ROOT_PATH . '/data/xunsearch/');
    }

    public function indexAction()
    {
        echo "XunSearch::index";
    }

    public function addDocAction()
    {
        $xs = new \XS('demo'); // 建立 XS 对象，项目名称为：demo
        $index = $xs->index; // 获取 索引对象

        $step = 100;
        $begin = 0;
        $users = [1];
        while (count($users) > 0 && $begin < 1000) {
            $users = TestSphinx::find([
                'offset' => $begin,
                'limit' => $step,
                'columns' => 'id,user_login,user_nicename,create_time,avatar',
            ]);
            echo $begin . " ";
            $begin += $step;

            foreach ($users as $user) {
                $data = $user->toArray();
                // 创建文档对象
                $doc = new \XSDocument;
                $doc->setFields($data);

                // 添加到索引数据库中
                $index->add($doc);
            }
        }
    }

}

