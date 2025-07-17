<?php
include "../connect.php";

$id = filterRequest("id");



$stmt = $con->prepare("DELETE FROM favorite WHERE favorite_id  = $id ");
$stmt->execute();
$count = $stmt->rowCount();

    if ($count > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "failure"));
    }


?>


