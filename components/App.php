<?php


namespace components;


use models\Item;

class App
{
    use \components\traits\SingletonTrait;

    public $request = null;
    public $auth = null;
    public $db = null;

    public function init()
    {
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        $this->db =   \components\Db::getInstance();
        $this->auth = \components\Auth::getInstance();

        $this->request = new Request();
        $this->request->init();
    }

    public static function getAppRootDir() {
        return $_SERVER['DOCUMENT_ROOT'] . '/../';
    }
//    public $request = null;
//    public $auth = null;
//
//
//    public function __construct()
//    {
//        session_start();
//        ini_set('error_reporting', E_ALL);
//        ini_set('display_errors', 1);
//        ini_set('display_startup_errors', 1);
//        $this->request = new Request();
//        $this->request->init();
////        $this->auth = new Auth();
////        $this->auth->init();
//
//    }
//
//    public function init()
//    {
//        //echo "Приложение запущено! <br>";
//    }
}