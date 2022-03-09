<?php
  // create short variable names
  $date = date('H:i, jS F Y');
?>
<html>
<head>
  <title>Current Bookstore Catalog</title>
</head>
<body>
<h1>Current Bookstore Catalog</h1>
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
  echo "<input align ='center' type='submit' value='Add to cart'/>"; 
  echo "</form>";
?>
<!-- This form should 
<h2>Order Books Based Off Order ID and Quantity Desired</h2>
<form action="move_to_cart.php" method="post">
<tr>
  <td>List Of IDs</td>
  <td align="left"><input type="text" name="idLst" size="20" maxlength="255"/></td>
</tr>
<tr>
  <td>List of Quantites</td>
  <td align="left"><input type="text" name="qtLst" size="20" maxlength="3"/></td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="add to cart"/></td>
</tr>
</table>
</form>-->
</body>
</html>
