<?php

namespace app\models;

use app\App;

/**
 * Class User
 * @package app\Base\models
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $name
 */

class User extends BaseModel
{
    public $baseTable = 'user';

    public $id;
    public $login;
    public $password;
    public $name;

    public function columns() {
        return [
            'id' => 'integer',
            'login' => 'string',
            'password' => 'string',
            'name' => 'string',
        ];
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
        return $this;
    }

}