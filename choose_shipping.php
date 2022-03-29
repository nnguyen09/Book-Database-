<?php
session_start();
$email =$_SESSION['email'];  
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());  
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];
$q_get_modes = "select * from shipping_modes";
$r1 = mysqli_query($myconnection, $q_get_modes);

echo "
<form action='confirm_purchase.php' method='post'>
<table>
<tr><td>Chose Shipping Option:<select name='shipping_types'>";
while($row = mysqli_fetch_array($r1)){
$shipping_type = htmlspecialchars($row['shipping_type']);
echo  "<option value='$shipping_type'>$shipping_type</option>";
}
echo "</td></tr>
</table>
<input align ='center' type='submit' value='Submit'/>
</form>

</body>
</html>

";
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";

?>