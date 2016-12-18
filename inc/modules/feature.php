<?php 
/**
 * Feature section
 *
 * This is the template for the content of feature section
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_add_feature_section' ) ) :
  /**
   * Add feature section
   *
   *@since Business Center 1.0.0
   */
  function business_center_add_feature_section() {
    // Check if feature is enabled
    $enable_feature = apply_filters( 'business_center_section_status', true, 'enable_feature' );

    if ( true !== $enable_feature ) {
      return false;
    }

    // Get feature section details
    $section_details = array();

    $section_details = apply_filters( 'business_center_filter_feature_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render feature section now.
    business_center_render_feature_section( $section_details );
  }
endif;
add_action( 'business_center_core_modules', 'business_center_add_feature_section', 30 );


if ( ! function_exists( 'business_center_get_feature_section_details' ) ) :
  /**
   * Features section details.
   *
   * @since Business Center 1.0.0
   * @param array $input Features section details.
   */
  function business_center_get_feature_section_details( $input ) {
    $options = business_center_get_theme_options();

    // Features type
    $feature_content_type  = $options['feature_content_type'];

    $content = array();
    switch ( $feature_content_type ) {

      	case 'category':
	        $cat_id = array();
	        if ( !empty( $options['feature_category'] ) ) {
	            $cat_id = $options['feature_category'];
	        }

	        // Bail if no valid pages are selected.
	        if ( empty( $cat_id ) ) {
	            return $input;
	        }else{
	            $cat_id =  (array)$cat_id;
	        }
	        $args = array(
              'no_found_rows'  => true,
              'category__in'   => $cat_id,
              'post_type'      => 'post',
              'posts_per_page' => 5,
              'orderby'        => 'ASC',
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
            $post_id = $post->ID;

            $content[ $i ]['title'] = get_the_title( $post_id );
            $content[ $i ]['url']   = get_permalink( $post_id );
             $img_array = null;
            if ( has_post_thumbnail( $post_id ) ) {
                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            } else {
                $img_array[0] =  get_template_directory_uri() . '/assets/uploads/no-featured-image-1300x600.jpg';
            }

            if ( isset( $img_array ) ) {
              $content[$i]['img_array'] = $img_array;
            }

            if ( 'fa-icon' == $options['feature_icon_type'] && !empty( $options['feature_fa_icon_'.$i] ) ) {
              $content[ $i ]['fa_icon']      = $options['feature_fa_icon_'.$i];
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
// Features section content details.
add_filter( 'business_center_filter_feature_section_details', 'business_center_get_feature_section_details' );


if ( ! function_exists( 'business_center_render_feature_section' ) ) :
  /**
   * Start feature section
   *
   * @return string Features content
   * @since Business Center 1.0.0
   *
   */
   function business_center_render_feature_section( $content_details = array() ) {
        $options = business_center_get_theme_options();

        if ( empty( $content_details ) ) {
          return;
        } 
        ?>
       <section id="features">
         <div class="entry-content two-columns">
           <div class="column-wrapper featured-images-list">
              <?php 
              $j = 0;

              foreach( $content_details as $content ) {
                $class = '';
                if ( $j == 0 ) {
                  $class = 'active';
                } 
                ?>
                <a href="<?php echo ( ! empty( $content['url'] ) ) ? esc_url( $content['url'] ) : '';?>" class="feature-image <?php echo esc_attr( $class );?>">
                  <img src="<?php echo esc_url( $content['img_array'][0] );?>" alt="<?php echo ( ! empty( $content['title'] ) ) ? esc_attr( $content['title'] ) : '';?>">
                </a>
                <?php $j++; 
              } ?>
           </div><!-- .column-wrapper-->
           <div class="column-wrapper">
             <ul class="features-list clear three-columns">

              <?php 
              $k = 0;
              foreach( $content_details as $content ) {
                $class = '';
                if ( $k == 0 ) {
                  $class = 'active';
                } 
                ?>
               <li>
                 <a href="<?php echo ( ! empty( $content['url'] ) ) ? esc_attr( $content['url'] ) : ''; ?>" class="<?php echo esc_attr( $class );?>">
                   <div class="feature-item">
                    <?php if ( 'category' == $options['feature_content_type'] && 'fa-icon' == $options['feature_icon_type'] ) { ?>
                      <i class="fa <?php echo ( ! empty( $content['fa_icon'] ) ) ? esc_attr( $content['fa_icon'] ) : '';?>"></i>
                    <?php }
                    if ( ! empty( $content['title'] ) ) { ?>
                      <span><?php echo esc_html( $content['title'] ); ?></span>
                    <?php } ?>
                   </div><!-- .feature-item -->
                 </a>
               </li>
                <?php
                $k++;
               } 
               if ( ! empty( $options['custom_feature_view_more_text'] ) ) { ?>
              <li>
                <a href="<?php echo ( ! empty( $options['custom_feature_view_more_link'] ) ) ? esc_url( $options['custom_feature_view_more_link'] ) : ''; ?>">
                  <div class="feature-item">
                    <span class="more-features view-more">
                      <?php echo ( ! empty( $options['custom_feature_view_more_text'] ) ) ? esc_html( $options['custom_feature_view_more_text'] ) : '';?>
                    </span>
                  </div><!-- .feature-item -->
                </a>
              </li>
              <?php  } ?>
             </ul>
           </div><!-- .column-wrapper-->  
         </div><!-- .entry-content -->
       </section><!-- #features -->
<?php 
    }
endif;