<?php
/**
* Homepage (Static ) options
*
* @package business_center
* @since Business Center 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'business_center_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'business_center_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content']
) );

$wp_customize->add_control( 'business_center_theme_options[enable_frontpage_content]', array(
	'label'       => __( 'Enable Content', 'business-center' ),
	'description' => __( 'Check to enable content on static front page only.', 'business-center' ),
	'section'     => 'static_front_page',
	'type'        => 'checkbox'
) );