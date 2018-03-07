<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 03.03.2018
 * Time: 14:54
 */

namespace controllers;

use components\Controller;
class ErrorController extends Controller
{
    public function actionIndex() {

        $this->render ('404.html', array());

    }
}