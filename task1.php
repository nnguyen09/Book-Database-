<?php
$user = "bookstore";
$bool = false;
$mysqli = new mysqli('localhost', 'root', '', 'bookstore');
$year = $_POST['year'];


// grab movie info from movies table
//$qGetInfo = "SELECT * FROM book WHERE book_id in (select book_id from wrote where author_id in (select author_id from author where name = '$year'))";

$qGetInfo = "SELECT * FROM book WHERE title ='$year'";

$result = $mysqli->query($qGetInfo);

if(mysqli_num_rows($result) == 0) 
{
	$qGetInfo = "SELECT * FROM book WHERE book_id in (select book_id from wrote where author_id in (select author_id from author where name = '$year'))";
	$result = $mysqli->query($qGetInfo);
	if(mysqli_num_rows($result) == 0)
	{
		$response["success"] = "false";
		echo json_encode($response);
	}
}

$testrow = mysqli_fetch_array($result);


$response["title"] = $testrow['title'];
    $response["year"] = $testrow['year'];
    $response["length"] = $testrow['price'];
    $response["genre"] = $testrow['genre'];

    $response["success"] = "true";
    echo json_encode($response);
?>
