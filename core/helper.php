<?php
/**
 * Helper.
 *
 * @package Network_Wide_Custom_Code
 * @since x.x.x
 */

namespace NWCC\Core;

use NWCC\Core\Traits\Get_Instance;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Helper
 *
 * @since x.x.x
 */
class Helper {

	use Get_Instance;

	/**
	 * Keep default values of all settings.
	 *
	 * @var array
	 * @since x.x.x
	 */
	public function get_defaults() {
		return [
			NWCC_SETTINGS => [
				'header_css' => '',
				'header_js'  => '',
				'footer_css' => '',
				'footer_js'  => '',
			],
		];
	}

	/**
	 * Get option value from database and retruns value merged with default values
	 *
	 * @param string $option option name to get value from.
	 * @return array
	 * @since x.x.x
	 */
	public function get_option( $option ) {
		$db_values = get_site_option( $option, [] );
		return wp_parse_args( $db_values, $this->get_defaults()[ $option ] );
	}
}
