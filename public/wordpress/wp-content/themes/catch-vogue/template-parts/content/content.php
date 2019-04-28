<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Catch Vogue
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php 
				$columns = catch_vogue_get_posts_columns();
				$thumbnail = 'post-thumbnail';

				if ( 'layout-one' === $columns ) {
					$thumbnail = 'catch-vogue-blog';
					$layout  = catch_vogue_get_theme_layout();
				
					if ( 'no-sidebar-full-width' === $layout ) {
						$thumbnail = 'catch-vogue-slider';
					}
				}

				the_post_thumbnail( $thumbnail ); 
				?>
			</a>
		</div>
		<?php endif; ?>

		<div class="entry-container">
			<?php if ( is_sticky() ) : ?>
			<span class="sticky-label"><?php esc_html_e( 'Featured', 'catch-vogue' ); ?></span>
			<?php endif; ?>

			<header class="entry-header">
				<?php
				if ( 'post' === get_post_type() ) :
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
				endif; ?>
			</header><!-- .entry-header -->


			<?php
				echo '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->'; ?>

				<div class="entry-footer">
					<div class="entry-meta entry-meta-left">
						<?php catch_vogue_blog_entry_meta_left(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-meta entry-meta-right">
						<?php catch_vogue_blog_entry_meta_right(); ?>
					</div><!-- .entry_category -->
				</div><!-- .entry-footer -->
		

		</div> <!-- .entry-container -->
	</div> <!-- .hentry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
