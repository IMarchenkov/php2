<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:30
 */

namespace controllers;
use components\Controller;


class NewsController extends Controller
{
    public function actionIndex() {
        echo "Приветствуем в новостях";
    }

    public function actionView() {
        echo "Смотрим новость";
    }
}