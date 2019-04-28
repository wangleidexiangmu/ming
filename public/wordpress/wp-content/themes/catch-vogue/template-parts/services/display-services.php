<?php
/**
 * The template for displaying services content
 *
 * @package Catch Vogue
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_vogue_service_option', 'disabled' );

if ( ! catch_vogue_check_section( $enable_content ) ) {
	// Bail if services content is disabled.
	return;
}

$services_posts = catch_vogue_get_services_posts();

if ( empty( $services_posts ) ) {
	return;
}



$title    = get_option( 'ect_service_title', esc_html__( 'Services', 'catch-vogue' ) );
$subtitle = get_option( 'ect_service_content' );


$classes[] = 'services-section';
$classes[] = 'section';

if ( ! $title && ! $subtitle ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="services-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( '' !== $title || $subtitle ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( '' !== $title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $subtitle ) : ?>
					<div class="section-description">
						<?php
						$subtitle = apply_filters( 'the_content', $subtitle );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $subtitle ) );
						?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<?php

		$wrapper_classes[] = 'section-content-wrapper';

		$wrapper_classes[] = 'layout-three';
		?>

		<div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>">
			<?php
			
			foreach ( $services_posts as $post ) {
				setup_postdata( $post );

				// Include the services content template.
				get_template_part( 'template-parts/services/content', 'services' );
			}

			wp_reset_postdata();
			
			?>
		</div><!-- .services-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #services-section -->
