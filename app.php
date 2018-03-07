<?php
session_start();
require_once "autoload.php";
require_once "vendor/autoload.php";


$arURL = explode("/", $_SERVER["REQUEST_URI"]);
$arResult = createPage($arURL);
$title = $arResult["CATEGORY"]["NAME"];
require_once "templates/header.php";
if ($arResult["CONTENT"]) {
    require_once "templates/" . $arResult["CATEGORY"]["CODE"] . ".php";
} else {
    $content["NAME"] = "ОШИБКА пусто";
    require_once "templates/404.php";
}
require_once "templates/footer.php";
?>