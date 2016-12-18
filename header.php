<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business Center 1.0.0
 */

/**
 * business_center_doctype hook
 *
 * @hooked business_center_doctype -  10
 *
 */
do_action( 'business_center_doctype' );

?>
<head>
	<?php
		/**
		 * business_center_before_wp_head hook
		 *
		 * @hooked business_center_wp_head -  10
		 *
		 */
		do_action( 'business_center_before_wp_head' );

		wp_head(); 
	?>
</head>

<body <?php body_class(); ?>>
	<?php
	/**
	 * business_center_loader hook
	 *
	 * @hooked business_center_loader -  10
	 *
	 */
	do_action( 'business_center_loader' );

	/**
	 * business_center_page_start hook
	 *
	 * @hooked business_center_page_start -  10
	 *
	 */
	do_action( 'business_center_page_start' );

	/**
	 * business_center_header_start hook
	 *
	 * @hooked business_center_header_start       - 10
	 *
	 */
	do_action( 'business_center_header_start' );

	/**
	 * business_center_header hook
	 *
	 * @hooked business_center_site_branding       - 10
	 * @hooked business_center_navigation       - 20
	 *
	 */
	do_action( 'business_center_header' );

	/**
	 * business_center_header_end hook
	 *
	 * @hooked business_center_header_end       - 100
	 * @hooked business_center_search_result       - 110
	 *
	 */
	do_action( 'business_center_header_end' );

	/**
	 * business_center_site_content_start hook
	 *
	 * @hooked business_center_site_content_start -  10
	 *
	 */
	do_action( 'business_center_site_content_start' );
	
	/**
	 * business_center_custom_header hook
	 *
	 * @hooked business_center_display_custom_header -  10
	 *
	 */
	do_action( 'business_center_custom_header' );

	/**
	 * business_center_core_modules hook
	 *
	 * @hooked business_center_breadcrumb -  10
	 * @hooked business_center_slider -  20
	 *
	 */
	do_action( 'business_center_core_modules' );