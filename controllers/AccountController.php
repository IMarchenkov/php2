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
use models\Order;
use models\Status;
use models\User;


class AccountController extends Controller
{
    public function actionIndex()
    {

        if (Auth::check()) {
            $orderModel = new Order();
            if (Auth::isAdmin()) {
                $data['orders'] = $orderModel->getAllOrders();
            } else {
                $data['orders'] = $orderModel->getOrderByUser();
            }

            $data['admin'] = Auth::isAdmin();

            $statusModel = new Status();
            $data['status'] = $statusModel->getAllStatuses();
        } else {
            $data['error'] = 'Вы не авторизованы';
        }



        $this->render('account.html', $data);
    }

    public function actionCheckout()
    {
        $data = [];

        $this->render('checkout.html', $data);
    }

//    public function actionLogin( Request $request ) {
//
//        if(!empty($request->postParams)){
//            $modelUser = new User();
//
//            $user = $modelUser->getUserByLogin($request->postParams['login']);
//
//            if(!empty($user) && $user['password'] == md5($request->postParams['password'])) {
//                $_SESSION['user'] = $user;
//                echo json_encode(['success' => true]);
//            } else {
//                echo json_encode(['success' => false]);
//            }
//
//        }
//
//    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
        $this->redirect('/');

    }

    public function actionRegister()
    {
        $modelUser = new User();
        $modelUser->addUser($_REQUEST['name'], $_REQUEST['password']);
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/");
    }

    public function actionNewuser()
    {
        $this->render('register.html', []);
    }
}