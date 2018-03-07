<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 06.03.2018
 * Time: 0:51
 */

namespace models;


use components\Auth;
use components\Model;

class Basket extends Model
{
    public $id = null;
    public $basket_id = null;
    public $user_id = null;
    public $date = null;
    public $totalPrice = 0;
    public $count = null;
    public $arItems = [];
    public $arItemsId = [];

    public function addBasketItem($item_id, $quantity = 1)
    {
        $item = new Item($item_id);
        $this->totalPrice += $item->getPrice();
        $this->count += $quantity;
        $this->arItemsId = $_SESSION['BASKET'];
        $key = array_search($item_id, array_column($this->arItemsId, 'item_id'));
        if ($key) {
            $this->arItemsId[$key]['QUANTITY'] += $quantity;
            if (!empty($this->arItems))
                $this->arItems[$key]['QUANTITY'] += $quantity;
            else {
                $this->arItems[$key]['QUANTITY'] = $this->arItemsId[$key]['QUANTITY'];
                $this->arItems[$key]['ITEM'] = new Item($item_id);
            }
        } else {
            $this->arItems[] = ['ITEM' => $item, 'QUANTITY' => $quantity];
            $this->arItemsId[] = ['item_id' => $item_id, 'QUANTITY' => $quantity];
        }
        if (Auth::check()) {

        } else {
            $_SESSION['BASKET'] = $this->arItemsId;
        }
        $_SESSION['BASKET'] = $this->arItemsId;

//        try {
//            $this->arItemsId = $_SESSION['BASKET'];
//        } catch (Exception $e) {
//            $result = false;
//            $errorMessage = $e;
//        }
        return $this->sendBasket();
    }

    public function updateBasketItem($item_id, $quantity)
    {
        $result = true;
        $errorMessage = '';
        $this->arItemsId = $_SESSION['BASKET'];
        $key = array_search($item_id, array_column($this->arItemsId, 'item_id'));
        if ($key !== null) {
            if ($quantity > 0) {
                $this->arItemsId[$key]['QUANTITY'] = $quantity;
                if (!empty($this->arItems))
                    $this->arItems[$key]['QUANTITY'] = $quantity;
                else {
                    $this->arItems[$key]['QUANTITY'] = $this->arItemsId[$key]['QUANTITY'];
                    $this->arItems[$key]['ITEM'] = new Item($item_id);
                }
            } else {
                unset($this->arItemsId[$key]);
                unset($this->arItems[$key]);
            }
        } else {
            $result = false;
            $errorMessage = 'Такого товара в корзине нет.';
        }

        $_SESSION['BASKET'] = $this->arItemsId;
        return $this->sendBasket($result, $errorMessage);
    }

    public function getBasket()
    {
        if (Auth::check()) {

        }
        $result = true;
        $errorMessage = '';
        try {
            $this->arItemsId = $_SESSION['BASKET'];
        } catch (Exception $e) {
            $result = false;
            $errorMessage = $e;
        }

        return $this->sendBasket($result, $errorMessage);
    }

    public function sendBasket($result = true, $errorMessage = '')
    {
        $arResult = [];
        if ($result) {
            foreach ($this->arItemsId as $key => $value) {
                if (!empty($this->arItems[$key]))
                    $item = $this->arItems[$key];
                else {
                    $item['ITEM'] = new Item($value['item_id']);
                    $item['QUANTITY'] = $value["QUANTITY"];
                    $this->arItems[$key][''] = $item;
                }
                $basketItem["id"] = $item['ITEM']->getId();
                $basketItem["quantity"] = $value["QUANTITY"];
                $basketItem["price"] = $item['ITEM']->getPrice();
                $basketItem["title"] = $item['ITEM']->getName();
                $basketItem["image"] = $item['ITEM']->getImage()->getPath();
                $basketItem["rating"] = $item['ITEM']->getRating();
                $arResult[$basketItem["id"]] = $basketItem;
            }
            $arResult['items'] = $arResult;
            $arResult["result"] = 1;
        } else {
            $arResult = array();
            $arResult["result"] = 0;
            $arResult["errorMessage"] = $errorMessage;
        }

        return $arResult;
    }
}