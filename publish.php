<?php
echo "<h3 align='center'><i>Publisher Adds a Book</i></h3>";
echo"<form action='task2.php' method='post'>
<table align='center'>
<tr>
	<td>Publisher ID</td>
	<td><input type='text' name='publisher_id'  minlength='3' required/></td>
</tr>
<tr>
	<td>Author ID</td>
	<td><input type='text' name='author_id'  minlength='3' required/></td>
</tr>
<tr>
	<td>Title</td>
	<td><input type='text' name='book_title'  minlength='3' required/></td>
</tr>
<tr>
	<td>Genre</td>
	<td><input type='text' name='book_genre'  minlength='3' required/></td>
</tr>
<tr>
	<td>ISBN</td>
	<td><input type='text' name='isbn' minlength='13' maxlength='13' required/></td>
</tr>
<tr>
	<td>Types Avaliable</td>  
	<td><input type='checkbox' name='book_type[]' value='e_book' />E-Book </td>
	<td><input type='checkbox' name='book_type[]' value='hard_cover'/>Hard Cover</td>
	<td><input type='checkbox' name='book_type[]' value='paper_back'/>Paper Back</td>
</tr>

</table>
<p align='center'><input align ='center' type='submit' value='Publish Book'/></p>
</form>";


echo "<h3 align='center'><i>Publisher Updates Price of a Book</i></h3>";
echo"<form action='update.php' method='post'>
<table align='center'>
<tr>
	<td>Publisher ID</td>
	<td><input type='text' name='publisher_id'  minlength='3' required/></td>
</tr>
<tr>
	<td>Title</td>
	<td><input type='text' name='book_title'  minlength='3' required/></td>
</tr>
<tr>
	<td>New price</td>  
	<td><input type='text' name='new_price'</td>
</tr>
</table>
<p align='center'><input align ='center' type='submit' value='Update Price of Book'/></p>
</form>";
echo "<form action ='bookstore.html' method= 'post'>";
echo "<table>";
echo "<input type='submit' value='Main Menu' />"; 
echo "</table>";
echo "</form>";


?>