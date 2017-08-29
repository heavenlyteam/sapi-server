<?php

namespace app\Common;

class Request
{

    private $params;

    public function __construct()
    {
        $this->requestProcessing();
    }

    public function get($name)
    {
        if ($this->params->get->$name === null) {
            return false;
        } else {
            return $this->params->get->$name;
        }
    }

    public function post($name)
    {
        if (array_key_exists($name, $this->params['post'])) {
            return $this->params['post'][$name];
        }else {
            return false;
        }
    }

    public function files()
    {

    }

    private function requestProcessing()
    {

        $postArray = [];
        $getArray = [];
        $request = [];
        foreach ($_POST as $key => $value) {
            $postArray[$key] = $value;
        }
        foreach ($_GET as $key => $value) {
            $getArray[$key] = $value;
        }

        $request['post'] = $postArray;
        $request['get'] = $getArray;
        $request['type'] = strtolower($_SERVER['REQUEST_METHOD']);
        $request['isPost'] = ($request['type'] === 'post');
        $request['isGet'] = ($request['type'] === 'get');

        $this->params = $request;
    }

    public function isPost()
    {
        return $this->params['isPost'];
    }

    public function isGet()
    {
        return $this->params['isGet'];
    }

    public function type()
    {
        return $this->params['type'];
    }

}