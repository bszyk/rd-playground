<?php
/**
 * Template part for research
 *
 * @package rd
 */

?>

<form action='<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>' method='POST' style='border: 1px solid black; padding: 25px; margin: 25px;'>
<h3>Register a new user</h3>
<!-- nonce -->
<?php wp_nonce_field( 'register_user', 'register_user_nonce' ); ?>
<!-- nonce -->
<label for='username'> Enter a username:
	<input type='text' placeholder='username' name='reg_username' id='reg_username' />
</label>
<br />
<label for='password'> Enter a password:
	<input type='text' placeholder='password' name='reg_password' id='reg_password' />
</label>
<br />
<button type='submit' value='Submit'>Submit</button>
<input type="hidden" name="action" value="create_user">
</form>
