<?php

namespace app;
use app\Base\Request;
use mysqli;

include_once 'config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Base' . DIRECTORY_SEPARATOR . 'request.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Base' . DIRECTORY_SEPARATOR . 'db.class.php';

/**
 * Class App
 * @property Request $request
 */
class App
{

    private $dbObject = null;
    public $request = [];
    public $config = null;
    public $store = null;


    public function __construct()
    {
        $this->request = new Request();
        $this->config = new \Config();
        $this->store = new \Db($this->config->mysqlParams());
    }

    public function db()
    {
        return $this->dbObject;
    }

}