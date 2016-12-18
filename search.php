<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Business Center 1.0.0
 */

get_header(); ?>

<div class="container page-section">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'business-center' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			/**
			 * business_center_pagination hook
			 *
			 * @hooked business_center_pagination -  10
			 *
			 */
			do_action( 'business_center_pagination' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php if ( is_active_sidebar( 'business-center-search' ) ) { ?>
		<aside id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'business-center-search' ); ?>
		</aside>
	<?php } ?>
</div>
<?php
get_footer();
