<?php

  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $currentLogin = $_SESSION["p_username"];

  $isbn = $_POST['isbn'] ?? "";
  $author_id = $_POST['author_id'] ?? "";
  $type = $_POST['type'] ?? "";
  $title = $_POST['title'] ?? "";
  $price = $_POST['price'] ?? "";
  $genre = $_POST['genre'] ?? "";
  $series = $_POST['series'] ?? "";

  $getpubID = "select publisher_id from publisher where login = \"$currentLogin\"";
  $getIDResult = mysqli_query($myconnection, $getpubID) or die ('Query failed: ' . mysql_error());
  $row = mysqli_fetch_array ($getIDResult ,MYSQLI_ASSOC);
  $pubID = $row["publisher_id"];

//Add New Book

  if ($isbn <> null) {
  
  	$check_book_exist = "select * from book where isbn = \"$isbn\"";
  	$check_result = mysqli_query($myconnection, $check_book_exist) or die ('Query failed: ' . mysql_error());

  	if (mysqli_num_rows($check_result) > 0) {
  		echo 'Book already exists';
  	} else {
  		$query = "insert into book values (\"$isbn\",$pubID,$author_id,\"$type\",\"$title\",$price,\"$genre\",\"$series\")";
  		$result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
		echo 'Book has been added';
  	}

  	mysqli_free_result($check_result);
  }

  $isbn_price_change =$_POST['isbn_price_change'] ?? "";
  $new_price = $_POST['new_price'] ?? "";

//Update book price 

  if ($isbn_price_change <> "") {

  	$check_book_exist = "select * from book where isbn = \"$isbn_price_change\" and publisher_id = $pubID";
  	$check_result = mysqli_query($myconnection, $check_book_exist) or die ('Query failed: ' . mysql_error());
  
  	if (mysqli_num_rows($check_result) > 0) {
		$update = "update book set price = $new_price where isbn = \"$isbn_price_change\"";
		$result2 = mysqli_query($myconnection, $update) or die ('Query failed: ' . mysql_error());
		echo 'Price has been updated';
	} else {
		echo 'Book does not exist or you did not publish this book';
	}
  }



  mysqli_free_result($getIDResult);
  mysqli_close($myconnection);

?>


