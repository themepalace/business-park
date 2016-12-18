<?php
/**
 * Business Center bas.0ic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Business Center
 * 
 */

$options = business_center_get_theme_options();


if ( ! function_exists( 'business_center_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Business Center 1.0.0
	 */
	function business_center_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'business_center_doctype', 'business_center_doctype', 10 );


if ( ! function_exists( 'business_center_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
		$options = business_center_get_theme_options(); ?>
		<?php
	}
endif;
add_action( 'business_center_before_wp_head', 'business_center_head', 10 );


if ( ! function_exists( 'business_center_loader' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_loader() {
		$options = business_center_get_theme_options();
		if ( $options['loader_enable'] ) { ?>
			<div id="loader">
	         <div class="loader-container">
         		<i class="fa <?php echo esc_attr( $options['loader_icon'] );?> fa-spin"></i>
	         </div>
	     	</div><!-- end loader -->
		<?php }
	}
endif;
add_action( 'business_center_loader', 'business_center_loader', 10 );


if ( ! function_exists( 'business_center_page_start' ) ) :
	/**
	 * Start div id #page and screen reader link
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'business-center' ); ?></a>
		<?php
	}
endif;
add_action( 'business_center_page_start', 'business_center_page_start', 10 );


if ( ! function_exists( 'business_center_header_start' ) ) :
	/**
	 * Start div id #masthead
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_header_start() {
		?>
        <header id="masthead" class="site-header" role="banner">
		<?php
	}
endif;
add_action( 'business_center_header_start', 'business_center_header_start', 10 );


if ( ! function_exists( 'business_center_site_branding' ) ) :
	/**
	 * Start div class .site-branding
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_site_branding() {
		?>
		<div class="site-branding">
			<div class="site-logo">
				<?php
		        if ( function_exists( 'the_custom_logo' ) ) :
		        	the_custom_logo();
		        endif;
		        ?>
			</div><!-- .site-logo -->

			<div id="site-header">
				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
				<?php
				endif; 
		        ?>
	        </div><!-- #site-header -->
		</div><!-- .site-branding -->
		<?php
	}
endif;
add_action( 'business_center_header', 'business_center_site_branding', 10 );


if ( ! function_exists( 'business_center_header_end' ) ) :
	/**
	 * End header class id #masthead
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_header_end() {
		?>
        </header><!--end .site-header-->
		<?php
	}
endif;
add_action( 'business_center_header_end', 'business_center_header_end', 100 );


if ( ! function_exists( 'business_center_site_content_start' ) ) :
	/**
	 * Start div id #content
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_site_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'business_center_site_content_start', 'business_center_site_content_start', 10 );


if ( ! function_exists( 'business_center_site_content_end' ) ) :
	/**
	 * End div id #content
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_site_content_end() {
		?>
		</div><!--end .site-content-->
		<?php
	}
endif;
add_action( 'business_center_site_content_end', 'business_center_site_content_end', 100 );



if ( ! function_exists( 'business_center_footer_start' ) ) :
	/**
	 * End div id #content
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_footer_start() {
		$footer_sidebar_data = business_center_footer_sidebar_class();
		$class               = $footer_sidebar_data['class'];
		?>
		<footer id="colophon" class="site-footer <?php echo esc_attr( $class );?>-col" role="contentinfo">
		<?php
	}
endif;
add_action( 'business_center_footer_start', 'business_center_footer_start', 10 );


if ( ! function_exists( 'business_center_footer_widgets' ) ) :
	/**
	 * Footer widgets
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_footer_widgets() {

		$footer_sidebar_data = business_center_footer_sidebar_class();
		$active_id           = $footer_sidebar_data['active_id'];

		if ( empty( $active_id ) ) {
			return;
		} ?>
        <div class="container page-section">
	      	<?php for ( $i=0; $i < count( $active_id ); $i++ ) { ?>

			<div class="column-wrapper">
	      		<?php 
	      		if ( is_active_sidebar( 'footer-'.absint( $active_id[ $i ] ).'' ) ){
	      			dynamic_sidebar( 'footer-'.absint( $active_id[ $i ] ).'' );
	      		}
	      		?>
	      	</div>
	      	<?php } ?>
        </div><!-- end .container -->
		<?php
	}
endif;
add_action( 'business_center_footer', 'business_center_footer_widgets', 10 );


if ( ! function_exists( 'business_center_copyright' ) ) :
	/**
	 * End div class .site-info
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_copyright() { 
		$options = business_center_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>' );

		$theme_data = wp_get_theme();
		$copyright_text 	= sprintf( _x( 'Copyright &copy; %1$s', 'Year', 'business-center' ), date( 'Y' ) ) . ' &#124; ' . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . __( 'by', 'business-center' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( $theme_data->get( 'Author' ) ) .'</a>';
		
		if ( ! empty( $copyright_text ) ) :  ?>
	    <div class="site-info copyright text-center">
	    	<div class="container">
	      		<?php echo wp_kses_post( $copyright_text );?>
	    	</div>
	    </div><!-- end .site-info -->  	
	<?php
		endif;
	}
endif;
add_action( 'business_center_footer', 'business_center_copyright', 40 );


if ( ! function_exists( 'business_center_footer_end' ) ) :
	/**
	 * End footer id #colophon
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_footer_end() {
		?>
        </footer><!-- end .site-footer -->
		<?php
	}
endif;
add_action( 'business_center_footer_end', 'business_center_footer_end', 100 );


if ( ! function_exists( 'business_center_back_to_top' ) ) :
	/**
	 * Back to top class .backtotop
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_back_to_top() {
		$options = business_center_get_theme_options();
		if ( $options['scroll_top_visible'] ) : ?>
        	<div class="backtotop"><i class="fa fa-angle-up fa-2x"></i></div><!--end .backtotop-->
		<?php endif;
	}
endif;
add_action( 'business_center_footer_end', 'business_center_back_to_top', 110 );


if ( ! function_exists( 'business_center_page_end' ) ) :
	/**
	 * End div id #page
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_page_end() {
		?>
		</div><!-- end #page-->
		<?php
	}
endif;
add_action( 'business_center_page_end', 'business_center_page_end', 100 );