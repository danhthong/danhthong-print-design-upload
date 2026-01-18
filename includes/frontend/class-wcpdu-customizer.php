<?php
/**
 * Frontend customizer UI (modal) for product design.
 *
 * @package WooCommerce_Product_Design_Upload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCPDU_Customizer {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'render_customizer_button_and_modal' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Enqueue assets for modal + behavior.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		if ( ! is_product() ) {
			return;
		}

		$ver = defined( 'WCPDU_VERSION' ) ? WCPDU_VERSION : '1.0.0';

		wp_enqueue_style(
			'wcpdu-customizer-modal',
			WCPDU_PLUGIN_URL . 'assets/css/wcpdu-customizer-modal.css',
			[],
			$ver
		);

		wp_enqueue_script(
			'wcpdu-customizer-modal',
			WCPDU_PLUGIN_URL . 'assets/js/wcpdu-customizer-modal.js',
			[ 'jquery' ],
			$ver,
			true
		);
	}

	/**
	 * Render the customize button and modal UI.
	 *
	 * @return void
	 */
	public function render_customizer_button_and_modal() {
		global $product;

		if ( ! $product ) {
			return;
		}

		$enabled = $product->get_meta( '_wcpdu_enable_upload' );
		if ( 'yes' !== $enabled ) {
			return;
		}
		?>
		<div class="wcpdu-entry">
			<button type="button" class="button wp-element-button wcpdu-open-customizer primary">
				<?php echo esc_html__( 'Customize', 'wcpdu' ); ?>
			</button>
		</div>


		<div id="wcpdu-customizer-modal" class="wcpdu-modal" aria-hidden="true" style="display:none;">
			<div class="wcpdu-modal-overlay" data-wcpdu-modal-close="1"></div>

			<div class="wcpdu-modal-dialog" role="dialog" aria-modal="true" aria-label="<?php echo esc_attr__( 'Product customizer', 'wcpdu' ); ?>">
				<div class="wcpdu-modal-header">
					<h3 class="wcpdu-modal-title"><?php echo esc_html__( 'Customize Your Product', 'wcpdu' ); ?></h3>
					<button type="button" class="wcpdu-modal-close" data-wcpdu-modal-close="1" aria-label="<?php echo esc_attr__( 'Close', 'wcpdu' ); ?>">×</button>
				</div>

				<div class="wcpdu-modal-body">
					<input type="file" id="wcpdu-upload-image" name="wcpdu_upload_image" accept="image/*" />

					<div class="wcpdu-canvas-wrapper">
						<canvas id="wcpdu-canvas" width="450" height="450"></canvas>
					</div>

					<div class="wcpdu-toolbar">
						<button type="button" class="wcpdu-btn wcpdu-remove-object" aria-label="Remove selected object">
							✕ <?php echo esc_html__( 'Remove', 'wcpdu' ); ?>
						</button>
					</div>

					<input type="hidden" id="wcpdu-custom-design" name="wcpdu_custom_design" value="">
				</div>

				<div class="wcpdu-modal-footer">
					<button type="button" class="button wp-element-button wcpdu-cancel" data-wcpdu-modal-close="1">
						<?php echo esc_html__( 'Cancel', 'wcpdu' ); ?>
					</button>
					<button type="button" class="button wp-element-button button-primary wcpdu-apply">
						<?php echo esc_html__( 'Apply', 'wcpdu' ); ?>
					</button>
				</div>
			</div>
		</div>
		<?php
	}
}
