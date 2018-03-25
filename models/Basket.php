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
    public $table = 'BASKET';
    public $id = null;
    public $basket_id = null;
    public $user_id = null;
    public $date = null;
    public $totalPrice = 0;
    public $count = 0;
    public $arItems = [];
    public $arItemsId = [];

    public function addBasketItem($item_id, $quantity = 1)
    {
        $item = new Item($item_id);
        $this->totalPrice += $item->getPrice();
        $this->count += $quantity;
        $this->arItemsId = !empty($_SESSION['BASKET']) ? $_SESSION['BASKET'] : [];
        $key = null;
        foreach ($this->arItemsId as $ikey => $ivalue) {
            if ($ivalue['item_id'] == $item_id) {
                $key = $ikey;
                break;
            }
        }
        if ($key !== null) {
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
//        if (Auth::check()) {
//
//        } else {
//            $_SESSION['BASKET'] = $this->arItemsId;
//        }
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
//        $key = array_search($item_id, array_column($this->arItemsId, 'item_id'));
        $key = null;
        foreach ($this->arItemsId as $ikey => $ivalue) {
            if ($ivalue['item_id'] == $item_id) {
                $key = $ikey;
                break;
            }
        }
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
//        if (Auth::check()) {
//
//        }
        $result = true;
        $errorMessage = '';
        if (!empty($_SESSION['BASKET'])) {
            try {
                $this->arItemsId = $_SESSION['BASKET'];
            } catch (Exception $e) {
                $result = false;
                $errorMessage = $e;
            }
        } else {
            $result = false;
            $errorMessage = 'Корзина пуста';
        }
        return $this->sendBasket($result, $errorMessage);
    }

    public function sendBasket($result = true, $errorMessage = '')
    {
        $arResult = [];
        if ($result && !empty($this->arItemsId)) {
            foreach ($this->arItemsId as $key => $value) {
                if (!empty($this->arItems[$key]))
                    $item = $this->arItems[$key];
                else {
                    if (empty($value['item_id'])) {
                        unset($this->arItemsId[$key]);
                    } else {
                        $item['ITEM'] = new Item($value['item_id']);
                        $item['QUANTITY'] = $value["QUANTITY"];
                        $this->arItems[$key][] = $item;
                    }
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

    /**
     * @return null
     */
    public function getBasketId()
    {
        if ($this->basket_id == null) {
            $this->basket_id = rand(100000, 999999);
            $basket = $this->getBasketById($this->basket_id);
            if ($basket) {
                $this->getBasketId();
            }

        }
        return $this->basket_id;
    }

    public function getBasketById($basket_id)
    {
        $this->basket_id = $basket_id;
        $arBasket = $this->get([], ['basket_id' => $basket_id]);
        $this->basket_id = $basket_id;
        foreach ($arBasket as $key => $value) {

            if (!$this->user_id) {
                $this->user_id = $value['user_id'];
            }

            if (!$this->date) {
                $this->date = $value['DATE'];
            }

            $item['ITEM'] = new Item($value['item_id']);
            $item['QUANTITY'] = $value["QUANTITY"];
            $this->arItems[$key][] = $item;

            $itemId['item_id'] = $value['user_id'];
            $itemId['QUANTITY'] = $value["QUANTITY"];
            $this->arItemsId[] = $itemId;

            $this->count += $value["QUANTITY"];
            $this->totalPrice += $item['ITEM']->getPrice() * $value["QUANTITY"];
        }
        return $this;
    }

    public function freezeBasket()
    {
        $arItemsId = $this->prepareBasket();
        if (!empty($arItemsId)) {
            foreach ($arItemsId as $key => $value) {

                $item['item_id'] = $value['item_id'];
                $item['quantity'] = $value['QUANTITY'];
                $item['user_id'] = Auth::getUserId();
                $item['basket_id'] = $this->getBasketId();

                $this->add($item);

                $this->count += $value["QUANTITY"];
                $pitem = new Item($value['item_id']);
                $this->totalPrice += $pitem->getPrice() * $value["QUANTITY"];
            }
        }
        unset($_SESSION['BASKET']);
        return $this->getBasketId();
    }

    protected function prepareBasket()
    {
        $this->getBasket();
        return $this->arItemsId;
    }
}