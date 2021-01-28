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
<?php wp_nonce_field( 'idp_user', 'idp_user_nonce' ); ?>
<h3>Login to the identity provider:</h3>
<label for='idp_username'> Enter a username:
	<input type='text' placeholder='username' name='idp_username' id='idp_username' />
</label>
<br />
<label for='idp_password'> Enter a password:
	<input type='text' placeholder='password' name='idp_password' id='idp_password' />
</label>
<br />
<button type='submit' value='Submit'>Submit</button>
<input type="hidden" name="action" value="request_token_from_idp">
</form>
	<?php
}
