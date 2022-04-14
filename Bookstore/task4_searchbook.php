 <?php
//Starting session
session_start();
//Getting search input
$search_term = $_POST['search']; 

//Connecting to database 
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//Query to get all books assuming a title was entered
$query = "SELECT * FROM book WHERE title = '$search_term'";
$result = mysqli_query($myconnection, $query);

//if it returns any rows then it means they put a title in the search bar
if(mysqli_num_rows($result) > 0) {}

//otherwise checks for another input type
else
{
	
	//Query that gets all books assuming they entered an authors name
    $query= "SELECT * FROM book WHERE book_id in (SELECT  book_id from wrote WHERE author_id in (SELECT author_id from author WHERE name = '$search_term'))";
    $result = mysqli_query($myconnection, $query);
	
	//if it returns any rows then it means they put an author name as an input
	if(mysqli_num_rows($result) > 0){}
	
	//otherwise checks for genre search
	else
	{
		
		//Query to get all books assuming they entered a genre type
		$query ="select * from book where genre = '$search_term'";
		$result = mysqli_query($myconnection, $query);
	 
		//if it returns any rows then it means they put an genre as an input
		if(mysqli_num_rows($result) > 0){}
		
		//Else it means they didnt enter in a key work so outputs whole catalog
		else{
			echo "So sorry you did not enter in a proper search term, author name, title, or genre, here is our full catalog though";
			//Query to get all books in the catalog
			$query ="select * from book ";
			$result = mysqli_query($myconnection, $query);
	 }
	}
   }


//Begining of outputing books form with adding to cart capability 
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
  $book_counter = htmlspecialchars($row['book_id']);
    
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
//end of outputing book form

//Checks if they are logged in, if they are main meneu sends them to bookstore.php, else .html
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
