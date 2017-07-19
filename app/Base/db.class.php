<?php

class Db
{

    private $dbObject;
    private $valuesToSelect = [];
    private $fromTable = '';
    private $action;
    private $to;
    private $valuesToInsert = [];
    private $whereConditions = [];
    private $query = null;
    private $dbResponse = null;

    public function __construct(array $dbConfig)
    {
        $this->dbObject = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['dbname']);
    }

    public function select(array $values)
    {
        $this->action = 'SELECT';
        foreach ($values as $value) {
            $this->valuesToSelect[] = $value;
        }
        return $this;
    }

    public function insert(string $to, array $values) {
        $this->action = 'INSERT' . ' INTO `' . $to . '` (';
        $iteratorCounter = 0;
        foreach ($values as $value => $key) {
            $iteratorCounter++;
            $this->action .= ' `' .$value . '`';
            if($iteratorCounter === count($values)) {
                $this->action .= ' ) ';
            }else {
                $this->action .= ', ';
            }
        }
        return $this;
    }

    public function from(string $tableName)
    {
        $this->fromTable = $tableName;
        return $this;
    }

    public function where(string $column, string $action, string $value)
    {
        $this->whereConditions[] = strtolower(' `' . $column . '` ' . $action . ' ' . $value);
        return $this;
    }

    public function exec()
    {
        $this->dbResponse = $this->dbObject->query($this->buildQuery());
        return $this;
    }

    public function all()
    {
        return (object)$this->dbResponse;
    }

    public function one()
    {
        return (object)$this->dbResponse[0];
    }

    private function buildQuery()
    {
        $qs = $this->action;
        $iterator = 0;
        foreach ($this->valuesToSelect as $column) {
            $iterator++;
            $qs .= ' `' . $column . '` ';
            if (count($this->valuesToSelect) !== $iterator) {
                $qs .= ',';
            }
            if (count($this->valuesToSelect) === $iterator) {
                $qs .= 'FROM ';
            }
        }
        $qs .= strtoupper('`' . $this->fromTable . '`');

        $iterator = 0;
        foreach ($this->whereConditions as $condition) {
            if ($iterator === 0) {
                $qs .= ' WHERE';
            }
            if ($iterator > 0) {
                $qs .= ' AND';
            }
            $qs .= $condition;
            $iterator++;
        }
        $this->query = $qs;
        return $qs;
    }

    public function delete(string $table) {
        $this->action = 'DELETE ' . 'FROM `' . $table . '`';
        return $this;
    }

    public function getQuery()
    {
        return $this->buildQuery();
    }

}