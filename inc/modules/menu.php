<?php
/**
 * Menu
 *
 * This is the template for all registered menus
 *
 * @package Theme Palace
 * @subpackage business_center
 * @since Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_navigation' ) ) :
	/**
	 * Add primary menu
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_navigation() {
		?>
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
	        	<button class="menu-toggle">
	            <span class="menu-icon">
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
		          </span><!-- .menu-icon -->
		        </button><!-- .menu-toggle -->
		        <div class="menu-close"><i class="fa fa-close"></i></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'ul', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
        <?php 
        endif;
	}
endif;
add_action( 'business_center_header', 'business_center_navigation', 20 );

if ( ! function_exists( 'business_center_social_menu' ) ) :
	/**
	 * Add social menu
	 *
	 * @since Business Center 1.0.0
	 *
	 */
	function business_center_social_menu() {
		if ( has_nav_menu( 'social-link' ) ) : 
			 wp_nav_menu( array( 
			                    'theme_location' => 'social-link', 
			                    'container_class' => 'social-menu', 
			                    'container_id' => 'social-menu-1', 
			                    'menu_id' => 'primary-menu'
			                   ) );
        endif;
	}
endif;
add_action( 'business_center_footer_start', 'business_center_social_menu', 20 );