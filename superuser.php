<?php

session_start();
$email =$_SESSION['email'];

$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

echo "<h3 align='center'><i>Update Shipping methods</i></h3>";
echo"<form action='change_ship.php' method='post'>
<table align='center'>
<tr>
	<td>Shipping Type</td>
	<td><input type='text' name='shipping_type'  required/></td>
</tr>
<tr>
	<td>New Shipping Cost</td>
	<td><input type='text' name='shipping_cost'  required/></td>
</tr>
</table>
<p align='center'><input align ='center' type='submit' value='change_ship'/></p>
</form>";


echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
?>