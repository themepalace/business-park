<?php 
/**
 * Team section
 *
 * This is the template for the content of team section
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_add_team_section' ) ) :
  /**
   * Add team section
   *
   *@since Business Center 1.0.0
   */
  function business_center_add_team_section() {
    // Check if team is enabled
    $enable_team = apply_filters( 'business_center_section_status', true, 'enable_team' );

    if ( true !== $enable_team ) {
      return false;
    }

    // Get team section details
    $section_details = array();

    $section_details = apply_filters( 'business_center_filter_team_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render team section now.
    business_center_render_team_section( $section_details );
  }
endif;
add_action( 'business_center_core_modules', 'business_center_add_team_section', 30 );


if ( ! function_exists( 'business_center_get_team_section_details' ) ) :
  /**
   * Team section details.
   *
   * @since Business Center 1.0.0
   * @param array $input Team section details.
   */
  function business_center_get_team_section_details( $input ) {
    $options = business_center_get_theme_options();

    // Team type
    $team_content_type  = $options['team_content_type'];

    $content = array();
    switch ( $team_content_type ) {
      	case 'category':
	        $cat_id = array();
	        if ( !empty( $options['team_category'] ) ) {
	            $cat_id = $options['team_category'];
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
              'posts_per_page' => 4,
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
            $content[ $i ]['name']      = get_the_title( $post_id );
            $content[ $i ]['link']      = get_permalink( $post_id );
            if ( isset( $options['custom_team_position_'.$i] ) ) {
              $content[ $i ]['position']      = $options['custom_team_position_'.$i];
            }
            $content[ $i ]['content']      = get_the_excerpt( $post_id );

            if ( has_post_thumbnail( $post_id ) ) {
                $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $img_array = $featured_img[0];
            } else {
                $img_array =  get_template_directory_uri() . '/assets/uploads/user.png';
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
// Team section content details.
add_filter( 'business_center_filter_team_section_details', 'business_center_get_team_section_details' );


if ( ! function_exists( 'business_center_render_team_section' ) ) :
  /**
   * Start team section
   *
   * @return string Team content
   * @since Business Center 1.0.0
   *
   */
   function business_center_render_team_section( $content_details = array() ) {
        $options = business_center_get_theme_options();

        if ( empty( $content_details ) ) {
          return;
        } 
        ?>
        <section id="team" class="page-section no-padding-top">
          <div class="container">
            <header class="entry-header">
              <div class="separate"></div>
              <h2 class="entry-title"><?php echo esc_html( $options['team_title'] ); ?></h2>  
            </header><!-- .entry-header -->
          </div><!-- .container -->
          <div class="entry-content four-columns">

          <?php foreach ( $content_details as $content ) { ?>
            <div class="column-wrapper">
              <div class="image-wrapper">
              <?php 
              $name = ( ! empty( $content['name'] ) ) ? $content['name'] : '';  
              $link = ( ! empty( $content['link'] ) ) ? $content['link'] : '';  
              ?>
                <img src="<?php echo esc_url( $content['img_array'][0] ); ?>" alt="<?php echo esc_attr( $name ); ?>">
                <div class="black-overlay"></div>
              </div><!-- .image-wrapper -->
              <div class="hover-content">
                <h5><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $name ); ?></a></h5>
                <?php if ( ! empty( $content['position'] ) ) { ?>
                  <small><?php echo esc_html( $content['position'] ); ?></small>
                <?php }
                if ( ! empty( $content['content'] ) ) { ?>
                  <p><?php echo esc_html( $content['content'] ); ?></p>
                <?php } ?>
              </div><!-- .hover-content -->
            </div><!-- .column-wrapper -->
          <?php } ?>
          </div><!-- .entry-content -->
          <div class="text-center">
          <?php if ( ! empty( $options['team_read_more_btn_txt'] ) ) { ?>
            <a href="<?php echo esc_url( $options['team_read_more_btn_txt_url'] );?>" class="btn btn-transparent"><?php echo esc_html( $options['team_read_more_btn_txt'] );?></a>
          <?php } ?>
          </div><!-- .text-center -->
        </section><!-- #team -->
<?php 
    }
endif;