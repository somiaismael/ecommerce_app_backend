<?php

include '../connect.php';


$userid = filterRequest("userid");
$addressid = filterRequest("addressid");
$orderstype = filterRequest("orderstype");
$pricedelivery = filterRequest("pricedelivery");
$priceorders = filterRequest("priceorders");
$couponid = filterRequest("couponid");
$coupondiscount = filterRequest("coupondiscount");
$paymentmethod = filterRequest("paymentmethod");

$totalprice= $pricedelivery + $priceorders;

//check type delivery
if($orderstype == 1){
    $pricedelivery=0;
}
//check coupon

$now=date("Y.m.d H:i:s");


$checkcoupon=getData('coupon' , "coupon_id  = '$couponid' AND coupon_expirdedate > '$now' AND coupon_count >  0  ",null,false);

if($checkcoupon >0){
    $totalprice =$totalprice - $priceorders * $coupondiscount /100;
    $stmt=$con->prepare(
        "UPDATE `coupon` SET `coupon_count`=`coupon_count` - 1 WHERE coupon_id  = '$couponid'");
    $stmt->execute();

}

//
$data = array(
    "orders_userid" => $userid,
    "orders_address" => $addressid,
    "orders_type" => $orderstype,
    "orders_pricedelivery" => $pricedelivery,
    "orders_price" => $priceorders,
    "orders_coupon" => $couponid,
    "orders_paymentmethod" => $paymentmethod,
    "orders_totalprice" => $totalprice,
    
);

$count=insertData("orders", $data,false);

if($count > 0){

    $stmt=$con->prepare("SELECT MAX(orders_id) FROM orders");
    $stmt->execute();
    $maxid=$stmt->fetchColumn();
    $data=array(
        "cart_orders" => $maxid
    );

    updateData("cart",$data,"cart_userid =$userid AND cart_orders = 0");
}