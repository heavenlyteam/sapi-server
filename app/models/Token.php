<?php

namespace app\models;

use app\App;

class Token extends BaseModel
{

    public $baseTable = 'token';

    public $token;
    public $user_id;
    public $id;

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function getUser(string $token) {
        $this->find(['token', '=', $token]);
        if($this->user_id) {
            return (new User($this->app))->find(['id', '=', $this->user_id]);
        }else {
            return false;
        }
    }

}