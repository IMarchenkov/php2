<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 22.02.2018
 * Time: 22:44
 */

namespace core;



class DB
{
    use Singleton;

    static private $db;
    static private $sql;
    static private $result;
    static private $filter = '';
    static private $select = 'SELECT *';
    static private $sort = '';
    static private $limit = '';
    static private $params = '';
    static private $values='';
    static private $table;
    static private $arResult;



    static public function init()
    {
//        require_once "../config/dbconn.php";

        $db = mysqli_connect(HOST, USER, PASS, DB);
        mysqli_query($db, "SET NAMES ut8");
        self::$db = $db;
    }

    static public function close()
    {
        self::$filter = '';
        self::$select = 'SELECT *';
        self::$sort = '';
        self::$limit = '';
        self::$params = '';
        self::$arResult = NULL;

    }

    /**
     * @return mixed
     */
    static public function getArResult()
    {
        return self::$arResult;
    }

    /**
     * @param mixed $table
     * @return $this
     */
    static public function setTable($table)
    {
        self::$table = $table;
    }

    /**
     * @param array $arFilter
     * @return $this
     */
    static public function setFilter(array $arFilter)
    {
        if (!empty($arFilter)) {
            self::init();
            $filter = " WHERE ";
            foreach ($arFilter as $key => $value) {
                $value = mysqli_real_escape_string(self::$db, $value);
                $filter = $filter . $key . ' = "' . $value . '" AND ';
            }
            $filter = substr($filter, 0, -5);
            mysqli_close(self::$db);
            self::$filter = $filter;
        }

    }

    /**
     * @param array $arSelect
     * @return $this
     */
    static public function setSelect(array $arSelect)
    {
        $select = "SELECT ";
        if (!empty($arSelect)) {
            foreach ($arSelect as $key => $value) {
                $select = $select . " " . $value . ",";
            }
            $select = substr($select, 0, -1);
        } else {
            $select = $select . "*";
        }
        self::$select = $select;

    }

    /**
     * @param array $arSort
     * @return $this
     */
    static public function setSort(array $arSort)
    {
        $sort = '';
        if (!empty($arSort)) {
            foreach ($arSort as $key => $value) {
                $sort = " ORDER BY " . $key . " " . $value . ",";
            }
            $sort = substr($sort, 0, -1);
            self::$sort = $sort;
        }

    }

    /**
     * @param array $arLimit
     * @return $this
     */
    static public function setLimit(array $arLimit)
    {
        if (!empty($arLimit)) {
            $limit = " LIMIT " . $arLimit[0];
            if ($arLimit[1])
                $limit = $limit . "," . $arLimit[1];
            self::$limit = $limit;
        }

    }

    /**
     * @param array $arParams
     * @return $this
     */
    static public function setParams(array $arParams)
    {
        $params = '';
        if (!empty($arParams)) {
            foreach ($arParams as $key => $value) {
                self::init();
                $value = mysqli_real_escape_string(self::$db, $value);
                $params = $params . $key . " = " . $value . ", ";
            }
            $params = substr($params, 0, -2);
            mysqli_close(self::$db);
            self::$params = $params;
        }
    }

    static public function setValues(array $arValues)
    {
        $params = '';
        if (!empty($arValues)) {
            $cols = "(";
            $values = "VALUES(";
            foreach ($arValues as $key => $value) {
                self::init();
                $value = mysqli_real_escape_string(self::$db, $value);
                $cols = $cols . $key.", ";
                $values = $values.'"' . $value.'", ';
            }
            $cols = substr($cols, 0, -2);
            $cols = $cols.") ";
            $values = substr($values, 0, -2);
            $values = $values.") ";
            $result = $cols." ".$values;
            mysqli_close(self::$db);
            self::$values = $result;
        }
    }

    static private function executeQuery()
    {
        self::init();
        self::$result = mysqli_query(self::$db, self::$sql);
        mysqli_close(self::$db);
    }

    static private function getResult(){
        self::init();
        $result = mysqli_query(self::$db, self::$sql);
        $arResult = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arResult[] = $row;
        }

        mysqli_close(self::$db);
        self::$arResult = $arResult;
    }

    static public function add()
    {
        $sql = "INSERT INTO " . self::$table;
        $sql = $sql . self::$values;

        self::$sql = $sql;
        self::executeQuery();

    }

    static public function get()
    {
        $sql = self::$select;
        $sql = $sql . " FROM " . self::$table;
        $sql = $sql . self::$filter;
        $sql = $sql . self::$sort;
        $sql = $sql . self::$limit;

        self::$sql = $sql;
        self::getResult();
//        var_dump(self::$sql);
//        var_dump(self::$arResult);
    }

    static public function del()
    {
        $sql = "DELETE FROM " . self::$table;
        if (self::$filter) {
            $sql = $sql . self::$filter;
            $sql = $sql . self::$sort;
            $sql = $sql . self::$limit;

            self::$sql = $sql;
            self::executeQuery();
        } else {
            throw new \Exception('Не заданы параметры запроса');
        }

    }

    static public function update()
    {
        if (self::$params) {
            $sql = "UPDATE " . self::$table . " SET ";
            $sql = $sql . self::$params;
            $sql = $sql . self::$filter;

            self::$sql = $sql;
            self::executeQuery();
        } else {
            throw new \Exception('Не заданы параметры запроса');
        }

    }
}