<?php

namespace app;

use mysqli;
use app\Common\Request;

include_once 'config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Common' . DIRECTORY_SEPARATOR . 'autoloader.php';
include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Common' . DIRECTORY_SEPARATOR . 'request.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Common' . DIRECTORY_SEPARATOR . 'db.class.php';

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
        $this->config = new \Config();
        $this->store = new \Db($this->config->mysqlParams());
        $this->parseComponents();
    }

    private function parseComponents() {
        $components = scandir($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Components');
        $componentsArray = [];
        foreach ($components as $component) {
            if($component !== '.' && $component !== '..') {
                $componentName = str_replace('.php', '', $component);
                $componentsArray[$componentName] = new $componentName();
            }
        }
        var_dump($componentsArray);die;
    }

    public function db()
    {
        return $this->dbObject;
    }

}