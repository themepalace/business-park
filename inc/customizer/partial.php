<?php
/**
 * Customizer Partial Functions
 *
 * @package Theme_Palace
 * @since Business Center 1.0.0
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Business Center 1.0.0
 *
 * @return void
 */
function business_center_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Business Center 1.0.0
 *
 * @return void
 */
function business_center_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the features read more text for the selective refresh partial.
 *
 * @since Business Center 1.0.0
 * @return string
 */
function business_center_partial_feature_view_more_text() {
	$options = business_center_get_theme_options();
	return esc_html( $options['custom_feature_view_more_text'] );
}

/**
 * Render the call to action btn text for the selective refresh partial.
 *
 * @since Business Center 1.0.0
 * @return string
 */
function business_center_partial_call_to_action_btn_txt() {
	$options = business_center_get_theme_options();
	return esc_html( $options['call_to_action_btn_txt'] );
}

/**
 * Render the front page blog title for the selective refresh partial.
 *
 * @since Business Center 1.0.0
 * @return string
 */
function business_center_partial_front_page_blog_title() {
	$options = business_center_get_theme_options();
	return esc_html( $options['front_page_blog_title'] );
}

/**
 * Render the team title for the selective refresh partial.
 *
 * @since Business Center 1.0.0
 * @return string
 */
function business_center_partial_team_title() {
	$options = business_center_get_theme_options();
	return esc_html( $options['team_title'] );
}

/**
 * Render the team read more btn text for the selective refresh partial.
 *
 * @since Business Center 1.0.0
 * @return string
 */
function business_center_partial_team_read_more_btn_txt() {
	$options = business_center_get_theme_options();
	return esc_html( $options['team_read_more_btn_txt'] );
}

/**
 * Render the contact title for the selective refresh partial.
 *
 * @since Business Center 1.0.0
 * @return string
 */
function business_center_partial_contact_title() {
	$options = business_center_get_theme_options();
	return esc_html( $options['contact_title'] );
}
