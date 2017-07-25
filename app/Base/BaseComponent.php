<?php

namespace app\Base;

class BaseComponent {

    public function __construct()
    {
        if(!$this->init()) {
            return false;
        }
        return $this->run();
    }

    /**
     * Function run before main component start
     */
    public function init() {
        return true;
    }

    /**
     * Main component hook
     */
    public function run() {
        return true;
    }

}