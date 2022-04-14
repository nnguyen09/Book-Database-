<?php
//This file gets the bestselling books of each year

//Starting session
session_start();

//Getting year they input
$year_provided = $_POST['year'];

//getting connection to database
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//If they didn't enter a year then it will output the best seller of each year
if($_POST['year']==''){

  echo "Best seller of each Year!";

//Query to get each year that has a bestseller
$get_years = "select a.years from (select max(a.cnt) as max_per_year, year(a.year_bought) as years  from (select count(book_id) as cnt, book_id, year_bought from grab group by book_id, year_bought)as a group by a.year_bought) as a";
$r1 = mysqli_query($myconnection, $get_years);
//Query to get the rows from book that are the best seller of each year 
$q2 = "select * from book where book_id in (select a.book_id from
(select count(book_id) as cnt, book_id, year_bought from grab group by book_id, year_bought) as a,
(select max(a.cnt) as max_per_year, a.year_bought as years  from (select count(book_id) as cnt, book_id, year_bought from grab group by book_id, year_bought)as a group by a.year_bought) as b 
where a.cnt = b.max_per_year and b.years = a.year_bought)";
$result = mysqli_query($myconnection, $q2);

//Start of book table output that lets you add the books to cart
echo "<form method = 'post' action = 'cart.php' >";
echo "<table>";
echo "<tr><td></td>";
echo "<td> BOOK_ID </td>";
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
	
	//Getting year value of best seller
	$row2 = mysqli_fetch_array($r1);
	
    $book_counter = htmlspecialchars($row['book_id']);
  
    echo "<tr><td> For year ".$row2['years']."</td>";
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
// End of book output
}
//The else handles when they did enter a year
else{
//Query that gets the best selling book of the provided year
$q1 = "select * from book where book_id in (select a.book_id from
(select count(book_id) as cnt, book_id, year(year_bought) as years from grab group by book_id, years) as a,
(select max(a.cnt) as max_per_year, year(a.year_bought) as years  from (select count(book_id) as cnt, book_id, year_bought from grab group by book_id, year_bought)as a group by a.year_bought) as b 
where a.cnt = b.max_per_year and b.years = a.years and b.years = '$year_provided')";
$result = mysqli_query($myconnection, $q1);

//If it has zero rows it means there was no best seller of that year, therefore outputs bestsellers of all years like above
if(mysqli_num_rows($result) == 0)
{
echo "No best seller of that year, here are some other hits though!!";
$get_years = "select a.years from (select max(a.cnt) as max_per_year, year(a.year_bought) as years  from (select count(book_id) as cnt, book_id, year_bought from grab group by book_id, year_bought)as a group by a.year_bought) as a";
$r1 = mysqli_query($myconnection, $get_years);
$q2 = "select * from book where book_id in (select a.book_id from
(select count(book_id) as cnt, book_id, year_bought from grab group by book_id, year_bought) as a,
(select max(a.cnt) as max_per_year, a.year_bought as years  from (select count(book_id) as cnt, book_id, year_bought from grab group by book_id, year_bought)as a group by a.year_bought) as b 
where a.cnt = b.max_per_year and b.years = a.year_bought)";
$result = mysqli_query($myconnection, $q2);

echo "<form method = 'post' action = 'cart.php' >";
echo "<table>";
echo "<tr><td></td>";
echo "<td> BOOK_ID </td>";
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
	$row2 = mysqli_fetch_array($r1);
	
    $book_counter = htmlspecialchars($row['book_id']);
    echo "<tr><td> For year ".$row2['years']."</td>";
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
//Else it has a result for that year, therefore it only outputs that best selling book
else
{
//Start of outputing best selelr
echo "Best seller of '$year_provided'";
echo "<form method = 'post' action = 'cart.php' >";
echo "<table>";
echo "<tr><td></td>";
echo "<td> BOOK_ID </td>";
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
    $book_counter = htmlspecialchars($row['book_id']);

	echo "<tr><td> For year ".$year_provided."</td>";
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
}

//Checks they are logged in if they are main menu goes to bookstore.php, else .html
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


