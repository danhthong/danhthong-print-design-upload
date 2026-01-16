<?php
/**
 * Plugin activation handler
 *
 * @package WooCommerce_Product_Design_Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_Activator {

	/**
	 * Run on plugin activation.
	 *
	 * @return void
	 */
	public static function activate() {

		// Default settings
		$default_settings = [
			'enable_upload'      => 1,
			'max_file_size'      => 10, // MB
			'allowed_file_types' => 'jpg,png,pdf',
		];

		if ( ! get_option( 'wcpdu_settings' ) ) {
			add_option( 'wcpdu_settings', $default_settings );
		}

		// Save plugin version (for future migrations)
		if ( defined( 'WCPDU_VERSION' ) ) {
			update_option( 'wcpdu_version', WCPDU_VERSION );
		}

		/**
		 * Hook for addons / future extensions
		 */
		do_action( 'wcpdu_activated' );
	}
}
