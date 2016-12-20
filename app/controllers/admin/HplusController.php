<?php

namespace MyApp\Controllers\Admin;

use MyApp\Controllers\ControllerBase;

class HplusController extends ControllerBase
{

    public function indexAction()
    {
        return $this->view->render('admin/hplus', 'index');
    }

    public function listAction()
    {
        return $this->view->render('admin/hplus', 'list');
    }

}

