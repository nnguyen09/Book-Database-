<?php
//This php is used to update an account that is currently a member

//start session get email
session_start();
$email = $_SESSION['email'];

//connect to database
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//gets new membership status from post
$new_member_status = $_POST['member'];

//gets their info from member 
$q_name_phone = "select * from member where email = '$email'";
$result= mysqli_query($myconnection, $q_name_phone);
//setting local variables for name, phone, and pass
while($row = mysqli_fetch_array($result)){
    $name = $row['name'];
    $phone_number = $row['phone_number'];
    $password = $row['password'];
}

//If they selected normal membership it updates their payment due each month to 20 dollars, normal rate
if($new_member_status == 'normal_membership'){
    $q_update = "update member set member_fee = '20.00' where email = '$email'";
    $r_update = mysqli_query($myconnection,$q_update);
	echo "Upgraded to normal membership!!";
}

//If they selected premium it updates it to 50, the premium rate
if($new_member_status == 'premium_membership'){
    $q_update = "update member set member_fee = '50.00' where email = '$email'";
    $r_update = mysqli_query($myconnection,$q_update);
	echo "Upgraded to premium membership!!";

}

//if they selected cancle membership it inserts their info into non_member and deletes them from member
if($new_member_status == 'Cancel_membership'){
    $qu3 = "insert INTO non_member (email,name,phone_number,password) values ('$email' ,'$name','$phone_number', '$password')";
    $result = mysqli_query($myconnection,$qu3);
    $q_delete = "delete from member where email = '$email'";
    $r_delete = mysqli_query($myconnection, $q_delete);
	echo "Cancled membership ";
}

//Main menu button
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
?>