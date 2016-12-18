<?php
/**
 * Front Page Blog options
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */


// Add front page blog section
$wp_customize->add_section( 'business_center_front_page_blog_section', array(
	'title'             => __('Front Page Blog Options','business-center'),
	'description'       => __( 'The recommended size for the images in this section is 500px by 375px.', 'business-center' ),
	'panel'             => 'business_center_sections_panel',
) );


/**
 * Front Page Blog Options
 */
// Enable front_page_blog.
$wp_customize->add_setting( 'business_center_theme_options[enable_front_page_blog]', array(
	'default'           => $options['enable_front_page_blog'],
	'sanitize_callback' => 'business_center_sanitize_checkbox',
) );

$wp_customize->add_control( 'business_center_theme_options[enable_front_page_blog]', array(
	'label'             => __( 'Enable Front Page Blog Section?', 'business-center' ),
	'section'           => 'business_center_front_page_blog_section',
	'type'				=> 'checkbox'
) );

// Front Page Blog title.
$wp_customize->add_setting( 'business_center_theme_options[front_page_blog_title]', array(
	'default'           => $options['front_page_blog_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'business_center_theme_options[front_page_blog_title]', array(
	'active_callback'	=> 'business_center_is_front_page_blog_enable',
	'label'             => __( 'Title:', 'business-center' ),
	'section'           => 'business_center_front_page_blog_section',
	'type'				=> 'text'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'business_center_theme_options[front_page_blog_title]', array(
		'selector'            => '#blog-posts .entry-header .entry-title',
		'render_callback'     => 'business_center_partial_front_page_blog_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

/**
 * Front Page Blog content type options.
 */
$wp_customize->add_setting( 'business_center_theme_options[front_page_blog_content_type]', array(
	'default'           => $options['front_page_blog_content_type'],
	'sanitize_callback' => 'business_center_sanitize_select',
) );

$wp_customize->add_control( 'business_center_theme_options[front_page_blog_content_type]', array(
	'active_callback'	=> 'business_center_is_front_page_blog_enable',
	'label'             => __( 'Content Type', 'business-center' ),
	'section'           => 'business_center_front_page_blog_section',
	'choices'			=> business_center_front_page_blog_content_type_options(),
	'type'				=> 'select'
) );

/**
 * Category Content Type Options
 */
// Catgegory Options
$wp_customize->add_setting( 'business_center_theme_options[front_page_blog_category]', array(
	'sanitize_callback' => 'business_center_sanitize_tax_checkbox'
) );

$wp_customize->add_control( new Business_Center_Customize_Control_Checkbox_Multiple( $wp_customize, 'business_center_theme_options[front_page_blog_category]', array(
	'active_callback' => 'business_center_is_front_page_blog_enable',
	'label'           => __( 'Select Category', 'business-center' ),
	'description'             => __( 'Note: Leave the checkboxes unchecked if you want to display the latest posts.', 'business-center' ),
	'section'         => 'business_center_front_page_blog_section',
	'type'            => 'checkbox-multiple',
	'taxonomy'		  => 'category',
) ) );

// Read more button text.
$wp_customize->add_setting( 'business_center_theme_options[front_page_blog_posts_read_more_btn_txt]', array(
	'default'           => $options['front_page_blog_posts_read_more_btn_txt'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'business_center_theme_options[front_page_blog_posts_read_more_btn_txt]', array(
	'active_callback'	=> 'business_center_is_front_page_blog_enable',
	'label'             => __( 'Button Text:', 'business-center' ),
	'section'           => 'business_center_front_page_blog_section',
	'type'				=> 'text'
) );

// Read more button URL.
$wp_customize->add_setting( 'business_center_theme_options[front_page_blog_posts_read_more_btn_txt_url]', array(
	'default'           => $options['front_page_blog_posts_read_more_btn_txt_url'],
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'business_center_theme_options[front_page_blog_posts_read_more_btn_txt_url]', array(
	'active_callback'	=> 'business_center_is_front_page_blog_enable',
	'label'             => __( 'Button URL:', 'business-center' ),
	'section'           => 'business_center_front_page_blog_section',
	'type'				=> 'url'
) );