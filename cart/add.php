<?php
include "../connect.php";

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");


$count = getData(
  'cart','cart_userid = ? AND cart_itemsid = ? AND cart_orders = 0',array($userid,$itemid),false);

$data = array(
  'cart_userid' =>  $userid ,
  'cart_itemsid'=>  $itemid 
);


insertData('cart',$data);
?>

