<?php
namespace controllers;
use components\Auth;
use components\Controller;

use models\Catalog;


class CatalogController extends Controller
{
    public function actionIndex() {

        if(Auth::check()) {
//            var_dump("Приветствую, хозяин!");
        }

        $catalogModel = new Catalog();

        $params = $catalogModel->getCatalog();

        $params['admin'] = Auth::isAdmin();

        $this->render ('catalog.html', $params);

    }


    public function actionView($path) {
        if(Auth::check()) {
//            var_dump("Приветствую, хозяин!");
        }

        $catalogModel = new Catalog();

        $params = $catalogModel->getDetailItem($path[2]);


        $this->render ('detail.html', $params);
    }
}