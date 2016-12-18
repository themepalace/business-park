<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business Center 1.0.0
 */

get_header(); ?>
<div class="container page-section">
	<div id="primary" class="content-area three-columns">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			echo '<div class="row">';

			/* Start the Loop */
			$i = 0;
			while ( have_posts() ) : the_post();
				if ( $i % 3 == 0 ) {
					echo '</div><div class="row">';
				}

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

				$i++;
			endwhile;
			echo "</div>";

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
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();