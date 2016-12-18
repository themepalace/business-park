<?php
/**
 * Footer options
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

/*Footer Section*/
$wp_customize->add_section( 'business_center_section_footer', array(
	'title'      			=> __( 'Footer Options', 'business-center' ),
	'panel'      			=> 'business_center_theme_options_panel',
) );

// Scroll top visible
$wp_customize->add_setting( 'business_center_theme_options[scroll_top_visible]', array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback'		=> 'business_center_sanitize_checkbox',
) );

$wp_customize->add_control( 'business_center_theme_options[scroll_top_visible]', array(
		'label'      			=> __( 'Display Scroll Top Button', 'business-center' ),
		'section'    			=> 'business_center_section_footer',
		'type'		 			=> 'checkbox',
) );