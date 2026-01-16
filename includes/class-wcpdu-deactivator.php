<?php
/**
 * Plugin deactivation handler
 *
 * @package WooCommerce_Product_Design_Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_Deactivator {

	/**
	 * Run on plugin deactivation.
	 *
	 * @return void
	 */
	public static function deactivate() {

		/**
		 * We DO NOT delete user data on deactivation.
		 * Data cleanup should be done in uninstall.php only.
		 */

		// Example: flush rewrite rules if needed in future
		// flush_rewrite_rules();

		/**
		 * Hook for addons / extensions
		 */
		do_action( 'wcpdu_deactivated' );
	}
}
