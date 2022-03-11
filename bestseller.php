<?php
//Need an input of year option in the html leading to this page
$year_provided = $_POST['year'];
echo "Best seller list";
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

if($_POST['year']!=''){
    //Code to grab best seller of year
}
else{
//else defaults to show best sellers of every year
$q1 = "select * from book where book_id in 
(select b.book from 
(select max(s.cou), s.book as book, s.years from 
(select count(g.book_id) as cou,g.book_id as book, year(o.order_date) as years from 
grab g, orders o where 
g.order_id = o.order_id group by years,book) 
as s group by s.years) as b)";
$result = mysqli_query($myconnection, $q1);
//echo $q1;
echo "<form method = 'post' action = 'cart.php' >";
echo "<table>";


  while($row = mysqli_fetch_array($result)){
    $book_counter = htmlspecialchars($row['book_id']);
  
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


?>


