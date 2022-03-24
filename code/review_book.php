<html>
<?php
  session_start();
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $custID = $_SESSION["custID"];
  $book_id = $_POST['book_id'];
  $rating = $_POST['rating'];
  $comment = $_POST['comment'];

  $query = "insert into reviews values ('',\"$book_id\", $custID, \"$comment\", $rating)";
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  echo 'Review has been submited';

?>

<p><a href ="login.html">Back to Login</a></p>
 </html>