<?php
/**
* pagination options
*
* @package business_center
* @since Business Center 1.0.0
*/

// Add sidebar section
$wp_customize->add_section( 'business_center_pagination', array(
	'title'               => __('Pagination','business-center'),
	'description'         => __( 'Pagination section options.', 'business-center' ),
	'panel'               => 'business_center_theme_options_panel'
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'business_center_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'business_center_sanitize_checkbox',
	'default'             => $options['pagination_enable']
) );

$wp_customize->add_control( 'business_center_theme_options[pagination_enable]', array(
	'label'               => __( 'Pagination Enable', 'business-center' ),
	'section'             => 'business_center_pagination',
	'type'                => 'checkbox',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'business_center_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'business_center_sanitize_select',
	'default'             => $options['pagination_type']
) );

$wp_customize->add_control( 'business_center_theme_options[pagination_type]', array(
	'label'               => __( 'Pagination Type', 'business-center' ),
	'section'             => 'business_center_pagination',
	'type'                => 'select',
	'choices'			  => business_center_pagination_options(),
	'active_callback'	  => 'business_center_is_pagination_enable'
) );
