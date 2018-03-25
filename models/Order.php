<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 24.03.2018
 * Time: 23:10
 */

namespace models;


use components\Auth;
use components\Model;
use models\Basket;

class Order extends Model
{
    public $table = 'ORDERS';
    public $order_id = null;
    public $basket_id = null;
    public $payment_id = null;
    public $delivery_id = null;
    public $status_id = 0;
    public $user_id = null;
    public $sum_price = 0.00;

    public function addOrder($payment_id, $delivery_id)
    {
        $basketModel = new Basket();
        $order['basket_id'] = $this->basket_id = $basketModel->freezeBasket();
        $order['payment_id'] = $this->payment_id = $payment_id;
        $order['delivery_id'] = $this->delivery_id = $delivery_id;
        $order['status_id'] = $this->status_id = 0;
        $order['user_id'] = $this->user_id = Auth::getUserId();
        $order['sum_price'] = $this->sum_price = $basketModel->totalPrice;  //стоимость доставки пока не учитываем
        $this->order_id = $this->add($order);
        return $this->order_id;
    }

    public function getOrderByUser()
    {
        $arResult = $this->get([], ['user_id' => Auth::getUserId()]);
        return $arResult;
    }

    public function getAllOrders()
    {
        $arResult = $this->get();
        foreach ($arResult as $key=>$order){
            $userModel = new User;
            $arResult[$key]['user'] = $userModel->getUserById($order['user_id']);
        }
        return $arResult;
    }

    public function statusChange($order_id, $status_id){
        $res = $this->update(['status_id'=>$status_id], ['id'=>$order_id]);
        return $res;
    }
}