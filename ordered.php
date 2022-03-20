<?php
session_start();
$email =$_SESSION['email'];  
  $myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $cartq="select cart_id from cart where user_email = '$email'";
  $rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());

while ($row = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)) {$cart = $row["cart_id"];}

//Generates order_id
	do{
	$o_id = strval(rand(0,9999));
	$o_id .="O";
	$qtestid = "SELECT * FROM orders where order_id = '$o_id'";
	$result = mysqli_query($myconnection, $qtestid);
	}while(mysqli_num_rows($result) != 0);
	echo $o_id;
	echo "<br>";
	$date = date("Y-m-d");

	$order_insert = "insert into orders (order_id, order_date) values ('$o_id','$date')";
	echo $order_insert;
	echo "<br>";
	$result = mysqli_query($myconnection, $order_insert);

	$books_purchased_from_cart = "select book_id from hold where cart_id = '$cart'";
	echo $books_purchased_from_cart;
	echo "<br>";

	$result1 = mysqli_query($myconnection, $books_purchased_from_cart);
	while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) 
	{
		$book = $row["book_id"];
		$bought_insert = "insert into grab (order_id, book_id) values ('$o_id','$book')";
		echo $bought_insert;
		echo "<br>";
		$add = mysqli_query($myconnection, $bought_insert);
	}
		$remove_from_hold = "delete from hold where cart_id = '$cart'";
		$remove = mysqli_query($myconnection, $remove_from_hold);
		$insert_history = "insert into history (email, order_id) values ('$email', '$o_id')";
		$remove = mysqli_query($myconnection, $insert_history);
?>