<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business Center 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
	$options = business_center_get_theme_options();
	if ( ! $options['hide_featured_image'] ) {
		business_center_post_thumbnail();
	}
	?>

	<header class="entry-header">
		<?php

		if ( 'post' === get_post_type() ) : ?>
			<p class="entry-meta">
				<?php 
				business_center_posted_on();
				business_center_posted_by(); 
				?>
			</p><!-- .entry-meta -->
		<?php
		endif;

		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt();?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php business_center_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
