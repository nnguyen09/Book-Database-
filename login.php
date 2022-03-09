
<html>
<head>
  <title>Create account</title>
</head>
<body>
<h1>Login Page</h1>
<?php 
  check_Login_Info($_POST);

?>
<form action = "" method="post">
        <table>
            <tr>
                <td>Email</td>         
                <td><input type="text" name ="email"></td> 
             </tr>
             <tr>
                <td>password</td>         
                <td><input type="password" name ="password"></td> 
             </tr>
             <tr>
<td colspan="2" align="center"><input type="submit" value="Login"/></td>
</tr>
    </table>
</form>
<?php
  
  function check_Login_Info($array){

    $email = $array['email'];
    $password = $array['password'];
    $submit = $array['submit'];
  $mc = mysqli_connect('localhost', 'root', '')
    or die ('Could not connect: ' . mysql_error());
 
  $mydb = mysqli_select_db ($mc, 'bookstore') or die ('Could not select database');
  
  
  $q1 = "Select * from non_member where email = '$email'";
  $q2 = "Select * from member where email = '$email'";
  $r1 = mysqli_query($mc, $q1);
  $r2 = mysqli_query($mc, $q2);

  if(mysqli_num_rows($r1) == 0){
      if(mysqli_num_rows($r2) == 0){
          echo "Error, neither memeber or non member";
          if($email!='' ){
            header("Location: create_account.php");
          }
      }
      else{
        echo "They are a member";
        header("Location: bookstore.php?email=".$email);
      }
  }
  else{
    echo "They are a non-member";
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
