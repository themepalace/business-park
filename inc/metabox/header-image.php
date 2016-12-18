<?php
/**
 * Business Center metabox file for header image
 *
 * This is the template that includes all the metabox for the header image
 *
 * @package Theme Palace
 * @since Business Center 1.0.0
 */

/**
 * Outputs the content of the sidebar position
 */
function business_center_header_image_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'business_center_nonce' );
    $stored_header_image_option = get_post_meta( $post->ID, 'business-center-header-image', true );

    $header_image_options       = business_center_header_image();
    ?>

    <p>
     <label for="business-center-header-image" class="business-center-row-title"><?php _e( 'Header Image', 'business-center' )?></label>
     <select name="business-center-header-image" id="business-center-header-image">

        <?php foreach ( $header_image_options as $header_image_option => $value ) { ?>
         <option value="<?php echo esc_attr( $header_image_option );?>" <?php if ( isset ( $stored_header_image_option ) ) selected( $stored_header_image_option, $header_image_option ); ?>><?php echo esc_html( $value ); ?></option>
        <?php } ?>
     </select>
    </p>
    <?php
}


/**
 * Saves the sidebar position input
 */
function business_center_sidebar_header_image_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'business_center_nonce' ] ) && wp_verify_nonce( $_POST[ 'business_center_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'business-center-header-image' ] ) ) {
        update_post_meta( $post_id, 'business-center-header-image', esc_html( $_POST[ 'business-center-header-image' ] ) );
    }

}
add_action( 'save_post', 'business_center_sidebar_header_image_save' );