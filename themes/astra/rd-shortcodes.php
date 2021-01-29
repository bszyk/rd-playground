<?php
/**
 * Shortcodes
 *
 * @package rd
 */

/**
 * Registration form
 */
function render_reg_form() {
	ob_start();
	get_template_part( 'template-parts/rd/rd', 'reg_form' );
	return ob_get_clean();
}

add_shortcode( 'reg_form', 'render_reg_form' );

/**
 * Registration form via REST endpoint
 */
function render_rest_reg_form() {
	ob_start();
	get_template_part( 'template-parts/rd/rd', 'rest_reg_form' );
	return ob_get_clean();
}

add_shortcode( 'rest_reg_form', 'render_rest_reg_form' );

/**
 * Login form
 */
function render_login_form() {
	ob_start();
	get_template_part( 'template-parts/rd/rd', 'login_form' );
	return ob_get_clean();
}

add_shortcode( 'login_form', 'render_login_form' );

// /**
//  * Login to IdP with JWT form
//  */
// function render_idp_login_form() {
// 	ob_start();
// 	get_template_part( 'template-parts/rd/rd', 'jwt_login_form' );
// 	return ob_get_clean();
// }

// add_shortcode( 'idp_login_form', 'render_idp_login_form' );
