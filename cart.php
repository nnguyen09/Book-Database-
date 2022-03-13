<?php

  $email =$_SESSION['email']; 
  echo $email;

  // create short variable names
  //$get_current_list_of_books = "select list_of_books from cart where email ='$email'";
  //$list_of_books = '';
  foreach($_POST as $book_quantity => $value){
    if($value != 0){
    echo "<br>Post Parameter '$book_quantity' has '$value'";
    //$list_of_books .= $book_quantity .";
    }
  }

  echo "<form method = 'post' action = 'cart.php' >";
  $query = "SELECT * FROM book where book_id in(select book_id from grad where order_id ='$cart_order_id'";
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  $counter = 0;

     // echo 'name'.$counter;

  echo "<form method = 'post' action = 'confirm_purchase.php' >";
  echo "<table>";


  while($row = mysqli_fetch_array($result)){
    $bookcounter = htmlspecialchars($row['book_id']);
  
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
    echo "<td>Quantity: <select name='$bookcounter'>
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
echo "<p align ='center'><input type='submit' value='Confirm Purchase'/></p>"; 
echo "</form>";
?>


  