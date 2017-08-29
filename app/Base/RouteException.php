<?php

namespace app\Base;


class RouteException extends \Exception
{

    public $message = 'Unknown routing exception';
    public $code = 0;

    public function __construct($message, $code = 0, \Exception $previous)
    {
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message, $code, $previous);
    }


    public function showNotFound() {
        return header('Location: ' . $_SERVER['HTTP_HOST'] . '/index/notFound');
    }

    public function trace() {
        return $this->getTraceAsString();
    }

}