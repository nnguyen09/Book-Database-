 <?php
   
  $title = $_POST['title']; 
  $author = $_POST['author'];
 
  $myconnection = mysqli_connect('localhost', 'root', '') 
    or die ('Could not connect: ' . mysql_error());

  $mydb = mysqli_select_db ($myconnection, 'bookstore') or die ('Could not select database');

  $query1 = "SELECT title, year FROM book WHERE title = '$title'";
  //$query2 = "SELECT title, year FROM book, author WHERE author = '$name'";

  $result1 = mysqli_query($myconnection, $query1);
  if(mysqli_num_rows($result1) == 1) {
    echo "pass";
    echo "<br>";
   //$result2 = mysqli_query($myconnection, $query2) or die ('Query failed: ' . mysql_error());
  }
   else{
    echo "fail1";
    echo "<br>";
     $query2= "SELECT title,year FROM book WHERE book_id in (SELECT  book_id from wrote WHERE author_id in (SELECT author_id from author WHERE name = '$title'))";

    echo "fail2";
    echo "<br>";
    $result1 = mysqli_query($myconnection, $query2);

    echo "fail3";
    echo "<br>";
    if(mysqli_num_rows($result1) == 1){
      echo "pass";
      echo "<br>";
    }
    else {
      echo "fail";
      echo "<br>";
    }
   }
  echo 'Title &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; year &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>';

  while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) {    
    echo $row["title"];
    echo "&nbsp;&nbsp;&nbsp;";
    echo $row["year"];
    echo "&nbsp;&nbsp;&nbsp;";
    // echo $year;
    // echo "&nbsp;&nbsp;&nbsp;";
    echo '<br>';
  }
/*$query2 = "SELECT title, year FROM book, author WHERE author = '$name'";

 $result2 = mysqli_query($myconnection, $query2) or die ('Query failed: ' . mysql_error());

  while ($row = mysqli_fetch_array ($result2, MYSQLI_ASSOC)) {    
    echo $row["title"];
    echo "&nbsp;&nbsp;&nbsp;";
    echo $row["year"];
    echo "&nbsp;&nbsp;&nbsp;";
    // echo $year;
    // echo "&nbsp;&nbsp;&nbsp;";
    echo '<br>';
  }

*/
  mysqli_free_result($result1);

  mysqli_close($myconnection);

?>
