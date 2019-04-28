<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Catch Vogue
 *
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

			<?php
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php catch_vogue_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<?php endif; ?>

		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/*translators: %s: Name of current post. Only visible to screen readers*/
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'catch-vogue' ),
					array(
						'span' => array(
							'class' => array(),
							),
						)
					),
				get_the_title()
				) );
			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'catch-vogue' ) . '</span>',
				'after'  => '</div>',
				'link_before'     => '<span>',
				'link_after'       => '</span>',
				) );
				?>
			</div> <!-- .entry-content -->

		<footer class="entry-footer">
			<div class="entry-meta">
				<?php catch_vogue_entry_footer(); ?>
			</div><!-- .entry-meta -->
			<?php catch_vogue_author_bio(); ?>
		</footer><!-- .entry-footer -->
	</div> <!-- .entry-container -->
</article><!-- #post-<?php //the_ID(); ?> -->




