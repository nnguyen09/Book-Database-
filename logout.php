<?php
//This php handles user log out

//Starts session
session_start();

//unsets the session[email] so now it doesnt exsist untill a new one is populated from login again
unset($_SESSION['email']);

//Loads the html non logged in bookstore main page
header("Location: bookstore.html");
?>