<?php
$type = $_POST["shipping_type"];
$cost = $_POST["shipping_cost"];

$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

$q1 = "Select * from shipping_modes where shipping_type = '$type'";
$r1 = mysqli_query($myconnection, $q1);

if(mysqli_num_rows($r1) == 0)
{
	$q2 = "insert into shipping_modes(shipping_type, shipping_cost) values('$type', '$cost')";
	$r2 = mysqli_query($myconnection, $q2);
	echo "Created new shipping option '$type' with cost '$cost'";

}
else
{
	$q3 = "update shipping_modes set shipping_cost = '$cost' where shipping_type = '$type'";
	$r2 = mysqli_query($myconnection, $q3);
	echo "Updated '$type' shipping to cost '$cost'";

}

echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
?>