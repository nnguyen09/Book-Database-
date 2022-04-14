<?php
session_start();
$user = "bookstore";
$bool = false;
$mysqli = new mysqli('localhost', 'root', '', 'bookstore');
$email = $_POST['year'];
$password = $_POST['password'];
unset($_SESSION['email']);
$_SESSION['email'] == $email;
$q1 = "Select * from non_member where email = '$email' and password= '$password' ";
	$q2 = "Select * from member where email = '$email' and password= '$password' ";
	$r1 = $mysqli->query(($q1));
	$r2 = $mysqli->query(($q2));
    if($r1->num_rows == 0)
	{
		//If r2 has no results then that means they are not a member either
		if($r2->num_rows == 0)
		{
			//If they entered in a password and email and got here it means they entered in the wrong email and password, so it tells them
			if(($email!='' )&&($password!=''))
			{
				$response["success"] = "false";
				echo json_encode($response);
				unset($_SESSION['email']);
			}
		}
		//Else it does return results and therefore they are a member and can log in
		else
		{
			$testrow = mysqli_fetch_array($r2);

			$response["title"] = $testrow['password'];
			$response["year"] = 1999;
			$response["length"] = 200;
			$response["genre"] = $testrow['email'];
	
			$response["success"] = "true";
			echo json_encode($response);
	}
	}
	else
	{
		$testrow = mysqli_fetch_array($r1);

		$response["title"] = $testrow['password'];
		$response["year"] = 1999;
		$response["length"] = 200;
		$response["genre"] = $testrow['email'];

		$response["success"] = "true";
		echo json_encode($response);
		
		


	}

	
?>