<?php
include "../connect.php";

$userid = filterRequest("userid");
$itemid = filterRequest("itemid");


$stmt = $con->prepare("DELETE FROM favorite WHERE favorite_usersid  = $userid AND favorite_itemsid = $itemid");
$stmt->execute();
$count = $stmt->rowCount();

    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }


?>


