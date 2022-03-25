<?php
session_start();
  // create short variable names
  $email = $_POST['email_login'];
  $password = $_POST['password'];
  $membership = $_POST['member'];
  $name = $_POST['user_name'];
  $phone_number = $_POST['phone_number']
?>
<html>
<head>
  <title>Create account</title>
</head>
<body>
<h1>New account</h1>
<?php

 $myconnection = mysqli_connect('localhost', 'root', '')
   or die ('Could not connect: ' . mysql_error());

 $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

    echo $email;
    echo $membership;
    $qu1 = "INSERT INTO users (email,name) values ('$email' ,'$name')";
if(mysqli_query($myconnection, $qu1)){
        echo "Account created succesfully";
    }
else{
    echo "Error1" . $qu1 ."<br>" . mysqli_error($myconnection);
}

$qu2 = "INSERT INTO customer (email,name,phone_number) values ('$email' ,'$name','$phone_number')";
if(mysqli_query($myconnection, $qu2)){
        echo "Registered as a customer";
    }
else{
    echo "Error2" . $qu2 ."<br>" . mysqli_error($myconnection);
}

//generate cart id
do
{
	$cart_id = strval(rand(0,9999));
	$qtestid = "SELECT * FROM cart where cart_id = '$cart_id'";
	$result = mysqli_query($myconnection, $qtestid);
}while(mysqli_num_rows($result) != 0);
$qcart = "insert into cart (cart_id, user_email, item_cost, shipping_type, tax) values ('$cart_id','$email', 0.0, 'standard', 5)";
if(mysqli_query($myconnection, $qcart))
{
        echo "Cart created";
}
else{
    echo "Error2" . $qcart ."<br>" . mysqli_error($myconnection);
}


if($membership == 'yes'){
    $qu3 = "INSERT INTO member (email,name,phone_number,member_fee,password) values ('$email' ,'$name','$phone_number','20.00', '$password')";
    
    if(mysqli_query($myconnection, $qu3)){
            echo "Registered as a Member";
			$_SESSION['email'] = $email;
            header("Location: bookstore.php");
     
        }
    else{
        echo "Error3" . $qu3 ."<br>" . mysqli_error($myconnection);
    }

}

if($membership == 'premium'){
    $qu4 = "INSERT INTO member (email,name,phone_number,member_fee,password) values ('$email' ,'$name','$phone_number','50.00', '$password')";
    if(mysqli_query($myconnection, $qu4)){
            echo "Registered as a premium member";
			$_SESSION['email'] = $email;
            header("Location: bookstore.php");
     
        }
    else{
        echo "Error4" . $qu4 ."<br>" . mysqli_error($myconnection);
    }

}

if($membership == 'no'){
    $qu5 = "INSERT INTO non_member (email,name,phone_number,password) values ('$email' ,'$name','$phone_number', '$password')";
    if(mysqli_query($myconnection, $qu5)){
            echo "Registered as a non_member";
			$_SESSION['email'] = $email;
            header("Location: bookstore.php");
     
        }
    else{
        echo "Error5" . $qu5 ."<br>" . mysqli_error($myconnection);
    }


}

?>
</body>
</html>
