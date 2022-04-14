<?php
session_start();
$user = "bookstore";
$bool = false;
$mysqli = new mysqli('localhost', 'root', '', 'bookstore');

//gets the email from current session
$email =$_SESSION['email'];

//returns the number of books that the user have ordered
$q1 ="select count(book_id) as quantity from grab where order_id in (select order_id from history where email ='$email') group by book_id";
$r1 = $mysqli->query(($q1));

//returns the book information for the book the user has bought or ordered
$q2 ="select * from book where book_id in (select book_id from grab where order_id in (select order_id from history where email ='$email'))";
$r2 = $mysqli->query(($q2));
if($r1->num_rows == 0)
{
    //If r2 has no results then that means they are not a member either
    if($r2->num_rows == 0)
    {
        $response["success"] = "Fail";
		echo json_encode($response);
				
    }
}
else{
    $response["success"] = "true";
		echo json_encode($response);
		
}

?>