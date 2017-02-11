<?php

namespace App\Model;

use App\DI\Service;

class Model
{
    protected $tableName;

    protected $pdo;

    protected $variables = [];

    public function __construct($tableName)
    {
        $this->pdo = Service::get('pdo');
        $this->tableName = $tableName;
    }

    public function fetchAll($sql = '')
    {
        $query = empty($sql) ?
            'SELECT * FROM `' . $this->getTableName() . '`' :
            $sql;

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll($pdo::FETCH_CLASS);
    }

    public function fetch($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch($pdo::FETCH_LAZY);
    }

    public function __set($name, $val)
    {
        $this->variables[$name] = $val;
    }

    public function __get($name)
    {
        return isset($this->variables[$name]) ? $this->variables : null;
    }
}
