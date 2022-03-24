<html>
<head>
  <title>Add/Update Book</title>
</head>
<body>
<h2>Add new book</h2>
<form action="pub_add_update_book.php" method="post">
<table border="0">
<tr>
  <td>ISBN</td>
  <td align="left"><input type="text" name="isbn" size="20" maxlength="20"/></td>
</tr>
  <td>Title</td>
  <td align="left"><input type="text" name="title" size="50" maxlength="50"/></td>
</tr>
<tr>
  <td>Author ID</td>
  <td align="left"><input type="number" name="author_id" size="3" maxlength="3"/></td>
</tr>
<tr>
  <td>Type</td>
  <td align="left"><select name="type"/>
	<option value="hardcover">Hardcover</option>
	<option value="paperback">Paperback</option>
	<option value="ebook">EBook</option>
	<option value="audio">Audio</option>
  </select></td>
</tr>
<tr>
  <td>Price</td>
  <td align="left"><input type="text" name="price" size="40" maxlength="40"/></td>
</tr>
<tr>
  <td>Genre</td>
  <td align="left"><select name="genre"/>
	<option value="Sports">Sports</option>
	<option value="Kids">Kids</option>
	<option value="Horror">Horror</option>
	<option value="Religious">Religious</option>
	<option value="Romance">Romance</option>
	<option value="Comedy">Comedy</option>
	<option value="Sci-Fi">Sci_Fi</option>
	<option value="Fantasy">Fantasy</option>
	<option value="Cars">Cars</option>
	<option value="Military History">Military History</option>
	<option value="Ancient History">Ancient History</option>
	<option value="Fiction">Fiction</option>
	<option value="NonFiction">NonFiction</option>
  </select></td>
</tr>
<tr>
  <td>Series</td>
  <td align="left"><input type="text" name="series" size="40" maxlength="40"/></td>
</tr>
<tr>
  <td colspan="2" align="left"><input type="submit" value="Add Book"/></td>
</tr>
</table>
</form>

<h2>Change book price</h2>

<form action="pub_add_update_book.php" method="post">
<table border="0">
<tr>
  <td>ISBN</td>
  <td align="left"><input type="text" name="isbn_price_change" size="20" maxlength="20"/></td>
</tr>
<tr>
  <td>Price</td>
  <td align="left"><input type="text" name="new_price" size="40" maxlength="40"/></td>
</tr>
<tr>
  <td colspan="2" align="left"><input type="submit" value="Change Price"/></td>
</tr>
</table>
</form>

<h2>Add New Author</h2>

<form action="pub_add_update_book.php" method ="post">
<table border="0">
<tr>
  <td>Author Name</td>
  <td align="left"><input type="text" name="author_name" size="20" maxlength="20"/></td>
</tr>
<tr>
  <td colspan="2" align="left"><input type="submit" value="Add Author"/></td>
</tr>
</table>
</form>

<table>
<?php
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $currentLogin = $_SESSION["p_username"];
  $getpubID = "select publisher_id from publisher where login = \"$currentLogin\"";
  $getIDResult = mysqli_query($myconnection, $getpubID) or die ('Query failed: ' . mysql_error());
  $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
  $pub_ID = $row["publisher_id"];

  $get_book = "select * from book where publisher_id = $pub_ID";
  $getbookResult = mysqli_query($myconnection, $get_book) or die ('Query failed: ' . mysql_error());

	
  $get_author = "select * from author";
  $getauthorResult = mysqli_query($myconnection, $get_author) or die ('Query failed: ' . mysql_error());

echo "<table border='1'>

<tr>
<th>Author Name</th>
<th>Author ID</th>
</tr>";

  while ($author = mysqli_fetch_array($getauthorResult, MYSQLI_ASSOC)) {
echo "<tr>";  
echo "<td>" .$author["author_name"]. "</td>";  
echo "<td>" .$author["author_id"]. "</td>";
  }
echo "</table>";
 
  echo "<table border='1'>

<tr>
<th>Title</th>
<th>ISBN</th>
<th>Author ID</th>
<th>Type</th>
<th>Price</th>
<th>Genre</th>
<th>Series</th>
</tr>";

  while ($book = mysqli_fetch_array($getbookResult, MYSQLI_ASSOC)) {
echo "<tr>";    
echo "<td>" .$book["title"]. "</td>"; 
echo "<td>" .$book["isbn"]. "</td>";
echo "<td>" .$book["author_id"]. "</td>";
echo "<td>" .$book["type"]. "</td>";
echo "<td>" .$book["price"]. "</td>";
echo "<td>" .$book["genre"]. "</td>";
 if($book["series"] = " "){
     echo "<td>" ."NA". "</td>";
  }else{
     echo "<td>" .$book["series"]. "</td>";
  }
  }
echo "</table>";
  mysqli_free_result($getbookResult);
  mysqli_free_result($getauthorResult);
  mysqli_close($myconnection);

?>
</table>
</body>
</html>