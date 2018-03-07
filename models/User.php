<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 21:21
 */

namespace models;

use components\Model;
//use core\DB;

class User extends Model
{
    public $table = 'Users';
    public $user;

//    public function __construct($id)
//    {
//        $this->user = self::getUsers(array('id' => $id))[0];
//    }

    public function getUsers($arSelect = array(), $arFilter = array(), $arSort = array(), $arLimit = array())
    {
        $users = $this->get($arSelect, $arFilter, $arSort, $arLimit);
        return $users;
    }



//    public function getVisitedPages($arSelect = array(), $arFilter = array(), $arSort = array(), $arLimit = array())
//    {
//        if (empty($arFilter))
//            $arFilter = array("user_id" => $this->user['id]']);
//        DB::setTable("VISITED_PAGES");
//        DB::setSelect($arSelect);
//        DB::setFilter($arFilter);
//        DB::setSort($arSort);
//        DB::setLimit($arLimit);
//        DB::get();
//        $arResult = DB::getArResult();
//        DB::close();
//        return $arResult;
//    }
//
//    public function addVisitedPage($link)
//    {
//        $count = $this->getVisitedPages(array("COUNT(*)"));
//        if ($count == 5){
//            DB::setTable("VISITED_PAGES");
//            DB::setFilter(array("user_id" => $this->user['id']));
//            DB::setSort(array("DATE_CREATED"=>"ASC"));
//            DB::setLimit(array(0,1));
//            DB::del();
//            DB::close();
//        }
//        DB::setTable("VISITED_PAGES");
//        DB::setValues(array("user_id" => $this->user['id'], 'link' => $link));
//        DB::add();
//        DB::close();
//    }
}