<html>
<head>
  <title>Group 7 Bookstore</title>
</head>
<body>
<h1 align ="center" >Welcome to Our Group 7's Bookstore</h1>
<h2 align = "center">Home page</h2>

<?php
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
          <td colspan='5' align='center'><b><i>A place of magical discoveries and the rediscovery of past pleasures</i> </b></td>
        </tr>
        <tr>
          <td align='center'> <a href='bestseller.php' >BEST SELLERS</a></td> 
          <td align='center'> <a href='login.php' >LOGIN/SIGNUP</a></td> 
          <td align='center'><a href='catalog.php' >CATALOGUE</a></td> 
          <td align='center' ><a href='cart.php' >CART</a></td>
          <td align='center'> <a href='task4_searchbook.html' >SEARCH</a></td>
          <td align='center' ><a href='publish.php' >ADD BOOKS</a></td>
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
echo "before start<br>";
session_start();
echo "after start<br>";
$_SESSION["email"] = $_GET['email'];

echo $_SESSION['email'];

if(!isset($_SESSION["email"])){
  header("bookstore.html");
}

if($_GET){
        $user_email = $_GET['email'];
        //$password = $_GET['password'];
         
        $myconnection = mysqli_connect('localhost', 'root', '') 
        or die ('Could not connect: ' . mysql_error());
      
        $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
       
       // $queryAuthor = "Select title from book where book_id in(select book_id from wrote where author_id in(select author_id from author where email ='"mysqli_real_escape_string($myconnection, $user_email) . "'";
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
  //echo "$e1";

  //$q1 = "Select * from member where email = '$author_email' ";
  //echo "$q1";
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

echo "<br><br>Successful";

  }

  else{
  $query = 'SELECT * FROM book';
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  $counter = 0;

     // echo 'name'.$counter;

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


  //echo "$re1";
  //echo "hello1";
 /* if(mysqli_num_rows($re1) != ''){
    echo "hello2";
    }
    else{
      echo"hello3";
    }    
   */    
     	/*echo "&nbsp;&nbsp;&nbsp;Year:";
	echo $row['year'];
	echo "&nbsp;&nbsp;&nbsp;Genre:";
	echo $row['genre'];
	echo "&nbsp;&nbsp;&nbsp;Title:";
	echo $row['title'];
	echo "&nbsp;&nbsp;&nbsp;ISBN:";
	echo $row['isbn'];
	echo "&nbsp;&nbsp;&nbsp;Book Condition:";
	echo $row['book_condition'];
	echo "&nbsp;&nbsp;&nbsp;Price:";
	echo $row['price'];
	echo "&nbsp;&nbsp;&nbsp;Book Types:";
	echo $row['book_type'];
	echo "&nbsp;&nbsp;&nbsp;Total Rating:";
	echo $row['total_rating'];
	echo "&nbsp;&nbsp;&nbsp;";
	echo "<br>";*/
  
  
?>
</body>
</html>

<!-- this php will lead to a page that has a login, and register
form of the type 
<h3>Register</h3>
<form action="register.php" method="post">
<table border="0">
<tr bgcolor="#cccccc">
  <td width="150">Item</td>
  <td width="15">Quantity</td>
</tr>
<tr>
  <td>Email</td>
  <td align="left"><input type="text" name="reg_email" size="3" maxlength="3"/></td>
</tr>
<tr>
  <td>Password</td>
  <td align="left"><input type="text" name="reg_passowrd" size="3" maxlength="3"/></td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="Register"/></td>
</tr>
</table>
</form>

login will lead directly to an accountmanager.php which will 
be an important junction point to handle queries 1,3,6, 7, and possibly 8 but unsure on that one.
register will lead to a simple registration page, which when completed will lead to the same 
accountmanager page.
-->
<!--
<form action="login.php" method="post">
<table>
<tr>
<td colspan="2" align="center"><input type="submit" value="Login/Register"/></td>
</tr>
</table>
</form>
-->

<!-- this php will lead to a list of all books currently in the database
this page should let you add books of x quantity to your cart, 
-->
        

<!--<h3>Task 2</h3>
<form action="task2.php" method="post">
<table>
    
</table>
</form>

<h3>Task 3</h3>
<form action="task3.php" method="post">
<table>
    
</table>
</form>

<h3>Task 4</h3>
<form action="task4.php" method="post">
<table>
    
</table>
</form>

<h3>Task 5</h3>
<form action="task5.php" method="post">
<table>
    
</table>
</form>

<h3>Task 6</h3>
<form action="task6.php" method="post">
<table>
    
</table>
</form>


<h3>Task 7</h3>
<form action="task7.php" method="post">
<table>
    
</table>
</form>

<h3>Task 8</h3>
<form action="task8.php" method="post">
<table>
    
</table>
</form>


<h3>Task 9</h3>
<form action="task9.php" method="post">
<table>
    
</table>
</form>

<h3>Task 10</h3>
<form action="task10.php" method="post">
<table>
    
</table>
</form>
-->





