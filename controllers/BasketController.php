<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 06.03.2018
 * Time: 21:58
 */

namespace controllers;


use components\Controller;
use models\Basket;

class BasketController extends Controller
{
    public function actionAdd($path = [], $quantity = 1)
    {
        $item_id = $_POST['item_id'];
        $basketModel = new Basket();
        $res = $basketModel->addBasketItem($item_id, $quantity);
        echo json_encode($res);
    }

    public function actionGet(){
//        unset($_SESSION['BASKET']);
        $basketModel = new Basket();
        $res = $basketModel->getBasket();
        echo json_encode($res);
    }

    public function actionDelete($path = [], $quantity = 0){
        $basketModel = new Basket();
        $item_id = $_POST['item_id'];
        $res = $basketModel->updateBasketItem($item_id,$quantity);
        echo json_encode($res);
    }

    public function actionChange($path = []){
        $basketModel = new Basket();
        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];
        $res = $basketModel->updateBasketItem($item_id,$quantity);
        echo json_encode($res);
    }
}