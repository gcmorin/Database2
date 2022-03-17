<?php
  session_start();
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $p_username = $_POST['p_username'] ?? "";
  $p_password = $_POST['p_password'] ?? "";
  $c_username = $_POST['c_username'] ?? "";
  $c_password = $_POST['c_password'] ?? "";
  $a_username = $_POST['a_username'] ?? "";
  $a_password = $_POST['a_password'] ?? "";
  $_SESSION["order"] = " ";


  if ($p_username <> null) {
	$test = "select * from publisher where login = \"$p_username\" && password = \"$p_password\"";
	$result = mysqli_query($myconnection, $test) or die ('Query failed: ' . mysql_error());
	if (mysqli_num_rows($result) > 0) {
    		$_SESSION["p_username"] = $p_username;
    		include("publisher_actions.php");
	} else {
		echo 'Incorrect username or password';
	}
	mysqli_free_result($result);
  } else if ($c_username <> null) {
    	$test = "select * from account where login = \"$c_username\" && password = \"$c_password\"";
	$result = mysqli_query($myconnection, $test) or die ('Query failed: ' . mysql_error());
	if (mysqli_num_rows($result) > 0) {
    		$_SESSION["c_username"] = $c_username;
    		include("customer_actions.php");
	} else {
		echo 'Incorrect username or password';
	}
	mysqli_free_result($result);
  } else if ($a_username <> null) {
    	$test = "select * from admin where login = \"$a_username\" && password = \"$a_password\"";
	$result = mysqli_query($myconnection, $test) or die ('Query failed: ' . mysql_error());
	if (mysqli_num_rows($result) > 0) {
    		$_SESSION["a_username"] = $a_username;
    		include("admin_actions.php");
	} else {
		echo 'Incorrect username or password';	
	}
	mysqli_free_result($result);
  }
?>
<html>	
<p><a href ="login.html">Back to Login</a></p>
</html>

