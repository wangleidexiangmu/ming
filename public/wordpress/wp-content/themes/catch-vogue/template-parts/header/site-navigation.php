<?php
/**
 * Primary Menu Template
 *
 * @package Catch Vogue
 */

?>
<div id="site-header-menu" class="site-header-menu">
	<div id="primary-menu-wrapper" class="menu-wrapper">

		<div class="header-overlay"></div>

		<div class="menu-toggle-wrapper">
			<button id="menu-toggle" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
				<div class="menu-bars">
					<div class="bars bar1"></div>
	  				<div class="bars bar2"></div>
	  				<div class="bars bar3"></div>
  				</div>
				<span class="menu-label"><?php echo esc_html_e( 'Menu', 'catch-vogue' ); ?></span>
			</button>
		</div><!-- .menu-toggle-wrapper -->

		<div class="menu-inside-wrapper">

				<?php get_template_part( 'template-parts/header/header', 'navigation' ); ?>
		</div><!-- .menu-inside-wrapper -->
	</div><!-- #primary-menu-wrapper.menu-wrapper -->

</div><!-- .site-header-menu -->

<div class="search-social-container">
	<div id="primary-search-wrapper">
			<div class="search-container">
				<?php get_Search_form(); ?>
			</div>
	</div><!-- #primary-search-wrapper -->

<?php get_template_part( 'template-parts/header/social', 'header' ); ?>
</div> <!-- .search-social-container -->

<?php
	if( function_exists( 'catch_vogue_header_cart' ) ) {
		catch_vogue_header_cart();
	}
?>
