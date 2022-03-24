<?php

  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $method = $_POST['method'] ?? "";
  $price = $_POST['price'] ?? "";
  $login = $_POST['login'] ?? "";
  $password = $_POST['password'] ?? "";
  $pname = $_POST['pname'] ?? "";


if($price <> ""){
  $update = "update shipping_cost set price = $price where type = \"$method\"";
  $result = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
  echo 'Price has been updated';
}

if($login <> ""){
  $add_user = "insert into user values ('')";
  $user_result = mysqli_query($myconnection, $add_user) or die ('Query failed: ' . mysql_error());
  $getID = "select id from user order by id desc limit 1";
  $getIDResult = mysqli_query($myconnection, $getID) or die ('Query failed: ' . mysql_error());
  $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
  $newID = $row["id"];
  $query = "insert into publisher values (\"$login\",\"$password\", $newID,\"$pname\")";
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  echo 'Publisher has been added';
}

  mysqli_close($myconnection);

?>
<html>
<p><a href ="login.html">Back to Login</a></p>
</html>