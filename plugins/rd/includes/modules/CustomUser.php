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
	}

	/**
	 * @
	 */
	public function create_user() {
		if ( ! empty( $_POST ) || ! isset( $_POST['registration_form_nonce'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['registration_form_nonce'] ) ), 'registration_form' ) ) {

			if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
				$username = sanitize_text_field( wp_unslash( $_POST['username'] ) );
				$password = sanitize_text_field( wp_unslash( $_POST['password'] ) );

				$hash_password = wp_hash_password( $password );

				$userdata = array(
					'user_pass'  => $hash_password,
					'user_login' => sanitize_text_field( $username ),
				);
		
				wp_insert_user( $userdata );
			}
		}
	}

	/**
	 * @
	 */
	public function login_user() {
		
	}
}
