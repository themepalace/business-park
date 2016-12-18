<?php
/**
* Customizer validation functions
*
* @package Business_Center
* @since Business Center 1.0.0
*/

/**
 * Check the value of long excerpt
 *
 * @since Business Center 1.0.0
 * @return string A source value for use
 */
function business_center_validate_excerpt( $validity, $value ){
  $value = intval( $value );
  if ( empty( $value ) || ! is_numeric( $value ) ) {
    $validity->add( 'required', __( 'You must supply a valid number.', 'business-center' ) );
  } elseif ( $value < 5 ) {
    $validity->add( 'min_no_of_words', __( 'Minimum no of words is 5', 'business-center' ) );
  } elseif ( $value > 100 ) {
    $validity->add( 'max_no_of_words', __( 'Maximum no of words is 100', 'business-center' ) );
  }
  return $validity;
}
