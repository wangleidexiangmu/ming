<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Catch Vogue
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="archive-content-wrap">
						<div class="section-heading-wrapper">
								<div class="section-title-wrapper">
									<h2 class="section-title"><?php echo esc_html__( 'Blog', 'catch-vogue' ); ?></h2>
								</div>
						</div><!-- .section-heading-wrap -->
					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php endif; ?>

						<div class="section-content-wrapper <?php echo esc_attr( catch_vogue_get_posts_columns() ); ?>">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();
								
								get_template_part( 'template-parts/content/content', get_post_format() );
							
							endwhile;
							?>
						</div> <!-- .section-content-wrapper -->

						<?php
						catch_vogue_content_nav();

					else :

						get_template_part( 'template-parts/content/content', 'none' );

					endif; ?>
				</div> <!-- .archive-content-wrap -->
			</main><!-- #main -->
		</div><!-- #primary -->
	<?php get_sidebar(); 
get_footer();
