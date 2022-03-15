<html>
  <head>
  <title>Searched Books</title>
  </head>
  <body>
  <table>
<?php
    session_start();

  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  if($_SESSION["order"] == " "){
      $query = "insert into orders values ('',NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
      $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());

      $getID = "select order_id from orders order by order_id desc limit 1";
      $getIDResult = mysqli_query($myconnection, $getID) or die ('Query failed: ' . mysql_error());
      $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
      $newID = $row["order_id"];      

      $_SESSION["order"] = $newID;
  }
  

  $type = $_POST['Type'] ?? "";
  $values = $_POST['value'] ?? "";

  if ($type == "All"){
	$all_book = "select * from book";
	$getBookResult = mysqli_query($myconnection, $all_book) or die ('Query failed: ' . mysql_error());
  } else {
	$book_list = "select * from book where $type = \"$values\"";
	$getBookResult = mysqli_query($myconnection, $book_list) or die ('Query failed: ' . mysql_error());
  }

  echo "<table border='1'>

  <tr>
  <th>Title</th>
  <th>ISBN</th>
  <th>Author ID</th>
  <th>Type</th>
  <th>Price</th>
  <th>Genre</th>
  <th>Series</th>
  <th>Cart</th>
  </tr>";

  while ($book = mysqli_fetch_array($getBookResult, MYSQLI_ASSOC)) {
	$id = $book["isbn"];
	echo "<tr>";    
	echo "<td>" .$book["title"]. "</td>"; 
	echo "<td>" .$book["isbn"]. "</td>";
	echo "<td>" .$book["author_id"]. "</td>";
	echo "<td>" .$book["type"]. "</td>";
	echo "<td>" .$book["price"]. "</td>";
	echo "<td>" .$book["genre"]. "</td>";
 	if($book["series"] <> " "){
		echo "<td>" .$book["series"]. "</td>";
  	}	
	echo "<td>
		<form action=\"add_book.php\" method=\"post\">
			<input type=\"text\" name=\"book_id\" hidden=\"true\" value = $id>
			<input type=\"number\" name=\"quantity\">
			<input type=\"submit\" name=\"myButton\" value=\"Add\"/>
		</form>
	      </td>";

  }
  echo "</table>";
  mysqli_free_result($getBookResult);
  mysqli_close($myconnection);

?>
  </table>
  </body>
  </html>
