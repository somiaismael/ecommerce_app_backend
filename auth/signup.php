<?php

include '../connect.php';


$username = filterRequest("username");
$email = filterRequest("email");
$phone = filterRequest("phone");
$password = sha1($_POST["password"]);
$vrfiycode = rand(10000,99999);

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? OR users_phone = ?");
$stmt ->execute(array($email , $phone));
$count= $stmt->rowCount();

if($count > 0){
    printFailure("email or phone are exist");
} else {

    $data =array(
        "users_name" => $username,
        "users_email" => $email,
        "users_phone" => $phone,
        "users_password" => $password,
        "users_verfiycode" => $vrfiycode,
    );
    // sendEmail($email,"Vrify Code Ecommerce App","This yor verfiy code $vrfiycode");
    insertData("users" ,$data );

}