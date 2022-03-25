<?php
session_start();
$email = $_SESSION['email'];
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
$new_member_status = $_POST['member'];
echo "<br>".$new_member_status;
$q_name_phone = "select * from member where email = '$email'";
$result= mysqli_query($myconnection, $q_name_phone);
while($row = mysqli_fetch_array($result)){
    $name = $row['name'];
    $phone_number = $row['phone_number'];
    $password = $row['password'];
}

if($new_member_status == 'normal_membership'){
    $q_update = "update member set member_fee = '20.00' where email = '$email'";
    $r_update = mysqli_query($myconnection,$q_update);
}

if($new_member_status == 'premium_membership'){
    $q_update = "update member set member_fee = '50.00' where email = '$email'";
    $r_update = mysqli_query($myconnection,$q_update);
}

if($new_member_status == 'Cancel_membership'){
    $qu3 = "insert INTO non_member (email,name,phone_number,password) values ('$email' ,'$name','$phone_number', '$password')";
    $result = mysqli_query($myconnection,$qu3);
    $q_delete = "delete from member where email = '$email'";
    $r_delete = mysqli_query($myconnection, $q_delete);
}
echo "Updated membership!!";

echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
?>