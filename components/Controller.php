<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:20
 */

namespace components;

class Controller
{
    public function render($view, $params = [])
    {

//        echo "Будет отрисован шаблон {$view}  с параметрами:";

//        var_dump($params);

        $loader = new \Twig_Loader_Filesystem('../templates');
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new \Twig_Extension_Debug());
        $template = $twig->loadTemplate($view);
        if (Auth::check()) {
//            var_dump("Приветствую, хозяин!");
        }
        require_once "../templates/header.php"; // как время будет переведу на twig
        echo $template->render($params);
        require_once "../templates/footer.php"; // как время будет переведу на twig
    }
}