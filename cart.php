<?php
session_start();
  $email =$_SESSION['email'];  

  // create short variable names
  //$get_current_list_of_books = "select list_of_books from cart where email ='$email'";
  //$list_of_books = '';

   
  $myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $cartq="select cart_id from cart where user_email = '$email'";
  $rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());
//grabbing cart id
while ($row = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)) {$cart = $row["cart_id"];}
  foreach($_POST as $book_quantity => $value)
  {
    if($value != 0)
    {
    echo "<br>Post Parameter '$book_quantity' has '$value'";
    $query1="select title from book where book_id ='$book_quantity'";
    $result1 = mysqli_query($myconnection, $query1) or die ('Query failed: ' . mysql_error());
            $hold_insert = "insert into hold(cart_id,book_id) values('$cart','$book_quantity')";
            //Inserting books added to cart into hold
            for($i =1; $i <= $value; $i++){$r1 = mysqli_query($myconnection, $hold_insert);}
         /*if(mysqli_num_rows($result1)!=0)
         {
           while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) 
              {    
                echo $row["title"];
                echo "&nbsp;&nbsp;&nbsp;";
                echo '<br>';
                echo '<br>';
              }
          }*/
      }
  }
  echo "<form action ='ordered.php' action= 'post'>";
  echo "<p align ='center'><input type='submit' value='Confirm Purchase'/></p>"; 
  echo "</form>";
?>



  