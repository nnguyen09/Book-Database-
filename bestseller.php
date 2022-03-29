<?php
session_start();
//Need an input of year option in the html leading to this page
$year_provided = $_POST['year'];

$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

if($_POST['year']==''){//Code to grab best seller of a given year
echo "Best seller of each Year!";

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

while($row = mysqli_fetch_array($result)){
	$row2 = mysqli_fetch_array($r1);
	
    $book_counter = htmlspecialchars($row['book_id']);
  
    // to make it shows only author books add a query that checks author email to check if he is a customer
    // and the book associated with his author_id and then add that to cart
    
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
else{
//else defaults to show best sellers of every year
$q1 = "select * from book where book_id in (select a.book_id from
(select count(book_id) as cnt, book_id, year(year_bought) as years from grab group by book_id, years) as a,
(select max(a.cnt) as max_per_year, year(a.year_bought) as years  from (select count(book_id) as cnt, book_id, year_bought from grab group by book_id, year_bought)as a group by a.year_bought) as b 
where a.cnt = b.max_per_year and b.years = a.years and b.years = '$year_provided')";
$result = mysqli_query($myconnection, $q1);
//echo $q1;

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
while($row = mysqli_fetch_array($result)){
	$row2 = mysqli_fetch_array($r1);
	
    $book_counter = htmlspecialchars($row['book_id']);
  
    // to make it shows only author books add a query that checks author email to check if he is a customer
    // and the book associated with his author_id and then add that to cart
    
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

}else{
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


  while($row = mysqli_fetch_array($result)){
    $book_counter = htmlspecialchars($row['book_id']);
  
    // to make it shows only author books add a query that checks author email to check if he is a customer
    // and the book associated with his author_id and then add that to cart
    
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


