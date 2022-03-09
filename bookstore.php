<html>
<head>
  <title>Group 7 Bookstore</title>
</head>
<body>
<h1 align ="center" >Welcome to Our Group 7's Bookstore</h1>
<h2 align = "center">Home page</h2>

<form action="bookstore.html" method="POST">
<p align="right"><input type='submit' value='LogOut/SignOut'/></p>
</form>

<?php 
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
 
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
  
  $query = 'select * from book';
  $result = mysqli_query($myconnection, $query) or die ('Query failed: ' . mysql_error());
  $counter = 0;
  
 // echo 'name'.$counter;

  echo "<form method = 'post' action = 'cart.php' >";
  echo "<table>";

  while($row = mysqli_fetch_array($result)){
	$counter +=1;
	$bookcounter = 'book'.$counter;

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
    <option value='0(Delete)'></option>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
</select></td>";
	echo "</tr>";
             
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
  }
  echo "</table>";
  echo "<br><br>";
  echo "<p align ='center'><input type='submit' value='Add to cart'/></p>"; 
  echo "</form>";
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





