<?php
function sum($a, $b)
{
    return $a + $b;
}

function minus($a, $b)
{
    return $a - $b;
}

function mult($a, $b)
{
    return $a * $b;
}

function div($a, $b)
{
    if ($b != 0) return $a / $b;
    else return "Division by zero";
}

switch ($_REQUEST["action"]) {
    case "sum":
        $res = sum($_REQUEST["num1"], $_REQUEST["num2"]);
        break;
    case "minus":
        $res = minus($_REQUEST["num1"], $_REQUEST["num2"]);
        break;
    case "mult":
        $res = mult($_REQUEST["num1"], $_REQUEST["num2"]);
        break;
    case "div":
        $res = div($_REQUEST["num1"], $_REQUEST["num2"]);
        break;
}
echo $res ?>