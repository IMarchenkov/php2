<nav class="container">
    <ul>
        <?
//        $arMainMenu = array(
//            array("NAME" => "Home", "LINK" => "/", "SUB" => ""),
//            array("NAME" => "Man", "LINK" => "single_page.html", "SUB" => array(0, 1, 2, 3)),
//            array("NAME" => "Women", "LINK" => "checkout.html", "SUB" => array(0, 1, 2, 3)),
//            array("NAME" => "Kids", "LINK" => "#", "SUB" => array()),
//            array("NAME" => "Accoseriese", "LINK" => "#", "SUB" => array()),
//            array("NAME" => "Featured", "LINK" => "#", "SUB" => array()),
//            array("NAME" => "Hot Deals", "LINK" => "shopping_cart.html", "SUB" => array(0, 1, 2, 3))
//        );

//        $arSubMenu = array(
//            array("Women" => "#", "Dresses" => "#", "Tops" => "#", "Sweaters/Knits" => "#",
//                "Jackets/Coats" => "#", "Blazers" => "#", "Denim" => "#", "Leggings/Pants" => "#",
//                "Skirts/Shorts" => "#", "Accessories" => "#"),
//            array("Women" => "#", "Dresses" => "#", "Tops" => "#", "Sweaters/Knits" => "#", "Jackets/Coats" => "#"),
//            array("Women" => "#", "Dresses" => "#", "Tops" => "#", "Sweaters/Knits" => "#", "Jackets/Coats" => "#"),
//            array("Women" => "#", "Dresses" => "#", "Tops" => "#", "Sweaters/Knits" => "#", "Jackets/Coats" => "#"));
        use Core\MainMenu;
        $arMainMenu = MainMenu::getMainMenu();
//        var_dump($arMainMenu);
        foreach ($arMainMenu as $tab):?>
            <li><a href="/<?=$tab["CODE"] != "main" ? $tab["CODE"] : '' ?>" ><?= $tab["NAME"] ?></a>
                <? if (!empty($tab["SUB"])) {
                    $subMenus = $tab["SUB"]; ?>
                    <div class="mega_menu">
                        <?
                        foreach ($subMenus as $subMenuID):?>
                            <ul>
                                <? foreach ($arSubMenu[$subMenuID] as $name => $link): ?>
                                    <li><a href="<?= $link ?>"><?= $name ?></a></li>
                                <? endforeach; ?>
                            </ul>
                        <? endforeach; ?>
                        <a href="#" class="menu_banner"><img src="/img/layer-42.png" alt="woman"></a>
                    </div>
                <? } ?>
            </li>
        <? endforeach; ?>
    </ul>
</nav>