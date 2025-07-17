<?php

include "../../connect.php";

$orderid =filterRequest('orderid');
$usersid=filterRequest('usersid');
$accesstoken=filterRequest('accesstoken');

$data=array(
    'orders_status'=>1
);

updateData('orders',$data,"	orders_id =$orderid AND orders_status = 0");
sendNotification("warning","you order is approve waiting to recive soon",'users',$accesstoken);
?>