<?php
/**
 * Testimonial hook
 *
 * @package kingston
 */

if ( ! function_exists( 'kingston_add_testimonial_section' ) ) :
    /**
    * Add testimonial section
    *
    *@since Kingston 1.0.0
    */
    function kingston_add_testimonial_section() {

        // Check if testimonial is enabled on frontpage
        $testimonial_enable = apply_filters( 'kingston_section_status', 'enable_testimonial' );

        if ( ! $testimonial_enable )
            return false;

        // Get testimonial section details
        $section_details = array();
        $section_details = apply_filters( 'kingston_filter_testimonial_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render testimonial section now.
        kingston_render_testimonial_section( $section_details );
    }
endif;
add_action( 'kingston_primary_content_action', 'kingston_add_testimonial_section', 100 );


if ( ! function_exists( 'kingston_get_testimonial_section_details' ) ) :
    /**
    * testimonial section details.
    *
    * @since Kingston 1.0.0
    * @param array $input testimonial section details.
    */
    function kingston_get_testimonial_section_details( $input ) {

        $content = array();
        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ )  :
            $page_id = kingston_theme_option( 'testimonial_content_page_' . $i );

            if ( ! empty( $page_id ) ) :
                $page_ids[] = $page_id;
            endif;

        endfor;
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          =>  ( array ) $page_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
            );                         

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = kingston_trim_content( 35 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'thumbnail' ) : '';

                // Push to the main array.
                array_push( $content, $page_post );
                $i++;
            endwhile;
        endif;
        wp_reset_postdata();
            
        if ( ! empty( $content ) )
            $input = $content;
       
        return $input;
    }
endif;
// testimonial section content details.
add_filter( 'kingston_filter_testimonial_section_details', 'kingston_get_testimonial_section_details' );


if ( ! function_exists( 'kingston_render_testimonial_section' ) ) :
  /**
   * Start testimonial section
   *
   * @return string testimonial content
   * @since Kingston 1.0.0
   *
   */
   function kingston_render_testimonial_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $background = kingston_theme_option( 'testimonial_image', '' );
        ?>
    	<div class="page-section testimonial-section relative" style="background-image: url( '<?php echo esc_url( $background ); ?>' );">
            <div class="overlay"></div>
            <div class="wrapper">
                <div class="section-content testimonial-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 1200, "dots": false, "arrows": false, "autoplay": true, "fade": false, "draggable": true }'>
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="hentry slide-item">
                            <div class="post-wrapper">
                                <span class="quote">
                                    <?php echo kingston_get_svg( array( 'icon' => 'quote-right' ) ); ?>
                                </span>

                                <?php if ( ! empty( $content['image'] ) ) : ?>
                                    <div class="testimonial-image">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>">
                                            <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ) ?>">
                                        </a>
                                    </div><!-- .testimonial-image -->
                                <?php endif; 

                                if ( ! empty( $content['excerpt'] ) ) : ?>
                                    <div class="entry-content">
                                        <?php echo '"' . wp_kses_post( $content['excerpt'] ) . '"'; ?>
                                    </div><!-- .entry-content -->
                                <?php endif; ?>

                                <div class="entry-container">
                                    <?php if ( ! empty( $content['title'] ) ) : ?>
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        </header>
                                    <?php endif; ?>
                                </div><!-- .entry-container -->
                            </div><!-- .post-wrapper -->
                        </article>
                    <?php endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #testimonial-posts -->
    <?php 
    }
endif;