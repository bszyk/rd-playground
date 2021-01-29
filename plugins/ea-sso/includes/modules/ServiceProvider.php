<?php
/**
 * Login to another WP site via JWT and REST API.
 *
 * @package EA_SSO
 */

namespace EA_SSO\modules;

/**
 * @
 */
class ServiceProvider {

	/**
	 *
	 * Root url of IdP to request token from
	 *
	 * @var string
	 */
	private $url;

	/**
	 * Construct
	 */
	public function __construct() {
		$this->url = 'http://ssord-identity.local';

		add_action( 'init', array( $this, 'request_token_from_idp' ) );
	}

	/**
	 * Send request to get IdP's token
	 */
	public function request_token_from_idp() {
		if ( ! empty( $_POST ) || ! isset( $_POST['idp_user_nonce'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['idp_user_nonce'] ) ), 'idp_user' ) ) {

			if ( isset( $_POST['idp_username'] ) && isset( $_POST['idp_password'] ) ) {
				$username = sanitize_text_field( wp_unslash( $_POST['idp_username'] ) );
				$password = sanitize_text_field( wp_unslash( $_POST['idp_password'] ) );

				$response = wp_remote_request(
					$this->url . '/wp-json/jwt-auth/v1/token',
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
				} else {
					echo 'response error 1';
				}
			}
		}
	}

	/**
	 *
	 * If a valid token is received, hit IdP endpoint to trigger login
	 *
	 * @param string $username IdP username.
	 * @param string $password IdP password.
	 * @param string $token JWT token from IdP.
	 */
	public function login_to_idp( $username, $password, $token ) {
		$response = wp_remote_request(
			$this->url . '/wp-json/ea-sso/v1/login',
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
			wp_redirect( $this->url . '/wp-admin' );
			exit();
		} else {
			echo 'reponse error 2';
		}
	}
}
