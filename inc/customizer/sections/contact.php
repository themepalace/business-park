<?php
/**
 * Contact options
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */


// Add contact section
$wp_customize->add_section( 'business_center_contact_section', array(
	'title'             => __('Contact Options','business-center'),
	'description'       => __( 'Contact options.', 'business-center' ),
	'panel'             => 'business_center_sections_panel',
) );


/**
 * Contact Options
 */
// Enable contact.
$wp_customize->add_setting( 'business_center_theme_options[enable_contact]', array(
	'default'           => $options['enable_contact'],
	'sanitize_callback' => 'business_center_sanitize_checkbox',
) );

$wp_customize->add_control( 'business_center_theme_options[enable_contact]', array(
	'label'             => __( 'Enable Contact Section?', 'business-center' ),
	'section'           => 'business_center_contact_section',
	'type'				=> 'checkbox'
) );

// Contact title.
$wp_customize->add_setting( 'business_center_theme_options[contact_title]', array(
	'default'           => $options['contact_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'business_center_theme_options[contact_title]', array(
	'active_callback'	=> 'business_center_is_contact_enable',
	'label'             => __( 'Title:', 'business-center' ),
	'section'           => 'business_center_contact_section',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_center_theme_options[contact_title]', array(
		'selector'            => '#contact-form .entry-header .entry-title',
		'render_callback'     => 'business_center_partial_contact_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Contact shortcode image options
$wp_customize->add_setting( 'business_center_theme_options[custom_contact_form_shortcode]', array(
	'sanitize_callback' => 'wp_kses_post'
) );

$wp_customize->add_control( 'business_center_theme_options[custom_contact_form_shortcode]', array(
	'active_callback' => 'business_center_is_contact_enable',
	'label'           => __( 'Form Shortcode ', 'business-center' ),
	'section'         => 'business_center_contact_section',
	'type'			  => 'text',
	'input_attrs'	  => array( 'placeholder' => '[contact-form-7 id="1880" title="Contact form 1"]' )
) );