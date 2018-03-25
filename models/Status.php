<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 25.03.2018
 * Time: 11:45
 */

namespace models;


use components\Model;

class Status extends Model
{
    public $table = 'ORDER_STATUS';

    public function getStatusById($id){
        return $this->get([],['id'=>$id])[0];
    }

    public function getAllStatuses(){
        return $this->get();
    }

}