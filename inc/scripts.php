<?php
/**
 * Theme inline styles and javascripts
 *
 * @package Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_inline_css' ) ) :
	// Add Custom Css
	function business_center_inline_css() {
		$options = business_center_get_theme_options();

		$css = '';
		
		// Custom header style
		$cusotm_header_style = '';
		$header_text_color = get_header_textcolor();
		if ( HEADER_TEXTCOLOR != $header_text_color ) {
			if ( ! display_header_text() ) :
				$cusotm_header_style = '
				.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}';
			else :
				$cusotm_header_style = '
				#site-header .site-title a,
				.site-description {
					color: #' . esc_attr( $header_text_color ). ';
				}';
			endif;
		}

		$css .= $cusotm_header_style;
		wp_add_inline_style( 'business-center-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'business_center_inline_css', 10 );

if ( ! function_exists( 'business_center_add_inline_scripts' ) ) :
	function business_center_add_inline_scripts() {
		$options = business_center_get_theme_options();

		$fixed_menu_script = '';
		if ( $options['make_menu_sticky'] ) {
	   		$fixed_menu_script = '
	   			( function( $ ) {
	   				$(window).scroll(function(){
				        if ($(this).scrollTop() > 1)
				          $(".nav-shrink #masthead").addClass("is-sticky");
				        else
				          $(".nav-shrink #masthead").removeClass("is-sticky");
				    });
				} )( jQuery );';
		}
		$script = $fixed_menu_script;
	   	wp_add_inline_script( 'business-center-custom', $script );
	}
endif;
add_action( 'wp_enqueue_scripts', 'business_center_add_inline_scripts' );