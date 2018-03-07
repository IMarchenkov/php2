<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 24.02.2018
 * Time: 12:21
 */

namespace core;

use core\DB;
use core\Gallery;

class App
{
    static protected $category;
    static protected $content;

    public function init()
    {
        require_once "../templates/header.php";
        self::getCategory();
        self::getContent();
        $arResult = self::$content;
//        var_dump($arResult);
        $loader = new \Twig_Loader_Filesystem('../templates');
        $twig = new \Twig_Environment($loader, array('debug'=>true));
        $twig->addExtension(new \Twig_Extension_Debug());
        foreach ($arResult as $component) {
            $template = $twig->loadTemplate($component["TEMPLATE"] . ".html");
            echo $template->render(array(
                'title' => $component["NAME"],
                'description'=>$component["DESCRIPTION"],
                'detail_link'=>$component["DETAIL_LINK"],
                'items' => $component["ITEMS"],
                'back_url'=>$_SERVER["HTTP_REFERER"]
            ));
        }
        require_once "../templates/footer.php";
    }

    static private function getCategory()
    {
        $category = explode('/', $_REQUEST['path'])[0];
        $category = $category ? $category : "main";
        $arFilter = array("CODE" => $category);
//        var_dump($arFilter);
        DB::setTable("CATEGORIES");
        DB::setFilter($arFilter);
        DB::get();
        $arCategory = DB::getArResult();
        DB::close();
        unset($arFilter);

        self::$category = $arCategory[0];
    }

    static private function getContent()
    {
        $detail = explode('/', $_REQUEST['path'])[-1];
        if ($detail)
        $arResult = array();
        $arFilter = array("OWNER_ID" => self::$category['id']);
        DB::setTable("CONTENT");
        DB::setFilter($arFilter);
        DB::get();
        $arContentData = DB::getArResult();
        DB::close();

        foreach ($arContentData as $key => $value) {
            $content_table = $value["CONTENT_TABLE"];
            if ($value["CONTENT_FILTER"] && $value["CONTENT_FILTER"] != 'detail') {
                $contentFilter = array();
                $content_filters = explode("+", $value["CONTENT_FILTER"]);
                foreach ($content_filters as $filter) {
                    $filter = str_replace(array("(", ")", " "), "", $filter);
                    $filter_key = explode(",", $filter)[0];
                    $filter_value = explode(",", $filter)[1];
                    $contentFilter[$filter_key] = $filter_value;
                }
            }elseif ($value["CONTENT_FILTER"] == 'detail'){
                $contentFilter = array("id"=>$_GET['id']);
                DB::setTable($content_table);
                DB::setFilter($contentFilter);
                DB::setParams(array("VIEW"=>"VIEW+1"));
                DB::update();
                DB::close();
            } else {
                $contentFilter = null;
            }
            if ($value["CONTENT_SORT"]) {
                $contentSort = array();
                $content_sorts = explode("+", $value["CONTENT_SORT"]);
                foreach ($content_sorts as $sort) {
                    $sort = str_replace(array("(", ")"), "", $sort);
                    $sort_key = explode(",", $sort)[0];
                    $sort_value = explode(",", $sort)[1];
                    $contentSort[$sort_key] = $sort_value;
                }
            } else {
                $contentSort = null;
            }
            if ($value["CONTENT_LIMIT"]) {
                $contentLimit = array();
                $content_limits = explode("+", $value["CONTENT_LIMIT"]);
                foreach ($content_limits as $limit) {
                    $limit = str_replace(array("(", ")"), "", $limit);
                    $limit_start = explode(",", $limit)[0];
                    $limit_offset = explode(",", $limit)[1];
                    $contentLimit[0] = $limit_start;
                    $contentLimit[1] = $limit_offset;
                }
            } else {
                $contentLimit = null;
            }

            $arResult[$value["CODE"]] = $value;
            DB::setTable($content_table);
            if ($contentFilter)
                DB::setFilter($contentFilter);
            if ($contentSort)
                DB::setSort($contentSort);
            if ($contentLimit)
                DB::setLimit($contentLimit);
            DB::get();
            $arContent = DB::getArResult();
            DB::close();
            $arResult[$value["CODE"]]["ITEMS"] = $arContent;
            foreach ($arResult[$value["CODE"]]["ITEMS"] as $key => $item) {
                if ($item["IMAGES"]) {
                    $arImg_id = explode(",", $item["IMAGES"]);
                    $arResult[$value["CODE"]]["ITEMS"][$key]["IMAGES"] = array();
                    foreach ($arImg_id as $img_id) {
                        unset($arFilter);
                        $arFilter = array("id" => $img_id);
                        $arResult[$value["CODE"]]["ITEMS"][$key]["IMAGES"][] = Gallery::getImages(null, $arFilter)[0];
                    }
                }
            }

        }
        self::$content = $arResult;
    }
}