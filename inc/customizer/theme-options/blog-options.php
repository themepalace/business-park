<?php
/**
 * Blog options
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

$wp_customize->add_section( 'business_center_blog_options', array(
        'title'    => __( 'Blog options', 'business-center' ),
        'panel'    => 'business_center_theme_options_panel'
    )
); 

//Meta
$wp_customize->add_setting( 'business_center_theme_options[hide_date]', array(
    'sanitize_callback' => 'business_center_sanitize_checkbox',
    'default' => $options['hide_date'],     
  )   
);

$wp_customize->add_control( 'business_center_theme_options[hide_date]', array(
    'type' => 'checkbox',
    'label' => __( 'Hide post date?', 'business-center' ),
    'section' => 'business_center_blog_options',
  )
);

$wp_customize->add_setting( 'business_center_theme_options[hide_author]', array(
    'sanitize_callback' => 'business_center_sanitize_checkbox',
    'default' => $options['hide_author'],     
  )   
);

$wp_customize->add_control( 'business_center_theme_options[hide_author]', array(
    'type' => 'checkbox',
    'label' => __( 'Hide post author?', 'business-center' ),
    'section' => 'business_center_blog_options',
  )
); 

$wp_customize->add_setting( 'business_center_theme_options[hide_category]', array(
    'sanitize_callback' => 'business_center_sanitize_checkbox',
    'default' => $options['hide_category'],     
  )   
);

$wp_customize->add_control( 'business_center_theme_options[hide_category]', array(
    'type' => 'checkbox',
    'label' => __( 'Hide post category?', 'business-center' ),
    'section' => 'business_center_blog_options',
  )
); 

$wp_customize->add_setting( 'business_center_theme_options[hide_tags]', array(
    'sanitize_callback' => 'business_center_sanitize_checkbox',
    'default' => $options['hide_tags'],     
  )   
);

$wp_customize->add_control( 'business_center_theme_options[hide_tags]', array(
    'type' => 'checkbox',
    'label' => __( 'Hide post tags?', 'business-center' ),
    'section' => 'business_center_blog_options',
  )
); 

//Index images
$wp_customize->add_setting( 'business_center_theme_options[hide_featured_image]', array(
        'sanitize_callback' => 'business_center_sanitize_checkbox',
    )       
);

$wp_customize->add_control( 'business_center_theme_options[hide_featured_image]', array(
        'type' => 'checkbox',
        'label' => __( 'Hide featured images?', 'business-center' ),
        'section' => 'business_center_blog_options',
    )
);