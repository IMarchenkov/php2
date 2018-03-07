<?php

function autoload($className) {
//    echo 'Попытка загрузки класса:' . $className . '<br>';
    $fileName = __DIR__ .'/' .str_replace('\\','/',$className) . '.php';

//    echo 'Ищем класс в директоррии:' . $fileName . '<br>';
    if(file_exists($fileName)) {
        require_once $fileName;
    }

}

spl_autoload_register('autoload');