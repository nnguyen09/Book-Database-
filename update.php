<?php
$a_id = $_POST['publisher_id'];
$title = $_POST['book_title'];
$new_price = $_POST['new_price'];


$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

$q1 = "update book set price = '$new_price' where book_id in(select book_id from published where book_id in (select book_id from book where title = '$title') and publisher_id = '$a_id')";
$price_update = mysqli_query($myconnection, $q1);
echo "updated price of '$title' to '$new_price' succesfully<br>";


echo "<form action ='bookstore.html' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";

?>