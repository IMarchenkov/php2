<?php
include_once 'header.php';
$id = $_GET["id"];
$arSelect = array("NAME", "PATH", "VIEW");
$arFilter = array("ID" => $id);
$arImages = getImages($arSelect, $arFilter);
updateImage(array("VIEW" => "VIEW+1"), $arFilter);
$h1_title = $arImages[0]["NAME"]; ?>
    <h1><?= ucfirst($h1_title) ?></h1>
    <img src="<?= $arImages[0]["PATH"] ?>" alt="<?= $arImages[0]["NAME"] ?>">
    <span style="display: block; text-align: center;">Число просмотров: <?= $arImages[0]["VIEW"] ?></span>
<? include_once "footer.php" ?>