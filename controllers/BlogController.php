<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:30
 */

namespace controllers;
use components\Auth;
use components\Controller;

use models\Blog;

class BlogController extends Controller
{

    public function actionIndex() {

        if(Auth::check()) {
            var_dump("Приветствую, хозяин!");
        }

        $blogModel = new Blog();

        $articles = $blogModel->getBlogs();

        $this->render ('blog.tmpl', $articles);

    }


    public function actionView() {
        echo "Смотрим бложик";
    }
}