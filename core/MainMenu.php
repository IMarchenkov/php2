<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 24.02.2018
 * Time: 13:35
 */

namespace core;


class MainMenu extends DB
{
    static public function getMainMenu()
    {
        self::init();
        self::setTable("CATEGORIES");
        self::setFilter(array("IS_SHOW"=>1));
        self::get();
        $arResult = self::getArResult();
        self::close();
        return $arResult;
    }
}