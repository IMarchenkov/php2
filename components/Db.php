<?php

namespace components;
//require_once "../config/dbconn.php";

class Db
{


    private $pdo = null;
    public $dbname = DB;
    public $dbuser = USER;
    public $dbpass = PASS;
    public $dbhost = HOST;
    public $charset = 'utf8';
    public $options = [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // по умолчанию ассоциативный массив
//        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // ошибки бросают исключения
        \PDO::ATTR_ERRMODE=> \PDO::ERRMODE_WARNING
    ];

    use \components\traits\SingletonTrait;

    public function init() {
        $this->getPDO();
    }

    public function getPDO() {
        if(empty($this->pdo)) {
            $this->pdo = new \PDO("mysql:host={$this->dbhost};dbname={$this->dbname};charset={$this->charset}",
                $this->dbuser,
                $this->dbpass,
                $this->options);
        }

        return $this->pdo;
    }
}