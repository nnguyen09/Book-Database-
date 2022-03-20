<?php
session_start();
$email = $_SESSION['email'];
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());
while ($row = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)) {$cart = $row["cart_id"];}

foreach($_POST as $book => $value){

$q1 = "delete from hold where book_id = '$book' and cart_id = '$cart' ";
echo $q1;
echo "<br>";
$rdelete = mysqli_query($myconnection, $q1);
header("Location: view_cart.php");
}
echo "<br>";?>