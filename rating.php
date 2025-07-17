<?php
include "./connect.php";

$orderid = filterRequest("orderid");
$rating = filterRequest("rating");
$comment = filterRequest("comment");

$data = array(
  'orders_noterating' =>  $comment ,
  'orders_rating'=>  $rating
);


updateData('orders', $data ," orders_id = $orderid");
?>