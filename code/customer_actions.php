
<html>
<?php
$user = $_SESSION["c_username"];
$_SESSION["order"] = "x";
$myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $id = "select customer_id from account where login = \"$user\"";
  $getIDResult = mysqli_query($myconnection, $id) or die ('Query failed: ' . mysql_error());
  $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
  $_SESSION["custID"] = $row["customer_id"]; 
  $cID = $row["customer_id"];
  
  $account_info = "select * from account where customer_id = $cID";
  $cIDResult = mysqli_query($myconnection, $account_info) or die ('Query failed: ' . mysql_error());
  $account = mysqli_fetch_array ($cIDResult ,MYSQLI_ASSOC);


   echo "<table border='1'>

  <tr>
  <th>Name</th>
  <th>Password</th>
  <th>Address</th>
  <th>Email</th>
  <th>Member</th>
  </tr>";
	echo "<tr>";    
	echo "<td>" .$account["name"]. "</td>"; 
	echo "<td>" .$account["password"]. "</td>"; 
	echo "<td>" .$account["address"]. "</td>";
	echo "<td>" .$account["email"]. "</td>";
	if ($account["memberstatus"] == 0){
		echo "<td> No </td>";
	} else {echo "<td> Yes </td>";}
  
  echo "</table>";
?>

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

<?php
  $cID = $_SESSION["custID"];
 $order = "select order_id, date from orders where customer_id = $cID";
 $getOrderResult = mysqli_query($myconnection, $order) or die ('Query failed: ' . mysql_error());
 echo "<table border='1'>

  <tr>
  <th>OrderID</th>
  <th>Date</th>
  <th>View</th>
  </tr>";

  while ($myorder = mysqli_fetch_array($getOrderResult, MYSQLI_ASSOC)) {
	$id = $myorder["order_id"];
	echo "<tr>";    
	echo "<td>" .$myorder["order_id"]. "</td>"; 
	echo "<td>" .$myorder["date"]. "</td>";
	echo "<td>
		<form action=\"view_order.php\" method=\"post\">
			<input type=\"text\" name=\"order_id\" hidden=\"true\" value = $id>
			<input type=\"submit\" name=\"myButton\" value=\"View\"/>
		</form>
	      </td>";
  }
  echo "</table>";
?>



</body>
</html>