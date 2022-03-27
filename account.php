<?php
session_start();
$email = $_SESSION['email'];
$myconnection = mysqli_connect('localhost', 'root', '') 
  or die ('Could not connect: ' . mysql_error());

$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
$q1 = "select member_fee from member where email ='$email'";
$r1 = mysqli_query($myconnection, $q1);
if(mysqli_fetch_array($r1) == 0){
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
    <input align ='center' type='submit' value='Create account'/>
    <input align ='center' type='reset' value='Reset'/>
    </form>
    
    </body>
    </html>
    ";
}
else
{

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
    <input align ='center' type='submit' value='Create account'/>
    <input align ='center' type='reset' value='Reset'/>
    </form>
    
    </body>
    </html>
    ";
    
}



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
    


echo "<form action ='bookstore.php' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";

?>