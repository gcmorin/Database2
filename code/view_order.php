 <html>
<?php
  session_start();
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $order_id = $_POST['order_id'];

  $query = "select * from orders where order_id = $order_id";
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  $order_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $paymentID = $order_info["payment_id"];


  $query = "select * from paymentinfo where payment_id = $paymentID";
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  $payment_info = mysqli_fetch_array($result, MYSQLI_ASSOC);


  echo "Name: " .$order_info["name"]. "<br>"; 
  echo "Date: " .$order_info["date"]. "<br>"; 
  echo "Address: " .$order_info["address"]. "<br>"; 
  echo "Email: " .$order_info["email"]. "<br>"; 
  echo "Billing Name: " .$payment_info["customer_name"]. "<br>"; 
  echo "Card Number: " .$payment_info["card_number"]. "<br>"; 

  $cart_item = "select * from cart where order_id = $order_id";
  $cart_item_result = mysqli_query($myconnection, $cart_item) or die ('Query failed: ' . mysql_error());


  echo "<table border='1'>

  <tr>
  <th>Title</th>
  <th>ISBN</th>
  <th>Review</th>
  </tr>";

  while ($book = mysqli_fetch_array($cart_item_result, MYSQLI_ASSOC)) {
	$id = $book["isbn"];
	$query = "select title from book where isbn = \"$id\"";
  	$result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
	$title = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo "<tr>";    
	echo "<td>" .$title["title"]. "</td>"; 
	echo "<td>" .$book["isbn"]. "</td>";
	echo "<td>
		<form action=\"review_book.php\" method=\"post\">
			<input type=\"text\" name=\"book_id\" hidden=\"true\" value = $id>
			<select name=\"rating\">
				<option value = 1>1</option>
				<option value = 2>2</option>
				<option value = 3>3</option>
				<option value = 4>4</option>				
				<option value = 5>5</option>
			</select>
			<input type=\"text\" name=\"comment\" placeholder=\"Enter Comment Here\">
			<input type=\"submit\" name=\"myButton\" value=\"Review\"/>
		</form>
	      </td>";

  }
  echo "</table>";

echo "<form action=\"rebuy.php\" method=\"post\">
			<input type=\"text\" name=\"order_id\" hidden=\"true\" value = $order_id>
			<input type=\"submit\" name=\"myButton\" value=\"Rebuy\"/>
		</form>";

mysqli_close($myconnection);
?>


<p><a href ="login.html">Back to Login</a></p>
 </html>