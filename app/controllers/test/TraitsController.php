<?php

namespace MyApp\Controllers\Test;

class TraitsController extends \Phalcon\Mvc\Controller
{
    use \MyApp\Traits\System\Response;

    public function indexAction()
    {
        return self::success();
    }

}

