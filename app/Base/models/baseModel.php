<?php

use app\App;

/**
 * Class baseModel
 */
class baseModel {

    public $app;
    public $baseTable;
    public $id;

    /**
     * baseModel constructor.
     * @param App $app
     */
    public function __construct($app)
    {
        //TODO: rewrite init
        $this->app = $app;
    }

    public function columns() {
        return [];
    }

    /**
     * @param array $expression
     * @return $this
     */
    public function find(array $expression) {
        $this->load($this->app->store->select(['*'])->from($this->baseTable)->where($expression[0], $expression[1], $expression[2])->exec()->one());
        return $this;
    }

    public function load(object $object) {
        // override in models
    }

    public function create($values) {
        $this->load($this->app->store->insert($this->baseTable, $values)->exec()->one());
        return $this;
    }

    public function remove() {
        // TODO:: add DELETE statement in db.class
        $this->app->store->delete($this->baseTable)->where('id', '=', $this->id);
        return $this;
    }

}