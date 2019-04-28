<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Catch Vogue
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php catch_vogue_single_image(); ?>

	<div class="entry-container">
		<?php
		$header_image = catch_vogue_featured_overall_image();

		if ( ! $header_image ) : ?>

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			<div class="entry-meta">
				<?php catch_vogue_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<?php endif; ?>

		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'catch-vogue' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<div class="entry-meta">
					<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'catch-vogue' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
					?>
				</div> <!-- .entry-meta -->
			</footer><!-- .entry-footer -->
		<?php endif; ?>
		</div> <!-- .entry-container -->
</article><!-- #post-<?php the_ID(); ?> -->
