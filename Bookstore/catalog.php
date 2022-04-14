<html>
<head>
  <title>Current Bookstore Catalog</title>
</head>
<body>
<h1>Current Bookstore Catalog</h1>
<?php
//Start session
session_start();

//Connecting to database
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');


//getting all books
$query = 'select * from book';
$result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());

//Start of output form that outputs all books and allows the user to add to cart
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
  while($row = mysqli_fetch_array($result)){

	$bookcounter = htmlspecialchars($row['book_id']);
	
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
  echo "<input align ='center' type='submit' value='Add to cart'/>"; 
  echo "</form>";
//end of the output form
  
  
//Login check
if($email = $_SESSION['email']) 
{
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
}
else
{
echo "<form action ='bookstore.html' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
}
  
?>
</body>
</html>
