<?php
/**
 * Menu Customizer options
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */


// Add additonal menu section
$wp_customize->add_section( 'business_center_additional_menu_options', array(
	'title'             => __('Additional Options','business-center'),
	'description'       => __( 'Additional menu options.', 'business-center' ),
	'panel'             => 'nav_menus',
	'priority'          => 5
) );

// Make menu sticky option.
$wp_customize->add_setting( 'business_center_theme_options[make_menu_sticky]', array(
	'default'           => $options['make_menu_sticky'],
	'sanitize_callback' => 'business_center_sanitize_checkbox',
) );

$wp_customize->add_control( 'business_center_theme_options[make_menu_sticky]', array(
	'label'             => __( 'Make menu sticky', 'business-center' ),
	'section'           => 'business_center_additional_menu_options',
	'type'				=> 'checkbox'
) );