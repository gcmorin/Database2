<html>
  <head>
  <title>Cart</title>
  </head>
  <body>
  <table>
<?php
 session_start();
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database'); 

      $getID = "select order_id from orders order by order_id desc limit 1";
      $getIDResult = mysqli_query($myconnection, $getID) or die ('Query failed: ' . mysql_error());
      $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
      $order = $row["order_id"];

  $cID = $_SESSION["custID"];
  $total = 0;
  $isPhysical = False;
  $isDigital = False;
  $shipping = 0;
  echo "<table border='1'>

  <tr>
  <th>Title</th>
  <th>Quantity</th>
  </tr>";  


  $cart_item = "select * from cart where order_id = $order";
  $getCart = mysqli_query($myconnection, $cart_item) or die ('Query failed: ' . mysql_error());

  while ($cart = mysqli_fetch_array($getCart, MYSQLI_ASSOC)) {
	$id = $cart["isbn"];
	$title = "select * from book where isbn = \"$id\"";
	$getTitle = mysqli_query($myconnection, $title) or die ('Query failed: ' . mysql_error());
        $book = mysqli_fetch_array($getTitle, MYSQLI_ASSOC);
        if($book["type"] == "hardcover" || $book["type"] == "paperback"){
	 $isPhysical = True;
	} else if ($book["type"] == "audio" || $book["type"] == "ebook"){
	 $isDigital = True;
	}
	$total += $book["price"] * $cart["quantity"];
	echo "<tr>";    
	echo "<td>" .$book["title"]. "</td>"; 
	echo "<td>" .$cart["quantity"]. "</td>";
	mysqli_free_result($getTitle);
  }

  echo "</table>";
  if($isPhysical == True){
  	$pshipping = "select price from shipping_cost where type = \"mail\"";
	$getpshipping = mysqli_query($myconnection, $pshipping) or die ('Query failed: ' . mysql_error());
	$p_cost = mysqli_fetch_array($getpshipping, MYSQLI_ASSOC);	
	$shipping += $p_cost["price"];
  }
  if($isDigital == True){
  	$eshipping = "select price from shipping_cost where type = \"email\"";
	$geteshipping = mysqli_query($myconnection, $eshipping) or die ('Query failed: ' . mysql_error());
	$e_cost = mysqli_fetch_array($geteshipping, MYSQLI_ASSOC);
	$shipping += $e_cost["price"];	
  }

  $isMember = "select memberstatus from account where customer_id = $cID";
  $getMem = mysqli_query($myconnection, $isMember) or die ('Query failed: ' . mysql_error());
  $mem = mysqli_fetch_array($getMem, MYSQLI_ASSOC);
  
  if($mem != null){
	if($mem["memberstatus"] != 0){
  		$shipping = 0;
	}
  }

  $total = $total + $shipping;
  echo "Shipping total: " .$shipping. "<br>";
  echo "Book total: " .$total; 
  $_SESSION["total"] = $total;



  mysqli_free_result($getCart);
  mysqli_close($myconnection);

?>
<form action="orders_submit.php" method="post">
<table border="0">
<tr>
  <td>Name</td>
  <td align="left"><input type="text" name="name" size="20" maxlength="20"/></td>
</tr>
  <td>Address</td>
  <td align="left"><input type="text" name="address" size="50" maxlength="50"/></td>
</tr>
</tr>
  <td>Email</td>
  <td align="left"><input type="text" name="email" size="50" maxlength="50"/></td>
</tr>
<tr>
  <td>Date</td>
  <td align="left"><input type="text" name="date" size="10" placeholder="YYYY-MM-DD"/></td>
</tr>
<tr>
  <td>Card Name</td>
  <td align="left"><input type="text" name="cname" size="20" maxlength="20"/></td>
</tr>
<tr>
  <td>Card Number</td>
  <td align="left"><input type="text" name="cnumber" size="16"/></td>
</tr>
<tr>
  <td>Experation Date</td>
  <td align="left"><input type="text" name="edate" size="5" placeholder="MM/YY"/></td>
</tr>
<tr>
  <td>CVV</td>
  <td align="left"><input type="text" name="cvv" size="3"/></td>
</tr>
<tr>
  <td colspan="2" align="left"><input type="submit" value="Order"/></td>
</tr>
</table>
</form>
  </table>
  </body>
<p><a href ="search_book_form.php">Back to Book Search</a></p>
<p><a href ="login.html">Back to Login</a></p>
  </html>

