<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business Center 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_center_body_classes( $classes ) {
	$options = business_center_get_theme_options();

	// Add class only when laoder is disabled
	if ( ! $options['loader_enable'] ) {
		$classes[] = 'display-none';
	}

	if ( $options['make_menu_sticky'] ) {
		$classes[] = 'nav-shrink';
	}
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$sidebar_position = business_center_layout();

	if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
		$classes[] = 'no-sidebar';
	} elseif ( is_search() || is_404() ) {
		$classes[] = 'right-sidebar';
	} else {
		if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) {
			$classes[] = esc_attr( $sidebar_position );
		} else {
			$classes[] = 'no-sidebar';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'business_center_body_classes' );


/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function business_center_post_classes( $classes ) {
	$classes[] = 'column-wrapper';

	return $classes;
}
add_filter( 'post_class', 'business_center_post_classes' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function business_center_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'business_center_pingback_header' );
