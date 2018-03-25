<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Site</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/style2.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
</head>

<body>
<div class="header">
    <div class="container box-flex">
        <div class="left">
            <a class="logo" href="/"> <img src="/img/group-2.png" alt="logo">
                <span>BRAN</span><span>D</span></a>
            <div class="search">
                <button>Browse</button>
                <div class="under_browse">
                    <h1>Women</h1>
                    <hr>
                    <ul>
                        <li><a href="#">Dresses</a></li>
                        <li><a href="#">Tops</a></li>
                        <li><a href="#">Sweaters/Knits</a></li>
                        <li><a href="#">Jackets/Coats</a></li>
                        <li><a href="#">Blazers</a></li>
                        <li><a href="#">Denim</a></li>
                        <li><a href="#">Leggings/Pants</a></li>
                        <li><a href="#">Skirts/Shorts</a></li>
                        <li><a href="#">Accessories Bags/Purses</a></li>
                        <li><a href="#">Swimwear/Underwear</a></li>
                        <li><a href="#">Nightwear</a></li>
                        <li><a href="#">Shoes</a></li>
                        <li><a href="#">Beauty</a></li>
                    </ul>
                    <h1>Men</h1>
                    <hr>
                    <ul>
                        <li><a href="#">Tees/Tank tops</a></li>
                        <li><a href="#">Shirts/Polos</a></li>
                        <li><a href="#">Sweaters</a></li>
                        <li><a href="#">Sweatshirts/Hoodies</a></li>
                        <li><a href="#">Blazers</a></li>
                        <li><a href="#">Jackets/vests </a></li>
                    </ul>
                </div>
                <input type="text" placeholder="Search for Item..."><a class="fsearch" href="#"><i class="fa fa-search"
                                                                                                   aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="right">
            <a id="basket" class="basket" href="#"><img src="/img/forma-1.png" alt="basket"><span>0</span></a>
            <div id="basket_data" class="under_basket">
                <p class="total">EMPTY</p>
            </div>
            <style>
                #sign {
                    display: flex;
                    flex-flow: row nowrap;
                }

                fieldset {
                    display: flex;
                    flex-flow: column nowrap;
                    border: 0;
                }

            </style>
            <div class="my_acc">My Account</div>


            <div class="my_acc_pop">
                <? if (empty($_SESSION['login'])): ?>
                    <form id="sign" action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
                        <fieldset>
                            <input type="text" id="login" name="login" placeholder="Login">
                            <input type="password" id="pass" name="pass" placeholder="Password">
                            <label for="rememberme">Запомнить: <input type="checkbox" name="rememberme"
                                                                      id="rememberme"/></label>

                        </fieldset>
                        <fieldset>
                            <input type="submit" name="SubmitLogin" value="Sign in"/>
                            <a href="/account/newuser/">Sign up</a>
                        </fieldset>

                    </form>
                <? else: ?>
                    <form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
                        <p>Вы авторизованы под логином <b><?= $_SESSION['login'] ?></b></p>
                        <input type="submit" name="ExitLogin" value="Выйти"/>
                    </form>
                    <a href="/account/">Личный кабинет</a>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>
<?require_once "../templates/main_menu.php"?>
<main>

<!--        <h1>--><?//= $title ?><!--</h1>-->