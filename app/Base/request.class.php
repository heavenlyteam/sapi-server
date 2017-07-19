<?php

namespace app\Base;

class Request {

    private $params;

    public function __construct()
    {
        $this->requestProcessing();
    }

    public function get($name)
    {
        if($this->params->get->$name === null) {
            return false;
        } else {
            return $this->params->get->$name;
        }
    }

    public function post($name)
    {
        if($this->params->post->$name === null) {
            return false;
        } else {
            return $this->params->post->$name;
        }
    }

    private function requestProcessing() {
        $postArray = [];
        $getArray = [];
        $request = [];
        foreach ($_POST as $key => $value) {
            $postArray[$key] = $value;
        }
        foreach ($_GET as $key => $value) {
            $getArray[$key] = $value;
        }

        $request['post'] = (object)$postArray;
        $request['get'] = (object) $getArray;
        $request['type'] = 'get';

        if(count($postArray) === 0) {
            $request['isPost'] = false;
        }else {
            $request['isPost'] = true;
            $request['type'] = 'post';
        }

        if(count($getArray) === 0) {
            $request['isGet'] = false;
        }else {
            $request['isGet'] = true;
        }

        $this->params = (object) $request;
    }

    public function isPost() {
        return $this->params->isPost;
    }

    public function isGet() {
        return $this->params->isGet;
    }

    public function type() {
        return $this->params->type;
    }

}