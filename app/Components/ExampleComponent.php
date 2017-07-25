<?php

namespace app\Components;

use app\Base\BaseComponent;

class ExampleComponent extends BaseComponent {

    private $userName;

    public function __construct($name)
    {
        $this->userName = $name;
        parent::__construct();
    }

    public function init() {
        if($this->userName === null) {
            return false;
        }
        return true;
    }

    public function run()
    {
        return strrev($this->userName);
    }

}