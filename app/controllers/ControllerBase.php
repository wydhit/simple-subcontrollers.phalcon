<?php
// +----------------------------------------------------------------------
// | 控制器基类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace MyApp\Controllers;

use Phalcon\Mvc\Controller;
use MyApp\Traits\System\Response;

class ControllerBase extends Controller
{
    use Response;
    const USER_ID = 'id';
    const USER = 'USER-%d';

    public function initialize()
    {
        if (!$this->session->has(self::USER_ID)) {
            return $this->response->redirect('/login/index');
        }
        $id = $this->session->get(self::USER_ID);

        $user = $this->cache->get(sprintf(self::USER, $id));
        if (empty($user['id']) || empty($user['token'])) {
            return $this->response->redirect('/login/index');
        }
        $this->view->user = $user;
        $this->view->apiHost = env('API_HOST');
    }

    public function beforeExecuteRoute()
    {
        // 在每一个找到的动作前执行
    }

    public function afterExecuteRoute()
    {
        // 在每一个找到的动作后执行
    }
}
