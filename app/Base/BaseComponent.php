<?php

namespace app\Base;

class BaseComponent implements \BaseComponentInterface {

    private $name;

    public function __construct()
    {
        if(!$this->init()) {
            return false;
        }
        return $this->run();
    }

    public function init($params = null)
    {
        // TODO: Implement init() method.
    }

    public function run()
    {
        // TODO: Implement run() method.
    }
}