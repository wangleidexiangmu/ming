<?php
/**
 * The template for displaying featured content
 *
 * @package Catch Vogue
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_vogue_logo_slider_option', 'disabled' );

if ( ! catch_vogue_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$title     = get_theme_mod( 'catch_vogue_logo_slider_title', esc_html__( 'Logo Slider', 'catch-vogue' ) );
$sub_title = get_theme_mod( 'catch_vogue_logo_slider_sub_title' );
?>

<div id="clients-section" class="section page">
	<div class="wrapper">
		<?php if ( '' !== $title || $sub_title ) : ?>
			<div class="section-heading-wrapper clients-section-headline">
				<?php if ( '' !== $title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description">
						<?php echo wp_kses_post( $sub_title ); ?>
					</div><!-- .taxonomy-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper clients-content-wrapper">

			<div class="controller">
			    <!-- prev link -->


			    <div id="logo-slider-prev" class="cycle-prev fa fa-angle-left" aria-label="<?php esc_attr_e( 'Previous', 'catch-vogue' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Previous Slide', 'catch-vogue' ); ?></span></div>

			    <!-- empty element for pager links -->
			    <div id="logo-slider-pager" class="cycle-pager"></div>

			    <!-- next link -->


			    <div id="logo-slider-next" class="cycle-next fa fa-angle-right" aria-label="<?php esc_attr_e( 'Next', 'catch-vogue' ); ?>" aria-hidden="true"><span class="screen-reader-text"><?php esc_html_e( 'Next Slide', 'catch-vogue' ); ?></span></div>

			</div><!-- #controller-->

			<div class="cycle-slideshow"
			data-cycle-log="false"
			data-cycle-pause-on-hover="true"
			data-cycle-swipe="true"
			data-cycle-auto-height=container
			data-cycle-fx=carousel
			data-cycle-loader=false
			data-cycle-slides="> article"
			data-cycle-carousel-fluid="true"
			data-cycle-prev= .cycle-prev
			data-cycle-next= .cycle-next
			data-cycle-pager="#logo-slider-pager"
			data-cycle-prev="#logo-slider-prev"
			data-cycle-next="#logo-slider-next"
			data-cycle-slides="> .post-slide"
			data-cycle-carousel-visible=<?php echo absint( get_theme_mod( 'catch_vogue_logo_slider_visible_items', 5 ) ); ?>
			>
				<?php get_template_part( 'template-parts/logo-slider/post-types', 'logo-slider' ); ?>
			</div><!-- .cycle-slideshow -->
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #clients-section -->
