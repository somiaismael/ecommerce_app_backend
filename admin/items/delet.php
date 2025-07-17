<?php
include "../../connect.php";

$itemsid= filterRequest("itemsid");

$itemsimageName = filterRequest("itemsimageName");

deleteFile("../../upload/items",$itemsimageName);

deleteData('items',"items_id =$itemsid");
?>

