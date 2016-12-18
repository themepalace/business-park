<?php
/**
 * Call To Action options
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */


// Add call to action section
$wp_customize->add_section( 'business_center_call_to_action_section', array(
	'title'             => __('Call To Action Options','business-center'),
	'description'       => __( 'Call To Action options.', 'business-center' ),
	'panel'             => 'business_center_sections_panel',
) );


/**
 * Call To Action Options
 */
// Enable call_to_action.
$wp_customize->add_setting( 'business_center_theme_options[enable_call_to_action]', array(
	'default'           => $options['enable_call_to_action'],
	'sanitize_callback' => 'business_center_sanitize_checkbox',
) );

$wp_customize->add_control( 'business_center_theme_options[enable_call_to_action]', array(
	'label'             => __( 'Enable Call To Action Section?', 'business-center' ),
	'section'           => 'business_center_call_to_action_section',
	'type'				=> 'checkbox'
) );

/**
 * Call To Action content type options.
 */
$wp_customize->add_setting( 'business_center_theme_options[call_to_action_content_type]', array(
	'default'           => $options['call_to_action_content_type'],
	'sanitize_callback' => 'business_center_sanitize_select',
) );

$wp_customize->add_control( 'business_center_theme_options[call_to_action_content_type]', array(
	'active_callback'	=> 'business_center_is_call_to_action_enable',
	'label'             => __( 'Content Type', 'business-center' ),
	'section'           => 'business_center_call_to_action_section',
	'choices'			=> business_center_call_to_action_content_type_options(),
	'type'				=> 'select'
) );

/**
 * Post Content Type Options
 */
// Post Options
$wp_customize->add_setting( 'business_center_theme_options[call_to_action_post]', array(
	'sanitize_callback' => 'absint'
) );

$wp_customize->add_control( 'business_center_theme_options[call_to_action_post]', array(
	'active_callback' => 'business_center_is_call_to_action_enable',
	'label'           => __( 'Post ID: ', 'business-center' ),
	'description'           => __( 'Enter the post id here. The featured image will be used as background image. ', 'business-center' ),
	'section'         => 'business_center_call_to_action_section',
	'type'            => 'number',
) );

// Call To Action btn text
$wp_customize->add_setting( 'business_center_theme_options[call_to_action_btn_txt]', array(
	'default'           => $options['call_to_action_btn_txt'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'business_center_theme_options[call_to_action_btn_txt]', array(
	'active_callback'	=> 'business_center_is_call_to_action_enable',
	'label'             => __( 'Button Text:', 'business-center' ),
	'section'           => 'business_center_call_to_action_section',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_center_theme_options[call_to_action_btn_txt]', array(
		'selector'            => '#join-us .entry-content a.btn',
		'render_callback'     => 'business_center_partial_call_to_action_btn_txt',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}