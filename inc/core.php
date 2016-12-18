<?php
/**
 * Business Center core file.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @since Business Center 1.0.0
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load tgmpa
 */
require_once get_template_directory() . '/inc/tgm/tgm-hook.php';

/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';


// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';

/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add metabox
 */
require get_template_directory() . '/inc/metabox/metabox.php';

/**
 * modules additions.
 */
require get_template_directory() . '/inc/modules/modules.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Inline scripts additions.
 */
require get_template_directory() . '/inc/scripts.php';

if ( class_exists( 'WooCommerce' ) ) {
  /**
   * Load woocommerce compatibility file.
   */
  require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * Merge values from default options array and values from customizer
 *
 * @return array Values returned from customizer
 * @since Business Center 1.0.0
 */
function business_center_get_theme_options() {
  $business_center_default_options = business_center_get_default_theme_options();

  return array_merge( $business_center_default_options , get_theme_mod( 'business_center_theme_options', $business_center_default_options ) ) ;
}


/**
  * Write message for featured image upload
  *
  * @return array Values returned from customizer
  * @since Business Center 1.0.0
*/
function business_center_slider_image_instruction( $content, $post_id ) {
  $allowed = array( 'page' );
  if ( in_array( get_post_type( $post_id ), $allowed ) ) {
    return $content .= '<p><b>' . __( 'Note', 'business-center' ) . ':</b>' . __( ' The recommended size for image is 1300px by 600px while using it for slider', 'business-center' ) . '</p>';
  } elseif ( 'jetpack-testimonial' == get_post_type( $post_id ) ) {
    return $content .= '<p><b>' . __( 'Note', 'business-center' ) . ':</b>' . __( ' The recommended size for image is 500px by 375px while using it for testimonial', 'business-center' ) . '</p>';
  }
   return $content;
}
add_filter( 'admin_post_thumbnail_html', 'business_center_slider_image_instruction', 10, 2);
