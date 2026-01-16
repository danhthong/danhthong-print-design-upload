<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if product allows design upload.
 *
 * @param int $product_id
 * @return bool
 */
function wcpdu_is_upload_enabled( $product_id ) {

	$value = get_post_meta( $product_id, '_wcpdu_enable_upload', true );

	return 'yes' === $value;
}
