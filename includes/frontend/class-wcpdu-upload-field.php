<?php
/**
 * Upload field on product page
 *
 * @package WooCommerce_Product_Design_Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_Upload_Field {

	/**
	 * Settings option name.
	 *
	 * @var string
	 */
	private $option_name = 'wcpdu_settings';

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action(
			'woocommerce_before_add_to_cart_button',
			[ $this, 'render_upload_field' ]
		);
	}

	/**
	 * Render upload field on product page.
	 *
	 * @return void
	 */
	public function render_upload_field() {

		if ( ! $this->is_enabled() ) {
			return;
		}

		if ( ! is_product() ) {
			return;
		}

		$template = $this->locate_template( 'upload-field.php' );

		if ( ! $template ) {
			return;
		}

		$settings = get_option( $this->option_name, [] );

		$args = [
			'max_file_size'  => absint( $settings['max_file_size'] ?? 10 ),
			'allowed_types'  => esc_attr( $settings['allowed_file_types'] ?? 'jpg,png,pdf' ),
			'nonce'          => wp_create_nonce( 'wcpdu_upload_nonce' ),
			'field_name'     => 'wcpdu_design_file',
		];

		wc_get_template(
			$template,
			$args,
			'',
			WCPDU_PLUGIN_DIR . 'templates/'
		);
	}

	/**
	 * Check if upload feature is enabled.
	 *
	 * @return bool
	 */
	private function is_enabled() {

		$settings = get_option( $this->option_name, [] );

		return ! empty( $settings['enable_upload'] );
	}

	/**
	 * Locate template (theme override supported).
	 *
	 * @param string $template
	 * @return string|false
	 */
	private function locate_template( $template ) {

		$theme_template = locate_template(
			'woocommerce/wcpdu/' . $template
		);

		if ( $theme_template ) {
			return $template;
		}

		$plugin_template = WCPDU_PLUGIN_DIR . 'templates/' . $template;

		if ( file_exists( $plugin_template ) ) {
			return $template;
		}

		return false;
	}
}
