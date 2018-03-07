<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 21:06
 */

namespace controllers;


use components\Controller;
use models\Blog;
use models\News;

class IndexController extends Controller
{
    public function actionIndex() {

        $blogModel = new Blog();

        $newsModel = new News();


        $this->render ('index.html', [
//            'blogs' => $blogModel->getBlogs(),
//            'news'  => $newsModel->getNews(),
        ]);
    }

}