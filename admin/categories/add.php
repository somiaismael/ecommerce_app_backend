<?php
include "../../connect.php";

$categoriesname = filterRequest("categoriesname");
$categoriesnameAr = filterRequest("categoriesnameAr");
$categoriesimageName = imageUpload("../../upload/categories/","files");


$data = array(
  'categories_name' =>  $categoriesname ,
  'categories_name_ar'=>  $categoriesnameAr ,
  'categories_image'=>  $categoriesimageName 
);


insertData('categories',$data);
?>

