<?php
//This php allows the user to rate the book they selected to rate

//start session and get email
session_start();
$email = $_SESSION['email'];

//connecting to database
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//getting cart id
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];

//getting the book id
foreach($_POST as $book_quantity => $value){$book_id = $book_quantity;}

//Query to get all the ratings of the book that the user has made
$q0 = "select * from rate where email = '$email' and book_id = '$book_id'";
$r0 = mysqli_query($myconnection, $q0);

//if it returns zero that means they have not made a review yet and are shown the form to make a review
if(mysqli_fetch_array($r0) == 0)
{  

	//Form takes in text input, which is the review, and a drop down menu from 1 to 5 for the score they give, brings that to added_review.php
	echo "<form method = 'post' action = 'added_review.php' >";
	echo "<table>";
	echo "<tr><td>Comment: <input type = 'text' name = 'comment' </td>";
	echo "<td>Rating: <select name='$book_id'>
		  <option value='0'></option>
		  <option value='1'>1</option>
		  <option value='2'>2</option>
		  <option value='3'>3</option>
		  <option value='4'>4</option>
		  <option value='5'>5</option>
		  </select></td>";
	echo "</tr>";
	echo "</table>";
	echo "<p align ='center'><input type='submit' value='Add to cart'/></p>"; 
	echo "</form>";
   

}
//if it isnt zero then that means they have made a review of this book allready and cannot make another one
else{echo "<br> You already Rated this book silly";}

//Main menu form
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";

?>