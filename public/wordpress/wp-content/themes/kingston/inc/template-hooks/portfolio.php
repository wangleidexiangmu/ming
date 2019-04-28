<?php
/**
 * Portfolio hook
 *
 * @package kingston
 */

if ( ! function_exists( 'kingston_add_portfolio_section' ) ) :
    /**
    * Add portfolio section
    *
    *@since Kingston 1.0.0
    */
    function kingston_add_portfolio_section() {

        // Check if portfolio is enabled on frontpage
        $portfolio_enable = apply_filters( 'kingston_section_status', 'enable_portfolio' );

        if ( ! $portfolio_enable )
            return false;

        // Get portfolio section details
        $section_details = array();
        $section_details = apply_filters( 'kingston_filter_portfolio_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render portfolio section now.
        kingston_render_portfolio_section( $section_details );
    }
endif;
add_action( 'kingston_primary_content_action', 'kingston_add_portfolio_section', 60 );


if ( ! function_exists( 'kingston_get_portfolio_section_details' ) ) :
    /**
    * portfolio section details.
    *
    * @since Kingston 1.0.0
    * @param array $input portfolio section details.
    */
    function kingston_get_portfolio_section_details( $input ) {

        $content = array();
        $cat_id = kingston_theme_option( 'portfolio_content_category', '' );
        
        $args = array(
            'post_type'         => 'post',
            'cat'               =>  $cat_id,
            'posts_per_page'    => 6,
            'ignore_sticky_posts' => true,
            );                    


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = kingston_trim_content( 15 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'post-thumbnail' ) : '';

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
// portfolio section content details.
add_filter( 'kingston_filter_portfolio_section_details', 'kingston_get_portfolio_section_details' );


if ( ! function_exists( 'kingston_render_portfolio_section' ) ) :
  /**
   * Start portfolio section
   *
   * @return string portfolio content
   * @since Kingston 1.0.0
   *
   */
   function kingston_render_portfolio_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $title = kingston_theme_option( 'portfolio_title', '' );
        $read_more = kingston_theme_option( 'portfolio_btn_label', esc_html__( 'Read More', 'kingston' ) );

        ?>
    	<div id="portfolio" class="page-section relative">
            <div class="wrapper">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="section-header align-center">
                        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                        <div class="separator"></div>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content column-3">
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="hentry">
                            <div class="post-wrapper">
                                <div class="gallery">
                                    <?php if ( ! empty( $content['image'] ) ) : ?>
                                        <div class="featured-image">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>">
                                                <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                                            </a>
                                            <div class="overlay"></div>
                                                
                                            <a class="more-btn" href="<?php echo esc_url( $content['url'] ); ?>">
                                                <?php echo esc_html( $read_more ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?> 

                                    <div class="entry-container">
                                        <?php if ( !empty( $content['title'] ) ) : ?>
                                            <header class="entry-header">
                                                <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                            </header>
                                        <?php endif;

                                        if ( !empty( $content['excerpt'] ) ) : ?>
                                            <div class="entry-content">
                                                <?php echo wp_kses_post( $content['excerpt'] ); ?>
                                            </div><!-- .entry-content -->
                                        <?php endif; ?>
                                    </div>
                                </div><!-- .gallery -->
                            </div><!-- .post-wrapper -->
                        </article>
                    <?php endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #gallery -->
    <?php 
    }
endif;