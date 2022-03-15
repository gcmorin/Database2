<html>
<?php
     session_start();
      $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
      
      $old_order = $_POST['order_id'];

      $query = "insert into orders values ('',NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
      $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());

      $getID = "select order_id from orders order by order_id desc limit 1";
      $getIDResult = mysqli_query($myconnection, $getID) or die ('Query failed: ' . mysql_error());
      $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
      $new_order = $row["order_id"];      

      $_SESSION["order"] = $new_order;
      $old_cart = "select * from cart where order_id = $old_order";
      $cart_result = mysqli_query($myconnection, $old_cart) or die ('Query failed: ' . mysql_error());  

      while ($cart = mysqli_fetch_array($cart_result, MYSQLI_ASSOC)) {
	$isbn = $cart["isbn"];
	$quantity = $cart["quantity"];
      	$new_cart = "insert into cart values ('',$new_order, \"$isbn\", $quantity)";
	$result = mysqli_query($myconnection, $new_cart) or die ('Query failed: ' . mysql_error());
      }
     include("orders.php");
?>
</html>