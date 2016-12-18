<?php
/**
* Breadcrumb options
*
* @package business_center
* @since Business Center 1.0.0
*/

$wp_customize->add_section( 'business_center_breadcrumb', array(
	'title'             => __('Breadcrumb','business-center'),
	'description'       => __( 'Breadcrumb section options.', 'business-center' ),
	'panel'             => 'business_center_theme_options_panel'
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'business_center_theme_options[breadcrumb_enable]', array(
	'sanitize_callback'	=> 'business_center_sanitize_checkbox',
	'default'          	=> $options['breadcrumb_enable']
) );

$wp_customize->add_control( 'business_center_theme_options[breadcrumb_enable]', array(
	'label'            	=> __( 'Enable Breadcrumb', 'business-center' ),
	'section'          	=> 'business_center_breadcrumb',
	'type'             	=> 'checkbox',
) );

// Breadcrumb show on front setting and control.
$wp_customize->add_setting( 'business_center_theme_options[breadcrumb_show_on_front]', array(
	'sanitize_callback'	=> 'business_center_sanitize_checkbox',
	'default'          	=> $options['breadcrumb_show_on_front']
) );

$wp_customize->add_control( 'business_center_theme_options[breadcrumb_show_on_front]', array(
	'active_callback'	=> 'business_center_is_breadcrumb_enable',
	'label'            	=> __( 'Show on Front Page', 'business-center' ),
	'section'          	=> 'business_center_breadcrumb',
	'type'             	=> 'checkbox',
) );