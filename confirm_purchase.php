<?php
session_start();
echo "select a payment method and add shipping method and Confirm your order ";
echo "
<form action='ordered.php' method='post'>
<table>
    <tr>
    <td>Shipping Address          </td>
    <td><label>Address:</label><input type='text' name='address'  minlength='3' required/></td>
    <td><label>Zip:</label><input type='text' name='zip' minlength='3' required/></td>
    <td><label>State:</label><input type='text' name='state'  minlength='3' required/></td>
    <td><label>Country:</label><input type='text' name='country'   minlength='3' required/></td>
    </tr>

      <tr>
      <td>Card Info          </td>   
      <td><label>Card Number:</label><input type='text' name='card_number'  minlength='3' required/></td>
      <td><label>Card Type</label><input type='text' name='card_type' minlength='3' required/></td>
      <td><label>CVV Code</labeil><input type='text' name='cvv_code'  minlength='3' required/></td>
      <td><label>Exp Date</label><input type='text' name='exp_date'   minlength='3' required/></td>
      </tr>

      <tr>
      <td>Billing Address                  </td>
      <td><label>Address:</label><input type='text' name='address'  minlength='3'/></td>
      <td><label>Zip:</label><input type='text' name='zip' minlength='3' /></td>
      <td><label>State:</label><input type='text' name='state'  minlength='3' /></td>
      <td><label>Country:</label><input type='text' name='country'   minlength='3' /></td>
      </tr>

<tr>
    <td></td>
    <td><label>Same As Shipping</label><input type='checkbox' name='same_as_shipping'  minlength='3'/></td> 
</tr>
</table>
<input align ='center' type='submit' value='Purchase'/>
<input align ='center' type='reset' value='Reset'/>
</form>

</body>
</html>

";
?>
