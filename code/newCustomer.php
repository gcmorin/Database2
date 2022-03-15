<?php

  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $login = $_POST['login'] ?? "";
  $name = $_POST['name'] ?? "";
  $password = $_POST['password'] ?? "";
  $address = $_POST['address'] ?? "";
  $email = $_POST['email'] ?? "";

  $addUser = "insert into user values ()";
  $result = mysqli_query($myconnection, $addUser) or die ('Query failed: ' . mysql_error());

  $getID = "select id from user order by id desc limit 1";
  $getIDResult = mysqli_query($myconnection, $getID) or die ('Query failed: ' . mysql_error());
  $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
  $newID = $row["id"];

  $addCustomer = "insert into customer values ($newID)";
  $result = mysqli_query($myconnection, $addCustomer) or die ('Query failed: ' . mysql_error());

  $addAccount = "insert into account values (\"$login\", \"$password\", $newID, \"$name\", \"address\", \"$email\", '')";
  $result = mysqli_query($myconnection, $addAccount) or die ('Query failed: ' . mysql_error());

  echo 'Account has been created';

?>