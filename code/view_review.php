<html>
<table>
<?php

$myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

$isbn = $_POST['book_id'];

$query = "select * from reviews where isbn = \"$isbn\"";
$result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());

echo "<table border='1'>

  <tr>
  <th>User</th>
  <th>Rating</th>
  <th>Comment</th>
  </tr>";

 while ($review = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    
	$id = $review["customer_id"];
	$temp = "select name from account where customer_id = $id";
	$tempresult = mysqli_query($myconnection, $temp) or die ('Query failed: ' . mysql_error());
	$name = mysqli_fetch_array($tempresult, MYSQLI_ASSOC);
	echo "<tr>";
	echo "<td>" .$name["name"]. "</td>";
	echo "<td>" .$review["rating"]. "</td>";  
	echo "<td>" .$review["comment"]. "</td>";
	echo "</tr>";
	mysqli_free_result($tempresult);
  }
  echo "</table>";

mysqli_close($myconnection);
?>

<p><a href ="search_book_form.php">Back to Book Search</a></p>
</table>
</html>
