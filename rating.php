<?php
session_start();
$email =$_SESSION['email'];

$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

$q1 ="select count(book_id) as quantity from grab where order_id in (select order_id from history where email ='$email') group by book_id";
$r1 = mysqli_query($myconnection, $q1);

$q2 ="select * from book where book_id in (select book_id from grab where order_id in (select order_id from history where email ='$email'))";
$r2 = mysqli_query($myconnection, $q2);



 echo "<form method = 'post' action = 'process_review.php' >";
 echo "<table>";


while($row = mysqli_fetch_array($r2)){
    $rating = htmlspecialchars($row['book_id']);
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
    echo "<td><input type='submit' name = '$rating'  value='Rate this book'/></td>";
    echo "</tr>";

}
echo "</table>";
echo "<br><br>";
echo "<p align ='center'><input type='submit' value='Add to cart'/></p>"; 
echo "</form>";

echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";

?>