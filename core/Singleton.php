<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 02.03.2018
 * Time: 0:55
 */

namespace core;

trait Singleton
{
    protected static $instance;

    final public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }

    final private function __construct()
    {
        self::$init();
    }

    protected function init()
    {
    }

    final private function __wakeup()
    {
    }

    final private function __clone()
    {
    }
}