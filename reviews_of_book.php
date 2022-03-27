<?php
session_start();
//Need an input of year option in the html leading to this page
$email =$_SESSION['email'];  
$book_title = $_POST['title'];
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');


$q = "select * from book where title = '$book_title'";
$result = mysqli_query($myconnection, $q);

if(mysqli_num_rows($result) == 0)
{
	
	$q = "select * from book";
	$result = mysqli_query($myconnection, $q);
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


		while($row = mysqli_fetch_array($result))
		{
	
		$book_counter = htmlspecialchars($row['book_id']);
  
		// to make it shows only author books add a query that checks author email to check if he is a customer
		// and the book associated with his author_id and then add that to cart
    
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
}
else
{
$q1 = "select * from rate where book_id in (select book_id from book where title ='$book_title')";
$r1 = mysqli_query($myconnection, $q1);
	if(mysqli_num_rows($r1) == 0)
	{
		echo "So sorry, this book has no ratings here our selectiona of that book";
						
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


		while($row = mysqli_fetch_array($result))
		{
	
		$book_counter = htmlspecialchars($row['book_id']);
  
		// to make it shows only author books add a query that checks author email to check if he is a customer
		// and the book associated with his author_id and then add that to cart
    
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
	}	
	
	//this else handles when the book does have ratings
	else
	{
		while($row = mysqli_fetch_array($result))
		{
	
		$book_counter = htmlspecialchars($row['book_id']);
		}
		echo "User ratings for Book : '$book_title'";
		echo "<form method = 'post' action = 'cart.php' >";
		echo "<table>";
		while($row = mysqli_fetch_array($r1)){
  
			// to make it shows only author books add a query that checks author email to check if he is a customer
			// and the book associated with his author_id and then add that to cart
    
			echo "<tr><td>". htmlspecialchars($row['cus_comment']). "</td>";
			echo "<td>". htmlspecialchars($row['rating']). "</td>";
			echo "</tr>";
		}
		


		
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