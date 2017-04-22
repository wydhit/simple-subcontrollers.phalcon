<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Traits\System\Response;

class LoginController extends Controller
{
    use Response;
    const USER_ID = 'id';
    const USER = 'USER-%d';

    public function indexAction()
    {
        return $this->view->render('login', 'index');
    }

    /**
     * [pfnLoginAction desc]
     * @desc   登录
     * @author limx
     */
    public function pfnLoginAction()
    {
        $name = $this->request->get("name");
        $password = $this->request->get("password");
        if (empty($name) || empty($password)) {
            return self::error("手机号与验证码不能为空");
        }
        // TODO: 验证账号 并 保存SESSION
        $id = '1';
        $this->session->set(self::USER_ID, $id);
        // TODO: 缓存用户数据
        $this->cache->save(
            sprintf(self::USER, $id),
            [
                'id' => $id,
                'token' => uniqid(),
            ]
        );

        return self::success();
    }

    /**
     * [pfnLogout desc]
     * @desc   退出登录
     * @author limx
     * @return mixed
     */
    public function pfnLogoutAction()
    {
        $id = $this->session->get(self::USER_ID);
        // 删除SESSION
        $this->session->destroy();
        // 删除登录数据
        $this->cache->delete(sprintf(self::USER, $id));
        return $this->response->redirect('/login/index');
    }

}

