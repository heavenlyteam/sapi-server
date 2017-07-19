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
        // Config class constructor
    }

    public function hashSalt() {
        return $this->params['hashSalt'];
    }

    public function mysqlParams() {
        return $this->params['mysql'];
    }

}