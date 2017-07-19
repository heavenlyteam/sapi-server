<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

use app\App;
use app\Base\models\Token;
use app\Base\models\User;


/**
 * Class BaseUserController
 * @property App $app
 * @property \app\Base\Request $request
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
        $this->beforeAction();
    }

    public function beforeAction() {

        $this->headers();
        if($this->request->isPost() === false || !$this->request->post('token')) {
            echo json_encode([
                'status' => false,
                'description' => 'auth error',
            ]);
            exit();
        }

        try {
            $this->user = (new Token($this->app))->getUser($this->request->post('token'));
        } catch (Exception $ex) {
            var_dump($ex);die;
        }

        if(!$this->user) {
            echo json_encode([
                'status' => false,
                'description' => 'auth error',
            ]);
            exit();
        }
    }

    public function headers() {
        header("Content-type:application/json");
    }

}