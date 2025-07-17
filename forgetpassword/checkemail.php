<?php

include '../connect.php';

$email = filterRequest("email");

$vrfiycode = rand(10000,99999);

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? ");
$stmt ->execute(array($email ));
$count= $stmt->rowCount();

result($count);
if($count > 0){
    $data=array("users_verfiycode" => $vrfiycode);
    updateData('users' ,$data ,"users_email = '$email'", false );
      // sendEmail($email,"Vrify Code Ecommerce App","This yor verfiy code $vrfiycode");
} 

?>