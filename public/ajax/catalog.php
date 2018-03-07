<?php
require_once "../../autoload.php";
use models\Catalog;
require_once "../../config/dbconn.php";

if (!empty($_POST['action'])){

    switch ($_POST['action']){
        case 'count':
            $catalogModel = new Catalog();
            $count = $catalogModel->getItems(array("COUNT(*)"));
            $result =current($count[0]);
            break;
        case 'get':
            $catalogModel = new Catalog();
            $items = $catalogModel->getItems(array(),array(),array(), array(4,4));
            $result = $items;
            break;
    }

    echo json_encode($result);
}
?>