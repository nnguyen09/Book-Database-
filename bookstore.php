<html>
<head>
  <title>Group 7 Bookstore</title>
</head>
<body>
<h1 align ="center" >Welcome to Our Group 7's Bookstore</h1>
<h2 align = "center">Home page</h2>

<?php
session_start();
$admin_check = $_SESSION['email'];
if($admin_check == 'admin@gmail.com'){

}
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
          <td colspan='7' align='center'><b><i>A place of magical discoveries and the rediscovery of past pleasures</i> </b></td>
        </tr>
        <tr>";
if($admin_check == 'admin@gmail.com'){echo "<td align='center'> <a href='superuser.php' >Secret Super User Button</a></td> ";}
echo" <td align='center'> <a><form method = 'POST' action = 'bestseller.php'>BEST SELLERS (by year) <input type ='text' name ='year'/><input type ='submit' value = 'Search'/></form></a></td> 
          <td align='center'> <a><form method = 'POST' action = 'task4_searchbook.php'>Book Search <input type ='text' name ='search'/><input type ='submit' value = 'Search'/></form></a></td> 
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

if(!isset($_SESSION["email"])){
  header("bookstore.html");
}

if($_GET){
        $user_email = $_GET['email'];
         
        $myconnection = mysqli_connect('localhost', 'root', '') 
        or die ('Could not connect: ' . mysql_error());
      
        $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
        $query1 = "SELECT name FROM users where email = '" .mysqli_real_escape_string($myconnection, $user_email) . "'";
        
        $result1 = mysqli_query($myconnection, $query1) or die ('Query failed: ' . mysql_error());
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
 $author_email = $_GET['email'];
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $e1 = "SELECT name FROM author where email = '" .mysqli_real_escape_string($myconnection, $author_email) . "'";

  $re1 = mysqli_query($myconnection, $e1);



  if(mysqli_num_rows($re1) != 0){
    echo "hello";
    $a_query = "SELECT * FROM book where book_id in (Select book_id from wrote where author_id in ( SELECT  author_id FROM author where email = '" .mysqli_real_escape_string($myconnection, $author_email) . "' ))";
  $a_result = mysqli_query($myconnection, $a_query) or die ('Query failed: ' . mysql_error());
  $a_counter = 0;

  echo "<form method = 'post' action = 'cart.php' >";
  echo "<table>";


  while($row = mysqli_fetch_array($a_result)){
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

  else{
  $query = 'SELECT * FROM book';
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  $counter = 0;

  echo "<form method = 'post' action = 'cart.php' >";
  echo "<table>";


  while($row = mysqli_fetch_array($result)){
    $bookcounter = htmlspecialchars($row['book_id']);
  
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
  }
?>
</body>
</html>