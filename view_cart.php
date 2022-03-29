<?php
session_start();
$email =$_SESSION['email'];  
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());  
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];

  $get_cart_books = "select * from book where book_id in(select book_id from hold where cart_id ='$cart')";
 $get_quantity_of_book = "select count(book_id) as b_count from hold where cart_id = '$cart' group by book_id";
$book_result = mysqli_query($myconnection, $get_cart_books);
$quantity_result =  mysqli_query($myconnection, $get_quantity_of_book);
//echo $get_quantity_of_book;
   /*while($row2 = mysqli_fetch_array($quantity_result)){echo $row2['b_count'];
		echo "<br>";}*/
  echo "<form method = 'post' action = 'remove.php'>";
  echo "<table>";
  while($row = mysqli_fetch_array($book_result)){
  	$row2 = mysqli_fetch_array($quantity_result);
  	$book_id = $row['book_id'];
  
    // to make it shows only author books add a query that checks author email to check if he is a customer
    // and the book associated with his author_id and then add that to cart
    
    echo "<tr><td>". htmlspecialchars($row['book_id']). "</td>";
    echo "<td>". htmlspecialchars($row['year']). "</td>";
    echo "<td>". htmlspecialchars($row['genre']). "</td>";
    echo "<td>". htmlspecialchars($row['title']). "</td>";
    echo "<td>". htmlspecialchars($row['isbn']). "</td>";
    echo "<td>". htmlspecialchars($row['book_condition']). "</td>";
    echo "<td>". htmlspecialchars($row['price']). "</td>";
    echo "<td>". htmlspecialchars($row['book_type']). "</td>";
    echo "<td>". htmlspecialchars($row['total_rating']). "</td>";
    echo "<td> Quantity In cart:  ".$row2['b_count']."</td>";
    echo "<td><input type ='checkbox' name = '$book_id' value ='yes'/></td>";
    echo "</tr>";
echo "<br>";
}
echo "</table>";
echo "<br><br>";
echo "<p align ='center'><input type='submit' value='Remove'/></p>"; 
echo "</form>";
echo "<form action ='choose_shipping.php' method= 'post'>";
echo "<table>";
  echo "<input type='submit' value='Confirm Purchase' />"; 
echo "</table>";
  echo "</form>";
  echo "</p>";
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";


?>