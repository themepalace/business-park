<?php 
/**
 * Contact section
 *
 * This is the template for the content of contact section
 *
 * @package business_center
 * @since Business Center 1.0.0
 */

if ( ! function_exists( 'business_center_add_contact_section' ) ) :
  /**
   * Add contact section
   *
   *@since Business Center 1.0.0
   */
  function business_center_add_contact_section() {
    // Check if contact is enabled
    $enable_contact = apply_filters( 'business_center_section_status', true, 'enable_contact' );

    if ( true !== $enable_contact ) {
      return false;
    }

    // Render contact section now.
    business_center_render_contact_section();
  }
endif;
add_action( 'business_center_site_content_end', 'business_center_add_contact_section', 10 );


if ( ! function_exists( 'business_center_render_contact_section' ) ) :
  /**
   * Start contact section
   *
   * @return string Contact content
   * @since Business Center 1.0.0
   *
   */
   function business_center_render_contact_section() {
      $options = business_center_get_theme_options();
        ?>
        <section id="contact-form">
            <div class="two-columns clear">
                <div class="column-wrapper">
                  <div class="fixed-bg" style="background-image:url( <?php echo get_template_directory_uri(). '/assets/uploads/contact-us-bg.jpg' ?> )"></div>
                </div><!-- .column-wrapper -->
              <div class="column-wrapper">
                <header class="entry-header">
                  <div class="separate"></div>
                    <?php if ( ! empty( $options['contact_title'] ) ) { ?>
                      <h2 class="entry-title"><?php echo esc_html( $options['contact_title'] ); ?></h2>  
                    <?php } ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                  <?php if ( ! empty( $options['custom_contact_form_shortcode'] ) ) { ?>
                    <div role="form" class="wpcf7" id="wpcf7-f21-p2-o1" lang="en-US" dir="ltr">
                        <?php echo do_shortcode( wp_kses_post( $options['custom_contact_form_shortcode'] ) ); ?>
                    </div><!-- .wpcf7 -->
                  <?php } ?>
                </div><!-- .entry-content -->
              </div><!-- .column-wrapper -->
            </div><!-- .container -->
        </section><!-- #contact-form -->
<?php 
    }
endif;