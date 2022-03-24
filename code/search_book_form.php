<html>
<head>
  <title>Book Search</title>
</head>
<body>
<h2>Book Search</h2>
<form action="search_book.php" method="post">
<table border="0">

<tr>
  <td>Search Type</td>
  <td align="left"><select name="Type"/>
	<option value="All">All</option>
	<option value="isbn">ISBN</option>
	<option value="title">Title</option>
	<option value="author">Author</option>
	<option value="genre">Genre</option>
	<option value="series">Series</option>
	<option value="Best Seller">Best Seller</option>
  </select></td>
</tr>
<tr>
  <td>Values</td>
  <td align="left"><input type="text" name="value" size="20" maxlength="20"/></td>
</tr>
<tr>
  <td colspan="2" align="left"><input type="submit" value="Search"/></td>
</tr>
</table>
</form>
 <p><a href ="orders.php">View Cart</a></p>
 <p><a href ="login.html">Back to Login</a></p>
</body>
</html>