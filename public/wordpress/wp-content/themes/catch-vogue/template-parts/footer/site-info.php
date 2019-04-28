<div id="site-generator">
	<div class="wrapper">

		<?php get_template_part( 'template-parts/footer/social', 'footer' ); ?>

		<div class="site-info">
			<?php
		        $theme_data = wp_get_theme();

		        $def_footer_text = sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'catch-vogue' ), esc_attr( date_i18n( __( 'Y', 'catch-vogue' ) ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>', get_the_privacy_policy_link() ) . ' &#124; ' . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'catch-vogue' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( $theme_data->get( 'Author' ) ) .'</a>';

		        echo wp_kses_post( $def_footer_text );
		    ?>
		</div> <!-- .site-info -->
	</div> <!-- .wrapper -->
</div><!-- .site-info -->
