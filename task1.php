<?php
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

if($membership == 'yes'){
    $qu3 = "INSERT INTO member (email,name,phone_number,member_fee,password) values ('$email' ,'$name','$phone_number','55.00', '$password')";
    
    if(mysqli_query($myconnection, $qu3)){
            echo "Registered as a Memeber";
        }
    else{
        echo "Error3" . $qu3 ."<br>" . mysqli_error($myconnection);
    }

}

if($membership == 'premium'){
    $qu4 = "INSERT INTO member (email,name,phone_number,member_fee,password) values ('$email' ,'$name','$phone_number','75.00', '$password')";
    if(mysqli_query($myconnection, $qu4)){
            echo "Registered as a premium member";
        }
    else{
        echo "Error4" . $qu4 ."<br>" . mysqli_error($myconnection);
    }

}

if($membership == 'no'){
    $qu5 = "INSERT INTO non_member (email,name,phone_number,password) values ('$email' ,'$name','$phone_number', '$password')";
    if(mysqli_query($myconnection, $qu5)){
            echo "Registered as a non_member";
        }
    else{
        echo "Error5" . $qu5 ."<br>" . mysqli_error($myconnection);
    }


}

?>
</body>
</html>
