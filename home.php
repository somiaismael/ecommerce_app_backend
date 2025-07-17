<?php
include "connect.php";

$alldata =array();
$alldata["status"] = "success" ;

//settings
// $settings= getAllData("settings" , "1=1" , null , false );
// $alldata["settings"] =$settings;

//categories
$categories= getAllData("categories" , null , null , false );
$alldata["categories"] =$categories;

//items
$items= getAllData("items" , null , null , false );
$alldata["items"] =$items;



echo json_encode($alldata);

?>