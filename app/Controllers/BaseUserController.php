<?php

use app\App;
use app\Base\models\Token;

class BaseUserController {

    public $app;
    public $request;
    public $user;

    /**
     * BaseUserController constructor.
     * @param App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->request = $app->request;
        $this->beforeAction();
    }

    public function beforeAction() {

        if(!$this->request->post('token')) {
            echo json_encode([
                'status' => false,
                'description' => 'auth error',
            ]);
            return false;
        }

        $this->user = (new Token($this->app))->getUser($this->request->post('token'));

        if(!$this->user) {
            echo json_encode([
                'status' => false,
                'description' => 'auth error',
            ]);
            return false;
        }

        header("Content-type:application/json");
    }

}