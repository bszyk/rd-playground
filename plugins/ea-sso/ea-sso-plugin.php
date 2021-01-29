<?php
/**
Plugin Name: EA - SSO Plugin
Plugin URI: https://easilyamusedinc.com
Description: Internal
Author: Easily Amused
Version: 1.0.0
Author URI: https://easilyamusedinc.com

@package EA_SSO
 */

namespace EA_SSO;

require_once __DIR__ . '/vendor/autoload.php';

use EA_SSO\modules\ServiceProvider;
use EA_SSO\modules\IdentityProvider;

/**
 * Create new instance of plugin.
 */
class EA_SSO {

	/**
	 * Create instance of desired functionality - Service or Identity Provider.
	 */
	public function __construct() {
		new ServiceProvider();
		// new IdentityProvider();

		add_shortcode( 'idp_login_form', array( $this, 'render_idp_login_form' ) );
	}

	/**
	 * Render login form.
	 */
	public function render_idp_login_form() {
		ob_start();
		include 'includes/template-parts/idp_login_form.php';
		return ob_get_clean();
	}

}

new EA_SSO();
