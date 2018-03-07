<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 06.03.2018
 * Time: 22:37
 */

namespace models;


use components\Model;

class Image extends Model
{
    public $table = 'IMAGES';
    protected $id = null;
    protected $name ='';
    protected $path = '';
    protected $size = 0;
    protected $view = 0;
    protected $is_gallery = false;
    protected $date_create = null;

    public function __construct($id = null)
    {
        $this->pdo = \components\Db::getInstance()->getPDO();
        if($id){
            return $this->getImageById($id);
        }
        return $this;
    }

    public function getImageById($id){
        $image = $this->get([],['id'=>$id])[0];

        $this->id = $id;
        $this->name = $image['NAME'];
        $this->path = $image['PATH'];
        $this->size = $image['SIZE'];
        $this->view = $image['VIEW'];
        $this->is_gallery = $image['IS_GALLERY'];
        $this->date_create = $image['DATE_CREATE'];

        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }


}