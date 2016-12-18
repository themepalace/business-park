<?php
/**
 * Feature options
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */


// Add feature section
$wp_customize->add_section( 'business_center_feature_section', array(
	'title'             => __('Feature Options','business-center'),
	'description'     => __( 'The recommended size for the image is 500px by 375px. ', 'business-center' ),
	'panel'             => 'business_center_sections_panel',
) );


/**
 * Feature Options
 */
// Enable service.
$wp_customize->add_setting( 'business_center_theme_options[enable_feature]', array(
	'default'           => $options['enable_feature'],
	'sanitize_callback' => 'business_center_sanitize_checkbox',
) );

$wp_customize->add_control( 'business_center_theme_options[enable_feature]', array(
	'label'             => __( 'Enable Feature Section?', 'business-center' ),
	'section'           => 'business_center_feature_section',
	'type'				=> 'checkbox'
) );

/**
 * Feature content type options.
 */
$wp_customize->add_setting( 'business_center_theme_options[feature_content_type]', array(
	'default'           => $options['feature_content_type'],
	'sanitize_callback' => 'business_center_sanitize_select',
) );

$wp_customize->add_control( 'business_center_theme_options[feature_content_type]', array(
	'active_callback'	=> 'business_center_is_feature_enable',
	'label'             => __( 'Content Type', 'business-center' ),
	'section'           => 'business_center_feature_section',
	'choices'			=> business_center_feature_content_type_options(),
	'type'				=> 'select'
) );

// View more button text.
$wp_customize->add_setting( 'business_center_theme_options[custom_feature_view_more_text]', array(
	'default'           => $options['custom_feature_view_more_text'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'business_center_theme_options[custom_feature_view_more_text]', array(
	'active_callback'	=> 'business_center_is_feature_enable',
	'label'             => __( 'View More Text: ', 'business-center' ),
	'section'           => 'business_center_feature_section',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_center_theme_options[custom_feature_view_more_text]', array(
		'selector'            => '#features .entry-content .view-more',
		'render_callback'     => 'business_center_partial_feature_view_more_text',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// View more button link.
$wp_customize->add_setting( 'business_center_theme_options[custom_feature_view_more_link]', array(
	'default'           => $options['custom_feature_view_more_link'],
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'business_center_theme_options[custom_feature_view_more_link]', array(
	'active_callback'	=> 'business_center_is_feature_enable',
	'label'             => __( 'View More Link: ', 'business-center' ),
	'section'           => 'business_center_feature_section',
	'type'				=> 'url'
) );

// Icon Options
$wp_customize->add_setting( 'business_center_theme_options[feature_icon_type]', array(
	'sanitize_callback' => 'business_center_sanitize_select',
	'default'			=> $options['feature_icon_type'],
) );

$wp_customize->add_control( 'business_center_theme_options[feature_icon_type]', array(
	'active_callback' => 'business_center_is_feature_enable',
	'label'           => __( 'Icon Type: ', 'business-center' ),
	'section'         => 'business_center_feature_section',
	'type'            => 'select',
	'choices'		  => array( 'fa-icon' => __( 'FA Icon', 'business-center' ), )
) );

for ( $i=1; $i <= 5; $i++ ) { 
	/**
	 * Custom Content Type Options
	 */
	// FA Icon Options
	$wp_customize->add_setting( 'business_center_theme_options[feature_fa_icon_'.$i.']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'business_center_theme_options[feature_fa_icon_'.$i.']', array(
		'active_callback' => 'business_center_is_feature_content_type_custom_fa_icon_enable',
		'label'           => __( 'FA Icon ', 'business-center' ) . $i,
		'section'         => 'business_center_feature_section',
		'type'            => 'text',
		'input_attr'	  => array( 'placeholder' => 'fa-archive' )	
	) );
}

/**
 * Category Content Type Options
 */
// Catgegory Options
$wp_customize->add_setting( 'business_center_theme_options[feature_category]', array(
	'sanitize_callback' => 'business_center_sanitize_tax_checkbox'
) );

$wp_customize->add_control( new Business_Center_Customize_Control_Checkbox_Multiple( $wp_customize, 'business_center_theme_options[feature_category]', array(
	'active_callback' => 'business_center_is_feature_enable',
	'label'           => __( 'Select Category', 'business-center' ),
	'section'         => 'business_center_feature_section',
	'type'            => 'checkbox-multiple',
	'taxonomy'		  => 'category',
) ) );