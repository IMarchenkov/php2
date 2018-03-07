<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 23.02.2018
 * Time: 23:40
 */

namespace core;

class Gallery extends DB
{
    static public function testG()
    {
        echo "ЙА ГаЛеРейкО";
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
            move_uploaded_file($file['tmp_name'], "../". $new_path);

            $arParams["NAME"] = htmlspecialchars($name[0]);
            $arParams["PATH"] = $new_path;
            $arParams["SIZE"] = $file["size"];
            $arParams["IS_GALLERY"] = $isGallery;

            self::init();
            self::setTable("IMAGES");
            self::setParams($arParams);
            self::add();
            self::close();
        }
    }

    static public function getImages($arSelect = array(), $arFilter = array(), $arSort = array())
    {
        self::init();
        self::setTable("IMAGES");
        if (!empty($arSelect))
            self::setSelect($arSelect);
        if (!empty($arFilter))
            self::setFilter($arFilter);
        if (!empty($arSort))
            self::setSort($arSort);
        self::get();
        $arResult = self::getArResult();
        self::close();
        return $arResult;
    }

    function updateImage($arParams = array(), $arFilter = array())
    {
        self::setTable("IMAGES");
        if (!empty($arParams))
            self::setSelect($arParams);
        if (!empty($arFilter))
            self::setFilter($arFilter);
        self::update();
        self::close();
    }

    static function getDataFromURL($data){
        $arPath = explode("/",$data['path']);
        if ($arPath[0] == 'gallery' and $arPath[1] == 'image'){
            $arFilter = array("id"=>$data['id']);
            $arResult['template'] = 'image';
        }else{
            $arFilter = null;
            $arResult['template'] = 'gallery';
        }
        self::setTable("IMAGES");
        if (!empty($arFilter))
            self::setFilter($arFilter);
        self::get();
        $arResult['CONTENT'] = self::getArResult();
        self::close();
        return $arResult['CONTENT'];
    }
}