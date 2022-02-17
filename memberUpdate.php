<?php
 
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $currentLogin = "cust1";

  $query = "SELECT login,memberstatus FROM account where login = \"$currentLogin\"";
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  $update = "update account set memberstatus = 1 where login = \"$currentLogin\" and memberstatus = 0";
  $result2 = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
  echo 'Update Member status';
  echo '<br><br>';

  echo 'CustomerID &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Member<br>';

  while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {    
    echo $row["login"];
    echo "&nbsp;&nbsp;&nbsp;";
    echo $row["memberstatus"];
    echo '<br>';
  }

  mysqli_free_result($result);

  mysqli_close($myconnection);

?>
