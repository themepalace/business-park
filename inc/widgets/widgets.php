<?php
/**
 * Business Center widgets inclusion
 *
 * This is the template that includes all custom widgets of Business Center
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_center_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'business-center' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'business-center' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Search', 'business-center' ),
		'id'            => 'business-center-search',
		'description'   => esc_html__( 'This sidebar is only for the Search page.', 'business-center' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( '404', 'business-center' ),
		'id'            => 'business-center-404',
		'description'   => esc_html__( 'This sidebar is only for the 404 page.', 'business-center' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	for ($i=1; $i < 4; $i++) { 
		register_sidebar( array(
			'name'          => esc_html__( 'Footer ', 'business-center' ).$i,
			'id'            => 'footer-'.$i,
			'description'   => esc_html__( 'Add footer widgets here.', 'business-center' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'business_center_widgets_init' );

/**
 * Add featured image widget
 */
require get_template_directory() . '/inc/widgets/featured-image.php';

/**
 * Register widgets
 */
add_action( 'widgets_init', function() {
	
	// Register Featured Image widget
	register_widget( 'business_center_Featured_Image' );
});
