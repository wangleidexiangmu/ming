<?php
/**
 * The template for displaying testimonial items
 *
 * @package Catch Vogue
 */
?>

<?php
$enable = get_theme_mod( 'catch_vogue_testimonial_option', 'disabled' );

if ( ! catch_vogue_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

$type = 'jetpack-testimonial';


// Get Jetpack options for testimonial.
$jetpack_defaults = array(
	'page-title' => esc_html__( 'Testimonials', 'catch-vogue' ),
);

// Get Jetpack options for testimonial.
$jetpack_options = get_theme_mod( 'jetpack_testimonials', $jetpack_defaults );
$headline        = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'catch-vogue' );

$subheadline = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';

$classes[] = 'section testimonial-wrapper';

$background = get_theme_mod( 'catch_vogue_testimonial_bg_image' );

if ( $background ) {
	$classes[] = 'has-background-image';
}

?>

<?php if ( $background ) : ?>
<div class="testimonials-content-wrapper <?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="background-image: url( <?php echo esc_url( $background ); ?> )">
<?php else : ?>
<div class="testimonials-content-wrapper <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
<?php endif; ?>
	<div class="wrapper">
		<?php if ( $headline || $subheadline ) : ?>
			<div class="section-heading-wrapper">
			<?php if ( $headline ) : ?>
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
				</div>
			<?php endif; ?>

			<?php if ( $subheadline ) : ?>
				<div class="section-description">
					<?php
					$subheadline = apply_filters( 'the_content', $subheadline );
					echo str_replace( ']]>', ']]&gt;', $subheadline );
					?>
				</div><!-- .section-description -->
			<?php endif; ?>
			</div><!-- .section-heading-wrap -->
		<?php endif; ?>

		<?php
			get_template_part( 'template-parts/testimonials/post-types', 'testimonial' );
		?>
	</div><!-- .wrapper -->
</div><!-- .testimonials-content-wrapper -->
