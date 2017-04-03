<?php
// +----------------------------------------------------------------------
// | 默认控制器 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
namespace MyApp\Controllers;

use MyApp\Logics\Common;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->version = (new Common())->version();
        return $this->view->render('index', 'index');
    }

    public function searchAction()
    {
        $key = $this->request->get('key');
        $apis = app('api');
        foreach ($apis as $api => $url) {
            $res = stripos($api, $key);
            if ($res === false) {
                continue;
            }
            return $this->response->redirect($url);
        }
        return $this->response->redirect('/index/index');
    }
}