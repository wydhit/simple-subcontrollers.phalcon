<?php

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
}
