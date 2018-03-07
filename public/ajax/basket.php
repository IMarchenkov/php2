<?php
//require_once "../../config/config.php";
//require_once "../../engine/db.php";
//require_once "../../engine/functions.php";
//require_once "../../engine/login.php";
require_once "../../autoload.php";
use models\Catalog;
require_once "../../config/dbconn.php";
function sendBasket($basket_id, $result, $errorMessage = false )
{
    $arResult = array();
//$arResult["old_basket"] = $basket_id;
    $arBasket = getBasket($basket_id);
//$arResult["new_basket"] = $basket_id;
    foreach ($arBasket as $item) {
        $arFilter = array("ID" => $item["item_id"]);
        $itemProps = getItem("ITEMS", $arFilter)["ITEMS"][0];
        $basketItem["id"] = $item["item_id"];
        $basketItem["quantity"] = $item["quantity"];
        $basketItem["price"] = $itemProps["PRICE"];
        $basketItem["title"] = $itemProps["NAME"];
        $basketItem["image"] = $itemProps["IMAGES"][0]["PATH"];
        $basketItem["rating"] = $itemProps["RATING"];
        $arResult[$item["item_id"]] = $basketItem;
    }
    $arResult["items"] = $arResult;
    if ($result) {
        $arResult["result"] = 1;
    } else {
        $arResult = array();
        $arResult["result"] = 0;
        $arResult["errorMessage"] = $errorMessage;
    }
//    $arResult['basket'] = $basket_id;
    echo json_encode($arResult);
}

$result = true;
$action = $_POST["action"];
switch ($action) {
    case 'add':
        $basket_id = createBasket();
        try {
            addBasket($_POST["item_id"]);
        } catch (Exception $e) {
            $result = false;
            $errorMessage = $e;
        }
        sendBasket($basket_id, $result);
        break;
    case 'delete':
        $basket_id = createBasket();
        try {
            updateBasket($basket_id, $_POST["item_id"], 0);
        } catch (Exception $e) {
            $result = false;
            $errorMessage = $e;
        }
        sendBasket($basket_id, $result);
        break;
    case 'change':
        $basket_id = createBasket();
        try {
            updateBasket($basket_id, $_POST["item_id"], $_POST["quantity"]);
        } catch (Exception $e) {
            $result = false;
            $errorMessage = $e;
        }
        sendBasket($basket_id, $result);
        break;
    case 'order':
        $errorMessage = false;
        if ($_SESSION["login"]) {
            createOrder($basket_id, 1, 1);
        }else{
            $result = false;
            $errorMessage = "Для офрмления покупки, пожалуйста, авторизуйтесь.";
        }
            $basket_id = createBasket();

        sendBasket($basket_id, $result, $errorMessage);
        break;
    case 'get':
        $basket_id = createBasket();
        $result = true;
        sendBasket($basket_id, $result);
        break;
}

?>