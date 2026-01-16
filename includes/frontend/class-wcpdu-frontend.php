<?php
/**
 * Frontend functionality
 *
 * @package WooCommerce_Product_Design_Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_Frontend {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->load_dependencies();
		$this->init_hooks();
	}

	/**
	 * Load required frontend classes.
	 *
	 * @return void
	 */
	private function load_dependencies() {

		// Helpers.
		require_once WCPDU_PLUGIN_DIR . 'includes/helpers/wcpdu-helpers.php';

		// Frontend core.
		require_once WCPDU_PLUGIN_DIR . 'includes/frontend/class-wcpdu-upload-field.php';
		require_once WCPDU_PLUGIN_DIR . 'includes/frontend/class-wcpdu-cart-display.php';

		// Init classes.
		new WCPDU_Upload_Field();
		new WCPDU_Cart_Display();
	}

	/**
	 * Initialize frontend hooks.
	 *
	 * @return void
	 */
	private function init_hooks() {

		add_action(
			'woocommerce_before_add_to_cart_button',
			[ $this, 'render_upload_field' ],
			20
		);
	}

	/**
	 * Render upload field on single product page.
	 *
	 * @return void
	 */
	public function render_upload_field() {

		if ( ! is_product() ) {
			return;
		}

		global $product;

		if ( ! $product instanceof WC_Product ) {
			return;
		}

		$product_id = $product->get_id();

		/**
		 * Per-product enable upload
		 */
		if ( ! wcpdu_is_upload_enabled( $product_id ) ) {
			return;
		}

		/**
		 * Allow 3rd-party override
		 */
		if ( ! apply_filters( 'wcpdu_show_upload_field', true, $product ) ) {
			return;
		}

		do_action( 'wcpdu_before_upload_field', $product );
		?>

		<div class="wcpdu-upload-wrapper">

			<h4 class="wcpdu-upload-title">
				<?php esc_html_e( 'Upload your design', 'wcpdu' ); ?>
			</h4>

			<div class="wcpdu-upload-field">
				<input
					type="file"
					name="wcpdu_design_files[]"
					multiple
					accept=".jpg,.jpeg,.png,.pdf,.ai,.psd"
				/>

				<p class="wcpdu-upload-hint">
					<?php esc_html_e( 'Accepted formats: JPG, PNG, PDF, AI, PSD', 'wcpdu' ); ?>
				</p>
			</div>

		</div>

		<?php
		do_action( 'wcpdu_after_upload_field', $product );
	}
}
