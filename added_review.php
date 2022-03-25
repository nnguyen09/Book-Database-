<?php
session_start();
$email = $_SESSION['email'];
$comment = $_POST['comment'];
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $cartq="select cart_id from cart where user_email = '$email'";
  $rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());
//grabbing cart id
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];

foreach($_POST as $book_quantity => $value)
{
$book_id = $book_quantity;
$rating = $value;
}
$q0 = "select * from rate where email = '$email' and book_id = '$book_id'";
$r0 = mysqli_query($myconnection, $q0);
if(mysqli_fetch_array($r0) == 0)
{
echo $book_id."<br>";
echo $rating."<br>";
echo $comment."<br>";

$q1 = "insert into rate(cus_comment, rating, book_id, email) values('$comment', '$rating', '$book_id', '$email')";
echo $q1."<br>";
$r1 = mysqli_query($myconnection, $q1);
$q2 = "select rating from rate where book_id =$book_id";
$r2 = mysqli_query($myconnection,$q2);
$total_rating = 0;
$counter = 0;
while ($row = mysqli_fetch_array ($r2, MYSQLI_ASSOC))
{
 $counter++;
 $total_rating +=  $row['rating'];
} 
$new_rating = $total_rating / $counter;



$q3 = "update book set total_rating = '$new_rating' where book_id = '$book_id'";
echo $q3."<br>";

$r3 = mysqli_query($myconnection, $q3);	
}
else
{
echo "<br> How did you get here?";
}
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";



?>