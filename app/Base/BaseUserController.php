<?php

namespace app\Base;

use app\App;
use app\models\Token;
use app\models\User;
use Exception;


/**
 * Class BaseUserController
 * @property App $app
 * @property \app\Common\Request $request
 * @property User $user
 */
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
        $this->beforeAction(function ($response) {
            echo json_encode($response);
            exit();
        });
    }

    public function beforeAction($callBack) {

        $this->headers();
        if($this->request->isPost() === false || !$this->request->post('token')) {
            $callBack([
                'status' => false,
                'description' => 'auth error',
            ]);
        }

        try {
            $this->user = (new Token($this->app))->getUser($this->request->post('token'));
        } catch (Exception $ex) {
            $callBack([
                'status' => false,
                'err' => $ex->getTraceAsString(),
            ]);
        }

        if(!$this->user) {
            $callBack([
                'status' => false,
                'description' => 'auth error',
            ]);
        }
    }

    public function headers() {
        header("Content-type:application/json");
    }

}