<?php
session_start();
$email =$_SESSION['email'];  
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());  
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];


echo "select a payment method and add shipping method and Confirm your order ";
echo "
<form action='ordered.php' method='post'>
<table>
    <tr>
    <td>Shipping Address          </td>
    <td><label>Address:</label><input type='text' name='address'  minlength='3' required/></td>
    <td><label>Zip:</label><input type='text' name='zip' minlength='3' required/></td>
    <td><label>State:</label><input type='text' name='state'  minlength='3' required/></td>
    <td><label>Country:</label><input type='text' name='country'   minlength='3' required/></td>
    </tr>

      <tr>
      <td>Card Info          </td>   
      <td><label>Card Number:</label><input type='text' name='card_number'  minlength='3' required/></td>
      <td><label>Card Type</label><input type='text' name='card_type' minlength='3' required/></td>
      <td><label>CVV Code</labeil><input type='text' name='cvv_code'  minlength='3' required/></td>
      <td><label>Exp Date</label><input type='text' name='exp_date'   minlength='3' required/></td>
      </tr>

      <tr>
      <td>Billing Address                  </td>
      <td><label>Address:</label><input type='text' name='card_address'  minlength='3'/></td>
      <td><label>Zip:</label><input type='text' name='card_zip' minlength='3' /></td>
      <td><label>State:</label><input type='text' name='card_state'  minlength='3' /></td>
      <td><label>Country:</label><input type='text' name='card_country'   minlength='3' /></td>
      </tr>

<tr>
    <td></td>
    <td><label>Same As Shipping</label><input type='checkbox' name='same_as_shipping' value = 'yes'/></td> 
</tr>
</table>
<input align ='center' type='submit' value='Purchase'/>
<input align ='center' type='reset' value='Reset'/>
</form>

</body>
</html>

";
	$books_purchased_from_cart = "select book_id from hold where cart_id = '$cart'";
	echo $books_purchased_from_cart;
	echo "<br>";
	$running_total = 0;
	$result1 = mysqli_query($myconnection, $books_purchased_from_cart);
	while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) 
	{
		$book = $row["book_id"];
		
		//getting price of book and adding it to total
		$get_price = "Select price from book where book_id = '$book'";
		$price_result = mysqli_query($myconnection, $get_price);
		$price_hold = mysqli_fetch_array($price_result, MYSQLI_ASSOC);
		$running_total += $price_hold['price'];
		
		
	}
	echo "Total cost of Books:  ".$running_total."<br>";
	$q_ship_cost = "Select shipping_cost from shipping_modes where shipping_type in (select shipping_type from cart where cart_id ='$cart')";
	$ship_result = mysqli_fetch_array(mysqli_query($myconnection, $q_ship_cost),MYSQLI_ASSOC)['shipping_cost'];
	echo "Shipping cost of:  ".$ship_result."<br>";
	$q_tax = "select tax from cart where cart_id = '$cart'";
	$tax_result = (mysqli_fetch_array(mysqli_query($myconnection, $q_tax),MYSQLI_ASSOC)['tax'] / 100) * ($running_total + $ship_result);
	echo "Expected tax of:  ". $tax_result."<br>";
	$total_cost = $tax_result + $ship_result + $running_total;
	echo "Total cost:  ".$total_cost."<br>";
	
	$q_update_cart_total = "update cart set item_cost = '$total_cost' where cart_id = '$cart'";
	if(mysqli_query($myconnection, $q_update_cart_total)){}
	else{echo "fail<br>";}
	
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
?>