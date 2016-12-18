<?php
/**
 * Business Center custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Business Center
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

if( ! function_exists( 'business_center_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Business Center 1.0.0
	 */
  	function business_center_check_enable_status( $input, $content_enable ){
		$options = business_center_get_theme_options();

		// Content status.
		$content_status = $options[ $content_enable ];

		// Get Page ID outside Loop.
		$query_obj = get_queried_object();
		$page_id   = null;
	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		// Front page displays in Reading Settings.
		$page_on_front  = get_option( 'page_on_front' );

		if ( ( ( ! is_home() && is_front_page() ) && $content_status ) ) {
			$input = true;
		}
		else {
			$input = false;
		}
		return ( $input );

  	}
endif;
add_filter( 'business_center_section_status', 'business_center_check_enable_status', 10, 2 );


if ( ! function_exists( 'business_center_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 *.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function business_center_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = business_center_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;
add_filter( 'business_center_filter_frontpage_content_enable', 'business_center_is_frontpage_content_enable' );


if ( ! function_exists( 'business_center_pagination' ) ) :

	/**
	 * Pagination.
	 *
	 * @since Business Center 1.0.0
	 */
	function business_center_pagination() {
		$options = business_center_get_theme_options();

		// Bail if pagination is disabled
		if ( false == $options['pagination_enable'] )
			return;

		$pagination_type = $options['pagination_type'];

		switch ( $pagination_type ) {

			case 'default':
				the_posts_navigation();
			break;

			case 'numeric':
				the_posts_pagination( array( 'mid_size' => 5 ) );
			break;

			default:
			break;
		}
	}
endif;
add_action( 'business_center_pagination', 'business_center_pagination', 10 );


if ( ! function_exists( 'business_center_post_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since Business Center 1.0.0
	 */
	function business_center_post_pagination() {
		the_post_navigation();
	}
endif;
add_action( 'business_center_action_post_pagination', 'business_center_post_pagination', 10 );


/**
 * long excerpt
 * 
 * @since Business Center 1.0.0
 * @return  long excerpt value
 */
function business_center_excerpt_length(){
	$options = business_center_get_theme_options();
	$length = $options['excerpt_length'];
	return (int)$length;
}
add_filter( 'excerpt_length', 'business_center_excerpt_length', 999 );

/**
 * Excerpt read more text
 * 
 * @since Business Center 1.0.0
 * @return  string Excerpt read more string
 */
function business_center_excerpt_more( $more ){
	$options = business_center_get_theme_options();
	$more =  $options['read_more_text'];
	
	return ' <a href="'.esc_url( get_the_permalink() ).'">' . esc_html( $more );
}
add_filter( 'excerpt_more', 'business_center_excerpt_more' ) .'</a>';

/**
 * custom excerpt function
 * 
 * @since Business Center 1.0.0
 * @return  no of words to display
 */
function business_center_trim_content( $length = 40, $post_obj = null ) {
	global $post;
	if ( is_null( $post_obj ) ) {
		$post_obj = $post;
	}

	$length = absint( $length );
	if ( $length < 1 ) {
		$length = 40;
	}

	$source_content = $post_obj->post_content;
	if ( ! empty( $post_obj->post_excerpt ) ) {
		$source_content = $post_obj->post_excerpt;
	}

	$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
	$trimmed_content = wp_trim_words( $source_content, $length, '...' );

   return apply_filters( 'business_center_trim_content', $trimmed_content );
}

if ( ! function_exists( 'business_center_is_jetpack_cpt_module_enable' ) ) :
    /**
     * Check if JetPack module is enabled
     *
     * @since Business Center 1.0.0
     *
     * @param string $jetpack_cpt_option 		Jetpack enable checkbox value
     */
    function business_center_is_jetpack_cpt_module_enable( $jetpack_cpt_option ) {
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) &&  get_option( $jetpack_cpt_option ) ) :
			return true;
		endif;

		return false;
    }
endif;
add_action( 'plugins_loaded', 'business_center_is_jetpack_cpt_module_enable' );
add_filter( 'business_center_filter_is_jetpack_cpt_module_enable', 'business_center_is_jetpack_cpt_module_enable' );


if ( ! function_exists( 'business_center_footer_sidebar_class' ) ) :
	/**
	 * Count the number of footer sidebars to enable dynamic classes for the footer
	 *
	 * @since Business Center 1.0.0
	 */
	function business_center_footer_sidebar_class() {
		$data = array();
		$active_id = array();
	   	$count = 0;

	   	if ( is_active_sidebar( 'footer-1' ) ) {
	   		$active_id[] = '1';
	      	$count++;
	   	}

	   	if ( is_active_sidebar( 'footer-2' ) ){
	   		$active_id[] = '2';
	      	$count++;
		}

	   	if ( is_active_sidebar( 'footer-3' ) ){
	   		$active_id[] = '3';
	      	$count++;
	   	}

	   	$class = '';

	   	switch ( $count ) {
        	case '1':
            	$class = 'one';
            break;

        	case '2':
            	$class = 'two';
            break;

        	case '3':
            	$class = 'three';
            break;

            default:
            	$class = 'one';
            break;
	   	}

		$data['active_id'] = $active_id;
		$data['class']     = $class;

	   	return $data;
	}
endif;


if ( ! function_exists( 'business_center_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since Business Center 1.0.0
	 *
	 * @return string Layout value
	 */
	function business_center_layout() {
		$options = business_center_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position = apply_filters( 'business_center_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular() || is_home() ) {
			if ( is_home() ) {
				$post_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), 'business-center-sidebar-position', true );
			} else {
				$post_sidebar_position = get_post_meta( get_the_ID(), 'business-center-sidebar-position', true );
			}
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}
		return $sidebar_position;
	}
endif;


if ( ! function_exists( 'business_center_title_as_per_template' ) ) :
	/**
	 * Return title as per template rendered
	 *
	 * @since Business Center 1.0.0
	 *
	 * @return string Template title
	 */
	function business_center_title_as_per_template() {
        if ( is_single() ) {
            $categories_list = get_the_category_list( esc_html__( ', ', 'business-center' ) );
			if ( $categories_list && business_center_categorized_blog() ) {
				printf( '<h2 class="entry-title">%s</h2>', $categories_list ); // WPCS: XSS OK.
			}
        } elseif ( is_archive() ) {
        	echo '<h2 class="entry-title">'.__( 'Archive', 'business-center' ).'</h2>';
        }
        
      	if ( is_singular() ) {
      		the_title( '<h1>', '</h1>' );
      	} elseif ( is_archive() ) {
      		the_archive_title( '<h1>', '</h1>' );
      	} elseif( is_404() ) {
			echo '<h1>' . __( '404 Page', 'business-center' ) . '</h1>';
		} elseif( is_search() ){
			echo '<h1>' . __( 'Search Page', 'business-center' ) . '</h1>';
		} elseif ( is_home() ) {
			echo '<h1>' . __( 'Blog Page', 'business-center' ) . '</h1>';
		}
	}
endif;