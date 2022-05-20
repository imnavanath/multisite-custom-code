<?php
/**
 * Plugin Loader.
 *
 * @package Network_Wide_Custom_Code
 * @since x.x.x
 */

namespace NWCC;

use NWCC\Admin\Menu;
use NWCC\Core\Helper;

/**
 * NWCC_Loader
 *
 * @since x.x.x
 */
class NWCC_Loader {

	/**
	 * Instance object.
	 *
	 * @var instance
	 */
	private static $instance;

	/**
	 * Instance of Helper class
	 *
	 * @var object helper
	 * @since x.x.x
	 */
	private $helper;

	/**
	 * NWCC DB Set option.
	 *
	 * @var array nwcc_option
	 * @since x.x.x
	 */
	private $nwcc_option;

	/**
	 * Member Variable for getting current site ID
	 *
	 * @var current_blog
	 */
	private $current_blog;

	/**
	 * Initiator
	 *
	 * @since x.x.x
	 * @return object initialized object of class.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 *
	 * @since x.x.x
	 */
	public function __construct() {

		if ( false === is_multisite() ) {
			return;
		}

		$this->current_blog = get_current_blog_id();

		spl_autoload_register( [ $this, 'autoload' ] );

		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );

		add_action( 'plugins_loaded', [ $this, 'setup_classes' ] );

		add_action( 'init', [ $this, 'load_frontend_runner' ] );
	}

	/**
	 * Autoload classes.
	 *
	 * @param string $class class name.
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$class_to_load = $class;

		$filename = strtolower(
			preg_replace(
				[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
				[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
				$class_to_load
			)
		);

		$file = NWCC_DIR . $filename . '.php';

		// if the file redable, include it.
		if ( is_readable( $file ) ) {
			require_once $file;
		}
	}

	/**
	 * Load Plugin Text Domain.
	 * This will load the translation textdomain depending on the file priorities.
	 *      1. Global Languages /wp-content/languages/network-wide-custom-code/ folder
	 *      2. Local dorectory /wp-content/plugins/network-wide-custom-code/languages/ folder
	 *
	 * @since x.x.x
	 * @return void
	 */
	public function load_textdomain() {
		$lang_dir = NWCC_ROOT . 'languages/';

		/**
		 * Filters the languages directory path to use for plugin.
		 *
		 * @param string $lang_dir The languages directory path.
		 */
		$lang_dir = apply_filters( 'nwcc_languages_directory', $lang_dir );

		load_plugin_textdomain( 'nwcc', false, $lang_dir );
	}

	/**
	 * Include required classes.
	 *
	 * @since x.x.x
	 */
	public function setup_classes() {

		if ( is_admin() && is_super_admin() ) {
			/* Setup Menu */
			Menu::get_instance();
		}
	}

	/**
	 * Load the provided CSS/JS assets on the frontend.
	 *
	 * @since x.x.x
	 */
	public function load_frontend_runner() {
		$blogs             = get_sites();
		$this->helper      = Helper::get_instance();
		$this->nwcc_option = $this->helper->get_option( NWCC_SETTINGS );

		if ( count( $blogs ) > 0 ) {
			foreach ( $blogs as $blog ) {
				// Add required actions for 'wp_head' script and style.
				add_action( 'wp_head', [ $this, 'wp_head_style' ] );
				add_action( 'wp_head', [ $this, 'wp_head_script' ] );

				// Add required actions for 'wp_footer' script and style.
				add_action( 'wp_footer', [ $this, 'wp_footer_style' ] );
				add_action( 'wp_footer', [ $this, 'wp_footer_script' ] );
			}
		}

		switch_to_blog( $this->current_blog );
	}

	/**
	 * Add style CSS in header.
	 *
	 * @since  x.x.x
	 * @return void
	 */
	public function wp_head_style() {
		echo '<style type="text/css">' . wp_unslash( $this->nwcc_option['header_css'] ) . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Add script JS in header.
	 *
	 * @since  x.x.x
	 * @return void
	 */
	public function wp_head_script() {
		echo '<script type="text/javascript">' . wp_unslash( $this->nwcc_option['header_js'] ) . '</script>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Add style CSS in footer.
	 *
	 * @since  x.x.x
	 * @return void
	 */
	public function wp_footer_style() {
		echo '<style type="text/css">' . wp_unslash( $this->nwcc_option['footer_css'] ) . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Add script in footer.
	 *
	 * @since  x.x.x
	 * @return void
	 */
	public function wp_footer_script() {
		echo '<script type="text/javascript">' . wp_unslash( $this->nwcc_option['footer_js'] ) . '</script>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
NWCC_Loader::get_instance();
