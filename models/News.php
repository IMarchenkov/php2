<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 21:03
 */

namespace models;


class News
{
    public function getNews () {

        return [
            [
                'title'=> 'Первая запись в новостях',
                'preview'=> 'Предпросмотр записи',
                'vews' => 666,
            ],
            [
                'title'=> 'Вторая запись в новостях',
                'preview'=> 'Предпросмотр записи',
                'vews' => 11,
            ],
            [
                'title'=> 'Третья запись в новостях',
                'preview'=> 'Предпросмотр записи',
                'vews' => 1210,
            ],
        ];
    }
}