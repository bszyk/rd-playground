<?php
/**
 * Create custom user
 *
 * @package rd
 */

namespace RD\modules;

/**
 * @
 */
class CustomUser {

	/**
	 * @
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'create_user' ) );
		add_action( 'init', array( $this, 'rest_create_user' ) );
		add_action( 'after_setup_theme', array( $this, 'login_user' ) );
	}

	/**
	 * @
	 */
	public function create_user() {
		if ( ! empty( $_POST ) || ! isset( $_POST['reg_user_nonce'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['reg_user_nonce'] ) ), 'reg_user' ) ) {

			if ( isset( $_POST['reg_username'] ) && isset( $_POST['reg_password'] ) && isset( $_POST['permalink'] ) ) {
				$username  = sanitize_text_field( wp_unslash( $_POST['reg_username'] ) );
				$password  = sanitize_text_field( wp_unslash( $_POST['reg_password'] ) );
				$permalink = sanitize_text_field( wp_unslash( $_POST['permalink'] ) );

				$userdata = array(
					'user_pass'  => $password,
					'user_login' => $username,
				);

				wp_insert_user( $userdata );

				wp_safe_redirect( $permalink );
			}
		}
	}

	/**
	 * @
	 */
	public function rest_create_user() {
		if ( ! empty( $_POST ) || ! isset( $_POST['rest_reg_user_nonce'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rest_reg_user_nonce'] ) ), 'rest_reg_user' ) ) {

			if ( isset( $_POST['rest_reg_username'] ) && isset( $_POST['rest_reg_password'] ) && isset( $_POST['rest_reg_email'] ) && isset( $_POST['permalink'] ) ) {
				$username = sanitize_text_field( wp_unslash( $_POST['rest_reg_username'] ) );
				$email    = sanitize_text_field( wp_unslash( $_POST['rest_reg_email'] ) );
				$password = sanitize_text_field( wp_unslash( $_POST['rest_reg_password'] ) );

				$request = new \WP_REST_Request( 'POST', '/wp/v2/users' );
				$request->set_query_params(
					array(
						'username' => $username,
						'email'    => $email,
						'password' => $password,
					)
				);
				rest_do_request( $request );
			}
		}
	}

	/**
	 * @
	 */
	public function login_user() {
		if ( ! empty( $_POST ) || ! isset( $_POST['login_user_nonce'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['login_user_nonce'] ) ), 'login_user' ) ) {

			if ( isset( $_POST['login_username'] ) && isset( $_POST['login_password'] ) && isset( $_POST['permalink'] ) ) {
				$username  = sanitize_text_field( wp_unslash( $_POST['login_username'] ) );
				$password  = sanitize_text_field( wp_unslash( $_POST['login_password'] ) );
				$permalink = sanitize_text_field( wp_unslash( $_POST['permalink'] ) );

				$creds = array(
					'user_login'    => $username,
					'user_password' => $password,
					'remember'      => true,
				);

				$user = wp_signon( $creds, false );

				if ( is_wp_error( $user ) ) {
						echo esc_html( $user->get_error_message() );
				}

				wp_safe_redirect( $permalink );
			}
		}
	}
}
