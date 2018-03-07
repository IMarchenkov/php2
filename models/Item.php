<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 06.03.2018
 * Time: 22:07
 */

namespace models;


use components\Model;

class Item extends Model
{
    public $table = 'ITEMS';
    protected $id = null;
    protected $name = '';
    protected $code = '';
    protected $sort = 500;
    protected $category = 3;
    protected $image = [];
    protected $price = 0;
    protected $rating = 0;
    protected $date_create = null;
    protected $active = 'Y';

    public function __construct($id = null)
    {
        $this->pdo = \components\Db::getInstance()->getPDO();
        if ($id){
            return $this->getItemById($id);
        }
        return $this;
    }

    public function getItemById($id){
        $item = $this->get([],['id'=>$id])[0];

        $this->id = $id;
        $this->name = $item['NAME'];
        $this->code = $item['CODE'];
        $this->sort = $item['SORT'];
        $this->category = $item['CATEGORY'];
        $this->image = new Image($item['IMAGES']);
        $this->price = $item['PRICE'];
        $this->rating = $item['RATING'];
        $this->date_create = $item['DATE_CREATE'];
        $this->active = $item['ACTIVE'];

        return $this;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @return null
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }

    /**
     * @return string
     */
    public function getActive(): string
    {
        return $this->active;
    }

    /**
     * @return array
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}