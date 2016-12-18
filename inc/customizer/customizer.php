<?php
/**
 * Business Center Theme Customizer.
 *
 * @package Business Center 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_center_customize_register( $wp_customize ) {
	$options = business_center_get_theme_options();

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load customizer custom controls functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load validation callback functions.
	require get_template_directory() . '/inc/customizer/validation.php';

	// Load customize partial functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => 'business_center_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => 'business_center_customize_partial_blogdescription',
		) );
	}

	// Load additonal menu options
	require get_template_directory() . '/inc/customizer/sections/menu.php';

	// Add panel for sections
	$wp_customize->add_panel( 'business_center_sections_panel' , array(
	    'title'      => __( 'Sections','business-center' ),
	    'description'=> __( 'Section Options.', 'business-center' ),
	    'priority'   => 140,
	) );

	/**
	 * Core Modules
	 */
	// Slider
	require get_template_directory() . '/inc/customizer/sections/slider.php';

	// Features
	require get_template_directory() . '/inc/customizer/sections/feature.php';

	// Call To Action
	require get_template_directory() . '/inc/customizer/sections/call-to-action.php';

	// Front Page Blog
	require get_template_directory() . '/inc/customizer/sections/front-page-blog.php';

	// Team 
	require get_template_directory() . '/inc/customizer/sections/team.php';

	// Contact 
	require get_template_directory() . '/inc/customizer/sections/contact.php'; 

	// Add panel for common theme options
	$wp_customize->add_panel( 'business_center_theme_options_panel' , array(
	    'title'      => __( 'Theme Options','business-center' ),
	    'description'=> __( 'Theme Options.', 'business-center' ),
	    'priority'   => 150,
	) );

	/**
	 * Theme Options
	 */
	// loader
	require get_template_directory() . '/inc/customizer/theme-options/loader.php';

	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load excerpt option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load breadcrumb option
	require get_template_directory() . '/inc/customizer/theme-options/breadcrumb.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load blog option
	require get_template_directory() . '/inc/customizer/theme-options/blog-options.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';
}
add_action( 'customize_register', 'business_center_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

// Load customizer theme pro link
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_center_customize_preview_js() {
	wp_enqueue_script( 'business_center_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'business_center_customize_preview_js' );


if ( ! function_exists( 'business_center_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Business Center 1.0.0
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function business_center_reset_options() {
		$options = business_center_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'business_center_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'business_center_reset_options' );