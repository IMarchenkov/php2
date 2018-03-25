<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 21:18
 */

namespace components;

use components\traits\SingletonTrait;
use models\User;
use models\Sessions;

class Auth
{
    use SingletonTrait;
    private $user;

    public static function check()
    {
        return !empty(self::getInstance()->getUser());
    }

    public function init()
    {
        $this->user = null;

//        $userModel = new User();
//        $sessionModel = new Sessions();
        if (!empty($_POST['SubmitLogin'])) {
            $this->login();
        } elseif (!empty($_SESSION['IdUserSession']))    // пытаемся авторизоваться через сессии
        {
            $this->checkAuthWithSession($_SESSION['IdUserSession']);
//	echo "Авторизация по сессии";
        } else // В последнем случае пытаемся авторизоваться через cookie
        {
            $this->checkAuthWithCookie();
//	echo "авторизация по cookie";
        }
        if (!empty($_POST['ExitLogin'])) {
            $this->UserExit();
        }
    }

    /*
    Осуществляем удаление всех переменных, отвечающих за авторизацию пользователя.
    */
    function UserExit()
    {
        //Удаляем запись из БД об авторизации пользователей
        if (!empty($_SESSION['IdUserSession'])) {
            $sessionModel = new Sessions();
            $sessionModel->killUserSession($_SESSION['IdUserSession']);
        }
        unset($this->user);
    }

    /*Авторизация пользователя
    при использования технологии хэширования паролей
    $username - имя пользователя
    $password - введенный пользователем пароль
    */

    protected function authWithCredential($username, $password)
    {
        $arFilter = array("login" => $username);
        $userModel = new User();
        $user_date = $userModel->getUsers(array(), $arFilter);
        if (!empty($user_date[0])) {
            $user_date = $user_date[0];
            $passHash = $user_date['pass'];
            $id_user = $user_date['id_user'];
            if (password_verify($password, $passHash)) {
                $this->user = $userModel->getUsers(array(), array('id_user' => $id_user));
                if (!empty($_POST['rememberme']))
                    $isRemember = $_POST['rememberme'] == "on" ? true : false;
                else
                    $isRemember = false;
                $sesionModel = new Sessions();
                $sesionModel->addUserSession($id_user, $isRemember);
                $_SESSION['login'] = $user_date['login'];
            } else {
                $this->UserExit();
            }
        } else {
            $this->UserExit();
        }
    }

    /* Авторизация при помощи сессий
    При переходе между страницами происходит автоматическая авторизация
    */
    protected function checkAuthWithSession($IdUserSession)
    {
        $sessionModel = new Sessions();
        $user_date = $sessionModel->getUsersSession($IdUserSession)[0];
        if (!empty($user_date)) {
            $userModel = new User();
            $this->user = $userModel->getUsers(array(), array('id_user' => $user_date['id_user']))[0];
            $_SESSION['IdUserSession'] = $IdUserSession;
            $_SESSION['login'] = $user_date['login'];
            $_SESSION['id_user'] = $user_date['id_user'];
        } else {
            $this->UserExit();
        }
    }

    protected function checkAuthWithCookie()
    {
        if (!empty($_COOKIE['idUserCookie'])) {
            $idUserCookie = $_COOKIE['idUserCookie'];
            $sessionModel = new Sessions();
            $user_date = $sessionModel->getUsersSession($idUserCookie)[0];

            if ($user_date) {
                $this->checkAuthWithSession($idUserCookie);
            } else {
                $this->UserExit();
            }
        } else {
            $this->UserExit();
        }
    }

    protected function login()
    {
        if ($_POST['SubmitLogin'])   //Если попытка авторизации через форму, то пытаемся авторизоваться
        {
            $this->authWithCredential($_POST['login'], $_POST['pass']);
//	echo "Авторизация по форме";
        } elseif ($_SESSION['IdUserSession'])    //иначе пытаемся авторизоваться через сессии
        {
            $this->checkAuthWithSession($_SESSION['IdUserSession']);
//	echo "Авторизация по сессии";
        } else // В последнем случае пытаемся авторизоваться через cookie
        {
            $this->checkAuthWithCookie();
//	echo "авторизация по cookie";
        }
    }


    public function getUser()
    {
        if (!empty($this->user))
            return $this->user;
        else
            return null;
    }


    public static function getLogin()
    {

        if (!self::check()) {
            return null;
        }

        $user = self::getInstance()->getUser();

        return $user['login'];


    }

    public static function isAdmin()
    {

        $user = self::getInstance()->getUser();

        if (!empty($user['role']) && $user['role'] == 'admin') {
            return true;
        }

        return false;
    }

    public static function getUserId(){

        $user = self::getInstance()->getUser();
        if (!empty($user['id_user']))
            return $user['id_user'];
        else
            return null;
    }

//    public function init()
//    {
//
//        $this->user = null;
//
//        $userModel = new User();
//
//        if (!empty($_SESSION['user']['id'])) {
//            $this->user = $userModel->getUserById($_SESSION['user']['id']);
//
//        }
//
//
//        //$this->user = $userModel->getUser();
//
//    }
}