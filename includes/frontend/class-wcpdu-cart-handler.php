<?php
/**
 * Handle design file upload and store path into cart item
 *
 * @package WooCommerce_Product_Design_Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_Cart_Handler {

	/**
	 * Cart item key
	 */
	const CART_KEY = 'wcpdu_design_files';

	/**
	 * Constructor
	 */
	public function __construct() {

		add_filter(
			'woocommerce_add_cart_item_data',
			array( $this, 'handle_upload_and_store_path' ),
			10,
			3
		);
	}

	/**
	 * Upload files and store URL + PATH into cart item
	 *
	 * @param array $cart_item_data
	 * @param int   $product_id
	 * @param int   $variation_id
	 * @return array
	 */
	public function handle_upload_and_store_path( $cart_item_data, $product_id, $variation_id ) {

		if ( empty( $_FILES['wcpdu_design_files'] ) ) {
			return $cart_item_data;
		}

		require_once ABSPATH . 'wp-admin/includes/file.php';

		$files  = $_FILES['wcpdu_design_files'];
		$stored = array();

		foreach ( $files['name'] as $index => $name ) {

			if ( empty( $name ) || $files['error'][ $index ] !== UPLOAD_ERR_OK ) {
				continue;
			}

			$file = array(
				'name'     => sanitize_file_name( $files['name'][ $index ] ),
				'type'     => $files['type'][ $index ],
				'tmp_name' => $files['tmp_name'][ $index ],
				'error'    => $files['error'][ $index ],
				'size'     => $files['size'][ $index ],
			);

			$upload = wp_handle_upload(
				$file,
				array( 'test_form' => false )
			);

			if ( isset( $upload['error'] ) ) {
				continue;
			}

			$stored[] = array(
				'name' => $file['name'],
				'url'  => esc_url_raw( $upload['url'] ),
				'path' => sanitize_text_field( $upload['file'] ),
			);
		}

		if ( empty( $stored ) ) {
			return $cart_item_data;
		}

		$cart_item_data[ self::CART_KEY ] = $stored;

		// Force unique cart item (avoid merge)
		$cart_item_data['wcpdu_uid'] = md5( microtime() . wp_rand() );

		return $cart_item_data;
	}
}
