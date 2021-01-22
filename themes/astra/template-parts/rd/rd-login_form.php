<?php
/**
 * Template part for research
 *
 * @package rd
 */

if ( is_user_logged_in() ) { ?>
	<a href="<?php echo esc_url( wp_logout_url() ); ?>">Logout</a>
<?php } else { ?>

<form action='<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>' method='POST' style='border: 1px solid black; padding: 25px; margin: 25px;'>
<h3>Login an existing user:</h3>
<!-- nonce -->
	<?php wp_nonce_field( 'login_user', 'login_user_nonce' ); ?>
<!-- nonce -->
<label for='login_username'> Enter a username:
	<input type='text' placeholder='username' name='login_username' id='login_username' />
</label>
<br />
<label for='login_password'> Enter a password:
	<input type='text' placeholder='password' name='login_password' id='login_password' />
</label>
<br />
<button type='submit' value='Submit'>Submit</button>
<input type="hidden" name="action" value="login_user">
<input type="hidden" name="permalink" value="<?php echo esc_attr( get_permalink() ); ?>">
</form>
	<?php
}
