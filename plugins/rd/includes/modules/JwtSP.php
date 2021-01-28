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

	/**
	 * Sends request to get IdP's token
	 */
	public function request_token_from_idp() {
		$username = 'admin';
		$password = 'admin';

		$response = wp_remote_request(
			'http://ssord-identity.local/wp-json/jwt-auth/v1/token',
			array(
				'method' => 'POST',
				'body'   => array(
					'username' => $username,
					'password' => $password,
				),
			)
		);

		$body = json_decode( wp_remote_retrieve_body( $response ) );

		if ( 200 === $body->statusCode ) {
			$token = $body->data->token;
			$this->login_to_idp( $username, $password, $token );
		}
	}

	/**
	 * If a valid token is received, hit IdP endpoint to trigger login
	 */
	public function login_to_idp( $username, $password, $token ) {
		$response = wp_remote_request(
			'http://ssord-identity.local/wp-json/rdlogin/v1/login',
			array(
				'method'  => 'POST',
				'body'    => wp_json_encode(
					array(
						'username' => $username,
						'password' => $password,
					)
				),
				'headers' => array(
					'Content-Type'  => 'application/json',
					'Authorization' => 'Bearer ' . $token,
				),
			),
		);

		if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
			wp_redirect( 'http://ssord-identity.local/wp-admin' );
			exit();
		}

	}
}
