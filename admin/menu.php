<?php
/**
 * Admin panel.
 *
 * @package Network_Wide_Custom_Code
 * @since x.x.x
 */

namespace NWCC\Admin;

use NWCC\Core\Helper;
use NWCC\Core\Traits\Get_Instance;

/**
 * Admin menu
 *
 * @since x.x.x
 */
class Menu {

	use Get_Instance;

	/**
	 * Current site ID.
	 *
	 * @var current_blog
	 * @since x.x.x
	 */
	private $current_blog;

	/**
	 * Sitewide NWCC option.
	 *
	 * @var object helper
	 * @since x.x.x
	 */
	private $nwcc_settings;

	/**
	 * Instance of Helper class
	 *
	 * @var object helper
	 * @since x.x.x
	 */
	private $helper;

	/**
	 * Constructor
	 *
	 * @since x.x.x
	 */
	public function __construct() {
		$this->helper = Helper::get_instance();

		add_action( 'network_admin_menu', [ $this, 'settings_page' ], 99 );
		add_action( 'admin_enqueue_scripts', [ $this, 'settings_page_scripts' ] );
		add_action( 'wp_ajax_nwcc_update_settings', [ $this, 'nwcc_update_settings' ] );
	}

	/**
	 * Adds admin menu for settings page.
	 *
	 * @return void
	 * @since x.x.x
	 */
	public function settings_page() {
		add_menu_page(
			__( 'Custom Code', 'nwcc' ),
			__( 'Custom Code', 'nwcc' ),
			'administrator',
			NWCC_SETTINGS,
			[ $this, 'render_nwcc_element' ],
			'dashicons-media-code',
			99
		);
	}

	/**
	 * Renders main div to implement tailwind UI.
	 *
	 * @return void
	 * @since x.x.x
	 */
	public function render_nwcc_element() {
		?>
			<div class="wp-nwcc-settings" id="wp-nwcc-settings"></div>
		<?php
	}

	/**
	 * Enqueue settings page script and style
	 *
	 * @return void
	 * @since X.X.X
	 */
	public function settings_page_scripts() {

		if ( isset( $_GET['page'] ) && NWCC_SETTINGS === wp_unslash( $_GET['page'] ) ) { // phpcs:ignore
			$version           = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? time() : NWCC_VER;
			$script_asset_path = NWCC_DIR . 'assets/build/admin.asset.php';
			$script_info       = file_exists( $script_asset_path ) ? include $script_asset_path : array(
				'dependencies' => [],
				'version'      => $version,
			);
			$script_deps       = $script_info['dependencies'];

			wp_enqueue_script(
				NWCC_SETTINGS,
				NWCC_URL . 'assets/build/admin.js',
				$script_deps,
				$version,
				true
			);

			wp_localize_script(
				NWCC_SETTINGS,
				NWCC_SETTINGS,
				[
					'ajax_url'     => admin_url( 'admin-ajax.php' ),
					'update_nonce' => wp_create_nonce( 'nwcc_update_settings' ),
					NWCC_SETTINGS  => $this->helper->get_option( NWCC_SETTINGS ),
				]
			);

			wp_enqueue_style( NWCC_SETTINGS, NWCC_URL . 'assets/build/admin.css', [], $version );

			wp_enqueue_style( 'nwcc_admin_style', NWCC_URL . 'admin/admin-style.css', [], $version );
		}
	}

	/**
	 * Ajax handler for submit action on settings page.
	 * Updates settings data in database.
	 *
	 * @return void
	 * @since x.x.x
	 */
	public function nwcc_update_settings() {
		check_ajax_referer( 'nwcc_update_settings', 'security' );
		$key = '';

		if ( ! empty( $_POST[ NWCC_SETTINGS ] ) && is_array( $_POST[ NWCC_SETTINGS ] ) ) {
			$key = NWCC_SETTINGS;
		}

		if ( empty( $key ) ) {
			wp_send_json_error( [ 'message' => __( 'No valid response.', 'nwcc' ) ] );
		}

		if ( $this->update_settings( $key, $_POST[ $key ] ) ) {
			wp_send_json_success( [ 'message' => __( 'Settings saved successfully.', 'nwcc' ) ] );
		}

		wp_send_json_error( [ 'message' => __( 'Failed to save settings.', 'nwcc' ) ] );
	}

	/**
	 * Update dettings data in database
	 *
	 * @param string $key options key.
	 * @param array  $data user input to be saved in database.
	 * @return boolean
	 * @since x.x.x
	 */
	public function update_settings( $key, $data ) {
		$data         = $this->sanitize_data( $data );
		$default_data = $this->helper->get_option( $key );
		if ( $data === $default_data ) {
			return true;
		}
		$data = wp_parse_args( $data, $default_data );
		return update_site_option( $key, $data );
	}

	/**
	 * Sanitize data as per data type
	 *
	 * @param array $data raw input received from user.
	 * @return array
	 * @since x.x.x
	 */
	public function sanitize_data( $data ) {
		$filtered_data = [];

		foreach ( $data as $key => $value ) {
			$value                 = sanitize_text_field( wp_unslash( $value ) );
			$filtered_data[ $key ] = $value;
		}

		return $filtered_data;
	}
}
