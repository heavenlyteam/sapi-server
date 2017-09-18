<?php

namespace app\Base;

use mysqli;

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
    private $actionName = null;
    private $limit = null;
    private $offset = null;

    public function __construct(array $dbConfig)
    {
        $this->dbObject = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['dbname']);
    }

    public function select(array $values)
    {
        $this->action = 'SELECT';
        $this->actionName = 'select';
        foreach ($values as $value) {
            $this->valuesToSelect[] = $value;
        }
        return $this;
    }

    public function insert(string $to, array $values)
    {
        $this->actionName = 'insert';
        $this->action = 'INSERT' . ' INTO `' . $to . '` (';
        $iteratorCounter = 0;
        foreach ($values as $value => $key) {
            $iteratorCounter++;
            $this->action .= ' `' . $value . '`';
            if ($iteratorCounter === count($values)) {
                $this->action .= ' ) ';
            } else {
                $this->action .= ', ';
            }
        }

        $this->action .= 'VALUES (';
        $iteratorCounter = 0;
        foreach ($values as $value => $key) {
            $iteratorCounter++;
            $this->action .= ' "' . $key . '"';
            if ($iteratorCounter === count($values)) {
                $this->action .= ' ) ';
            } else {
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
        $this->whereConditions[] = strtolower(' `' . $column . '` ' . $action . ' "' . $value . '"');
        return $this;
    }

    public function exec()
    {
        $this->dbResponse = $this->dbObject->query($this->buildQuery());
        $this->clear();
        return $this;
    }

    public function clear()
    {
        $this->action = null;
        $this->valuesToSelect = [];
        $this->valuesToInsert = [];
        $this->query = null;
        $this->actionName = null;
        $this->whereConditions = [];
        $this->fromTable = null;
    }

    public function all()
    {
        return (object)mysqli_fetch_all($this->dbResponse, MYSQLI_ASSOC);
    }

    public function one()
    {
        $data = mysqli_fetch_all($this->dbResponse, MYSQLI_ASSOC);
        if (count($data) > 0) {
            return (object)$data[0];
        } else {
            return (object)[];
        }
    }

    /**
     * Build query, which will be execute in mysql
     *
     * @return string
     */
    private function buildQuery()
    {
        $qs = $this->action;

        if ($this->actionName === 'insert') {
            $this->query = $qs;
            return $qs;
        }
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
        $qs .= strtolower('`' . $this->fromTable . '`');

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

        if (is_numeric($this->limit)) {
            $qs .= ' LIMIT ' . $this->limit;
        }
        if (is_numeric($this->offset)) {
            $qs .= ' OFFSET ' . $this->offset;
        }

        $this->query = $qs;
        return $qs;
    }

    public function delete(string $table)
    {
        $this->actionName = 'delete';
        $this->action = 'DELETE ' . 'FROM `' . $table . '`';
        return $this;
    }

    public function getQuery()
    {
        return $this->buildQuery();
    }

    /**
     * Add limit params to query
     *
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        if (is_numeric($limit)) {
            $this->limit = $limit;
        }
        return $this;
    }

    /**
     * Add offset params to query
     *
     * @param int $offset
     * @return $this
     */
    public function offset(int $offset)
    {
        if (is_numeric($offset)) {
            $this->limit = $offset;
        }
        return $this;
    }

}