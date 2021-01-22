<?php
/**
 * Template part for research
 *
 * @package rd
 */

?>

<form action='<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>' method='POST' style='border: 1px solid black; padding: 25px; margin: 25px;'>
<h3>Login an existing user:</h3>
<!-- nonce -->
<?php wp_nonce_field( 'login_user', 'login_user_nonce' ); ?>
<!-- nonce -->
<label for='username'> Enter a username:
	<input type='text' placeholder='username' name='login_username' id='login_username' />
</label>
<br />
<label for='password'> Enter a password:
	<input type='text' placeholder='password' name='login_password' id='login_password' />
</label>
<br />
<button type='submit' value='Submit'>Submit</button>
<input type="hidden" name="action" value="login_user">
</form>
