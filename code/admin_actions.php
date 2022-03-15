<html>
<head>
  <title>Update Shipping Price</title>
</head>
<body>
<h2>Update Shipping Price</h2>
<form action="shippingUpdate.php" method="post">
<table border="0">
<tr>
  <td>Shipping Method</td>
  <td align="left"><select name="method"/>
	<option value="mail">Mail</option>
	<option value="email">Email</option>
  </select></td>
</tr>
<tr>
  <td>Price</td>
  <td align="left"><input type="text" name="price" size="5" maxlength="5"/></td>
</tr>

<tr>
  <td colspan="2" align="left"><input type="submit" value="Update"/></td>
</tr>
</table>
</form>

</body>
</html>