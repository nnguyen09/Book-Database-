 <?php
session_start();
  //This can probably be done via a switch case to make runtime more efficient but do not have time to implement that and bug check
  $search_term = $_POST['search']; 
 
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $query = "SELECT * FROM book WHERE title = '$search_term'";

  $result = mysqli_query($myconnection, $query);
  //if it returns any rows then it means they put a title in the search bar
  if(mysqli_num_rows($result) > 0) {}
  //otherwise checks for another input type
   else
   {
    $query= "SELECT * FROM book WHERE book_id in (SELECT  book_id from wrote WHERE author_id in (SELECT author_id from author WHERE name = '$search_term'))";
    $result = mysqli_query($myconnection, $query);
	//if it returns any rows then it means they put an author name as an input
	if(mysqli_num_rows($result) > 0){}
	//otherwise checks for genre search
	else
	{
	 $query ="select * from book where genre = '$search_term'";
	 $result = mysqli_query($myconnection, $query);
	 
	 //if it returns any rows then it means they put an genre as an input
	 if(mysqli_num_rows($result) > 0){}
	 else{}
	}
   }
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
