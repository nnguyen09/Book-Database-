<?php
echo"
  <title>Book Store Database - Search Book</title>
</head>
<body>
<h2>Search book by title and author </h2>

<form action='task4_searchbook.php' method='post'>
<table border='0'>
<tr bgcolor='#cccccc'>
  <td>Find the particular book by title of the book or Authors name </td>
 <td align='left'><input type='text' name='title' size='50' maxlength='50'/></td>
</tr>
<tr bgcolor='#cccccc'>
  <td colspan='2' align='center'><input type='submit' value='Submit Query'/></td>
</tr>
</table>
</form>
";
?>