<?php

namespace models;

use components\Model;
use core\DB;

class Gallery extends Model
{
    public $table = 'IMAGES';

    public function getGallery()
    {
//        DB::setTable("IMAGES");
//        DB::setSelect(array());
//        DB::setFilter(array("IS_GALLERY" => 1));
////        DB::setSort($arSort);
//        DB::get();
//        $images = DB::getArResult();
//        DB::close();
        $images = self::getImages(array(), array("IS_GALLERY" => 1), array());
        $params = array(
            'title' => "Галлерея",
            'description' => "Галлерея изображений",
            'detail_link' => "/gallery",
            'items' => $images,
            'back_url' => $_SERVER["HTTP_REFERER"]
        );
        return $params;
    }

    public function getDetailImage($name)
    {
        $image = $this->getImages(array(), array("NAME" => $name), array())[0];
        $params = array(
            'title' => $image['NAME'],
            'image' => $image,
            'back_url' => $_SERVER["HTTP_REFERER"]
        );
        self::updateImage(array("VIEW"=>"VIEW+1"), $arFilter = array("NAME" => $name));
        return $params;
    }

    static function addImage($file, $isGallery = false)
    {
        $arParams = array();
        $IMAGE_PATH = "images/";
        $info = getimagesize($file["tmp_name"]); //получаем размеры картинки и ее тип
        if (in_array($info["mime"], array('image/png', 'image/jpeg', 'image/gif'))) {
            $new_path = $IMAGE_PATH . $file["name"];
            $name = explode(".", $file["name"]);
            if (file_exists("../" . $new_path)) {
                $new_path = $IMAGE_PATH . $name[0] . "_" . time() . "." . $name[count($name) - 1];
            }
//            echo "/public/" . $new_path;
            move_uploaded_file($file['tmp_name'], "../" . $new_path);

            $arParams["NAME"] = htmlspecialchars($name[0]);
            $arParams["PATH"] = $new_path;
            $arParams["SIZE"] = $file["size"];
            $arParams["IS_GALLERY"] = $isGallery;

            DB::setTable("IMAGES");
            DB::setValues($arParams);
            DB::add();
            DB::close();
        }
    }

    public function getImages($arSelect = array(), $arFilter = array(), $arSort = array(),$arLimit=array())
    {
//        DB::init();
//        DB::setTable("IMAGES");
//        if (!empty($arSelect))
//            DB::setSelect($arSelect);
//        if (!empty($arFilter))
//            DB::setFilter($arFilter);
//        if (!empty($arSort))
//            DB::setSort($arSort);
//        DB::get();
//        $arResult = DB::getArResult();
//        DB::close();
        $images = $this->get($arSelect, $arFilter, $arSort, $arLimit);
        return $images;
    }

    static public function updateImage($arParams = array(), $arFilter = array())
    {
        DB::setTable("IMAGES");
        if (!empty($arParams))
            DB::setParams($arParams);
        if (!empty($arFilter))
            DB::setFilter($arFilter);
        DB::update();
        DB::close();
    }
}