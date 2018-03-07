<?php
namespace models;

use components\Model;
use core\DB;
use models\Gallery;


class Catalog extends Model
{
    public $table = 'ITEMS';

    public function getCatalog()
    {
        $items = $this->getItems(array(), array(), array(), array(0,4));

        $params = array(
            'title' => "Каталог",
            'description' => "Каталог товаров",
            'detail_link' => "/catalog",
            'items' => $items,
            'back_url' => $_SERVER["HTTP_REFERER"]
        );
        return $params;
    }

    public function getDetailItem($code)
    {
        $item = self::getItems(array(), array("CODE" => $code), array())[0];
        $params = array(
            'title' => $item['NAME'],
            'item' => $item,
            'back_url' => $_SERVER["HTTP_REFERER"]
        );
        return $params;
    }

    public function getItems($arSelect = array(), $arFilter = array(), $arSort = array(), $arLimit = array()){
//        DB::setTable("ITEMS");
//        DB::setSelect($arSelect);
//        DB::setFilter($arFilter);
//        DB::setSort($arSort);
//        DB::setLimit($arLimit);
//        DB::get();
//        $items = DB::getArResult();
//        DB::close();

        $gallery = new Gallery();
        $items = $this->get($arSelect, $arFilter, $arSort, $arLimit);
        foreach ($items as $key => $item) {
            if ($item["IMAGES"]) {
                $arImg_id = explode(",", $item["IMAGES"]);
                $items[$key]["IMAGES"] = array();
                foreach ($arImg_id as $img_id) {
                    unset($arFilter);
                    $arFilter = array("id" => $img_id);
                    $items[$key]["IMAGES"][] = $gallery->getImages(null, $arFilter)[0];
                }
            }
        }
        return $items;
    }
}