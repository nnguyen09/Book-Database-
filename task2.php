<?php
  // create short variable names
  $pid = $_POST['publisher_id'];
  $auid = $_POST['author_id'];
  $btitle = $_POST['book_title'];
  $bgenre = $_POST['book_genre'];
  $btype = $_POST['book_type']
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
	echo "<br>";
	echo $pid;
	echo "<br>";
	echo $auid;
	echo "<br>";
	echo $btitle;
	echo "<br>";
	echo $bgenre;
	echo "<br>";
	$condition = '';
	$money = 19.99;
	if(!empty($_POST['book_type'])){
		foreach($_POST['book_type'] as $type){
			echo $type;
			$condition  .= $type . ',';
			$money += 5.00;
			echo "<br>";
		}
	}
	echo date("Y/m/d");
	echo "<br>";
	echo $condition;
	echo "<br>";
	echo $money;
	echo "<br>";
	
	/*Three layers to check, first makes sure the publisher exists
	then checks that the author does, then it checks if the title
	is allready in use, if they pass all the checks then it inserts 
	the new book into the book table, and their relationships with 
	wrote and published is inserted as well*/
	
	$qpid = "SELECT * FROM publisher where publisher_id = '" .mysqli_real_escape_string($myconnection, $pid) . "'";
	$result = mysqli_query($myconnection, $qpid);
	if(mysqli_num_rows($result) == 1){
		echo "pass";
		echo "<br>";
		$qauid = "SELECT * FROM author where author_id = '" .mysqli_real_escape_string($myconnection, $auid) . "'";
		$result = mysqli_query($myconnection, $qauid);
		if(mysqli_num_rows($result) == 1){
			echo "pass";
			echo "<br>";
		
			$qtitle = "SELECT * FROM book where title = '" .mysqli_real_escape_string($myconnection, $btitle) . "'";
			$result = mysqli_query($myconnection, $qtitle);
			if(mysqli_num_rows($result) == 0){
				echo "pass";
				echo "<br>";
				
				//This loop generates an id number for the book and makes sure it is not in use
				do{
				$bid = strval(rand(0,9999));
				$qtestid = "SELECT * FROM book where book_id = '$bid'";
				$result = mysqli_query($myconnection, $qtestid);
				}while(mysqli_num_rows($result) != 0);
				echo $bid;
				echo "<br>";
				$year = intval(date('Y'));
				
				$qfinal = "INSERT INTO book (book_id,year,genre,title,isbn,book_condition,price,book_type, total_rating) values ('$bid','$year','$bgenre','$btitle','13516', 'new', '$money','$condition', '0.0')";
				if(mysqli_query($myconnection, $qfinal)){
					echo "Inserted new book";
					echo "<br>";
				}
				$qfinal1 = "insert into published (publisher_id,book_id) values ('$pid','$bid')";
				if(mysqli_query($myconnection, $qfinal1)){
					echo "Inserted new published";
					echo "<br>";
				}
				$qfinal2 = "insert into wrote (author_id,book_id) values ('$auid','$bid')";
				if(mysqli_query($myconnection, $qfinal2)){
					echo "Inserted new wrote";
					echo "<br>";
				}

			}
			else {
				echo "fail";
				echo "<br>";
			}
		
		}
		else{
			echo "fail";
			echo "<br>";
		}
	}
	else{
		echo "fail";
		echo "<br>";
	}
?>
</body>
</html>
