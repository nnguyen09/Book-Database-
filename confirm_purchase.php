<?php
//This php takes in the users purchase information and brings it to ordered.php to process their order

//Start session and get email
session_start();
$email =$_SESSION['email'];  

//Get shipping mode chosen from choose_ship 
$shipping_mode = $_POST['shipping_types'];

//connect to database
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//getting cart id
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());  
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];

//updating the users cart to have the new shipping type they chose earlier
$change_modes = "update cart set shipping_type = '$shipping_mode' where cart_id = '$cart'";
$r1 = mysqli_query($myconnection, $change_modes);

//Echoing form that takes shipping address, card info, and billing address, also has a 
//same as shipping check box which makes it so billing address doesnt need to be filled
echo "select a payment method and add shipping method and Confirm your order ";
echo "
<form action='ordered.php' method='post'>
<table>
    <tr>
    <td>Shipping Address          </td>
    <td><label>Address:</label><input type='text' name='address'  required/></td>
    <td><label>Zip:</label><input type='text' name='zip'  required/></td>
    <td><label>State:</label><input type='text' name='state'   required/></td>
    <td><label>Country:</label><input type='text' name='country'  required/></td>
    </tr>

      <tr>
      <td>Card Info          </td>   
      <td><label>Card Number:</label><input type='text' name='card_number' maxlength='16' required/></td>
      <td><label>Card Type</label><input type='text' name='card_type' required/></td>
      <td><label>CVV Code</labeil><input type='password' name='cvv_code'  size='3' required/></td>
      <td><label>Exp Date</label><input type='text' name='exp_date'   minlength='3' required/></td>
      </tr>

      <tr>
      <td>Billing Address                  </td>
      <td><label>Address:</label><input type='text' name='card_address' /></td>
      <td><label>Zip:</label><input type='text' name='card_zip'  /></td>
      <td><label>State:</label><input type='text' name='card_state' /></td>
      <td><label>Country:</label><input type='text' name='card_country' /></td>
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
	//running total of all books they have
	$running_total = 0;
	
	//Query that gets all the book ids currently in the cart
	$books_purchased_from_cart = "select book_id from hold where cart_id = '$cart'";
	$result1 = mysqli_query($myconnection, $books_purchased_from_cart);
	
	//This loop processes the price of each book in the cart and adds them to the running total
	while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) 
	{
		$book = $row["book_id"];
		
		//getting price of book and adding it to total
		$get_price = "Select price from book where book_id = '$book'";
		$price_result = mysqli_query($myconnection, $get_price);
		$price_hold = mysqli_fetch_array($price_result, MYSQLI_ASSOC);
		$running_total += $price_hold['price'];
	}
	
	//Showing user total cost of just the books
	echo "Total cost of Books:  ".$running_total."<br>";
	
	//Query that gets the shipping cost then echos it to user
	$q_ship_cost = "Select shipping_cost from shipping_modes where shipping_type in (select shipping_type from cart where cart_id ='$cart')";
	$ship_result = mysqli_fetch_array(mysqli_query($myconnection, $q_ship_cost),MYSQLI_ASSOC)['shipping_cost'];
	echo "Shipping cost of:  ".$ship_result."<br>";
	
	//Query that gets the expected tax to be applied and echos it
	$q_tax = "select tax from cart where cart_id = '$cart'";
	$tax_result = (mysqli_fetch_array(mysqli_query($myconnection, $q_tax),MYSQLI_ASSOC)['tax'] / 100) * ($running_total + $ship_result);
	echo "Expected tax of:  ". $tax_result."<br>";
	
	//adds all values together to get the true total price
	$total_cost = $tax_result + $ship_result + $running_total;
	echo "Total cost:  ".$total_cost."<br>";
	
	//updates the carts item_cost to total cost
	$q_update_cart_total = "update cart set item_cost = '$total_cost' where cart_id = '$cart'";
	if(mysqli_query($myconnection, $q_update_cart_total)){}
	else{echo "fail<br>";}

//main menu button	
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
?>
