<?php
/**
 * Login to the WP site if a username and password is provided to custom endpoint with a valid JWT.
 *
 * @package EA_SSO
 */

namespace EA_SSO\modules;

/**
 * @
 */
class IdentityProvider {

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'create_login_rest_route' ) );
	}

	/**
	 * Register a custom REST endpoint to hit after receiving a token
	 */
	public function create_login_rest_route() {
		register_rest_route(
			'ea-sso/v1',
			'/login',
			array(
				'methods'  => 'POST',
				'callback' => array( $this, 'login_rest_callback' ),
			)
		);
	}

	/**
	 *
	 * If a request is made to the custom login endpoint with a valid token, log in with provided credentials
	 *
	 * @param \WP_REST_Request $data Response containing username & password for IdP.
	 */
	public function login_rest_callback( \WP_REST_Request $data ) {
		$login_info = json_decode( $data->get_body(), true );

		$username = $login_info['username'];
		$password = $login_info['password'];

		$creds = array(
			'user_login'    => $username,
			'user_password' => $password,
			'remember'      => true,
		);

		$user = wp_signon( $creds, false );

		if ( is_wp_error( $user ) ) {
				echo esc_html( $user->get_error_message() );
				return new \WP_REST_Response( null, 404 );
		}

		return new \WP_REST_Response( null, 200 );
	}
}
