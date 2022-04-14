<?php
if(isset($_POST['email'])&&isset($_POST['password'])){
    require_once "conn.php";
    require_once "validate.php";
    $email = validate($_POST['email']);
    $password = validate($_POST['passwod']);
    $q1 = "Select * from non_member where email = '$email' and password= '" .md5($password) . "' ";
	$q2 = "Select * from member where email = '$email' and password= '" .md5($password) . "' ";
	$r1 = $conn->query(($q1));
	$r2 = $conn->query(($q2));
    if($r1->num_rows == 0)
	{
		//If r2 has no results then that means they are not a member either
		if($r2->num_rows == 0)
		{
			//If they entered in a password and email and got here it means they entered in the wrong email and password, so it tells them
			if(($email!='' )&&($password!=''))
			{
				echo "<i>Invalid Email address Or Password</i>";
			}
		}
		//Else it does return results and therefore they are a member and can log in
		else
		{
			echo "Login successful";
		}
	}

}


?>