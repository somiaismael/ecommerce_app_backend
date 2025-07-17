<?php


include "../../connect.php";

$email = filterRequest("email");
$password = filterRequest("password");


// $stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? And users_password = ? And users_approve = 1");
// $stmt ->execute(array($email , $password));
// $count= $stmt->rowCount();
// result($count);
getData("delivery","delivery_email = ? And delivery_password = ? ",array($email,$password));