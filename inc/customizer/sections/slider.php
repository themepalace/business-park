<?php
/**
 * Slider options
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */


// Add slider section
$wp_customize->add_section( 'business_center_slider_section', array(
	'title'             => __('Slider Options','business-center'),
	'description'       => __( 'Slider options.', 'business-center' ),
	'panel'             => 'business_center_sections_panel',
) );


/**
 * Slider Options
 */
// Enable slider.
$wp_customize->add_setting( 'business_center_theme_options[enable_slider]', array(
	'default'           => $options['enable_slider'],
	'sanitize_callback' => 'business_center_sanitize_checkbox',
) );

$wp_customize->add_control( 'business_center_theme_options[enable_slider]', array(
	'label'             => __( 'Enable Slider?', 'business-center' ),
	'section'           => 'business_center_slider_section',
	'type'				=> 'checkbox'
) );

// Transition type.
$wp_customize->add_setting( 'business_center_theme_options[slider_transition]', array(
	'default'           => $options['slider_transition'],
	'sanitize_callback' => 'business_center_sanitize_select',
) );

$wp_customize->add_control( 'business_center_theme_options[slider_transition]', array(
	'active_callback'	=> 'business_center_is_slider_enable',
	'label'             => __( 'Transition Effects', 'business-center' ),
	'section'           => 'business_center_slider_section',
	'choices'			=> business_center_transition_effects_options(),
	'type'				=> 'select'
) );

// Slider speed.
$wp_customize->add_setting( 'business_center_theme_options[slider_speed]', array(
	'default'           => $options['slider_speed'],
	'sanitize_callback' => 'business_center_sanitize_number_range',
) );

$wp_customize->add_control( 'business_center_theme_options[slider_speed]', array(
	'active_callback'	=> 'business_center_is_slider_enable',
	'label'             => __( 'Slider Speed ( in milliseconds )', 'business-center' ),
	'section'           => 'business_center_slider_section',
	'input_attrs'		=> array( 'min' => 1 ),
	'type'				=> 'number'
) );

// Add enable slider pager setting and control.
$wp_customize->add_setting( 'business_center_theme_options[enable_slider_pager]', array(
	'default'           => $options['enable_slider_pager'],
	'sanitize_callback' => 'business_center_sanitize_checkbox'
) );

$wp_customize->add_control( 'business_center_theme_options[enable_slider_pager]', array(
	'active_callback' => 'business_center_is_slider_enable',
	'label'           => __( 'Enable Pager Controls?', 'business-center' ),
	'section'         => 'business_center_slider_section',
	'type'            => 'checkbox',
) );

// Add enable slider autoplay setting and control.
$wp_customize->add_setting( 'business_center_theme_options[enable_slider_autoplay]', array(
	'default'           => $options['enable_slider_autoplay'],
	'sanitize_callback' => 'business_center_sanitize_checkbox'
) );

$wp_customize->add_control( 'business_center_theme_options[enable_slider_autoplay]', array(
	'active_callback' => 'business_center_is_slider_enable',
	'label'           => __( 'Enable Autoplay?', 'business-center' ),
	'section'         => 'business_center_slider_section',
	'type'            => 'checkbox',
) );

// Slider Caption setting and control.
$wp_customize->add_setting( 'business_center_theme_options[enable_slider_caption]', array(
	'default'           => $options['enable_slider_caption'],
	'sanitize_callback' => 'business_center_sanitize_checkbox'
) );

$wp_customize->add_control( 'business_center_theme_options[enable_slider_caption]', array(
	'active_callback' => 'business_center_is_slider_enable',
	'label'           => __( 'Enable slider caption?', 'business-center' ),
	'section'         => 'business_center_slider_section',
	'type'            => 'checkbox',
) );

// Horizontal Line
$wp_customize->add_setting( 'business_center_theme_options[slider_basic_controls]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Business_Center_Customize_Horizontal_Line( $wp_customize, 'business_center_theme_options[slider_basic_controls]',
	array(
		'active_callback' => 'business_center_is_slider_enable',
		'section'         => 'business_center_slider_section',
		'type'			  => 'hr',
) ) );


/**
 * Slider content type options.
 */
$wp_customize->add_setting( 'business_center_theme_options[slider_content_type]', array(
	'default'           => $options['slider_content_type'],
	'sanitize_callback' => 'business_center_sanitize_select',
) );

$wp_customize->add_control( 'business_center_theme_options[slider_content_type]', array(
	'active_callback'	=> 'business_center_is_slider_enable',
	'label'             => __( 'Content Type', 'business-center' ),
	'section'           => 'business_center_slider_section',
	'choices'			=> business_center_default_content_type_options(),
	'type'				=> 'select'
) );

for ( $i=1; $i <= 3; $i++ ) { 
	/**
	 * Page Content Type Options
	 */
	// Page Options
	$wp_customize->add_setting( 'business_center_theme_options[slider_page_'.$i.']', array(
		'sanitize_callback' => 'business_center_sanitize_page'
	) );

	$wp_customize->add_control( 'business_center_theme_options[slider_page_'.$i.']', array(
		'active_callback' => 'business_center_is_slider_enable',
		'label'           => __( 'Select Page ', 'business-center' ) . $i,
		'section'         => 'business_center_slider_section',
		'type'            => 'dropdown-pages',
	) );

	// Button text
	$wp_customize->add_setting( 'business_center_theme_options[slider_btn_text_'.$i.']', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> __( 'Start Browsing', 'business-center' )
	) );

	$wp_customize->add_control( 'business_center_theme_options[slider_btn_text_'.$i.']', array(
		'active_callback'	=> 'business_center_is_slider_enable',
		'label'             => __( 'Button Text ', 'business-center' ) . $i,
		'section'           => 'business_center_slider_section',
		'type'				=> 'text'
	) );

	// Video Link Options
	$wp_customize->add_setting( 'business_center_theme_options[slider_video_link_' . $i . ']', array(
		'sanitize_callback' => 'esc_url_raw',
		'default'			=> '#'
	) );

	$wp_customize->add_control( 'business_center_theme_options[slider_video_link_' . $i . ']', array(
		'active_callback' => 'business_center_is_slider_enable',
		'label'           => __( 'Video Link ', 'business-center' ) . $i,
		'section'         => 'business_center_slider_section',
		'type'            => 'url',
	) );

	// Horizontal Line
	$wp_customize->add_setting( 'business_center_theme_options[slider_content_type_hr' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new Business_Center_Customize_Horizontal_Line( $wp_customize, 'business_center_theme_options[slider_content_type_hr' . $i . ']',
		array(
			'active_callback' => 'business_center_is_slider_enable',
			'section'         => 'business_center_slider_section',
			'type'			  => 'hr',
	) ) );
}