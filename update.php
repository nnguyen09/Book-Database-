<?php
//This page processes the updating of book prices for publishers

//Gets input from publisher
$a_id = $_POST['publisher_id'];
$title = $_POST['book_title'];
$new_price = $_POST['new_price'];

//Connecting to database
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//Query that updates the books price to the new price, if the title of that book doesnt exsist or the author id is the the one attached to that book, then it will update nothing
$q1 = "update book set price = '$new_price' where book_id in(select book_id from published where book_id in (select book_id from book where title = '$title') and publisher_id = '$a_id')";
$price_update = mysqli_query($myconnection, $q1);

//Displaying message that it updated succesfully
echo "updated price of '$title' to '$new_price' succesfully<br>";

//Main menu button
echo "<form action ='bookstore.html' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";

?>