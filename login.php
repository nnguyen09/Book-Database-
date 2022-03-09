
<html>
<head>
  <title>Create account</title>
</head>
<body>
<h2 align='center'>Login Page</h2>
<br><br>
<?php 
  check_Login_Info($_POST);

?>
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
<form action='create_account.php' method='post'>
 <p align='center'><input  type='submit' value='Create One First'/></p>
</form>
<?php
  
  function check_Login_Info($array){

    $email = $array['email'];
    $password = $array['password'];
    $submit = $array['submit'];
  $mc = mysqli_connect('localhost', 'root', '')
    or die ('Could not connect: ' . mysql_error());
 
  $mydb = mysqli_select_db ($mc, 'bookstore') or die ('Could not select database');
  
  
  $q1 = "Select * from non_member where email = '$email' and password= '$password' ";
  $q2 = "Select * from member where email = '$email' and password= '$password' ";
  $r1 = mysqli_query($mc, $q1);
  $r2 = mysqli_query($mc, $q2);

  if(mysqli_num_rows($r1) == 0){
      if(mysqli_num_rows($r2) == 0){
         // echo "Error, neither memeber or non member";
          if(($email!='' )&&($password!=''))
          {
            echo "<i>Invalid Email address Or Password</i>";
          //  header("Location: create_account.php");
          }
      }
      else{
        //echo "They are a member";
        header("Location: bookstore.php?email=".$email );
      }
  }
  else{
   // echo "They are a non-member";
   header("Location: bookstore.php?email=".$email);
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
