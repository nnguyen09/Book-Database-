<?php
//This php takes the rating the user gave in process review and inserts it into the review table

//Starting session and getting email
session_start();
$email = $_SESSION['email'];

//Getting comment from post
$comment = $_POST['comment'];

//Connecting to database
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//Query to get cart id
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());

//grabbing cart id
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];

//Getting the rating for each book reviewing
foreach($_POST as $book_quantity => $value)
{
$book_id = $book_quantity;
$rating = $value;
}

//The query is to check and see if the user has allready rated this book before
$q0 = "select * from rate where email = '$email' and book_id = '$book_id'";
$r0 = mysqli_query($myconnection, $q0);

//if zero means they have not rated this book before
if(mysqli_fetch_array($r0) == 0)
{
	
echo $book_id."<br>";
echo $rating."<br>";
echo $comment."<br>";

//Insert for rating
$q1 = "insert into rate(cus_comment, rating, book_id, email) values('$comment', '$rating', '$book_id', '$email')";
echo $q1."<br>";
$r1 = mysqli_query($myconnection, $q1);

//Getting all the rating values of that book
$q2 = "select rating from rate where book_id =$book_id";
$r2 = mysqli_query($myconnection,$q2);
$total_rating = 0;
$counter = 0;
//This loop sums all the ratings for the book together, and then divides it by the total amount of ratings to obtain a total rating for the book
while ($row = mysqli_fetch_array ($r2, MYSQLI_ASSOC))
{
 $counter++;
 $total_rating +=  $row['rating'];
} 
$new_rating = $total_rating / $counter;


//This updates the total rating of that book
$q3 = "update book set total_rating = '$new_rating' where book_id = '$book_id'";
echo $q3."<br>";
$r3 = mysqli_query($myconnection, $q3);	
}
else
{
echo "<br> How did you get here?";
}

//Main menu button
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";



?>