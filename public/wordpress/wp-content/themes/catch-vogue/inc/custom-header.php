<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Catch Vogue
 */

// For registration of custom-header, check customizer/header-background-color.php


if ( ! function_exists( 'catch_vogue_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see catch_vogue_custom_header_setup().
	 */
	function catch_vogue_header_style() {
		$header_textcolor = get_header_textcolor();

		$header_image = catch_vogue_featured_overall_image();

		if ( $header_image ) : ?>
			<style type="text/css" rel="header-image">
				.custom-header:before {
					background-image: url( <?php echo esc_url( $header_image ); ?>);
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
				}
			</style>
		<?php
		endif;

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( '#ffffff' === $header_textcolor ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a {
				color: #<?php echo esc_attr( $header_textcolor ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

if ( ! function_exists( 'catch_vogue_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own catch_vogue_featured_image(), and that function will be used instead.
	 *
	 * @since Catch Vogue 1.0
	 */
	function catch_vogue_featured_image() {
		$thumbnail = is_front_page() ? 'catch-vogue-header-inner' : 'catch-vogue-slider';

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

			if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {
				$image = wp_get_attachment_image_src( (int) $jetpack_options['featured-image'], $thumbnail );
				return $image[0];
			} else {
				return false;
			}
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) || is_post_type_archive( 'featured-content' ) || is_post_type_archive( 'ect-service' ) ) {
			$option = '';

			if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
				$option = 'jetpack_portfolio_featured_image';
			} elseif ( is_post_type_archive( 'featured-content' ) ) {
				$option = 'featured_content_featured_image';
			} elseif ( is_post_type_archive( 'ect-service' ) ) {
				$option = 'ect_service_featured_image';
			}

			$featured_image = get_option( $option );

			if ( '' !== $featured_image ) {
				$image = wp_get_attachment_image_src( (int) $featured_image, $thumbnail );
				return $image[0];
			} else {
				return get_header_image();
			}
		} elseif ( is_header_video_active() && has_header_video() ) {
			return true;
		} else {
			return get_header_image();
		}
	} // catch_vogue_featured_image
endif;

if ( ! function_exists( 'catch_vogue_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own catch_vogue_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Catch Vogue 1.0
	 */
	function catch_vogue_featured_page_post_image() {
		$thumbnail = 'catch-vogue-slider';
		if ( is_home() && $blog_id = get_option('page_for_posts') ) {
			if ( has_post_thumbnail( $blog_id  ) ) {
		    	return get_the_post_thumbnail_url( $blog_id, $thumbnail );
			} else {
				return catch_vogue_featured_image();
			}
		} elseif ( ! has_post_thumbnail() ) {
			return catch_vogue_featured_image();
		}

		$thumbnail = is_front_page() ? 'catch-vogue-header-inner' : 'catch-vogue-slider';

		if ( is_home() && $blog_id = get_option( 'page_for_posts' ) ) {
			return get_the_post_thumbnail_url( $blog_id, $thumbnail );
		} else {
			return get_the_post_thumbnail_url( get_the_id(), $thumbnail );
		}
	} // catch_vogue_featured_page_post_image
endif;

if ( ! function_exists( 'catch_vogue_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own catch_vogue_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Catch Vogue 1.0
	 */
	function catch_vogue_featured_overall_image() {
		global $post, $wp_query;
		$enable = get_theme_mod( 'catch_vogue_header_media_option', 'homepage' );

		// Get Page ID outside Loop
		$page_id = absint( $wp_query->get_queried_object_id() );

		$page_for_posts = absint( get_option( 'page_for_posts' ) );

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() ) {
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'catch-vogue-header-image', true );

			if ( 'disable' === $individual_featured_image || ( 'default' === $individual_featured_image && 'disable' === $enable ) ) {
				return;
			} elseif ( 'enable' == $individual_featured_image && 'disable' === $enable ) {
				return catch_vogue_featured_page_post_image();
			}
		}

		// Check Homepage
		if ( 'homepage' === $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return catch_vogue_featured_image();
			}
		} elseif ( 'exclude-home' === $enable ) {
			// Check Excluding Homepage
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return false;
			} else {
				return catch_vogue_featured_image();
			}
		} elseif ( 'exclude-home-page-post' === $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) {
				return false;
			} elseif ( is_singular() ) {
				return catch_vogue_featured_page_post_image();
			} else {
				return catch_vogue_featured_image();
			}
		} elseif ( 'entire-site' === $enable ) {
			// Check Entire Site
			return catch_vogue_featured_image();
		} elseif ( 'entire-site-page-post' === $enable ) {
			// Check Entire Site (Post/Page)
			if ( is_singular() || ( is_home() && $page_for_posts === $page_id ) ) {
				return catch_vogue_featured_page_post_image();
			} else {
				return catch_vogue_featured_image();
			}
		} elseif ( 'pages-posts' === $enable ) {
			// Check Page/Post
			if ( is_singular() ) {
				return catch_vogue_featured_page_post_image();
			}
		}

		return false;
	} // catch_vogue_featured_overall_image
endif;

if ( ! function_exists( 'catch_vogue_header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * @since Catch Vogue 1.0
	 */
	function catch_vogue_header_media_text() {
		if ( ! catch_vogue_has_header_media_text() ) {
			// Bail early if header media text is disabled
			return false;
		}

		$content_align = get_theme_mod( 'catch_vogue_header_media_content_align', 'content-aligned-center' );
		$text_align  = get_theme_mod( 'catch_vogue_header_media_text_align', 'text-aligned-center' );

		$classes[] = 'custom-header-content';
		$classes[] = $content_align;
		$classes[] = $text_align;

		?>
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="entry-container">
				<div class="entry-container-wrap">
					<header class="entry-header">
						<h2 class="entry-title">
							<?php catch_vogue_header_title(); ?>
						</h2>
					</header>

					<?php
					$header_media_logo = get_theme_mod( 'catch_vogue_header_media_image' );
					if ( $header_media_logo ) : ?>
						<div class="entry-header-image">
							<img src="<?php echo esc_url( $header_media_logo ); ?>" >
						</div> <!-- .entry-header-image -->
					<?php endif; ?>

					<?php catch_vogue_header_text(); ?>
				</div> <!-- .entry-container-wrap -->
			</div>
		</div> <!-- entry-container -->
		<?php
	} // catch_vogue_header_media_text.
endif;

if ( ! function_exists( 'catch_vogue_has_header_media_text' ) ):
	/**
	 * Return Header Media Text fro front page
	 *
	 * @since Catch Vogue 1.0
	 */
	function catch_vogue_has_header_media_text() {
		$header_media_title    = get_theme_mod( 'catch_vogue_header_media_title' );
		$header_media_subtitle = get_theme_mod( 'catch_vogue_header_media_subtitle' );
		$header_media_text     = get_theme_mod( 'catch_vogue_header_media_text' );
		$header_media_url      = get_theme_mod( 'catch_vogue_header_media_url', '' );
		$header_media_url_text = get_theme_mod( 'catch_vogue_header_media_url_text' );
		$header_media_logo     = get_theme_mod( 'catch_vogue_header_media_image' );

		$header_image = catch_vogue_featured_overall_image();

		if ( ( is_front_page() && ! $header_media_title && ! $header_media_logo && ! $header_media_subtitle && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) || ( ( is_singular() || is_archive() || is_search() || is_404() ) && ! $header_image ) ) {
			// Header Media text Disabled
			return false;
		}

		return true;
	} // catch_vogue_has_header_media_text.
endif;
