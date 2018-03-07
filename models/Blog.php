<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:54
 */

namespace models;


use components\Model;

class Blog extends Model
{
    public function getBlogs () {

        return [
            [
                'title'=> 'Первая запись в блоге',
                'preview'=> 'Предпросмотр записи',
                'vews' => 666,
            ],
            [
                'title'=> 'Вторая запись в блоге',
                'preview'=> 'Предпросмотр записи',
                'vews' => 11,
            ],
            [
                'title'=> 'Третья запись в блоге',
                'preview'=> 'Предпросмотр записи',
                'vews' => 1210,
            ],
        ];
    }
}