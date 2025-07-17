<?php
include "../connect.php";

$userid = filterRequest("userid");



getAllData('myfavoriteview', 'favorite_usersid	= ?', array($userid));


?>
