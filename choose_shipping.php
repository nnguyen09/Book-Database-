<?php
//This php is used to get the users choice for shipping options, origionally wanted it to be in confirm_purchase.php
//However due to time constrains and deciscions made early on with how confirm_purchase worked there was not enough time
//to implement it in there and this solution acomplishes the same need just less pretty

//Start session and get email
session_start();
$email =$_SESSION['email'];  

//connect to database
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//get cart
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());  
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];

//Get the current shipping modes offered
$q_get_modes = "select * from shipping_modes";
$r1 = mysqli_query($myconnection, $q_get_modes);

//Start form that will take the shipping option and pass it to confirm_purchase
echo "
<form action='confirm_purchase.php' method='post'>
<table>
<tr><td>Chose Shipping Option:<select name='shipping_types'>";
//populates the options with each shipping type avalible
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

//main menu button
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";

?>