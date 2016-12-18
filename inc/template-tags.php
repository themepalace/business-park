<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function business_center_posted_on() {
	$options = business_center_get_theme_options();

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<span class="screen-reader-text">' . __( 'Posted on', 'business-center' ) . '</span>' . $time_string;

	if( ! $options['hide_date'] ){
		echo '<span class="posted-on">' . $posted_on . '</span>';
	}

}
endif;


if ( ! function_exists( 'business_center_posted_by' ) ) :
/**
 * Prints HTML with meta information for author.
 */
function business_center_posted_by() {
	$options = business_center_get_theme_options();

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'business-center' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	if( ! $options['hide_author'] ){
		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}

}
endif;

if ( ! function_exists( 'business_center_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function business_center_entry_footer() {
	$options = business_center_get_theme_options();

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		if ( ! $options['hide_category'] ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'business-center' ) );
			if ( $categories_list && business_center_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'business-center' ) . '</span> ', $categories_list ); // WPCS: XSS OK.
			}
		}

		if ( ! $options['hide_tags'] ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'business-center' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'business-center' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span> ', 'business-center' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'business-center' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function business_center_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'business_center_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'business_center_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so business_center_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so business_center_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'business_center_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own business_center_post_thumbnail() function to override in a child theme.
 *
 * @since Business Center 1.0.0
 */
function business_center_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<?php the_post_thumbnail(); ?>

	<?php else : ?>
	<div class="image-wrapper">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail( 'business-center-blog', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
		</a><!-- .post-thumbnail -->
	</div><!-- .image-wrapper -->

	<?php endif; // End is_singular()
}
endif;

/**
 * Flush out the transients used in business_center_categorized_blog.
 */
function business_center_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'business_center_categories' );
}
add_action( 'edit_category', 'business_center_category_transient_flusher' );
add_action( 'save_post',     'business_center_category_transient_flusher' );
