<?php
session_start();
$email = $_SESSION['email'];
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());
$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
if(isset($_POST['old_phone']))
{
	$old_num = $_POST['old_phone'];
	$q = "select * from customer where email = '$email' and phone_number = '$old_num'";
	$r = mysqli_query($myconnection, $q);
	if(mysqli_num_rows($r) == 0)
	{
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
	else
	{
		$new_phone = $_POST['new_phone'];
		$update = "Update customer set phone_number = '$new_phone' where email = '$email' and phone_number = '$old_num'";
		$r = mysqli_query($myconnection, $update);
		$q = "select * from member where email = '$email' and phone_number = '$old_num'";
		$r = mysqli_query($myconnection, $q);
		if(mysqli_num_rows($r) == 0)
			{
				echo "not a member";
			}
		else
		{
			$new_phone = $_POST['new_phone'];
			$update = "Update member set phone_number = '$new_phone' where email = '$email' and phone_number = '$old_num'";
			$r = mysqli_query($myconnection, $update);
			echo "Updated phone number from: '$old_num'<br>To:   '$old_num'<br>";  

		}
		$r = mysqli_query($myconnection, $update);
		$q = "select * from non_member where email = '$email' and phone_number = '$old_num'";
		$r = mysqli_query($myconnection, $q);
		if(mysqli_num_rows($r) == 0)
		{
			echo "Not a non_member";
		}
		else
		{
			$new_phone = $_POST['new_phone'];
			$update = "Update non_member set phone_number = '$new_phone' where email = '$email' and phone_number = '$old_num'";
			$r = mysqli_query($myconnection, $update);
			echo "Updated phone number from: '$old_num'<br>To:   '$old_num'<br>";  
		}
	}
}

if(isset($_POST['old_password']))
{
	
	$old_pass = $_POST['old_password'];
	$q = "select * from member where email = '$email' and password = '$old_pass'";
	$r = mysqli_query($myconnection, $q);
	if(mysqli_num_rows($r) == 0)
	{
		echo "not member<br>";
		$q = "select * from non_member where email = '$email' and password = '$old_pass'";
		$r = mysqli_query($myconnection, $q);
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
		else
		{
			$new_password = $_POST['new_password'];
			$update = "Update non_member set password = '$new_password' where email = '$email' and password = '$old_pass'";
			$r = mysqli_query($myconnection, $update);
		}

	}
	else
	{
			$new_password = $_POST['new_password'];
			$update = "Update member set password = '$new_password' where email = '$email' and password = '$old_pass'";
			$r = mysqli_query($myconnection, $update);
	}

}



echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
?>