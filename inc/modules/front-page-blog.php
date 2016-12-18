<?php 
/**
 * Front Page Blog section
 *
 * This is the template for the content of front_page_blog section
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_add_front_page_blog_section' ) ) :
  /**
   * Add front_page_blog section
   *
   *@since Business Center 1.0.0
   */
  function business_center_add_front_page_blog_section() {
    // Check if front_page_blog is enabled
    $enable_front_page_blog = apply_filters( 'business_center_section_status', true, 'enable_front_page_blog' );

    if ( true !== $enable_front_page_blog ) {
      return false;
    }

    // Get front_page_blog section details
    $section_details = array();

    $section_details = apply_filters( 'business_center_filter_front_page_blog_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render front_page_blog section now.
    business_center_render_front_page_blog_section( $section_details );
  }
endif;
add_action( 'business_center_core_modules', 'business_center_add_front_page_blog_section', 30 );


if ( ! function_exists( 'business_center_get_front_page_blog_section_details' ) ) :
  /**
   * Front Page Blog section details.
   *
   * @since Business Center 1.0.0
   * @param array $input Front Page Blog section details.
   */
  function business_center_get_front_page_blog_section_details( $input ) {
    $options = business_center_get_theme_options();

    // Front Page Blog type
    $front_page_blog_content_type  = $options['front_page_blog_content_type'];

    $content = array();
    switch ( $front_page_blog_content_type ) {
      	
      	case 'category':
	        $cat_id = array();
	        if ( !empty( $options['front_page_blog_category'] ) ) {
	            $cat_id = $options['front_page_blog_category'];
	        }

	        // Bail if no valid pages are selected.
	        if ( ! empty( $cat_id ) ) {
	            $cat_id =  (array)$cat_id;
	        }

	        $args = array(
              'no_found_rows'  => true,
              'post_type'      => 'post',
              'posts_per_page' => 3,
              'orderby'        => 'ASC',
	        );
          if ( ! empty( $cat_id ) ) {
            $args['category__in'] = $cat_id;
          }
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
            $content[ $i ]['post_url'] = get_permalink( $post_id );
            $content[ $i ]['content'] = get_the_excerpt( $post_id );
            $content[ $i ]['btn_txt']   = $options['front_page_blog_posts_read_more_btn_txt'];
            $content[ $i ]['btn_txt_url']   = $options['front_page_blog_posts_read_more_btn_txt_url'];
            $content[ $i ]['date']   =  get_the_date( get_option( 'date_format' ), $post_id );

            if ( has_post_thumbnail( $post_id ) ) {
                $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'business-center-blog' );
                $img_array = $featured_img[0];
            } else {
                $img_array = '';
            }

            if ( isset( $img_array ) ) {
              $content[$i]['img_array'][0] = $img_array;
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
// Front Page Blog section content details.
add_filter( 'business_center_filter_front_page_blog_section_details', 'business_center_get_front_page_blog_section_details' );


if ( ! function_exists( 'business_center_render_front_page_blog_section' ) ) :
  /**
   * Start front_page_blog section
   *
   * @return string Front Page Blog content
   * @since Business Center 1.0.0
   *
   */
   function business_center_render_front_page_blog_section( $content_details = array() ) {
        $options = business_center_get_theme_options();

        if ( empty( $content_details ) ) {
          return;
        } 
        ?>
        <section id="blog-posts" class="page-section">
          <div class="container">
            <header class="entry-header">
              <div class="separate"></div>
              <?php if ( ! empty( $options['front_page_blog_title'] ) ) { ?>
                <h2 class="entry-title"><?php echo esc_html( $options['front_page_blog_title'] );?></h2>  
              <?php } ?>
            </header><!-- .entry-header -->

            <div class="entry-content three-columns">
              <?php foreach ($content_details as $content ) { ?>
                <div class="column-wrapper">
                  <?php if ( ! empty( $content['img_array'][0] ) ) { ?>
                    <div class="image-wrapper">
                      <a href="<?php echo esc_url( $content['post_url'] ); ?>"><img src="<?php echo esc_url( $content['img_array'][0] );?>" alt="<?php echo esc_attr( $content['title'] );?>"></a>
                    </div><!-- .image-wrapper -->
                  <?php } ?>
                  <div class="post-wrapper">
                    <div class="post-title">
                      <a href="<?php echo esc_url( $content['post_url'] ); ?>"><time datetime="<?php echo date_i18n( get_option( 'date_format' ), strtotime( $content['date'] ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $content['date'] ) ); ?></time></a>
                      <h5><a href="<?php echo esc_url( $content['post_url'] ); ?>"><?php echo esc_html( $content['title'] );?></a></h5>
                    </div><!-- .post-title -->
                    <?php if ( ! empty( $content['content'] ) ) { ?>
                      <div class="post-desc">
                        <?php echo wp_kses_post( $content['content'] ); ?>
                      </div><!-- .post-desc -->
                    <?php } ?>
                  </div><!-- .post-wrapper -->
                </div><!-- .column-wrapper -->
              <?php } ?>
              </div><!-- .entry-content -->
              <?php if ( ! empty( $options['front_page_blog_posts_read_more_btn_txt'] ) ) { ?>
                <a href="<?php echo esc_url( $options['front_page_blog_posts_read_more_btn_txt_url'] ); ?>" class="btn btn-transparent"><?php echo esc_html( $options['front_page_blog_posts_read_more_btn_txt'] ); ?></a>
              <?php } ?>
          </div><!-- .container -->
        </section><!-- #blog-posts -->
<?php 
    }
endif;