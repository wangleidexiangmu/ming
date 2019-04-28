<?php
/**
 * Templated sections init
 *
 * @package kingston
 */

/**
 * Add template hooks defaults.
 */

// slider
require get_template_directory() . '/inc/template-hooks/slider.php';

// introduction
require get_template_directory() . '/inc/template-hooks/introduction.php';

// service
require get_template_directory() . '/inc/template-hooks/service.php';

// portfolio
require get_template_directory() . '/inc/template-hooks/portfolio.php';

// testimonial
require get_template_directory() . '/inc/template-hooks/testimonial.php';

// recent
require get_template_directory() . '/inc/template-hooks/recent.php';
