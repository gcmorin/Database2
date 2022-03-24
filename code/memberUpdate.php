<?php
  session_start();

  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $currentLogin = $_SESSION["c_username"];
  $name = $_POST['name'] ?? "";
  $password = $_POST['password'] ?? "";
  $address = $_POST['address'] ?? "";
  $email = $_POST['email'] ?? "";
  $become_member = $_POST['become_member'] ?? "No";

  $getcustID = "select customer_id from account where login = \"$currentLogin\"";
  $getIDResult = mysqli_query($myconnection, $getcustID) or die ('Query failed: ' . mysql_error());
  $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
  $custID = $row["customer_id"];


  if($name <> null) {
	$update = "update account set name = \"$name\" where customer_id = $custID";
        $result = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
  }
  if($password <> null) {
	$update = "update account set password = \"$password\" where customer_id = $custID";
        $result = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
  }
  if($address <> null) {
	$update = "update account set address = \"$address\" where customer_id = $custID";
        $result = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
  }
  if($email <> null) {
	$update = "update account set email = \"$email\" where customer_id = $custID";
        $result = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
  }
  if($become_member == "Yes") {
  	$update = "update account set memberstatus = 1 where customer_id = $custID";
        $result = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());


    //Grab Order
    	$query = "insert into orders values ('',NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
        $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());    

        $getID = "select order_id from orders order by order_id desc limit 1";
        $getIDResult = mysqli_query($myconnection, $getID) or die ('Query failed: ' . mysql_error());
        $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
        $newID = $row["order_id"];
  
  	$query2 = "insert into cart values ('', $newID, \"Buy Now!\", 1)";
  	$result2 = mysqli_query($myconnection, $query2) or die ('Query failed: ' . mysql_error());

  }
 
  echo 'Account Info Updated';
  mysqli_close($myconnection);
  /* Redirect browser */
  header("Location: ../code/orders.php"); 
  exit();

?>
<html>
<p><a href ="login.html">Back to Login</a></p>
 </html>
