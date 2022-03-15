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

  $order = $_SESSION["order"];
  $total = 0;
  $isPhysicial = False;
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

  $total = $total + $shipping;
  echo "Shipping total: " .$shipping;
  echo "Book total: " .$total; 

  mysqli_free_result($getCart);
  mysqli_close($myconnection);

?>
  </table>
  </body>
  </html>