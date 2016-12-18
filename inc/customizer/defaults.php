<?php
/**
 * Business Center customizer default options
 *
 * @package business_center
 * @since Business Center 1.0.0
 */


/**
 * Returns the default options for Business Center.
 *
 * @since Business Center 1.0.0
 * @return array An array of default values
 */
function business_center_get_default_theme_options() {
	
	$business_center_default_options = array(
		// Additional menu options
			'make_menu_sticky'           => true,
			'disable_front_page_content' => false,
			
			// Theme Options
			'loader_enable'                               => false,
			'loader_icon'                                 => 'fa-spinner',
			'sidebar_position'                            => 'right-sidebar',
			'excerpt_length'                              => 50,
			'read_more_text'                              => __( 'Read More', 'business-center' ),
			'breadcrumb_enable'                           => false,
			'breadcrumb_show_on_front'                    => true,
			'pagination_enable'                           => false,
			'pagination_type'                             => 'default',
			'hide_date'                                   => false,
			'hide_author'                                 => false,
			'hide_tags'                                   => false,
			'hide_category'                               => false,
			'hide_featured_image'                         => false,
			'reset_options'                               => false,
			'enable_frontpage_content'                    => true,
			'archive_grid_layout'                         => 'grid',
			
			//Footer Editor Options
			'scroll_top_visible'                          => true,
			
			/**
			* Sections options
			*/
			// Slider
			'enable_slider'                               => false,
			'slider_content_type'                         => 'page',
			'slider_transition'                           => 'fade',
			'enable_slider_caption'                       => true,
			'enable_slider_pager'                         => true,
			'enable_slider_autoplay'                      => true,
			'slider_speed'                                => 800,
			
			// Features
			'enable_feature'                              => false,
			'feature_content_type'                        => 'category',
			'feature_icon_type'                           => 'fa-icon',
			'custom_feature_view_more_text'               => __( 'View More', 'business-center' ),
			'custom_feature_view_more_link'               => '#',
			
			// Call To Action
			'enable_call_to_action'                       => false,
			'call_to_action_content_type'                 => 'post',		
			'call_to_action_btn_txt'                      => __( 'JOIN US TODAY', 'business-center' ),	
			
			// Front Page Blog
			'enable_front_page_blog'                      => false,
			'front_page_blog_title'                       => __( 'News', 'business-center' ),
			'front_page_blog_posts_read_more_btn_txt'     => __( 'Read More News', 'business-center' ),		
			'front_page_blog_posts_read_more_btn_txt_url' => '#',		
			'front_page_blog_content_type'                => 'category',
			
			// Team
			'enable_team'                                 => false,
			'team_title'                                  => __( 'Our team', 'business-center' ),		
			'team_content_type'                           => 'category',
			'team_read_more_btn_txt'                      => __( 'View More', 'business-center' ),
			'team_read_more_btn_txt_url'                  => '#',
			
			// Contact
			'enable_contact'                              => false,
			'contact_title'                               => __( 'Contact', 'business-center' ),
	);

	$output = apply_filters( 'business_center_default_theme_options', $business_center_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}