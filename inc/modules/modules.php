<?php
/**
 * Business Center core modules.
 *
 * @package Business Center 1.0.0
 */

/**
 * Add theme structure module.
 */
require get_template_directory() . '/inc/modules/structure.php';

/**
 * Add theme menu module.
 */
require get_template_directory() . '/inc/modules/menu.php';

/**
 * Add breadcrumb module.
 */
require get_template_directory() . '/inc/modules/breadcrumb/breadcrumb-class.php';
require get_template_directory() . '/inc/modules/breadcrumb/breadcrumb.php';

/**
 * Add slider module.
 */
require get_template_directory() . '/inc/modules/slider.php';

/**
 * Add feature module.
 */
require get_template_directory() . '/inc/modules/feature.php';

/**
 * Add call to action module.
 */
require get_template_directory() . '/inc/modules/call-to-action.php';

/**
 * Add front page blog module.
 */
require get_template_directory() . '/inc/modules/front-page-blog.php';

/**
 * Add team module.
 */
require get_template_directory() . '/inc/modules/team.php';

/**
 * Add contact module.
 */
require get_template_directory() . '/inc/modules/contact.php';
