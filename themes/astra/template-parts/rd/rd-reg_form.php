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
<?php wp_nonce_field( 'reg_user', 'reg_user_nonce' ); ?>
<!-- nonce -->
<label for='reg_username'> Enter a username:
	<input type='text' placeholder='username' name='reg_username' id='reg_username' />
</label>
<br />
<label for='reg_password'> Enter a password:
	<input type='text' placeholder='password' name='reg_password' id='reg_password' />
</label>
<br />
<button type='submit' value='Submit'>Submit</button>
<input type="hidden" name="action" value="create_user">
<input type="hidden" name="permalink" value="<?php echo esc_url( get_permalink() ); ?>">
</form>
