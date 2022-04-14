<?php

//file that can be used by the admin to update or change the shipping methods
$type = $_POST["shipping_type"];
$cost = $_POST["shipping_cost"];

//creates connection
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());

//connects to the database
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//gets data from the shipping modes table for the respective shipping type the admin wants to update
$q1 = "Select * from shipping_modes where shipping_type = '$type'";
$r1 = mysqli_query($myconnection, $q1);

if(mysqli_num_rows($r1) == 0)
{
	//if the query doesn't return anything that means the shipping type does not exists and the admin can add one
	$q2 = "insert into shipping_modes(shipping_type, shipping_cost) values('$type', '$cost')";
	$r2 = mysqli_query($myconnection, $q2);
	echo "Created new shipping option '$type' with cost '$cost'";

}
//if the shipping type already exists then the admin can upgrade the cost of it
else {
	$q3 = "update shipping_modes set shipping_cost = '$cost' where shipping_type = '$type'";
	$r2 = mysqli_query($myconnection, $q3);
	echo "Updated '$type' shipping to cost '$cost'";

}
//takes you back to the main page on clicking the main menu button
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
?>