<?php
session_start();
$email =$_SESSION['email'];  
$myconnection = mysqli_connect('localhost', 'root', '') or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
$cartq="select cart_id from cart where user_email = '$email'";
$rcart = mysqli_query($myconnection, $cartq) or die ('Query failed: ' . mysql_error());  
$cart = mysqli_fetch_array ($rcart, MYSQLI_ASSOC)["cart_id"];

//Setting up info for credit card and users address
  $address = $_POST['address'];
  $zip = $_POST['zip'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  
  $card_number = $_POST['card_number'];
  $card_type = $_POST['card_type'];
  $cvv_code = $_POST['cvv_code'];
  $exp_date = $_POST['exp_date'];
  
  if(!isset($_POST['same_as_shipping']))
  {
	$card_address = $_POST['card_address'];
    $card_zip = $_POST['card_zip'];
    $card_state = $_POST['card_state'];
    $card_country = $_POST['card_country'];
  }
  else
  {
  	$card_address = $address;
    $card_zip = $zip;
    $card_state = $state;
    $card_country = $country;
  }
  
  $card_address = "".$card_address."-".$card_zip."-".$card_state."-".$card_country;
  

//If the number of rows is equal to 0 then the card is not yet associated with customer
$check_card = "select * from have where email = '$email' and card_number = '$card_number'";
if(mysqli_num_rows(mysqli_query($myconnection, $check_card)) == 0)
{
	//If the number of rows is 0 then the card is not in the database at all yet
	$check_card = "select * from payment where card_number = '$card_number'";
	if(mysqli_num_rows(mysqli_query($myconnection, $check_card)) == 0)
	{
		$card_insert = "insert into payment(card_number, card_type, exp_date, cvv_code, billing_address) values ('$card_number','$card_type','$cvv_code','$exp_date','$card_address')";
		
		$r = mysqli_query($myconnection, $card_insert);
	}
	$customer_has_card_insert = "insert into have(email, card_number) values ('$email', '$card_number')";
	$r = mysqli_query($myconnection, $customer_has_card_insert);

}

//Similar to above if it returns zero then that means this address is not yet associated with this customer and should be added
$check_address = "select * from stores where email = '$email' and shipping_address = '$address'
 and shipping_zip = '$zip' and shipping_state = '$state' and shipping_country = '$country'";
if(mysqli_num_rows(mysqli_query($myconnection, $check_address)) == 0)
{
	$check_address = $check_address = "select * from shipping_address where address = '$address'
 and zip = '$zip' and state = '$state' and country = '$country'";
	if(mysqli_num_rows(mysqli_query($myconnection, $check_address)) == 0)
	{
		$address_insert = "insert into shipping_address(address, zip, state, country) values ('$address', '$zip', '$state', '$country')";
		$r = mysqli_query($myconnection, $address_insert);
	}
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

	$date = date("Y-m-d");

	$order_insert = "insert into orders (order_id, order_date) values ('$o_id','$date')";
	$result = mysqli_query($myconnection, $order_insert);

	$books_purchased_from_cart = "select book_id from hold where cart_id = '$cart'";
	$result1 = mysqli_query($myconnection, $books_purchased_from_cart);
	while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) 
	{
		$book = $row["book_id"];
		$bought_insert = "insert into grab (order_id, book_id,year_bought) values ('$o_id','$book',$date)";
		$add = mysqli_query($myconnection, $bought_insert);
	}
		$remove_from_hold = "delete from hold where cart_id = '$cart'";
		$remove = mysqli_query($myconnection, $remove_from_hold);
		$insert_history = "insert into history (email, order_id) values ('$email', '$o_id')";
		$remove = mysqli_query($myconnection, $insert_history);
		
		$get_total = "select item_cost from cart where cart_id = '$cart'";
		$tot = mysqli_query($myconnection, $get_total);
		$total_cost = mysqli_fetch_array ($tot, MYSQLI_ASSOC)["item_cost"];
		$q_purchased_insert = "insert into purchased(amount_pay, order_id, card_number) values ('$total_cost', '$o_id', '$card_number')";
		$remove = mysqli_query($myconnection, $q_purchased_insert);
		
		$q_update_cart_total = "update cart set item_cost = 0 where cart_id = '$cart'";
		if(mysqli_query($myconnection, $q_update_cart_total)){}
		

echo "Order:  ".$o_id."  Processed succsefully";
echo "<br>";
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
?>