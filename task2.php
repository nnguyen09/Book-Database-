<?php
  // create short variable names
  $pid = $_POST['publisher_id'];
  $auid = $_POST['author_id'];
  $btitle = $_POST['book_title'];
  $bgenre = $_POST['book_genre'];
  $isbn = $_POST['isbn'];
  $btype = $_POST['book_type'];
?>
<html>
<head>
  <title>Publishing Book</title>
</head>
<body>
<h1>Books Published</h1>
<?php
	$myconnection = mysqli_connect('localhost', 'root', '')or die ('Could not connect: ' . mysql_error());
	$mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');
	$money = 19.99;
	$year = intval(date('Y'));
	
	//Checking if publisher exists (needs to exsist in database to proceed)
	$qpid = "SELECT * FROM publisher where publisher_id = '" .mysqli_real_escape_string($myconnection, $pid) . "'";
	$result = mysqli_query($myconnection, $qpid);
	if(mysqli_num_rows($result) == 1){


		//Checking if author exists (needs to exsist in database to proceed)
		$qauid = "SELECT * FROM author where author_id = '" .mysqli_real_escape_string($myconnection, $auid) . "'";
		$result = mysqli_query($myconnection, $qauid);
		if(mysqli_num_rows($result) == 1){

			//Checking if the book title is allready in use (book of the same title cannot exsist in database to proceed)
			$qtitle = "SELECT * FROM book where title = '" .mysqli_real_escape_string($myconnection, $btitle) . "'";
			$result = mysqli_query($myconnection, $qtitle);
			if(mysqli_num_rows($result) == 0){

				//Iterating through book types
				if(!empty($_POST['book_type'])){


					 
			             // echo "fail2";
					foreach($_POST['book_type'] as $type){

						
						//Checking book types and setting price accordingly
						if($type == 'e_book'){$money = 14.99;}
						if($type == 'hard_cover'){$money = 24.99;}
						if($type == 'paper_back'){$money = 19.99;}
						//generating random book id
						do{
						$bid = strval(rand(0,9999));
						$qtestid = "SELECT * FROM book where book_id = '$bid'";
						$result = mysqli_query($myconnection, $qtestid);
						}while(mysqli_num_rows($result) != 0);


						//Inserting book, and relationships pertaining to it
						$qfinal = "INSERT INTO `book` (`book_id`, `year`, `genre`, `title`, `isbn`, `book_condition`, `price`, `book_type`, `total_rating`) VALUES ('$bid','$year','$bgenre','$btitle','$isbn', 'new', '$money','$type', '0.0')";
						if(mysqli_query($myconnection, $qfinal)){}
						$qfinal1 = "insert into published (publisher_id,book_id) values ('$pid','$bid')";
						if(mysqli_query($myconnection, $qfinal1)){}
						$qfinal2 = "insert into wrote (author_id,book_id) values ('$auid','$bid')";
						if(mysqli_query($myconnection, $qfinal2)){}
					}
					echo "Inserted new books<br>";
				}
			}
else {echo "fail<br>";}
		}
else{echo "fail<br>";}
	}
else{echo "fail<br>";}

echo "<form action ='bookstore.html' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";
echo "</p>";

?>
</body>
</html>
