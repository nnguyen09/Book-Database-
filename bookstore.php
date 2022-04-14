<html>
<head>
  <title>Group 7 Bookstore</title>
</head>
<body>
<h1 align ="center" >Welcome to Our Group 7's Bookstore</h1>
<h2 align = "center">Home page</h2>

<?php
//Starting session
session_start();
//Getting the session email, will be uses to check if the email is equal to the admin email
$admin_check = $_SESSION['email'];
echo " <html>
<head>
  <title>Home page</title>
</head>
<body>
  <font face='Cambria' size='4'>
  <frameset rows='20%,*%'>
    <frame name='home_page'>
      <table border='1' width='100%' cellpadding='5' align='center'> 
        <tr>
          <td><!--<img src='logo.png'>--> </td> 
          <td colspan='8' align='center'><b><i>A place of magical discoveries and the rediscovery of past pleasures</i> </b></td>
        </tr>
        <tr>";
		
//Checks to see if the email is the admin email, if it is then it adds a button that only the admin user has access to that lets them edit or add new shipping types
if($admin_check == 'admin@gmail.com'){echo "<td align='center'> <a href='superuser.php' >Secret Super User Button</a></td> ";}

//The following buttons are similar to bookstore.html up till catalog, then the new ones are buttons for viewing cart, edditing account, checking history, adding rating to books youve bought, and logging out, in that order
echo" <td align='center'> <a><form method = 'POST' action = 'bestseller.php'>BEST SELLERS (by year) <input type ='text' name ='year'/><input type ='submit' value = 'Search'/></form></a></td> 
          <td align='center'> <a><form method = 'POST' action = 'task4_searchbook.php'>Book Search <input type ='text' name ='search'/><input type ='submit' value = 'Search'/></form></a></td> 
          <td align='center'> <a><form method = 'POST' action = 'reviews_of_book.php'>Getting User Ratings <input type ='text' name ='title'/><input type ='submit' value = 'Search'/></form></a></td> 
		  <td align='center'><a href='catalog.php' >CATALOGUE</a></td>
          <td align='center' ><a href='view_cart.php' >CART</a></td>
          <td align='center' ><a href='account.php' >ACCOUNT</a></td>
          <td align='center' ><a href='history.php' >ORDER HISTORY</a></td>
          <td align='center' ><a href='rating.php' >RATE BOOKS ORDERED</a></td>
		  <td align='center' ><a href='logout.php' >LOGOUT</a></td>
        </tr>
      </table>
    </frame>
        <br><br>
        <center><b><i>WELCOME TO OUR ONLINE BOOKSTORE</i></b></center>
        <br><br>
    <frame name='desc_page'>
        <!--<img src='bg.png' width='100%'/>-->
    </frame>
    
  </frameset>  
  </font>
</body>
</html>
";
?>
<?php 
//Final wall to prevent people who arent logged in from getting to the main website
//If there is no session[email] then that means they arent logged in and it will send them to bookstore.html
if(!isset($_SESSION["email"])){
  header("bookstore.html");
}

//Since login passes info using header() we have to use the GET array to access what it passed
if($_GET){
		//Sets user email to what was passed
        $user_email = $_GET['email'];
        
		//Connects to database
        $myconnection = mysqli_connect('localhost', 'root', '') 
        or die ('Could not connect: ' . mysql_error());
        $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
		
		//Query that gets the name of that user
        $query1 = "SELECT name FROM users where email = '" .mysqli_real_escape_string($myconnection, $user_email) . "'";
        $result1 = mysqli_query($myconnection, $query1) or die ('Query failed: ' . mysql_error());
        
		//Says hello to the user
		if(mysqli_num_rows($result1)!=0){
            while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) {    
                echo "Hello, " .$row["name"];
                echo "&nbsp;&nbsp;&nbsp;";
                echo '<br>';
                echo '<br>';
              }
        }
    }
    else{
        "Could not get email";
    }
?>



<?php

//Sets a variable to the email passed, this one will be used to see if they are an author
 $author_email = $_GET['email'];
 
//Connecting to database
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//Getting name of author
$e1 = "SELECT name FROM author where email = '" .mysqli_real_escape_string($myconnection, $author_email) . "'";
$re1 = mysqli_query($myconnection, $e1);

//If that query returns anything but a zero it means that the logged in user name is in the author table, meaing this customer is an author
if(mysqli_num_rows($re1) != 0)
{

	//Query that gets all the books that that author has made
    $a_query = "SELECT * FROM book where book_id in (Select book_id from wrote where author_id in ( SELECT  author_id FROM author where email = '" .mysqli_real_escape_string($myconnection, $author_email) . "' ))";
	$a_result = mysqli_query($myconnection, $a_query) or die ('Query failed: ' . mysql_error());

	//Start of output form that outputs books and allows them to be added to cart
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
	while($row = mysqli_fetch_array($a_result))
	{
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
	//end of output
}
//Else it means there is zero results, meaning they are not an author and should just output the catalog as normal
else
{
	//Getting all books
	$query = 'SELECT * FROM book';
	$result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
	
	//Start of form that outputs all books
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
	echo "<p align ='center'><input type='submit' value='Add to cart'/></p>"; 
	echo "</form>";
	//end of form
}
?>
</body>
</html>