<?php

namespace app\Base;

use app\App;

class BaseGuestController
{
    public $app;
    public $request;

    /**
     * BaseGuestController constructor.
     * @param App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->request = $app->request;
        $this->beforeAction();
    }

    public function beforeAction()
    {
        header("Content-type:application/json");
    }

}