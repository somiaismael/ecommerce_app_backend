<?php
include "../connect.php";

$userid=filterRequest('userid');
$adressname=filterRequest('adressname');
$city=filterRequest('city');
$street=filterRequest('street');
$lat=filterRequest('lat');
$lang=filterRequest('lang');

$data=array(
    'address_usersid'=>$userid,
    'address_name'=>$adressname,
    'address_city'=>$city,
    'address_street'=>$street,
    'address_lat'=>$lat,
    'address_lang'=>$lang,
);

insertData('address',$data);





?>