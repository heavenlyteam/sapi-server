<?php

class Config {

    private $params = [
        'hashSalt' => 'vkwejroiewurn8o2y34obi23n4ybiyu23r427834tyo2j8hrtb2o3784ho2873p4234',
        'mysql' => [
            'host' => 'localhost',
            'user' => 'root',
            'password' => 'vfhbyjxrf123',
            'dbname' => 'sapi',
        ],
    ];

    public function __construct()
    {
        $this->params['hashSalt'] = getenv('HASH_SALT');

        $this->params['mysql']['host'] = getenv('DB_HOST');
        $this->params['mysql']['user'] = getenv('DB_USER');
        $this->params['mysql']['password'] = getenv('DB_PASSWORD');
        $this->params['mysql']['dbname'] = getenv('DB_NAME');
    }

    public function hashSalt() {
        return $this->params['hashSalt'];
    }

    public function mysqlParams() {
        return $this->params['mysql'];
    }

}