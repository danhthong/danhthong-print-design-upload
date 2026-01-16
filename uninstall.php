<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option( 'wcpdu_settings' );
delete_option( 'wcpdu_version' );
