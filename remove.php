<?php
//this php removes items from the cart, is accessed from view_cart.php, will remove all selected books on that page

//session start get working email
session_start();
$email = $_SESSION['email'];

//connect to database
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//getting cart id
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());
while ($row = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)) {$cart = $row["cart_id"];}

//for each book in cart that was checked off it runs the code
foreach($_POST as $book => $value)
{
//Query that deletes the books of that book id from hold, only if they are associated with the customers cart id
$q1 = "delete from hold where book_id = '$book' and cart_id = '$cart' ";
$rdelete = mysqli_query($myconnection, $q1);

//Sends them back to view cart
header("Location: view_cart.php");
}
echo "<br>";?>