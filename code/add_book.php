 <html>
<?php
  session_start();
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $isbn = $_POST['book_id'];
  $quantity = $_POST['quantity'];
  $order_id = $_SESSION["order"];

  $query = "insert into cart values ('',$order_id,\"$isbn\", $quantity)";
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  echo 'Book has been added to your cart';

  mysqli_close($myconnection);
?>
<p><a href ="search_book_form.php">Back to Search</a></p>
 </html>