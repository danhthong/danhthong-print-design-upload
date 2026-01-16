<?php
/**
 * Internationalization functionality
 *
 * @package WooCommerce_Product_Design_Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_I18n {

	/**
	 * Load plugin textdomain.
	 *
	 * @return void
	 */
	public function load_textdomain() {

		load_plugin_textdomain(
			'wcpdu',
			false,
			dirname( plugin_basename( WCPDU_PLUGIN_DIR ) ) . '/languages/'
		);
	}
}
