<?php

include "../../connect.php";

$orderid =filterRequest('orderid');
$usersid=filterRequest('usersid');
// $accesstoken=filterRequest('accesstoken');

$data=array(
    'orders_status'=>4
);

updateData('orders',$data,"	orders_id =$orderid AND orders_status = 3");

// sendNotification("warning","you order on the way",'users'.$usersid,$accesstoken);

// sendNotification("warning","the order has been rcived to the customer",'admin',$accesstoken);
?>