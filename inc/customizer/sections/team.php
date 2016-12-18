<?php
/**
 * Team options
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */


// Add team section
$wp_customize->add_section( 'business_center_team_section', array(
	'title'       => __('Team Options','business-center'),
	'description' => __( 'The recommended image size for team image is 330 by 520. ', 'business-center' ),
	'panel'       => 'business_center_sections_panel',
) );


/**
 * Team Options
 */
// Enable team.
$wp_customize->add_setting( 'business_center_theme_options[enable_team]', array(
	'default'           => $options['enable_team'],
	'sanitize_callback' => 'business_center_sanitize_checkbox',
) );

$wp_customize->add_control( 'business_center_theme_options[enable_team]', array(
	'label'             => __( 'Enable Team Section?', 'business-center' ),
	'section'           => 'business_center_team_section',
	'type'				=> 'checkbox'
) );

// Team title.
$wp_customize->add_setting( 'business_center_theme_options[team_title]', array(
	'default'           => $options['team_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'business_center_theme_options[team_title]', array(
	'active_callback'	=> 'business_center_is_team_enable',
	'label'             => __( 'Title:', 'business-center' ),
	'section'           => 'business_center_team_section',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_center_theme_options[team_title]', array(
		'selector'            => '#team .entry-header .entry-title',
		'render_callback'     => 'business_center_partial_team_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

/**
 * Team content type options.
 */
$wp_customize->add_setting( 'business_center_theme_options[team_content_type]', array(
	'default'           => $options['team_content_type'],
	'sanitize_callback' => 'business_center_sanitize_select',
) );

$wp_customize->add_control( 'business_center_theme_options[team_content_type]', array(
	'active_callback'	=> 'business_center_is_team_enable',
	'label'             => __( 'Content Type', 'business-center' ),
	'section'           => 'business_center_team_section',
	'choices'			=> business_center_team_content_type_options(),
	'type'				=> 'select'
) );

for ( $i=1; $i <= 4; $i++ ) { 
	// Team position text options
	$wp_customize->add_setting( 'business_center_theme_options[custom_team_position_'.$i.']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'business_center_theme_options[custom_team_position_'.$i.']', array(
		'active_callback' => 'business_center_is_team_enable',
		'label'           => __( 'Position ', 'business-center' ) . $i,
		'description'           =>  ( 1 !== $i ? '' : __( 'Input the team position here as per the posts.', 'business-center' ) ),
		'section'         => 'business_center_team_section',
		'type'            => 'text',
	) );
	
	// Horizontal Line
	$wp_customize->add_setting( 'business_center_theme_options[team_content_type_hr' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new Business_Center_Customize_Horizontal_Line( $wp_customize, 'business_center_theme_options[team_content_type_hr' . $i . ']',
		array(
			'active_callback' => 'business_center_is_team_enable',
			'section'         => 'business_center_team_section',
			'type'			  => 'hr',
	) ) );
}

/**
 * Category Content Type Options
 */
// Catgegory Options
$wp_customize->add_setting( 'business_center_theme_options[team_category]', array(
	'sanitize_callback' => 'business_center_sanitize_tax_checkbox'
) );

$wp_customize->add_control( new Business_Center_Customize_Control_Checkbox_Multiple( $wp_customize, 'business_center_theme_options[team_category]', array(
	'active_callback' => 'business_center_is_team_enable',
	'label'           => __( 'Select Category', 'business-center' ),
	'section'         => 'business_center_team_section',
	'type'            => 'checkbox-multiple',
	'taxonomy'		  => 'category',
) ) );

// Read more button text.
$wp_customize->add_setting( 'business_center_theme_options[team_read_more_btn_txt]', array(
	'default'           => $options['team_read_more_btn_txt'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'business_center_theme_options[team_read_more_btn_txt]', array(
	'active_callback'	=> 'business_center_is_team_enable',
	'label'             => __( 'Button Text:', 'business-center' ),
	'section'           => 'business_center_team_section',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_center_theme_options[team_read_more_btn_txt]', array(
		'selector'            => '#team .btn-transparent',
		'render_callback'     => 'business_center_partial_team_read_more_btn_txt',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Read more button URL.
$wp_customize->add_setting( 'business_center_theme_options[team_read_more_btn_txt_url]', array(
	'default'           => $options['team_read_more_btn_txt_url'],
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'business_center_theme_options[team_read_more_btn_txt_url]', array(
	'active_callback'	=> 'business_center_is_team_enable',
	'label'             => __( 'Button URL:', 'business-center' ),
	'section'           => 'business_center_team_section',
	'type'				=> 'url'
) );