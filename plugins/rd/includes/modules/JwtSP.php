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
class JwtSP {

	/**
	 * @
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'request_token_from_idp' ) );
	}

	public function request_token_from_idp() {
		$response = wp_remote_request(
			'http://ssord-identity.local/wp-json/jwt-auth/v1/token',
			array(
				'method' => 'POST',
			)
		);

		$body = wp_remote_retrieve_body( $response );

		echo esc_html( $body );
	}
}
