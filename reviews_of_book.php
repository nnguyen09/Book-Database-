<?php
//Start session
session_start();

//Get email from session
$email =$_SESSION['email'];

//Get book title they entered  
$book_title = $_POST['title'];


//Connecting to database
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//Query that gets all books assuming title was entered
$q = "select * from book where title = '$book_title'";
$result = mysqli_query($myconnection, $q);

//If there is 0 rows that means there are no books of that title outputs whole catalog
if(mysqli_num_rows($result) == 0)
{
	//Query to get all books 
	$q = "select * from book";
	$result = mysqli_query($myconnection, $q);
	
	//Begining of outputing all books
	echo "So sorry, there are no books with that title here is our catalog";
	echo "<form method = 'post' action = 'cart.php' >";
		echo "<table>";
	echo "<tr><td> BOOK_ID </td>";
	echo "<td> Published </td>";
	echo "<td> Genre </td>";
	echo "<td> Title </td>";
	echo "<td> ISBN </td>";
	echo "<td> Condition </td>";
	echo "<td> Price </td>";
	echo "<td> Type </td>";
	echo "<td> Total Rating </td></tr>";

	//Iterates through each books atributes and outputs them, sets book_id to the value of a quantifier so they can add that many of that book id to their cart(hold table)
		while($row = mysqli_fetch_array($result))
		{
	
		$book_counter = htmlspecialchars($row['book_id']);
  
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
		//End of output
}
//Else it means there are books of that title
else
{
	//Query that gets all the rate info of that book 
	$q1 = "select * from rate where book_id in (select book_id from book where title ='$book_title')";
	$r1 = mysqli_query($myconnection, $q1);
	
	//If it has zero rows it means there are no reviews and outputs whole catalog
	if(mysqli_num_rows($r1) == 0)
	{
		echo "So sorry, this book has no ratings here is our selection of that book";
		
		//begining of output
		echo "<form method = 'post' action = 'cart.php' >";
		echo "<table>";
		echo "<tr><td> BOOK_ID </td>";
		echo "<td> Published </td>";
		echo "<td> Genre </td>";
		echo "<td> Title </td>";
		echo "<td> ISBN </td>";
		echo "<td> Condition </td>";
		echo "<td> Price </td>";
		echo "<td> Type </td>";
		echo "<td> Total Rating </td></tr>";

		//Iterates through each books atributes and outputs them, sets book_id to the value of a quantifier so they can add that many of that book id to their cart(hold table)
		while($row = mysqli_fetch_array($result))
		{
	
		$book_counter = htmlspecialchars($row['book_id']);
  
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
		//end of output
	}	
	
	//this else handles when the book does have ratings and only outputs the title, its reviews, and ratings associated with it
	else
	{
		//Gets the book id for the option to buy books
		while($row = mysqli_fetch_array($result))
		{$book_counter = htmlspecialchars($row['book_id']);}
		echo "User ratings for Book : '$book_title'";
		echo "<form method = 'post' action = 'cart.php' >";
		echo "<table>";
		
		//Grabs each customer comment and rating
		while($row = mysqli_fetch_array($r1)){
  
			echo "<tr><td>". htmlspecialchars($row['cus_comment']). "</td>";
			echo "<td>". htmlspecialchars($row['rating']). "</td>";
			echo "</tr>";
		}
		
		//sets book_id to the value of a quantifier so they can add that many of that book id to their cart(hold table)
		echo "</table>";
		echo "<br><br>";
		echo "<p align ='center'><td>Quantity: <select name='$book_counter'>
				<option value='0'></option>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
				<option value='4'>4</option>
				<option value='5'>5</option>
				</select></td></p>";
		echo "<p align ='center'><input type='submit' value='Add $book_title to Cart'/></p>"; 
		echo "</form>";
	}
}

//Checks if logged in, and makes button send them to the correct home page
if($email = $_SESSION['email']) 
{
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";

}
else
{
echo "<form action ='bookstore.html' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";

}


?>