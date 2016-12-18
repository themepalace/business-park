<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business Center 1.0.0
 */

	/**
	 * business_center_site_content_end hook
	 *
	 * @hooked business_center_site_content_end -  100
	 *
	 */
	do_action( 'business_center_site_content_end' );


	/**
	 * business_center_footer_start hook
	 *
	 * @hooked business_center_footer_start -  10
	 *
	 */
	do_action( 'business_center_footer_start' );

	/**
	 * business_center_footer hook
	 *
	 * @hooked business_center_footer_widgets -  10
	 * @hooked business_center_copyright -  20
	 *
	 */
	do_action( 'business_center_footer' );

	/**
	 * business_center_footer_end hook
	 *
	 * @hooked business_center_footer_end -  100
	 * @hooked business_center_back_to_top -  110
	 *
	 */
	do_action( 'business_center_footer_end' );

	/**
	 * business_center_page_end hook
	 *
	 * @hooked business_center_page_end -  100
	 *
	 */
	do_action( 'business_center_page_end' );
	?>

<?php wp_footer(); ?>

</body>
</html>
