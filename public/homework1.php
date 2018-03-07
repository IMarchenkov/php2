<?php
?>
<p>1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.
2. Описать свойства класса из п.1 (состояние).
3. Описать поведение класса из п.1 (методы).
4. Придумать наследников класса из п.1. Чем они будут отличаться?</p>
<?
function translit($s) {
    $s = (string) $s; // преобразуем в строковое значение
    $s = strip_tags($s); // убираем HTML-теги
    $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = trim($s); // убираем пробелы в начале и конце строки
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
    $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
    $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
}

function addToDB($table, $arParams){
    //делаем запись с параметрами $arParams в бд в таблице $table и возвращаем id, id получается автоинкрементом
    return 1;
}
function getFromBD($table, $arParams){
    // формируем запрос исходя из входящих аргументов и выдаем массив данных
    return $arResult;
}
class Element{
    protected $id;
    protected $name;
    protected $code;
    protected $description;

    public function __construct($name, $code = false, $description = '')
    {
        $this->name = $name;
        if (!$code) $this-> getCodeFromName($name);
        $this->description = $description;
        $this->id = addToDB("items", $this);
    }

    public function getCodeFromName($name){
        return translit($name);
    }
}
class Item extends Element{

    const TABLE = "items";
    protected $arImages;
    protected $price;
    protected $quantity;


    public function __construct($name, $code = false, $description = '', $arImages = false, $price = 0, $quantity = 0)
    {
        $this->name = $name;
        if (!$code) $this-> getCodeFromName($name);
        $this->description = $description;
        $this->arImages = $arImages;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->id = addToDB(TABLE, $this);
    }

    public function getProperties(){
        $arProperties = getFromBD(TABLE, array("ID"=>$this->id));
        return $arProperties;
    }

    public function updateItem($arParams){
        //проходимся по ключам массива $arParams и обновляем свойства класса
    }

}
?>
<p>
5. Дан код:
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo(); // 1
$a2->foo(); // 2
$a1->foo(); // 3
$a2->foo(); // 4
Что он выведет на каждом шаге? Почему?

    Переменная $x принадлежит классу, поэтому увеличивается каждый раз при вызове метода foo.


Немного изменим п.5
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); // 1
$a2->foo(); // 1
$a1->foo(); // 2
$a2->foo(); // 2

    Переменнная  $x вызывается в разных классах, поэтому и изменяется в них независимо.

6. Объясните результаты в этом случае.
*Дан код:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo(); // 1
$a2->foo(); // 1
$a1->foo(); // 2
$a2->foo(); // 2
Что он выведет на каждом шаге? Почему?

    Переменнная  $x вызывается в разных классах, поэтому и изменяется в них независимо.</p>
<?
?>