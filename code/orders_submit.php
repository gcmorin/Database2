<html>
<?php
  session_start();
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $name = $_POST['name'];
  $address = $_POST['address'];
  
      $getID = "select order_id from orders order by order_id desc limit 1";
      $getIDResult = mysqli_query($myconnection, $getID) or die ('Query failed: ' . mysql_error());
      $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
      $order_id = $row["order_id"];
  $cID = $_SESSION["custID"];
  $email = $_POST['email'];
  $date = $_POST['date'];
  $total = $_SESSION["total"];

  $cname = $_POST['cname'];
  $cnumber = $_POST['cnumber'];
  $edate = $_POST['edate'];
  $cvv = $_POST['cvv'];

  $query = "insert into paymentinfo values ('',$cID,$cnumber, \"$edate\", $cvv, \"$cname\")";
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
 
  $getID = "select payment_id from paymentinfo order by payment_id desc limit 1";
  $getIDResult = mysqli_query($myconnection, $getID) or die ('Query failed: ' . mysql_error());
  $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
  $pID = $row["payment_id"];

  $update = "UPDATE orders
              SET customer_id = $cID, payment_id = $pID, total = $total, 
		name = \"$name\", address = \"$address\", date = \"$date\", email = \"$email\"
WHERE order_id = $order_id";
  $result = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
  mysqli_close($myconnection);
  echo "Order has been submited";
?>
<p><a href ="login.html">Back to Login Page</a></p>
 </html>