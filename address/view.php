<?php
include "../connect.php";


$table='address';

$userid=filterRequest('userid');



getAllData($table , "address_usersid = $userid");
 





?>