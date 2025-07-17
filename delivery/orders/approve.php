<?php

include "../../connect.php";

$orderid =filterRequest('orderid');
$usersid=filterRequest('usersid');
$deliveryid=filterRequest('deliveryid');
// $accesstoken=filterRequest('accesstoken');

$data=array(
    'orders_status'=>3,
    'orders_delivery'=>$deliveryid,
);

updateData('orders',$data,"	orders_id =$orderid AND orders_status = 2");

// sendNotification("warning","you order on the way",'users'.$usersid,$accesstoken); //to user
// sendNotification("warning","the order has been approve by delivery",'admin',$accesstoken);//to admin
// sendNotification("warning","the order has been approve by delivery".$deliveryid,'delivery',$accesstoken);// too all delivery men
?>