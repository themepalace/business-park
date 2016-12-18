<?php 
/**
 * Feature section
 *
 * This is the template for the content of call_to_action section
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_add_call_to_action_section' ) ) :
  /**
   * Add call_to_action section
   *
   *@since Business Center 1.0.0
   */
  function business_center_add_call_to_action_section() {
    // Check if call_to_action is enabled
    $enable_call_to_action = apply_filters( 'business_center_section_status', true, 'enable_call_to_action' );

    if ( true !== $enable_call_to_action ) {
      return false;
    }

    // Get call_to_action section details
    $section_details = array();
    $section_details = apply_filters( 'business_center_filter_call_to_action_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render call_to_action section now.
    business_center_render_call_to_action_section( $section_details );
  }
endif;
add_action( 'business_center_core_modules', 'business_center_add_call_to_action_section', 30 );


if ( ! function_exists( 'business_center_get_call_to_action_section_details' ) ) :
  /**
   * Call To Action section details.
   *
   * @since Business Center 1.0.0
   * @param array $input Call To Action section details.
   */
  function business_center_get_call_to_action_section_details( $input ) {
    $options = business_center_get_theme_options();

    // Call To Action type
    $call_to_action_content_type  = $options['call_to_action_content_type'];

    $content = array();
    switch ( $call_to_action_content_type ) {
      	
      	case 'post':
            $id = null;
            if ( isset( $options['call_to_action_post'] ) ) {
                $id = $options['call_to_action_post'];
            }
            if ( ! empty( $id ) ) {
                $id = absint( $id );
            }
          // Bail if no valid pages are selected.
          if ( empty( $id ) ) {
              return $input;
          }

          $args = array(
              'no_found_rows'  => true,
              'post_type'      => 'post',
              'p'       => $id,
          );
      	break;

      	default:
      	break;
    }
      // Fetch posts.
      $posts = get_posts( $args );

      if ( ! empty( $posts ) ) {

          foreach ( $posts as $key => $post ) {
            $post_id = $post->ID;

            $content['sub_title'] = get_the_title( $post_id );
            $content['content']   = get_the_excerpt( $post_id );
            $content['btn_url']   = get_permalink( $post_id );
            $content['btn_txt']   =  $options['call_to_action_btn_txt'];

             $img_array = null;
            if ( has_post_thumbnail( $post_id ) ) {
                $bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $content['bg_image'] = $bg_image[0];
            } else {
                $content['bg_image'] =  '';
            }
      }
    }
    
    if ( ! empty( $content ) ) {
      $input = $content;
    }
    return $input;
  }
endif;
// Call To Action section content details.
add_filter( 'business_center_filter_call_to_action_section_details', 'business_center_get_call_to_action_section_details' );


if ( ! function_exists( 'business_center_render_call_to_action_section' ) ) :
  /**
   * Start call_to_action section
   *
   * @return string Call To Action content
   * @since Business Center 1.0.0
   *
   */
   function business_center_render_call_to_action_section( $content_details = array() ) {

        $options = business_center_get_theme_options();
        if ( empty( $content_details ) ) {
          return;
        } 
        $bg_image = ( ! empty( $content_details['bg_image'] ) ) ? $content_details['bg_image'] : '';
        ?>
        <section id="join-us" class="page-section" style="background-image: url(<?php echo esc_url( $bg_image ); ?>);">
         <div class="yellow-overlay"></div>
         <div class="container">
           <header class="entry-header">
             <p class="subtitle"><?php echo esc_html( $content_details['sub_title'] ); ?></p>
           </header>
           <div class="entry-content">
             <p><?php echo wp_kses_post( $content_details['content'] ); ?></p>
               <a href="<?php echo esc_url( $content_details['btn_url'] ); ?>" class="btn btn-black"><?php echo esc_html( $content_details['btn_txt'] ); ?></a>
           </div><!--.entry-content-->
         </div><!-- .container -->
        </section><!-- #join-us-->
<?php 
    }
endif;