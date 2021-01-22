<?php
/**
Plugin Name: Research and Development
Plugin URI: https://easilyamusedinc.com
Description: Internal
Author: Easily Amused
Version: 1.0.0
Author URI: https://easilyamusedinc.com

@package rd
 */

namespace RD;

require_once __DIR__ . '/vendor/autoload.php';

use RD\modules\CustomUser;

/**
 * @
 */
class RdPlugin {

	/**
	 * @
	 */
	public function __construct() {
		new CustomUser();
	}

}

new RdPlugin();
