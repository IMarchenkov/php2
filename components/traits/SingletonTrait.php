<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 02.03.2018
 * Time: 0:55
 */

namespace components\traits;


trait SingletonTrait
{
    private static $instance = null;
    private function __clone() {}
    private function __wakeup() {}
    protected function init() {}
    final private function __construct() {}

    public static function getInstance()
    {

        if (empty(self::$instance)) {
            self::$instance = new self();
            self::$instance->init();
        }

        return self::$instance;
    }




}