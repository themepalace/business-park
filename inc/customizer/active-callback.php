<?php
/**
 * Customizer active callbacks
 *
 * @package business_center
 * @since Business Center 1.0.0
 */


/**
 * Check if loader is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_loader_enable( $control ) {
	return $control->manager->get_setting( 'business_center_theme_options[loader_enable]' )->value();
}

/**
 * Check if breadcrumb is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_breadcrumb_enable( $control ) {
	return $control->manager->get_setting( 'business_center_theme_options[breadcrumb_enable]' )->value();
}


/**
 * Check if pagination is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */

function business_center_is_pagination_enable( $control ) {
	return $control->manager->get_setting( 'business_center_theme_options[pagination_enable]' )->value();
}

/**
 * Check if slider is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_slider_enable( $control ) {
	if ( $control->manager->get_setting( 'business_center_theme_options[enable_slider]' )->value() )
		return true;

	return false;
}

/**
 * Check if feature is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_feature_enable( $control ) {
	if ( $control->manager->get_setting( 'business_center_theme_options[enable_feature]' )->value() )
		return true;

	return false;
}

/**
 * Check if icon type fa icon is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_feature_content_type_custom_fa_icon_enable( $control ) {
	$feature_icon_type = $control->manager->get_setting( 'business_center_theme_options[feature_icon_type]' )->value();
	if ( business_center_is_feature_enable( $control ) && 'fa-icon' == $feature_icon_type )
		return true;

	return false;
}

/**
 * Check if call to action is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_call_to_action_enable( $control ) {
	if ( $control->manager->get_setting( 'business_center_theme_options[enable_call_to_action]' )->value() )
		return true;

	return false;
}

/**
 * Check if front page blog is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_front_page_blog_enable( $control ) {
	if ( $control->manager->get_setting( 'business_center_theme_options[enable_front_page_blog]' )->value() )
		return true;

	return false;
}

/**
 * Check if team is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_team_enable( $control ) {
	if ( $control->manager->get_setting( 'business_center_theme_options[enable_team]' )->value() )
		return true;

	return false;
}

/**
 * Check if contact is enabled.
 *
 * @since Business Center 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function business_center_is_contact_enable( $control ) {
	if ( $control->manager->get_setting( 'business_center_theme_options[enable_contact]' )->value() )
		return true;

	return false;
}