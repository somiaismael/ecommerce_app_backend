<?php
include "../connect.php";

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");

deleteData(
    'cart',"cart_id = (SELECT cart_id FROM cart WHERE cart_userid=$userid AND cart_itemsid = $itemid AND cart_orders = 0 LIMIT 1)")



?>


