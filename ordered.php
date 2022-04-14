<?php
//This php processes the actual order after they confirm order

//Start session, get email
session_start();
$email =$_SESSION['email'];

//connect to database  
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//gtet cart id
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());  
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];

//setting local variables for the values posted in confirm purchase

//address  info
$address = $_POST['address'];
$zip = $_POST['zip'];
$state = $_POST['state'];
$country = $_POST['country'];
 
//credit card info
$card_number = $_POST['card_number'];
$card_type = $_POST['card_type'];
$cvv_code = $_POST['cvv_code'];
$exp_date = $_POST['exp_date'];

//if same as shipping checkbox was not pressed it gets the billing address as input
if(!isset($_POST['same_as_shipping']))
{	
	$card_address = $_POST['card_address'];
    $card_zip = $_POST['card_zip'];
    $card_state = $_POST['card_state'];
    $card_country = $_POST['card_country'];
}
//else it means that they did click the same as shipping and the values are set as the values provided in shipping address
else
{
	$card_address = $address;
    $card_zip = $zip;
    $card_state = $state;
    $card_country = $country;
}

//concatinates the billing address as it is just one attribute in credit card table  
$card_address = "".$card_address."-".$card_zip."-".$card_state."-".$card_country;
  
//Query to check and see if this user has used this card before
$check_card = "select * from have where email = '$email' and card_number = '$card_number'";

//if it has zero rows it means this user is not associated with this card yet
if(mysqli_num_rows(mysqli_query($myconnection, $check_card)) == 0)
{
	//This query then checks to see if the card is in the payment table at all yet
	$check_card = "select * from payment where card_number = '$card_number'";
	
	//if it is zero then it means this card is not in the database yet
	if(mysqli_num_rows(mysqli_query($myconnection, $check_card)) == 0)
	{
		//Query that inserts the cart into the payment table
		$card_insert = "insert into payment(card_number, card_type, exp_date, cvv_code, billing_address) values ('$card_number','$card_type','$exp_date','$cvv_code','$card_address')";
		$r = mysqli_query($myconnection, $card_insert);
	}
	
	//Query that inserts the card into the have table, which is the table that shows a relationship between customers and credit cards
	$customer_has_card_insert = "insert into have(email, card_number) values ('$email', '$card_number')";
    $r = mysqli_query($myconnection, $customer_has_card_insert);
}

//This chunk does the same check as above but for the relationship between customers and shipping address instead of credit card

//Checks if customer has used this address before
$check_address = "select * from stores where email = '$email' and shipping_address = '$address' and shipping_zip = '$zip' and shipping_state = '$state' and shipping_country = '$country'";

//if zero then they havent
if(mysqli_num_rows(mysqli_query($myconnection, $check_address)) == 0)
{
	//checks if this address exsists in the database
	$check_address = $check_address = "select * from shipping_address where address = '$address' and zip = '$zip' and state = '$state' and country = '$country'";
	
	//if zero then it does not
	if(mysqli_num_rows(mysqli_query($myconnection, $check_address)) == 0)
	{
		//add adress to database
		$address_insert = "insert into shipping_address(address, zip, state, country) values ('$address', '$zip', '$state', '$country')";
		$r = mysqli_query($myconnection, $address_insert);
	}
	//add relationship between address and customer to database
	$customer_has_address_insert = "insert into stores(email, shipping_address, shipping_zip, shipping_state, shipping_country) values('$email', '$address', '$zip', '$state', '$country')";
	$r = mysqli_query($myconnection, $customer_has_address_insert);
}


	//Generates order_id
	do{
	$o_id = strval(rand(0,9999));
	$o_id .="O";
	$qtestid = "SELECT * FROM orders where order_id = '$o_id'";
	$result = mysqli_query($myconnection, $qtestid);
	}while(mysqli_num_rows($result) != 0);
	//get date of order
	$date = date("Y-m-d");

	//Insert the order into the database
	$order_insert = "insert into orders (order_id, order_date) values ('$o_id','$date')";
	$result = mysqli_query($myconnection, $order_insert);

	//Query that gets all the books stored in the customers cart
	$books_purchased_from_cart = "select book_id from hold where cart_id = '$cart'";
	$result1 = mysqli_query($myconnection, $books_purchased_from_cart);
	
	//This loop inserts each book id from hold(the relationship between cart and book) into grab(the relationship betweek book and order_id)
	while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) 
	{
		$book = $row["book_id"];
		$bought_insert = "insert into grab (order_id, book_id,year_bought) values ('$o_id','$book','$date')";
		$add = mysqli_query($myconnection, $bought_insert);
	}
	
	//Query that empties the cart
	$remove_from_hold = "delete from hold where cart_id = '$cart'";
	$remove = mysqli_query($myconnection, $remove_from_hold);
	
	//Insert the into the order history table
	$insert_history = "insert into history (email, order_id) values ('$email', '$o_id')";
	$remove = mysqli_query($myconnection, $insert_history);
	
	//gets the total cost purchased
	$get_total = "select item_cost from cart where cart_id = '$cart'";
	$tot = mysqli_query($myconnection, $get_total);
	$total_cost = mysqli_fetch_array ($tot, MYSQLI_ASSOC)["item_cost"];
	
	//insert purchase into purchase relationship (relationship between order id and credit card used
	$q_purchased_insert = "insert into purchased(amount_pay, order_id, card_number) values ('$total_cost', '$o_id', '$card_number')";
	$remove = mysqli_query($myconnection, $q_purchased_insert);
	
  //Query that updates the carts total cost to 0	
	$q_update_cart_total = "update cart set item_cost = 0 where cart_id = '$cart'";
	if(mysqli_query($myconnection, $q_update_cart_total))
	{
		
	}
		
//Main button
echo "Order:  ".$o_id."  Processed successfully";
echo "<br>";

echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
?>