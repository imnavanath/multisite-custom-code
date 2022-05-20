<?php
/**
 * Plugin Name:       Network Wide Custom Code
 * Description:       This plugin is for WordPress Multisite setup. It allows to add custom CSS & JS code in the network admin which will be enqueued on all sites under the network.
 * Requires at least: 5.9.3
 * Requires PHP:      5.6
 * Version:           1.0.0
 * Author:            Navanath Bhosale
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       nwcc
 *
 * @package           Network_Wide_Custom_Code
 */

/**
 * Set constants
 */
define( 'NWCC_FILE', __FILE__ );
define( 'NWCC_BASE', plugin_basename( NWCC_FILE ) );
define( 'NWCC_DIR', plugin_dir_path( NWCC_FILE ) );
define( 'NWCC_URL', plugins_url( '/', NWCC_FILE ) );
define( 'NWCC_VER', '1.0.0' );
define( 'NWCC_ROOT', dirname( NWCC_BASE ) );
define( 'NWCC_SETTINGS', 'nwcc_setting' );

require_once 'nwcc-loader.php';
