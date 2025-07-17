<?php
include "../../connect.php";

$categoryid= filterRequest("categoryid");
$categoriesname = filterRequest("categoriesname");
$categoriesnameAr = filterRequest("categoriesnameAr");
$imageName = imageUpload("../../upload/categories/","files");
$imageold = filterRequest("imageold");


if($imageName !="empty"){
    deleteFile("../../upload/categories",$imageold);
    $data = array(
        'categories_name' =>  $categoriesname ,
        'categories_name_ar'=>  $categoriesnameAr ,
        'categories_image'=>  $imageName
      );
}else{
    $data = array(
        'categories_name' =>  $categoriesname ,
        'categories_name_ar'=>  $categoriesnameAr ,
       
      );
}



updateData('categories',$data,"categories_id =$categoryid");
?>

