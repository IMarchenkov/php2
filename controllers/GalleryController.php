<?php
namespace controllers;
use components\Auth;
use components\Controller;

use models\Gallery;

class GalleryController extends Controller
{

    public function actionIndex() {

        if(Auth::check()) {
//            var_dump("Приветствую, хозяин!");
        }

        $galleryModel = new Gallery();

        $params = $galleryModel->getGallery();

        $this->render ('gallery.html', $params);

    }


    public function actionView($path) {
        if(Auth::check()) {
//            var_dump("Приветствую, хозяин!");
        }

        $galleryModel = new Gallery();

        $params = $galleryModel->getDetailImage($path[3]);

        $this->render ('image.html', $params);
    }
}