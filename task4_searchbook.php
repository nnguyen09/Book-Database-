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
  }
   else{
     $query2= "SELECT title,year FROM book WHERE book_id in (SELECT  book_id from wrote WHERE author_id in (SELECT author_id from author WHERE name = '$title'))";

    $result1 = mysqli_query($myconnection, $query2);
   }
  echo 'Title &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; year &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br>';

  while ($row = mysqli_fetch_array ($result1, MYSQLI_ASSOC)) {    
    echo $row["title"];
    echo "&nbsp;&nbsp;&nbsp;";
    echo $row["year"];
    echo "&nbsp;&nbsp;&nbsp;";
    echo '<br>';
  }
  mysqli_free_result($result1);

  mysqli_close($myconnection);

?>
