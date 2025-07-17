<?php
include "../../connect.php";

$itemsname = filterRequest("itemsname");
$itemsnameAr = filterRequest("itemsnameAr");
$itemsdec = filterRequest("itemsdec");
$itemsdecAr = filterRequest("itemsdecAr");
$itemscount = filterRequest("itemscount");
$itemsactive = filterRequest("itemsactive");
$itemsprice = filterRequest("itemsprice");
$itemsdiscount = filterRequest("itemsdiscount");
$itemsdate = filterRequest("itemsdate");
// $itemsdate = date("Y-m-d H:i:s");
$itemscat = filterRequest("itemscat");

$itemsimageName = imageUpload("../../upload/items/","files");


$data = array(
  'items_name' =>  $itemsname ,
  'items_name_ar'=>  $itemsnameAr ,
  'items_image'=>  $itemsimageName ,
  'items_dec' =>  $itemsdec ,
  'items_dec_ar'=>  $itemsdecAr ,
  'items_count'=>  $itemscount ,
  'items_active' =>  $itemsactive ,
  'items_price'=>  $itemsprice ,
  'items_discount'=>  $itemsdiscount,
  'items_date'=>  $itemsdate ,
  'items_cat'=>  $itemscat,
);


insertData('items',$data);
?>

