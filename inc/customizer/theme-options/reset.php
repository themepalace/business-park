<?php
/**
 * Reset options
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'business_center_reset_section', array(
	'title'             => __('Reset all settings','business-center'),
	'description'       => __( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'business-center' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'business_center_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'business_center_sanitize_checkbox',
	'transport'			  => 'postMessage'
) );

$wp_customize->add_control( 'business_center_theme_options[reset_options]', array(
	'label'             => __( 'Check to reset all settings', 'business-center' ),
	'section'           => 'business_center_reset_section',
	'type'              => 'checkbox',
) );