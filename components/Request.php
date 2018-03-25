<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:23
 */

namespace components;

use controllers\ErrorController;
use \Exception;

class Request
{
    protected $controller = 'index';
    protected $action = 'index';
    protected $controllerNamespace = 'controllers';



    public function init() {

        $url =  !empty($_REQUEST['path']) ? $_REQUEST['path'] : '';
        $path = explode('/',$url);

        if( count($path) >= 2 ) {
            $this->controller = $path[0];
            $this->action = $path[1] ? $path[1] : $this->action;
        } elseif ( count($path) == 1 && !empty ( $path[0])) {
            $this->controller = $path[0];
        }

        $classController = $this->controllerNamespace . '\\' . ucfirst($this->controller) . 'Controller';

        $action = 'action' . ucfirst($this->action);


        if(class_exists($classController)) {
           $instanceController = new $classController;
           if(method_exists($instanceController,$action)) {
               call_user_func_array([$instanceController,$action],[$path]);
           } else {
                throw new Exception(' Метод не существует!');
           }
        } else{
            $instanceController = new ErrorController();
            $instanceController->actionIndex();
        }



    }

}