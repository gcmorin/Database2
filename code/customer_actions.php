<html>
<head>
  <title>Update Account Info</title>
</head>
<body>
<h2>Update Account Info</h2>
<form action="memberUpdate.php" method="post">
<table border="0">
<tr>
  <td>Name</td>
  <td align="left"><input type="text" name="name" size="20" maxlength="20"/></td>
</tr>
  <td>Password</td>
  <td align="left"><input type="text" name="password" size="20" maxlength="20"/></td>
</tr>
<tr>
  <td>Address</td>
  <td align="left"><input type="type" name="address" size="50" maxlength="50"/></td>
</tr>
<tr>
  <td>Email</td>
  <td align="left"><input type="text" name="email" size="20" maxlength="20"/></td>
</tr>
<tr>
  <td>Member</td>
  <td align="left"><select name="become_member"/>
	<option value="No">No</option>
	<option value="Yes">Yes</option>
  </select></td>
</tr>
<tr>
  <td colspan="2" align="left"><input type="submit" value="Update"/></td>
</tr>
</table>
</form>

<form action="search_book_form.php">
<input type="submit" value="Book Search"/>
</form>

</body>
</html>