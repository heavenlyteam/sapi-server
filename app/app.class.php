<?php

namespace app;

use app\Common\Request;
use Config;
use app\Base\Db;

include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Common' . DIRECTORY_SEPARATOR . 'autoloader.php';

/**
 * Class App
 * @property Request $request
 */
class App
{

    private $dbObject = null;
    public $components = [];
    public $request = [];
    public $config = null;
    public $store = null;


    public function __construct()
    {
        $this->request = new Request();
        $this->config = new Config();
        $this->store = new Db($this->config->mysqlParams());
    }

    public function db()
    {
        return $this->dbObject;
    }

}