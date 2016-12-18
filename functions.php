<?php
/**
 * Business Center functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function business_center_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Business Center, use a find and replace
	 * to change 'business-center' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'business-center', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'business-center' ),
		'social-link' => esc_html__( 'Social Link', 'business-center' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'business_center_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add custom image size
	add_image_size( 'business-center-blog', 500, 375, true ); 

	add_theme_support( 'custom-logo' );
	
	// Declare woocommerce support
	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'business_center_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_center_content_width() {

	global $content_width;
	$sidebar_position = business_center_layout();

	switch ( $sidebar_position ) {

	  case 'no-sidebar':
	    $content_width = 1170;
	    break;

	  case 'left-sidebar':
	  case 'right-sidebar':
	    $content_width = 819;
	    break;

	  default:
	    break;
	}
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1170;
	}

	$GLOBALS['content_width'] = apply_filters( 'business_center_content_width', $content_width );
}
add_action( 'after_setup_theme', 'business_center_content_width', 0 );


if ( ! function_exists( 'business_center_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function business_center_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'business-center' ) ) {
		$fonts[] = 'Open Sans:300,400,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'business-center' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Courgette, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Courgette font: on or off', 'business-center' ) ) {
		$fonts[] = 'Courgette:400';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'business-center' ) ) {
		$fonts[] = 'Roboto:400,500,300';
	}

	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'business-center' ) ) {
		$fonts[] = 'Raleway:400,100,300,500,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'business-center' ) ) {
		$fonts[] = 'Poppins:400,500,600';
	}

	/* translators: If there are characters in your language that are not supported by Josefin Slab, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Josefin Slab font: on or off', 'business-center' ) ) {
		$fonts[] = 'Josefin Slab:400,500,600';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
endif;


/**
 * Enqueue scripts and styles.
 */
function business_center_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'business-center-fonts', business_center_fonts_url(), array(), null );

	// Load font awesome css
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/plugins/css/font-awesome.min.css', '', '4.6.3' );

	// Load slick theme css
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/plugins/css/slick-theme.min.css' );

	// Load slick css
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/plugins/css/slick.min.css' );

	// Load theme style
	wp_enqueue_style( 'business-center-style', get_stylesheet_uri() );

	wp_enqueue_script( 'business-center-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true );

	// Load slick js
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/plugins/js/slick.min.js', array( 'jquery' ), '1.6.0', true );

	wp_enqueue_script( 'business-center-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	// Load custom js
	wp_enqueue_script( 'business-center-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'business_center_scripts' );

/**
 * Theme core files additions.
 */
require get_template_directory() . '/inc/core.php';
