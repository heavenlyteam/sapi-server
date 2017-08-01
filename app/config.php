<?php

class Config {

    private $params = [
        'hashSalt' => '',
        'mysql' => [
            'host' => '',
            'user' => '',
            'password' => '',
            'dbname' => '',
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