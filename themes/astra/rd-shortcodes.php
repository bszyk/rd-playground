<?php
/**
 * Shortcodes
 *
 * @package rd
 */

/**
 * Registration form
 */
function render_rd_registration_form() {
	get_template_part( 'template-parts/rd/rd', 'registration_form' );
}

add_shortcode( 'rd_registration_form', 'render_rd_registration_form' );

/**
 * Login form
 */
function render_rd_login_form() {
	get_template_part( 'template-parts/rd/rd', 'login_form' );
}

add_shortcode( 'rd_login_form', 'render_rd_login_form' );
