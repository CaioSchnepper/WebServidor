<?php

namespace App\Models;

use PDO;

class Conexao
{
    private static $_instance = null;
    private $_pdo, $_query, $_error = false, $_results, $_count = 0, $_lastInsertID = 'NULL';

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=127.0.0.1;dbname=webservidor', 'root', '');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function get_instance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Conexao();
        }
        return self::$_instance;
    }

    public function query($sql, $params = [])
    {
        $this->_error = false;

        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $value) {
                    $this->_query->bindValue($x, $value);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                if (NULL !== $this->_pdo->lastInsertId()) {
                    $this->_lastInsertID = $this->_pdo->lastInsertId();
                }
            } else {
                $this->_error = true;
            }

        }
        return $this;
    }

    public function insert($table, $fields = [])
    {
        $fieldString = '';
        $valueString = '';
        $values = [];
        foreach ($fields as $field => $value) {
            $fieldString .= $field . ',';
            $valueString .= '?,';
            $values[] = $value;
        }
        $valueString = rtrim($valueString, ',');
        $fieldString = rtrim($fieldString, ',');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

        if ($this->query($sql, $values)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($table, $id, $fields = [])
    {
        $fieldString = '';
        $values = [];
        foreach ($fields as $field => $value) {
            $fieldString .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString, ',');

        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";

        if ($this->query($sql, $values)) {
            return true;
        } else {
            return false;
        }

    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        if (!$this->query($sql)->get_error()) {
            return true;
        } else {
            return false;
        }
    }

    private function _read($table, $params = [])
    {
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';

        if (array_key_exists('joins', $params)) {
            function bindjoin($array, $counter)
            {
                return $array["$counter"];
            }
            $counter = 0;
            foreach ($params['joins'] as $join) {
                $innerJoin .= ' INNER JOIN ' . $join . ' ON ' . bindjoin($params['bindjoin'], $counter);
                $counter++;
            }
        } else {
            $innerJoin = '';
        }

        if (isset($params['conditions'])) {
            if (is_array($params['conditions'])) {
                foreach ($params['conditions'] as $condition) {
                    $conditionString .= ' ' . $condition . ' AND';
                }
                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, ' AND');
            } else {
                $conditionString = $params['conditions'];
            }

            if ($conditionString != '') {
                $conditionString = ' WHERE ' . $conditionString;
            }
        }

        if (array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }

        if (array_key_exists('order', $params)) {
            $order = ' ORDER BY ' . $params['order'];
        }


        if (array_key_exists('limit', $params)) {
            $limit = ' LIMIT ' . $params['limit'];
        }

        $sql = "SELECT * FROM {$table}{$innerJoin}{$conditionString}{$order}{$limit}";

        if ($this->query($sql, $bind)) {
            if (is_array($this->_results) || is_object($this->_results)) {
                return sizeof($this->_results) == 0 ? array(0) : true;
            } else {
                return array(0);
            }
        } else {
            return array(0);
        }
    }

    public function find($table, $params = [])
    {
        if ($this->_read($table, $params)) {
            return $this->_results;
        }
        return false;
    }

    public function findFirst($table, $params = [])
    {
        if ($this->_read($table, $params)) {
            return $this->_results[0];
        }
        return false;
    }

    public function get_error()
    {
        return $this->_error;
    }

    public function get_results()
    {
        return $this->_results;
    }

    public function get_count()
    {
        return $this->_count;
    }

    public function get_lastInsertID()
    {
        return $this->_lastInsertID;
    }

}
