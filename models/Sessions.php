<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 04.03.2018
 * Time: 23:33
 */

namespace models;


use components\Model;
use models\User;

class Sessions extends Model
{
    public $table = 'users_auth';

    public function addUserSession($id_user, $isRemember)
    {
        $idUserCookie = (int)explode('.', microtime(true)/10000 + rand(100, 999))[0]* rand(100, 999) ;
        $_SESSION['id_user'] = $id_user;
        $_SESSION['IdUserSession'] = $idUserCookie;
        $arParams = array("id_user" => $id_user, "hash_cookie" => $idUserCookie, "prim" => '123456789');
        $this->add($arParams);
        if ($isRemember) {
            setcookie('idUserCookie', $idUserCookie, time() + 3600 * 24 * 7);
        }
    }

    public function killUserSession($IdUserSession)
    {
        $this->del(array("hash_cookie" => $IdUserSession));
        unset($_SESSION['id_user']);
        unset($_SESSION['IdUserSession']);
        unset($_SESSION['login']);
        unset($_SESSION['pass']);
        setcookie('idUserCookie', '', time() - 3600 * 24 * 7);
        setcookie("basket_id", '', time() - 3600 * 24 * 7);

        unset($_SESSION['BASKET']);
    }

    public function getUsersSession($hash_cookie)
    {
        $arResult = $this->get(array(), array("hash_cookie" => $hash_cookie));
        if (!empty($arResult)) {
            $userModel = new User();
            $res = $userModel->getUsers(array(), array("id_user" => $arResult[0]["id_user"]));
//            var_dump($res);
            if (!empty($res))
                $arResult[0]["login"] = $res[0]["login"];
            return $arResult;
        } else {
            return null;
        }
    }
}