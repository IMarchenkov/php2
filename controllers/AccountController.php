<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 03.03.2018
 * Time: 15:04
 */

namespace controllers;
use components\Auth;
use components\Controller;

use models\Account;


class AccountController extends Controller
{
    public function actionIndex() {

        if(Auth::check()) {
            var_dump("Приветствую, хозяин!");
        }

        $accountModel = new Account();

        $data = $accountModel->getAccount();

        $this->render ('account.html', $data);

    }

    public function actionLogin( Request $request ) {

        if(!empty($request->postParams)){
            $modelUser = new User();

            $user = $modelUser->getUserByLogin($request->postParams['login']);

            if(!empty($user) && $user['password'] == md5($request->postParams['password'])) {
                $_SESSION['user'] = $user;
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }

        }

    }

    public function actionLogout( ) {
        unset($_SESSION['user']);
        $this->redirect('/');

    }
}