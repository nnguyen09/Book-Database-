<?php
//This php isused to update the users info, either password or phone number only so far

//Start session get email
session_start();
$email = $_SESSION['email'];

//Connect to database
$myconnection = mysqli_connect('localhost', 'root', '') 
or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

//If they are update phone then old phone exists
if(isset($_POST['old_phone']))
{
	//Gets old phone number
	$old_num = $_POST['old_phone'];
	
	//Query that gets the customers info from their email
	$q = "select * from customer where email = '$email' and phone_number = '$old_num'";
	$r = mysqli_query($myconnection, $q);
	//If there is zero results it means they entered in the wrong phone number
	if(mysqli_num_rows($r) == 0)
	{
		
	//Promts them to enter in their desired phone number again
	echo "So sorry the number you entered was not what we had on file, please try again<br>";
	echo
    "<form action='update_info.php' method='post'><table>";
    
    echo "
    <tr>
    <td>Update Phone?</td>";


	echo "<td><input type='old_phone' name ='old_phone' minlength = 12 maxlength = 12 required> Old Number 123-456-7890 </td>";
	echo "<td><input type='new_phone' name ='new_phone' minlength = 12 maxlength = 12  required> New Number 123-456-7890 </td> ";
	echo"</tr>";
    echo "</table>
    <input align ='center' type='submit' value='Create account'/>
    <input align ='center' type='reset' value='Reset'/>
    </form>
    
    </body>
    </html>
    ";
	echo "<form action ='bookstore.php' method= 'post'>";
	echo "<table>";
	echo "<input type='submit' value='Main Menu' />"; 
	echo "</table>";
	echo "</form>";
	}
	
	//If it isnt zero that means they did enter in the correct old phone number
	else
	{
		//gets new number from post
		$new_phone = $_POST['new_phone'];
		
		//query that updates the customers phone number to the new one
		$update = "Update customer set phone_number = '$new_phone' where email = '$email' and phone_number = '$old_num'";
		$r = mysqli_query($myconnection, $update);
		
		//Query thats used to check if they are a member
		$q = "select * from member where email = '$email' and phone_number = '$old_num'";
		$r = mysqli_query($myconnection, $q);
		//if zero then they arent a member
		if(mysqli_num_rows($r) == 0){echo "not a member";}
		//otherwise they are a member
		else
		{
			//updates member phone number to new number
			$new_phone = $_POST['new_phone'];
			$update = "Update member set phone_number = '$new_phone' where email = '$email' and phone_number = '$old_num'";
			$r = mysqli_query($myconnection, $update);
			echo "Updated phone number from: '$old_num'<br>To:   '$old_num'<br>";  
		}
		$r = mysqli_query($myconnection, $update);
		
		//Query to check if they are a non_member
		$q = "select * from non_member where email = '$email' and phone_number = '$old_num'";
		$r = mysqli_query($myconnection, $q);
		//if zero then they are a not a non memeber
		if(mysqli_num_rows($r) == 0){echo "Not a non_member";}
		//else they are a non member
		else
		{
			//updates the nonmebers phone number
			$new_phone = $_POST['new_phone'];
			$update = "Update non_member set phone_number = '$new_phone' where email = '$email' and phone_number = '$old_num'";
			$r = mysqli_query($myconnection, $update);
			echo "Updated phone number from: '$old_num'<br>To:   '$old_num'<br>";  
		}
	}
}

//If they used the update password then old password will exsist in post
if(isset($_POST['old_password']))
{
	//Gets old password from post
	$old_pass = $_POST['old_password'];
	
	//Checking to see if their email and password match in member
	$q = "select * from member where email = '$email' and password = '$old_pass'";
	$r = mysqli_query($myconnection, $q);
	//if zero rows it means they arent a member  will check to see if they are a non member in this if
	if(mysqli_num_rows($r) == 0)
	{
		echo "not member<br>";
		//Checking to see if they are a non member
		$q = "select * from non_member where email = '$email' and password = '$old_pass'";
		$r = mysqli_query($myconnection, $q);
		//if it returns zero rows it means they either entered their username or password incorrectly, promts them to do the form again
		if(mysqli_num_rows($r) == 0){
			echo "Username or Password incorrect";
			 echo
			"<form action='update_info.php' method='post'><table>";
    
			echo "
			<tr>
			<td>Update Password?</td>";


			echo"<td><input type='old_password' name ='old_password' required>Old Password</td> ";
			echo"<td><input type='new_password' name ='new_password' required>New Password</td> ";
			echo"</tr>";
			echo "</table>
			<input align ='center' type='submit' value='Create account'/>
			<input align ='center' type='reset' value='Reset'/>
			</form>
    
			</body>
			</html>
			";
		}
		//else it means they are a non member
		else
		{
			$new_password = $_POST['new_password'];
			//updates non member with the new password they provided
			$update = "Update non_member set password = '$new_password' where email = '$email' and password = '$old_pass'";
			$r = mysqli_query($myconnection, $update);
		}

	}
	//else it means they are a member
	else
	{
			$new_password = $_POST['new_password'];
			//updates the member table to the new password they entered
			$update = "Update member set password = '$new_password' where email = '$email' and password = '$old_pass'";
			$r = mysqli_query($myconnection, $update);
	}

}


//main menu button
echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
?>