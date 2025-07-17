<?php

include "../../connect.php";

$orderid =filterRequest('orderid');
$ordertype =filterRequest('ordertype');
$usersid=filterRequest('usersid');
$accesstoken=filterRequest('accesstoken');

if($ordertype =0){
    $data=array(
        'orders_status'=>2
    );
}else{
    $data=array(
        'orders_status'=>4
    );
}


updateData('orders',$data,"	orders_id =$orderid AND orders_status = 1");

sendNotification("warning","you order is approve waiting to recive soon",'users'.$usersid,$accesstoken);

if($ordertype =0){
    sendNotification("warning","there is order wairing to approve",'delivery',$accesstoken);
}

?>