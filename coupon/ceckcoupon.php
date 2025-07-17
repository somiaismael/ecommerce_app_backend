<?php
include "../connect.php";


$table='coupon';

$now=date("Y.m.d H:i:s");


$coupon=filterRequest('coupon');



getData($table , "coupon_name = '$coupon' AND coupon_expirdedate > '$now' AND coupon_count >  0 ");
 




