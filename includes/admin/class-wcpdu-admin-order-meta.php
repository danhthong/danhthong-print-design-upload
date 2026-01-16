<?php
/**
 * Save design file paths into order item meta (DATABASE)
 *
 * @package WooCommerce_Product_Design_Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_Admin_Order_Meta {

	/**
	 * Order item meta key
	 *
	 * @var string
	 */
	private $meta_key = 'wcpdu_design_files';

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action(
			'woocommerce_checkout_create_order_line_item',
			array( $this, 'save_design_files_to_order' ),
			10,
			4
		);
	}

	/**
	 * Save file URL + PATH from cart into order item meta (DB)
	 *
	 * @param WC_Order_Item_Product $item
	 * @param string               $cart_item_key
	 * @param array                $values
	 * @param WC_Order             $order
	 * @return void
	 */
	public function save_design_files_to_order( $item, $cart_item_key, $values, $order ) {

		if ( empty( $values['wcpdu_design_files'] ) ) {
			return;
		}

		$item->add_meta_data(
			$this->meta_key,
			$values['wcpdu_design_files'],
			true
		);
	}
}
