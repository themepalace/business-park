<?php
/**
 * Business Center metabox file.
 *
 * This is the template that includes all the other files for metaboxes of Business Center theme
 *
 * @package Theme Palace
 * @since Business Center 1.0.0
 */

// Include header image meta
require get_template_directory() . '/inc/metabox/header-image.php';

/**
 * Adds meta box to the post editing screen
 */
function business_center_custom_meta() {
	// Header image meta
    add_meta_box( 'business_center_header_image', __( 'Header Image', 'business-center' ), 'business_center_header_image_callback', array( 'post', 'page' ) );
}
add_action( 'add_meta_boxes', 'business_center_custom_meta' );
