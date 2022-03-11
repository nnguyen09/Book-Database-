<html>
<head>
  <title>Create account</title>
</head>
<body>
<h1>Create account</h1>
<?php
echo "
<form action='task1.php' method='post'>
<table>
    <tr>
      <td>Email</td>
      <td><input type='text' name='email_login'  minlength='3' required/></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><input type='text' name='user_name'  minlength='3' required/></td>
    </tr>
<tr>
    <td>Password</td>
    <td><input type='password' name='password' minlength='8' required/></td>
</tr>
<tr>
  <td>Phone Number</td>
  <td><input type='text' name='phone_number'  minlength='10' required/></td>
</tr>
<tr>
  <td>Membership?</td>
  <td><input type='radio' name='member' value='yes' required/>Yes</td>
  <td><input type='radio' name='member' value='premium'/>Premium</td>
  <td><input type='radio' name='member' value='no'/>No</td>
</tr>
</table>
<input align ='center' type='submit' value='Create account'/>
<input align ='center' type='reset' value='Reset'/>
</form>

</body>
</html>

";
?>
