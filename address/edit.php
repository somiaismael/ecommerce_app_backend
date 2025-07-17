<?php
include "../connect.php";


$table='address';

$addressid=filterRequest('addressid');

$adressname=filterRequest('adressname');
$city=filterRequest('city');
$street=filterRequest('street');
$lat=filterRequest('lat');
$lang=filterRequest('lang');

$data=array(
    'address_name'=>$adressname,
    'address_city'=>$city,
    'address_street'=>$street,
    'address_lat'=>$lat,
    'address_lang'=>$lang,
);
updateData($table , $data ,"address_id = $addressid");
 





?>