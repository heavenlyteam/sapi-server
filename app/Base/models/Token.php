<?php

namespace app\Base\models;

use app\App;

class Token extends \baseModel
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
        $tokenRecord = $this->find(['token', '=', $token]);
        if($tokenRecord) {
            return (new User($this->app))->find(['id', '=', $tokenRecord->token]);
        }else {
            return false;
        }
    }

}