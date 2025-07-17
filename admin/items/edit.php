<?php
include "../../connect.php";

$itemsid= filterRequest("itemsid");
$itemsname = filterRequest("itemsname");
$itemsnameAr = filterRequest("itemsnameAr");
$itemsdec = filterRequest("itemsdec");
$itemsdecAr = filterRequest("itemsdecAr");
$itemscount = filterRequest("itemscount");
$itemsactive = filterRequest("itemsactive");
$itemsprice = filterRequest("itemsprice");
$itemsdiscount = filterRequest("itemsdiscount");
$itemscat = filterRequest("itemscat");

$imageName = imageUpload("../../upload/items/","files");
$imageold = filterRequest("imageold");
 

if($imageName == "empty"){
    $data = array(
        'items_name' =>  $itemsname ,
   'items_name_ar'=>  $itemsnameAr ,
   'items_dec' =>  $itemsdec ,
   'items_dec_ar'=>  $itemsdecAr ,
   'items_count'=>  $itemscount ,
   'items_active' =>  $itemsactive ,
   'items_price'=>  $itemsprice ,
   'items_discount'=>  $itemsdiscount,
 
   'items_cat'=>  $itemscat,
        
       );
}else{
      deleteFile("../../upload/items",$imageold);
      $data = array(
       'items_name' =>  $itemsname ,
    'items_name_ar'=>  $itemsnameAr ,
    'items_image'=>  $imageName ,
    'items_dec' =>  $itemsdec ,
    'items_dec_ar'=>  $itemsdecAr ,
    'items_count'=>  $itemscount ,
    'items_active' =>  $itemsactive ,
    'items_price'=>  $itemsprice ,
    'items_discount'=>  $itemsdiscount,
  
    'items_cat'=>  $itemscat,
        );
}



updateData('items',$data,"items_id =$itemsid");
?>

