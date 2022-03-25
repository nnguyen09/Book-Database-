<?php
session_start();
$email = $_SESSION['email'];
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $cartq="select cart_id from cart where user_email = '$email'";
  $rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());
//grabbing cart id
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];
 foreach($_POST as $book_quantity => $value)
  {$book_id = $book_quantity;}
  $q0 = "select * from rate where email = '$email' and book_id = '$book_id'";
  $r0 = mysqli_query($myconnection, $q0);
  if(mysqli_fetch_array($r0) == 0)
{  
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
else{
    echo "<br> You already Rated this book silly";

}
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";

?>