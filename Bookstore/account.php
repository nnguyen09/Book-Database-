<?php
//This file is used for updating account information of a respective use

// starting session
session_start();

//this session variable gets the email from the session currently running
$email = $_SESSION['email'];

//creates a connection
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());    //if can’t connect

//selects the database within the connection
  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  //To check the user membership based on the member fee and change the membership if the user wants to

  $q1 = "select member_fee from member where email ='$email'";
  $r1 = mysqli_query($myconnection, $q1);

if(mysqli_fetch_array($r1) == 0){
    //if the query does not return anything that means the logged in user is a non member and wants to register as a member

echo "Currently not a member, would you like to upgrade?<br>";
echo"<form action='update_nonmember_account.php' method='post'><table>";
echo "<tr>
    <td>Change Membership?</td>
    <td><input type='radio' name='member' value='yes' required/>Yes</td>
    <td><input type='radio' name='member' value='premium'/>Premium</td>
    <td><input type='radio' name='member' value='no'/>No</td>
    </tr>
    ";
echo "</table>
    <input align ='center' type='submit' value='Change Membership'/>
    </form>
    
    </body>
    </html>
    ";
}
else {
//if the logged in user is a member and wants to upgrade his membership this would be displayed

    echo
    "<form action='update_member_account.php' method='post'><table>";
    
    echo "
    <tr>
    <td>Change Membership?</td>";

echo"<td><input type='radio' name='member' value='normal_membership' required/>Normal Membership</td>";
echo"<td><input type='radio' name='member' value='premium_membership'/>Premium Membership</td>";
echo"<td><input type='radio' name='member' value='Cancel_membership'/>Cancel Membership</td>";
 echo"</tr>";
    echo "</table>
    <input align ='center' type='submit' value='Change Membership'/>
    </form>
    
    </body>
    </html>
    ";
    
}



    echo
    "<form action='update_info.php' method='post'><table>";
    //updating contact information of the user
    echo "
    <tr>
    <td>Update Phone?</td>";


	echo "<td><input type='old_phone' name ='old_phone' minlength = 12 maxlength = 12 required> Old Number </td>";
	echo "<td><input type='new_phone' name ='new_phone' minlength = 12 maxlength = 12  required> New Number </td> ";
	echo"</tr>";
    echo "</table>
    <input align ='center' type='submit' value='Update phone(123-123-1234)'/>
    </form>
    </body>
    </html>
    ";


    echo
    "<form action='update_info.php' method='post'><table>";
    
    //updating password of the logged in user
    echo " <tr> <td>Update Password?</td>";
 
    

	echo"<td><input type='old_password' name ='old_password' required>Old Password</td> ";
	echo"<td><input type='new_password' name ='new_password' required>New Password</td> ";
	echo"</tr>";
    echo "</table>
    <input align ='center' type='submit' value='Change password'/>

    </form>
    
    </body>
    </html>
    ";
    


// clicking the main menu button takes you back to the bookstore.php (main page)

echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";

?>