<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_Loader {

	public function __construct() {
		$this->load_dependencies();
		$this->define_hooks();
	}

	private function load_dependencies() {

		// Core
		require_once WCPDU_PLUGIN_DIR . 'includes/class-wcpdu-i18n.php';

		// Cart & Order logic (GLOBAL – MUST LOAD EARLY)
		require_once WCPDU_PLUGIN_DIR . 'includes/frontend/class-wcpdu-cart-handler.php';
		require_once WCPDU_PLUGIN_DIR . 'includes/admin/class-wcpdu-admin-order-meta.php';

		// Frontend UI
		require_once WCPDU_PLUGIN_DIR . 'includes/frontend/class-wcpdu-frontend.php';

		// Admin UI
		if ( is_admin() ) {
			require_once WCPDU_PLUGIN_DIR . 'includes/admin/class-wcpdu-admin.php';
		}
	}

	private function define_hooks() {

		// i18n
		$i18n = new WCPDU_I18n();
		add_action( 'plugins_loaded', [ $i18n, 'load_textdomain' ] );

		// GLOBAL logic (IMPORTANT)
		new WCPDU_Cart_Handler();      // cart item data
		new WCPDU_Admin_Order_Meta();  // save to DB

		// Frontend
		new WCPDU_Frontend();

		// Admin
		if ( is_admin() ) {
			new WCPDU_Admin();
		}
	}
}
