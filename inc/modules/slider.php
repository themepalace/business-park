<?php 
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package business_center
 * @since Business Center 1.0.0
 */
if ( ! function_exists( 'business_center_add_slider_section' ) ) :
  /**
   * Add slider section
   *
   *@since Business Center 1.0.0
   */
  function business_center_add_slider_section() {
    // Check if slider is enabled
    $enable_slider = apply_filters( 'business_center_section_status', true, 'enable_slider' );

    if ( true !== $enable_slider ) {
      return false;
    }

    // Get slider section details
    $section_details = array();
    $section_details = apply_filters( 'business_center_filter_slider_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render slider section now.
    business_center_render_slider_section( $section_details );
  }
endif;
add_action( 'business_center_core_modules', 'business_center_add_slider_section', 20 );


if ( ! function_exists( 'business_center_get_slider_section_details' ) ) :
  /**
   * Slider section details.
   *
   * @since Business Center 1.0.0
   * @param array $input Slider section details.
   */
  function business_center_get_slider_section_details( $input ) {
    $options = business_center_get_theme_options();

    // Slider type
    $slider_content_type  = $options['slider_content_type'];

    $content = array();
    switch ( $slider_content_type ) {
      	case 'page':
          $ids = array();
          for ( $i = 1; $i <= 3; $i++ ) {
              $id = null;
              if ( isset( $options[ 'slider_page_'.$i ] ) ) {
                  $id = $options[ 'slider_page_'.$i ];
              }
              if ( ! empty( $id ) ) {
                  $ids[] = absint( $id );
              }
          }
          // Bail if no valid pages are selected.
          if ( empty( $ids ) ) {
              return $input;
          }

	        $args = array(
	            'no_found_rows'  => true,
	            'orderby'        => 'post__in',
	            'post_type'      => 'page',
	            'post__in'       => $ids,
	        );
      	break;

      	default:
      	break;
    }

      // Fetch posts.
    $posts = get_posts( $args );

    if ( ! empty( $posts ) ) {

        $i = 1;
        foreach ( $posts as $key => $post ) {
            $page_id = $post->ID;
            $img_array = null;
          if ( has_post_thumbnail( $page_id ) ) {
              $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
          } else {
              $img_array[0] =  get_template_directory_uri() . '/assets/uploads/no-featured-image-1300x600.jpg';
          }

          if ( isset( $img_array ) ) {
            $content[$i]['img_array'] = $img_array;
          }

          $content[ $i ]['url']         = get_permalink( $page_id );
          if ( isset( $options['slider_btn_text_'.$i] ) ) {
            $content[ $i ]['button_text'] = $options['slider_btn_text_'. $i];
          }
          $content[ $i ]['title']       = get_the_title( $page_id );
          $content[ $i ]['alt']         = get_the_title( $page_id );
          if ( isset( $options['slider_video_link_'.$i] ) ) {
            $content[ $i ]['video_link']  = $options['slider_video_link_'.$i];
          }

          $i++;
        }
    }

    if ( ! empty( $content ) ) {
      $input = $content;
    }
    return $input;
  }
endif;
// Slider section content details.
add_filter( 'business_center_filter_slider_section_details', 'business_center_get_slider_section_details' );


if ( ! function_exists( 'business_center_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string Slider content
   * @since Business Center 1.0.0
   *
   */
   function business_center_render_slider_section( $content_details = array() ) {
        $options                 = business_center_get_theme_options();
        $slider_effect           = ( $options['slider_transition'] == 'fade' ) ? 'linear' : $options['slider_transition'];
        $slider_fade             = ( $options['slider_transition'] == 'fade' ) ? 'true' : 'false';
        $enable_slider_pager     = ( $options['enable_slider_pager'] ) ? 'true' : 'false';
        $enable_slider_autoplay  = ( $options['enable_slider_autoplay'] ) ? 'true' : 'false';
        $slider_speed            = $options['slider_speed'];

        if ( empty( $content_details ) ) {
          return;
        } 
        ?>
        <section id="main-slider" class="featured-slider">
	        <div class="regular" 
	        data-effect="<?php echo esc_attr( $slider_effect ); ?>" 
	        data-slick='{
		        	"slidesToShow": 1, 
		        	"slidesToScroll": 1, 
		        	"infinite": false, 
		        	"speed": <?php echo absint( $slider_speed ); ?>, 
		        	"dots": <?php echo esc_attr( $enable_slider_pager ); ?>, 
		        	"arrows":true, 
		        	"autoplay": <?php echo esc_attr( $enable_slider_autoplay ); ?>, 
		        	"fade": <?php echo esc_attr( $slider_fade ); ?>, 
		        	"draggable": false 
	        	}'>

                <?php foreach ( $content_details as $content ): ?>
		          	<div class="slider-item">
			            <a href="<?php echo ( ! empty( $content['url'] ) ) ? esc_url( $content['url'] ) : '';?>">
                    <img src="<?php echo esc_url( $content['img_array'][0] );?>" alt="">
			              <div class="black-overlay"></div>
                  </a>
                  <?php if( $options['enable_slider_caption'] ) :  ?>
			              <div class="main-slider-contents">
                      <?php if ( ! empty( $content['title'] ) ) { ?>
			                 <h2 class="title"><?php echo esc_html( $content['title'] );?></h2>  
                      <?php } ?>
			                <a href="<?php echo ( ! empty( $content['url'] ) ) ? esc_url( $content['url'] ) : '';?>" class="btn btn-yellow">
                        <?php echo ( ! empty( $content['button_text'] ) ) ? esc_html( $content['button_text'] ) : '';?>
                      </a>
                      <?php if ( ! empty( $content['video_link'] ) ) { ?>
                        <div class="video-link">
                          <a href="<?php echo ( ! empty( $content['video_link'] ) ) ? esc_url( $content['video_link'] ) : ''; ?>" target="_blank">
                            <div class="play-video"><i class="fa fa-play"></i></div>
                          </a>
                        </div><!-- .play-video -->
                      <?php } ?>
			            </div><!-- end .main-slider-contents -->
                <?php endif; ?>
		          	</div><!-- end .slider-item -->
                <?php endforeach; ?>
            </div><!-- end .regular -->
	    </section><!-- #main-slider -->          
<?php 
    }
endif;