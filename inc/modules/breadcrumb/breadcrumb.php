<?php 
if ( ! function_exists( 'business_center_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since Business Center 1.0.0
	 */
	function business_center_breadcrumb() {
		$options = business_center_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		if ( ( ! is_home() && is_front_page() ) && false == $options['breadcrumb_show_on_front'] ) {
			return;
		}
		echo '<section id="breadcrumb-list">
	            <div class="container">';
				
				$args = array(
					'container'       => 'nav',
					'before'          => '',
					'after'           => '',
					'show_on_front'   => boolval( $options['breadcrumb_show_on_front'] ),
					'network'         => false,
					'show_title'      => true,
					'show_browse'     => true,
					'labels'          => array(
						'browse' => __( 'Browse', 'business-center' ),
					),
					'post_taxonomy'   => array(),
					'echo'            => true,
				);
				breadcrumb_trail( $args );      

		echo 	'</div><!-- .container -->
          	</section><!-- end #breadcrumb-list -->';
		return;
	}
endif;

add_action( 'business_center_core_modules', 'business_center_breadcrumb' , 25 );