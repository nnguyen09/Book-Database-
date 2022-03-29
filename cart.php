<?php
session_start();

if($email = $_SESSION['email']){
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  $cartq="select cart_id from cart where user_email = '$email'";
  $rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());
//grabbing cart id
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];
 foreach($_POST as $book_quantity => $value)
  {
    if($value != 0)
    {
     // echo "<br>Post Parameter '$book_quantity' has '$value'";
    $query1="select title from book where book_id ='$book_quantity'";
    $result1 = mysqli_query($myconnection, $query1) or die ('Query failed: ' . mysql_error());
            $hold_insert = "insert into hold(cart_id,book_id) values('$cart','$book_quantity')";
            //Inserting books added to cart into hold
            for($i =1; $i <= $value; $i++){$r1 = mysqli_query($myconnection, $hold_insert);}
         if(mysqli_num_rows($result1)!=0)
         {
           while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) 
              {    
                $Title_in_cart = $row['title'];
                echo "Title : ".$Title_in_cart;
                echo "   Quantity in cart: ".$value;
                echo '<br>';
                echo '<br>';
              }
          }
      }
  }
  echo "<p>";
  echo "<form action ='view_cart.php' method = 'post'>
                <input type = 'submit'value ='Go to Cart' size ='20'/>";
                echo "</form>";
  echo "<form action ='choose_shipping.php' method= 'post'>";
  echo "<input type='submit' value='Confirm Purchase' size ='20' />"; 
  echo "</form>";
  echo "</p>";
  echo "<form action ='bookstore.php' method= 'post'>";
  echo "<table>";
  echo "<input type='submit' value='Main Menu' />"; 
  echo "</table>";
  echo "</form>";
  echo "</p>";

}
else{header("Location: login.php");}


   
  
?>



  