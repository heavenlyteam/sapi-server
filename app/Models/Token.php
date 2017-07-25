<?php

namespace app\Models;

use app\App;
use app\Base\BaseModel;

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
        $this->findOne(['token', '=', $token]);
        if($this->user_id) {
            return (new User($this->app))->findOne(['id', '=', $this->user_id]);
        }else {
            return false;
        }
    }

}