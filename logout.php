<?php
    session_start();
	echo $_SESSION['email'];
    unset($_SESSION['email']);
    header("Location: bookstore.html");
?>