<?php
?>
    <p>1. Создать структуру классов ведения товарной номенклатуры. <br>
        Есть абстрактный товар.<br>
        Есть цифровой товар, штучный физический товар и товар на вес.<br>
        У каждого есть метод подсчёта финальной стоимости.<br>
        У цифрового товара стоимость постоянная и дешевле штучного товара в два раза, у штучного товара обычная
        стоимость, у весового – в зависимости от продаваемого количества в килограммах. У всех формируется в конечном
        итоге доход с продаж.<br>
        Что можно вынести в абстрактный класс, наследование?</p>
<?

abstract class Good
{
    public $name;
    protected $price = 1000;
    protected $sales_revenue = 0;
    const K = 0.18;

    public function getSalesRevenue()
    {
        return $this->price * self::K;
    }

    abstract public function getPrice();
}

class PhysicalGood extends Good
{
    protected $weight;
    protected $quantity;

    /**
     * PhysicalGood constructor.
     * @param $weight
     * @param $quantity
     */
    public function __construct($name, $weight = 0, $quantity = 1)
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

}

class DigitalGood extends Good
{
    protected $quantity;

    /**
     * DigitalGood constructor.
     * @param $quantity
     */
    public function __construct($name, $quantity = 1)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price / 2;
    }

}

class BulkGood extends Good
{
    protected $weight;

    /**
     * BulkGood constructor.
     * @param $weight
     */
    public function __construct($name, $weight)
    {
        $this->name = $name;
        $this->weight = $weight;
    }

    public function getPrice()
    {
        return $this->price * $this->weight;
    }

}

$good1 = new PhysicalGood("physic good", 1, 1);
echo $good1->name;
echo "<br>";
echo $good1->getPrice();
echo "<br>";
$good2 = new DigitalGood("digital good", 1);
echo $good2->name;
echo "<br>";
echo $good2->getPrice();
echo "<br>";
$good3 = new BulkGood("bulk good", 2);
echo $good3->name;
echo "<br>";
echo $good3->getPrice();
echo "<br>";
?>