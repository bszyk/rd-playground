<?php
/**
 * Template part for research
 *
 * @package rd
 */

?>

<form action='' method='POST' style='border: 1px solid black; padding: 25px; margin: 25px;'>
<h3>Register a new user</h3>
<!-- nonce -->
<?php wp_nonce_field( 'rest_reg_user', 'rest_reg_user_nonce' ); ?>
<!-- nonce -->
<label for='rest_reg_username'> Enter a username:
	<input type='text' placeholder='username' name='rest_reg_username' id='rest_reg_username' />
</label>
<br />
<label for='rest_reg_email'> Enter your email:
	<input type='email' placeholder='email' name='rest_reg_email' id='rest_reg_email' />
</label>
<br />
<label for='rest_reg_password'> Enter a password:
	<input type='text' placeholder='password' name='rest_reg_password' id='rest_reg_password' />
</label>
<br />
<button type='submit' value='Submit'>Submit</button>
<input type="hidden" name="action" value="rest_create_user">
</form>
