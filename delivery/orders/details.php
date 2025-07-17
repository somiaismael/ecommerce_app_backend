<?php

include "../../connect.php";

$cartorders=filterRequest("cartorders");

getAllData("ordersdetailsview","cart_orders = $cartorders");
