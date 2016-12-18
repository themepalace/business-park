<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Business Center 1.0.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses business_center_header_style()
 */
function business_center_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'business_center_custom_header_args', array(
		'default-image'          => get_template_directory_uri(). '/assets/uploads/header-image.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1300,
		'height'                 => 720,
		'flex-height'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'business_center_custom_header_setup' );


if ( ! function_exists( 'business_center_header_image_meta_option' ) ) :
	/**
	 * Check header image option meta
	 *
	 * @since Business Center 1.0.0
	 *
	 * @return string Header image meta option
	 */
	function business_center_header_image_meta_option() {
		
		if ( is_archive() || is_404() || is_search() ) {
			if ( get_header_image() ) {
				return '<img src="'. esc_url( get_header_image() ) .'" width="'. esc_attr( get_custom_header()->width ) . '" height="'. esc_attr( get_custom_header()->height ) .'" alt="">';
			} else {
				return '<img src="'. get_template_directory_uri() .  '/assets/uploads/header-image.jpg" alt="">';
			}
		} else {
			global $post;
			$post_id = $post->ID;
			
			if ( !is_front_page() && is_home() ) {
				$post_id = get_option( 'page_for_posts' );
			}
			if ( is_front_page() && is_home() ) {
				if ( get_header_image() ) {
					return '<img src="'. esc_url( get_header_image() ) .'" width="'. esc_attr( get_custom_header()->width ) . '" height="'. esc_attr( get_custom_header()->height ) .'" alt="">';
				} else {
					return '<img src="'. get_template_directory_uri() .  '/assets/uploads/header-image.jpg" alt="">';
				}
			}

			$header_image_meta = get_post_meta( $post_id, 'business-center-header-image', true );

			if ( 'enable' == $header_image_meta ) {
				if ( has_post_thumbnail( $post_id ) ) {
					return get_the_post_thumbnail( $post_id, '', the_title_attribute( 'echo=0' ) );
				} else {
					return '<img src="'. get_template_directory_uri() .  '/assets/uploads/header-image.jpg" alt="">';
				}
			} elseif ( '' == $header_image_meta ) {
				if ( get_header_image() ) {
					return '<img src="'. esc_url( get_header_image() ) .'" width="'. esc_attr( get_custom_header()->width ) . '" height="'. esc_attr( get_custom_header()->height ) .'" alt="">';
				} else {
					return '<img src="'. get_template_directory_uri() .  '/assets/uploads/header-image.jpg" alt="">';
				}
			} elseif ( 'disable' == $header_image_meta ) {
				return false;
			} 
		}
	}
endif;


if ( ! function_exists( 'business_center_display_custom_header' ) ) :
	/**
	 * Custom header for single and other templates
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_display_custom_header() {
		
		if ( ! empty( business_center_header_image_meta_option()  ) ) { ?>
		<section id="banner-image" class="featured-banner">
			<?php echo business_center_header_image_meta_option(); ?>
	        <div class="black-overlay"></div>
          	<div class="container">
	        	<div class="banner-wrapper">
		            <div class="page-title">
		              <header class="entry-header">
			                <?php business_center_title_as_per_template();?>
		              </header>
		            </div><!-- end .page-title -->

		            <?php 
		            if ( is_single() ) {
		            $user_id = get_post_field( 'post_author', get_the_id() ); ?>
		            <span class="byline">
		              <span class="author vcard">
		                <a href="<?php echo esc_url( get_author_posts_url( $user_id ) );?>"><?php echo get_avatar( $user_id ); ?></a>
		                <span class="screen-reader-text"><?php _e( 'Author', 'business-center' );?></span> 
		                <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( $user_id ) );?>"><?php _e( 'Author:', 'business-center' );?><?php echo esc_html( get_the_author_meta( 'nicename', $user_id ) );?></a>
		              </span>
		            </span><!-- .byline -->

		            <span class="posted-on">
		              <span class="screen-reader-text"><?php _e( 'Posted on', 'business-center' );?> </span>
		                <?php business_center_posted_on();?>
		            </span><!-- .posted-on -->
		            <?php } ?>
	        	</div><!-- end .container -->
         	</div><!-- end .banner-wrapper -->
	     </section><!-- #banner-image -->
		<?php
		}
	}
endif;
add_action( 'business_center_custom_header', 'business_center_display_custom_header', 10 );
