<?php
//this file is used to check the order history of the user currently logged in

//Session start
session_start();

//gets the email from current session
$email =$_SESSION['email'];

//creates a connection 
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());

//connect with the database
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//returns the number of books that the user have ordered
$q1 ="select count(book_id) as quantity from grab where order_id in (select order_id from history where email ='$email') group by book_id";
$r1 = mysqli_query($myconnection, $q1);

//returns the book information for the book the user has bought or ordered
$q2 ="select * from book where book_id in (select book_id from grab where order_id in (select order_id from history where email ='$email'))";
$r2 = mysqli_query($myconnection, $q2);

//start of outputting books with ability to add items to cart
 echo "<form method = 'post' action = 'cart.php' >";
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

//iterating through each book and outputting the attributes of book
while($row = mysqli_fetch_array($r2)){
    $book_counter = htmlspecialchars($row['book_id']);
  	$row2 = mysqli_fetch_array($r1)["quantity"];

    // to make it shows only author books add a query that checks author email to check if he is a customer
    // and the book associated with his author_id and then add that to cart
    
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
    echo "<td>Quantity: <select name='$book_counter'>
      <option value='0'></option>
      <option value='1'>1</option>
      <option value='2'>2</option>
      <option value='3'>3</option>
  <option value='4'>4</option>
  <option value='5'>5</option>
  </select></td>";
    echo "</tr>";

}
echo "</table>";
echo "<br><br>";
echo "<p align ='center'><input type='submit' value='Add to cart'/></p>"; 
echo "</form>";

//close of outputting the information retrieved from the query

//takes you to the main page on clicking the main page
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
?>