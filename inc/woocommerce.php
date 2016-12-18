<?php
/**
 * Business Center woocommerce compatibility.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @since Business Center 1.0.0
 */


/**
 * Make theme WooCommerce ready
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_action('woocommerce_before_main_content', 'business_center_page_section', 10);
add_action('woocommerce_before_main_content', 'business_center_primary_content_start', 20);

function business_center_page_section() {
  	echo '<div class="container page-section">';
}

function business_center_primary_content_start() {
  	echo '<div id="primary" class="content-area">
    		<main id="main" class="site-main" role="main">';
}

add_action('woocommerce_after_main_content', 'business_center_primary_content_end', 10);
add_action('woocommerce_sidebar', 'business_center_page_section_end', 20);

function business_center_primary_content_end() {
  echo '</main>
  </div>';
}

function business_center_page_section_end() {
  	echo '</div>';
}
