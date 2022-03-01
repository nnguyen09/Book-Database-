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

  while($row = mysqli_fetch_array($result)){
	echo "Book ID:";
	echo $row['book_id'];
	echo "&nbsp;&nbsp;&nbsp;Year:";
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
	echo "<br>";
  }
?>
<!-- This form should -->
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
</form>
</body>
</html>
