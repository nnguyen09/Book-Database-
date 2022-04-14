<?php
//This php is used to show the user the options they have for books they can rate

//start session get email
session_start();
$email =$_SESSION['email'];

//connect to database
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//getting the count of the books they have bought
$q1 ="select count(book_id) as quantity from grab where order_id in (select order_id from history where email ='$email') group by book_id";
$r1 = mysqli_query($myconnection, $q1);

//getting the info of the books they got
$q2 ="select * from book where book_id in (select book_id from grab where order_id in (select order_id from history where email ='$email'))";
$r2 = mysqli_query($myconnection, $q2);


//Form that shows how many of the books they have bought as well as gives them the option to rate the book
echo "<form method = 'post' action = 'process_review.php' >";
echo "<table>";
echo "<tr><td></td><td> BOOK_ID </td>";
echo "<td> Published </td>";
echo "<td> Genre </td>";
echo "<td> Title </td>";
echo "<td> ISBN </td>";
echo "<td> Condition </td>";
echo "<td> Price </td>";
echo "<td> Type </td>";
echo "<td> Total Rating </td></tr>";



while($row = mysqli_fetch_array($r2)){
    $rating = htmlspecialchars($row['book_id']);
  	$row2 = mysqli_fetch_array($r1)["quantity"];
	
    echo "<tr><td>you bought ".$row2." quantity of book:   </td>";
    echo "<td>". htmlspecialchars($row['book_id']). "</td>";
    echo "<td>". htmlspecialchars($row['year']). "</td>";
    echo "<td>". htmlspecialchars($row['genre']). "</td>";
    echo "<td>". htmlspecialchars($row['title']). "</td>";
    echo "<td>". htmlspecialchars($row['isbn']). "</td>";
    echo "<td>". htmlspecialchars($row['book_condition']). "</td>";
    echo "<td>". htmlspecialchars($row['price']). "</td>";
    echo "<td>". htmlspecialchars($row['book_type']). "</td>";
    echo "<td>". htmlspecialchars($row['total_rating']). "</td>";
    echo "<td><input type='submit' name = '$rating'  value='Rate this book'/></td>";
    echo "</tr>";

}
echo "</table>";
echo "<br><br>"; 
echo "</form>";
//end of form

//main menu button
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";

?>