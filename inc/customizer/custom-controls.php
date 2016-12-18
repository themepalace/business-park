<?php
/**
 * Customizer custom controls
 *
 * @package business_center
 * @since Business Center 1.0.0
 */


if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

//Custom control for horizontal line
class Business_Center_Customize_Horizontal_Line extends WP_Customize_Control {
	public $type = 'hr';

	public function render_content() {
		?>
		<div>
			<hr style="border: 1px dotted #72777c;" />
		</div>
		<?php
	}
}

/**
 * Multiple checkbox customize control class.
 *
 * @since  1.0.0
 * @access public
 */
class Business_Center_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'checkbox-multiple';

    /**
	 * Taxonomy.
	 *
	 * @access public
	 * @var string
	 */
	public $taxonomy = '';

    /**
     * Enqueue scripts/styles.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue() {
        wp_enqueue_script( 'business-center-customize-controls', get_template_directory_uri() . '/assets/js/unminified/customize-control.js', array( 'customize-controls' ) );
    }

    /**
     * Constructor.
     *
     * @since Business Center 1.0.0
     *
     * @param WP_Customize_Manager $manager Customizer bootstrap instance.
     * @param string               $id      Control ID.
     * @param array                $args    Optional. Arguments to override class property defaults.
     */
    public function __construct( $manager, $id, $args = array() ) {

    	$taxonomy = 'category';
    	if ( isset( $args['taxonomy'] ) ) {
    		$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
    		if ( true === $taxonomy_exist ) {
    			$taxonomy = esc_attr( $args['taxonomy'] );
    		}
    	}
    	$args['taxonomy'] = $taxonomy;
    	$this->taxonomy = esc_attr( $taxonomy );

    	parent::__construct( $manager, $id, $args );
    }

    /**
     * Displays the control content.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function render_content() {

    	$tax_args = array(
    		'hierarchical' => 0,
    		'taxonomy'     => $this->taxonomy,
    	);

    	$choices = get_categories( $tax_args );

        if ( empty( $choices ) )
            return; ?>

        <?php if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>

        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <?php endif; ?>

        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

        <ul style="height: 150px; overflow-y: scroll">
            <?php foreach ( $choices as $value ) : 
            $value_arr = ! empty(  $this->value() ) ? $this->value() : array();
            ?>
                <li>
                    <label>
                        <input type="checkbox" value="<?php echo esc_attr( $value->term_id ); ?>" <?php checked( in_array( $value->term_id, $value_arr ) ); ?> /> 
                        <?php echo esc_html( $value->name ); ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>

        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
    <?php }
}