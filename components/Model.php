<?php

namespace components;


abstract class Model
{
    protected $pdo = null;
    public $table = '';
    public $fields = [];
    public $rules = [];
    private $query = '';
    private $queryData = array();

    public function __construct()
    {
        $this->pdo = \components\Db::getInstance()->getPDO();
    }

    private function getResult()
    {
        $statement = $this->pdo->prepare($this->query);
//        echo $this->query;
//        var_dump($this->queryData);
        $statement->execute($this->queryData);
        unset($this->queryData);
        return $statement->fetchAll();
    }

    private function exec()
    {
        $statement = $this->pdo->prepare($this->query);
//        echo $this->query;
//        var_dump($this->queryData);
        $statement->execute($this->queryData);
        unset($this->queryData);
        return $this->pdo->lastInsertId();
    }

    protected function get($arSelect = array(), $arFilter = array(), $arSort = array(), $arLimit = array())
    {
        $query = 'SELECT ';
        if (!empty($arSelect)) {
            $query = $query . $this->prepareSelect($arSelect);
        } else {
            $query = $query . '* ';
        }
        $query = $query . 'FROM ' . $this->table . ' ';
        if (!empty($arFilter)) {
            $query = $query . $this->prepareFilter($arFilter);
        }
        if (!empty($arSort)) {
            $query = $query . $this->prepareSort($arSort);
        }
        if (!empty($arLimit)) {
            $query = $query . $this->prepareLimit($arLimit);
        }
//        $query = $query . self::$limit;
        $this->query = $query;
        $arResult = $this->getResult();
//        var_dump($arResult);
        return $arResult;
    }

    public function add($arValues)
    {
        $query = "INSERT INTO " . $this->table . ' ';
        if (!empty($arValues)) {
            $query = $query . $this->prepareValues($arValues);
        } else {
            throw new \Exception('Не заданы параметры запроса');
        }
        $this->query = $query;
        $result = $this->exec();
        return $result;
    }

    public function update($arParams = array(), $arFilter = array())
    {
        $query = "UPDATE " . $this->table . " SET ";
        if (!empty($arParams)) {
            $query = $query . $this->prepareParams($arParams);
            if (!empty($arFilter))
                $query = $query . $this->prepareFilter($arFilter);
        } else {
            throw new \Exception('Не заданы параметры запроса');
        }
        $this->query = $query;
        $result = $this->execute($this->queryData);
        return $result;
    }

    public function del($arFilter = array(), $arSort = array(), $arLimit = array())
    {
        $query = "DELETE FROM " . $this->table . ' ';
        if (!empty($arFilter)) {
            $query = $query . $this->prepareFilter($arFilter);
            if (!empty($arSort)) {
                $query = $query . $this->prepareSort($arSort);
            }
            if (!empty($arLimit)) {
                $query = $query . $this->prepareLimit($arLimit);
            }
        } else {
            throw new \Exception('Не заданы параметры запроса');
        }
        $this->query = $query;
        $result = $this->exec();
        return $result;
    }

    private function prepareSelect($arSelect)
    {
        $select = '';
        foreach ($arSelect as $key => $value) {
            $select = $select . $value . ', ';
        }

        $select = substr($select, 0, -2);
        return $select . ' ';
    }

    private function prepareFilter($arFilter)
    {
        $filter = 'WHERE ';
        $tag = 'filter';
        $fiterActions = array('=', '<', '>', '>=', '<=');
        foreach ($arFilter as $key => $value) {
            $arValue_action = explode('.', $value);
            $value = $arValue_action[0];
            if (!empty($arValue_action[1]) && in_array($arValue_action[1], $fiterActions)) {
                $action = $arValue_action[1];
            } else {
                $action = '=';
            }
            $filter = $filter . $key . ' ' . $action . ' :' . $tag . $key . ' AND ';
            $this->queryData[$tag . $key] = $value;
        }

        $filter = substr($filter, 0, -5);
        return $filter . ' ';
    }

    private function prepareSort($arSort)
    {
        $arValues = array('ASC', 'DESC');
        $sort = 'ORDER BY ';
        foreach ($arSort as $key => $value) {
            if (in_array($value, $arValues)) {
                $sort = $sort . $key . ' ' . $value . ', ';
            }
        }
        if (strlen($sort) > 9) {
            $sort = substr($sort, 0, -2);
            $sort = $sort . ' ';
        } else {
            $sort = '';
        }
        return $sort;
    }

    private function prepareLimit($arLimit)
    {
        $limit = " LIMIT " . $arLimit[0];
        if (!empty($arLimit[1]))
            $limit = $limit . "," . $arLimit[1];
        return $limit;
    }

    private function prepareParams($arParams)
    {
        $params = '';
        $tag = 'param';
        foreach ($arParams as $key => $value) {
            $params = $params . $key . " = " . ' :' . $tag . $key . ", ";
            $this->queryData[$tag . $key] = $value;
        }
        $params = substr($params, 0, -2);
        return $params . ' ';
    }

    private function prepareValues($arValues)
    {
        $cols = "(";
        $values = "VALUES(";
        $tag = 'value';
        foreach ($arValues as $key => $value) {
            $cols = $cols . $key . ", ";
            $values = $values . ':' . $tag .$key. ', ';
            $this->queryData[$tag . $key] = $value;
        }
        $cols = substr($cols, 0, -2);
        $cols = $cols . ") ";
        $values = substr($values, 0, -2);
        $values = $values . ") ";
        $result = $cols . " " . $values;
        return $result;
    }

    public function validate($values, $rules) // оставил на сладкое, если успею реализовать минимум, то и его подключу
    {

        foreach ($rules as $key => $rule) {

            if (!isset($values[$key])) {
                continue;
            }

            switch ($rule) {
                case 'text':
                    if (!is_string($values[$key])) {
                        return false;
                    }
                    break;

                case 'int' : {
                    if (!is_numeric($values[$key])) {
                        return false;
                    }
                }

                    break;

                default:
                    throw new \Exception('Неизвестное правило валидации');


            }

        }

        return true;

    }


}