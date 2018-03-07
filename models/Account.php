<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 03.03.2018
 * Time: 15:07
 */

namespace models;

use components\Model;

class Account extends Model
{
    public $table = 'ITEMS';

    public $fields = [
        'title'    => 'text',
        'content'  => 'text',
        'views'    => 'int'
    ];

    public function getAccount()
    {
        $data = array();
        $data = $this->get(array('id', 'NAME'), array('id'=>'10.<'), array('id'=>'DESC'), array(5));
        var_dump($data);
        return $data;
    }
}