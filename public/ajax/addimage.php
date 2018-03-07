<?php
require_once "../../autoload.php";
use models\Gallery;
require_once "../../config/dbconn.php";
if ($_FILES) {
    $file = $_FILES["new_image"];
    Gallery::addImage($file, true);
}

header("Location:" . $_SERVER["HTTP_REFERER"]);
exit;