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

  if($_SESSION["order"] == "x"){
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
  } else if ($type =="author"){
	$author_id = "select * from book,author where book.author_id = author.author_id && author.author_name like '%$values%'";
	$getBookResult = mysqli_query($myconnection, $author_id) or die ('Query failed: ' . mysql_error());
  } else {
	$book_list = "select * from book where $type like '%$values%'";
	$getBookResult = mysqli_query($myconnection, $book_list) or die ('Query failed: ' . mysql_error());
  }

  echo "<table border='1'>

  <tr>
  <th>Title</th>
  <th>ISBN</th>
  <th>Author</th>
  <th>Publisher</th>
  <th>Type</th>
  <th>Price</th>
  <th>Genre</th>
  <th>Series</th>
  <th>View Reviews</th>
  <th>Cart</th>
  </tr>";

  while ($book = mysqli_fetch_array($getBookResult, MYSQLI_ASSOC)) {
	$id = $book["isbn"];
	$title = $book["title"];
	$author_id = $book["author_id"];
	$publisher_id = $book["publisher_id"];

	$author = "select author_name from author where author_id = $author_id";
	$getauthorResult = mysqli_query($myconnection, $author) or die ('Query failed: ' . mysql_error());
	$aname = mysqli_fetch_array($getauthorResult, MYSQLI_ASSOC);

	$pub = "select name from publisher where publisher_id = $publisher_id";
	$getpublisherResult = mysqli_query($myconnection, $pub) or die ('Query failed: ' . mysql_error());
	$pname = mysqli_fetch_array($getpublisherResult, MYSQLI_ASSOC);

	echo "<tr>";    
	echo "<td>" .$book["title"]. "</td>"; 
	echo "<td>" .$book["isbn"]. "</td>";
	echo "<td>" .$aname["author_name"]. "</td>";
	echo "<td>" .$pname["name"]. "</td>";
	echo "<td>" .$book["type"]. "</td>";
	echo "<td>" .$book["price"]. "</td>";
	echo "<td>" .$book["genre"]. "</td>";
 	if($book["series"] <> " "){
		echo "<td>" .$book["series"]. "</td>";
  	}
	echo "<td><form action=\"view_review.php\" method=\"post\">
			<input type=\"text\" name=\"book_id\" hidden=\"true\" value = $id>
			<input type=\"submit\" name=\"myButton\" value=\"View\"/>
		</form></td>";
	echo "<td><form action=\"add_book.php\" method=\"post\">
			<input type=\"text\" name=\"book_id\" hidden=\"true\" value = $id>
			<input type=\"number\" name=\"quantity\">
			<input type=\"submit\" name=\"myButton\" value=\"Add\"/>
		</form>
	      </td>";
	mysqli_free_result($getauthorResult);
	mysqli_free_result($getpublisherResult);
  }
  echo "</table>";
  mysqli_free_result($getBookResult);
  mysqli_close($myconnection);

?>
  </table>
  </body>
<p><a href ="search_book_form.php">Back to Search</a></p>
  </html>
