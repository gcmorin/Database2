<?php

  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $method = $_POST['method'] ?? "";
  $price = $_POST['price'] ?? "";

  $update = "update shipping_cost set price = $price where type = \"$method\"";
  $result = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
  echo 'Price has been updated';

  mysqli_close($myconnection);

?>