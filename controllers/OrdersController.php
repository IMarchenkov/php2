<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 07.03.2018
 * Time: 14:23
 */

namespace controllers;

use components\Auth;
use components\Controller;
use models\Order;

class OrdersController extends Controller
{
    public function actionIndex()
    {

        if (Auth::check()) {
//            var_dump("Приветствую, хозяин!");
        }

//        $accountModel = new Account();

        $data = [];

        $this->render('orders.html', $data);

    }

    public function actionAdd()
    {
        if (Auth::check()) {
            $orderModel = new Order();
            $date = $orderModel->addOrder($_POST['payment_id'], $_POST['delivery_id']);
            echo json_encode(['result' => 1, 'order_id' => $date]);
        } else {
            echo json_encode(['result' => 0, 'errorMessage' => 'Авторизуйтесь для оформления заказа']);
        }
    }

    public function actionStatus(){
        if (Auth::isAdmin()){
            $orderModel = new Order();
            $res = $orderModel->statusChange($_POST['order_id'], $_POST['status_id']);
            if ($res){
                echo json_encode(['result' => 1]);
            }else {
                echo json_encode(['result' => 0, 'errorMessage' => 'Статус не изменен']);
            }
        }
    }
}