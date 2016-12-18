<?php
/**
 * Excerpt options
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'business_center_excerpt_section', array(
	'title'             => __('Excerpt','business-center'),
	'description'       => __( 'Excerpt section options.', 'business-center' ),
	'panel'             => 'business_center_theme_options_panel'
) );


// long Excerpt length setting and control.
$wp_customize->add_setting( 'business_center_theme_options[excerpt_length]', array(
	'sanitize_callback' => 'business_center_sanitize_number_range',
	'validate_callback' => 'business_center_validate_excerpt',
	'default'			=> $options['excerpt_length']
) );

$wp_customize->add_control( 'business_center_theme_options[excerpt_length]', array(
	'label'       => __( 'Blog Page Excerpt Length', 'business-center' ),
	'description' => __( 'Total words to be displayed in archive page/search page.', 'business-center' ),
	'section'     => 'business_center_excerpt_section',
	'type'        => 'number',
	'input_attrs' => array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
	),
) );

// Read more text.
$wp_customize->add_setting( 'business_center_theme_options[read_more_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			  => $options['read_more_text']
) );

$wp_customize->add_control( 'business_center_theme_options[read_more_text]', array(
	'label'       => __( 'Read More Text', 'business-center' ),
	'section'     => 'business_center_excerpt_section',
	'type'        => 'text',
) );