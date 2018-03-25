<?php
require_once "../../autoload.php";

use models\Catalog;
use models\Item;

require_once "../../config/dbconn.php";

if (!empty($_POST['action'])) {

    switch ($_POST['action']) {
        case 'count':
            $catalogModel = new Catalog();
            $count = $catalogModel->getItems(array("COUNT(*)"));
            $result = current($count[0]);
            break;
        case 'get':
            $catalogModel = new Catalog();

            $start = !empty($_POST['start']) ? $_POST['start'] : 0;
            $count = !empty($_POST['count']) ? $_POST['count'] : '';
            if ($start && $count) {
                $arLimit = [$start, $count];
            } else {
                $arLimit = [];
            }
            $items = $catalogModel->getItems(array(), array(), array(), $arLimit);
            $result = $items;
            break;
        case 'delete':
            $itemModel = new Item();
            $result = $itemModel->deleteById($_POST['id']);
            break;
        case 'add':
            $itemModel = new Item();

            foreach ($_POST['item'] as $value) {
                switch ($value['name']) {
                    case 'name':
                        $item['NAME'] = $value['value'];
                        break;
                    case 'code':
                        $item['CODE'] = $value['value'];
                        break;
                    case 'price':
                        $item['PRICE'] = $value['value'];
                        break;
                    case 'image':
                        $item['IMAGES'] = $value['value'];
                        break;
                }
            }
            $result = $itemModel->addItem($item);
            break;
    }

    echo json_encode($result);
}
?>