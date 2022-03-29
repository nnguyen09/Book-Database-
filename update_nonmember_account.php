<?php
session_start();
$email = $_SESSION['email'];
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
$new_member_status = $_POST['member'];
echo "<br>".$new_member_status;
$q_name_phone = "select * from non_member where email = '$email'";
$result= mysqli_query($myconnection, $q_name_phone);
while($row = mysqli_fetch_array($result)){
    $name = $row['name'];
    $phone_number = $row['phone_number'];
    $password = $row['password'];
}

if($new_member_status == 'yes'){
    $qu3 = "insert INTO member (email,name,phone_number,member_fee,password) values ('$email' ,'$name','$phone_number','20.00', '$password')";
    
    if(mysqli_query($myconnection, $qu3)){
            echo "Registered as a Member";
			$_SESSION['email'] = $email;

        }
    else{
        echo "Error3" . $qu3 ."<br>" . mysqli_error($myconnection);
    }
    $q_delete = "delete from non_member where email = '$email'";
    $r_delete = mysqli_query($myconnection, $q_delete);

}

if($new_member_status == 'premium'){
    $qu4 = "INSERT INTO member (email,name,phone_number,member_fee,password) values ('$email' ,'$name','$phone_number','50.00', '$password')";
    if(mysqli_query($myconnection, $qu4)){
            echo "Registered as a premium member";
			$_SESSION['email'] = $email;
        }
    else{
        echo "Error4" . $qu4 ."<br>" . mysqli_error($myconnection);
    }
    $q_delete = "delete from non_member where email = '$email'";
    $r_delete = mysqli_query($myconnection, $q_delete);


}

if($new_member_status == 'no'){
    echo "You already arent a member fun guy";    
}


echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
?>