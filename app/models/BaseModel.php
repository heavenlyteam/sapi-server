<?php

namespace app\models;

use app\App;

/**
 * Class baseModel
 */
class BaseModel {

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

    /**
     * @param $object
     * @return bool
     */
    public function load($object) {
        if(!$object) return false;
        foreach ($object as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param $values
     * @return $this
     */
    public function create($values) {
        $this->load($this->app->store->insert($this->baseTable, $values)->exec()->one());
        return $this;
    }

    /**
     * @return $this
     */
    public function remove() {
        // TODO:: add DELETE statement in db.class
        $this->app->store->delete($this->baseTable)->where('id', '=', $this->id);
        return $this;
    }

    public function update(array $values) {

    }

}