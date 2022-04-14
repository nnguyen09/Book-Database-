<html>
<head>
  <title>Create account</title>
</head>
<body>
<h2 align='center'>Login Page</h2>
<br><br>
<?php 
//Starting session
session_start();
//Runs function to check if logged in, will only trigger after the page is refreshed using the form below
check_Login_Info($_POST);
?>
<!--This form takes in the info needed to log in and then refreshes the page, meaning that entered info is passed into the check_login_info function-->
<form action = "" method="post">
        <table align='center'>
            <tr>
                <td>Email</td>         
                <td><input type="email" name ="email" required></td> 
             </tr>
             <tr>
                <td>Password</td>         
                <td><input type="password" name ="password" required></td> 
</tr>
    </table>
    <br>
<p align='center'><input align ="right" type="submit" value="Login"/><input align ="right" type="reset" value="Reset"/></p>
</form>
<!--This form send the user to the create account page-->
<form action='create_account.php' method='post'>
 <p align='center'><input  type='submit' value='Create One First'/></p>
</form>
<?php
//Function that actually logs them in
function check_Login_Info($array)
{
	//Gets email from $_POST, only assigns if refreshed
	$email = $array['email'];
	
	//Adds element 'email' to session and sets the input email as its value, this will remain in till user goes to logout
	$_SESSION['email'] = $array['email'];
	
	//Gets password
	$password = $array['password'];
	$submit = $array['submit'];
	
	//Connecting to database
	$mc = mysqli_connect('localhost', 'root', '')
    or die ('Could not connect: ' . mysql_error());
	$mydb = mysqli_select_db ($mc, 'bookstore') or die ('Could not select database');

	//Q1 gets gets their info assuming they are a non_member while Q2 assumes they are a member, uses email and password as identifyer
	$q1 = "Select * from non_member where email = '$email' and password= '$password' ";
	$q2 = "Select * from member where email = '$email' and password= '$password' ";
	$r1 = mysqli_query($mc, $q1);
	$r2 = mysqli_query($mc, $q2);
	
	//If r1 has zero results it means they are not a non_member
	if(mysqli_num_rows($r1) == 0)
	{
		//If r2 has no results then that means they are not a member either
		if(mysqli_num_rows($r2) == 0)
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
			//Double checks that the session has a value email
			if(isset($_SESSION['email']))
			{
				header("Location: bookstore.php?email=".$email );
				}
			}
	}
	//Else it has results meaning they are a non member and can log in
	else
	{
		//Double checks that the session has a value email
		if(isset($_SESSION['email']))
		{
			header("Location: bookstore.php?email=".$email );
		}
	}
}
?>
<form action="bookstore.php" method="post">
<table>

</table>
<a href="bookstore.html" align ="center" />
</form>

</body>
</html>
<?php

//Main menu button
echo "<form action ='bookstore.html' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";
?>