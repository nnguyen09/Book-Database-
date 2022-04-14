<?php
//This php handles the when a book is added to the cart, displays the title of the book and the quantities added of it
session_start();
//confirming logged in
if($email = $_SESSION['email'])
{
	//Setting up connection
	$myconnection = mysqli_connect('localhost', 'root', '') 
	or die ('Could not connect: ' . mysql_error());
	$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
	
	//Query to get cart id
	$cartq="select cart_id from cart where user_email = '$email'";
	$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());
	
	//grabbing cart id
	$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];
 
	//This loops for each book added, using the quantity drop down window in the catalog
	foreach($_POST as $book_quantity => $value)
	{
		//So long as the value they selected isnt 0 it runs
		if($value != 0)
		{
			
			//Query that gets the title of the book based on the id which is stored in the book_quantity
			$query1="select title from book where book_id ='$book_quantity'";
			$result1 = mysqli_query($myconnection, $query1) or die ('Query failed: ' . mysql_error());
			
			//Query to insert the book id into the hold table
            $hold_insert = "insert into hold(cart_id,book_id) values('$cart','$book_quantity')";
            //Inserting that book n times where n is the quantity of books the user asked for
            for($i =1; $i <= $value; $i++){$r1 = mysqli_query($myconnection, $hold_insert);}
			
			//this is used to output the title and quanity added for the user
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
	
	//This form brings them to the view cart php which shows all the books currently in the cart
	echo "<p>";
	echo "<form action ='view_cart.php' method = 'post'>
          <input type = 'submit'value ='Go to Cart' size ='20'/>";
	echo "</form>";
	
	//This form sends them directly to choose_shipping which then will direct them to confirm purchase
	echo "<form action ='choose_shipping.php' method= 'post'>";
	echo "<input type='submit' value='Confirm Purchase' size ='20' />"; 
	echo "</form>";
	echo "</p>";
	
	//Main menu button
	echo "<form action ='bookstore.php' method= 'post'>";
	echo "<table>";
	echo "<input type='submit' value='Main Menu' />"; 
	echo "</table>";
	echo "</form>";
	echo "</p>";

}
//If they arent logged in directs them to log in
else{header("Location: login.php");}


   
  
?>



  