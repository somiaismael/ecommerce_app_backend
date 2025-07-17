<?php
include "../../connect.php";

$categoryid= filterRequest("categoryid");
$categoriesimageName = filterRequest("files");

deleteFile("../../upload/categories",$categoriesimageName);

deleteData('categories',"categories_id =$categoryid");
?>

