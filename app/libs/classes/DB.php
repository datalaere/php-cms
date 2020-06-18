<?php

class DB
{
    private $_pdo;
    private $_query;
    private $_error = false;
    private $_results;
    private $_count = 0;
    private static $_instance = null;
    
    private function __construct()
    {
        try {
            $this->_pdo = new PDO(
                Config::get('db.driver') . ':host=' .
                Config::get('db.host') . ';dbname=' .
                Config::get('db.name') . ';charset=' . 
                Config::get('db.charset'),
                Config::get('db.username'), 
                Config::get('db.password')
            );

        } catch(PDOException $error) {
            die($error->getMessage());
        }
    }

    public static function singleton()
    {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        
        return $this;
    }

    public function action($action, $table, $where = array())
    {
        if(count($where) === 3) {

            $operators = array('=', '>', '<', '>=', '<=', '<>');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)) {

                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        } else {
            $sql = "{$action} FROM {$table}";

            if(!$this->query($sql)->error()) {
                return $this;
            }
        }

        return false;
    }

    public function get($table, $where = array())
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = array())
    {
        $keys = array_keys($fields);
        $values = null;
        $x = 1;

        foreach($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                    $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) . "`) VALUES ({$values})";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function update($table, $id, $fields = array(), $attribute = 'id')
    {
        $set = '';
        $x   = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE {$attribute} = {$id}";

        if (!$this->query($sql, $fields)->error())
        {
            return true;
        }
        return false;
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        if($this->results()) {
            return $this->results()[0];
        }

        return false;
    }

    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->_count;
    }

    public function lastId()
    {
        return $this->_pdo->lastInsertId();
    }

}
