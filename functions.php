<?php
add_action( 'wp_enqueue_scripts', function() {
	$parent_styles = [];
    wp_enqueue_style( $parent_styles[] = 'activello-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'activellopinklemon-style',
        get_stylesheet_directory_uri() . '/style.css',
        $parent_styles,
        wp_get_theme()->get('Version')
    );
});


// slider
if ( ! function_exists( 'activello_featured_slider' ) ) :
	/**
 * Featured image slider, displayed on front page for static page and blog
 */
	function activello_featured_slider() {
		if ( ( is_home() || is_front_page() ) && get_theme_mod( 'activello_featured_hide' ) == 1 ) {

			wp_enqueue_style( 'flexslider-css' );
			wp_enqueue_script( 'flexslider-js' );

			echo '<div class="flexslider">';
			echo '<ul class="slides">';

			$slidecat = get_theme_mod( 'activello_featured_cat' );
			$slidelimit = get_theme_mod( 'activello_featured_limit', -1 );
			$slider_args = array(
				'cat' => $slidecat,
				'posts_per_page' => $slidelimit,
				'meta_query' => array(
					array(
						'key' => '_thumbnail_id',
						'compare' => 'EXISTS',
					),
				),
			);
			$query = new WP_Query( $slider_args );
			if ( $query->have_posts() ) :

				while ( $query->have_posts() ) : $query->the_post();
					if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) :
						echo '<li>';
						if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
							$feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							$args = array(
								'resize' => '1920,550',
							);
							$photon_url = jetpack_photon_url( $feat_image_url[0], $args );
							echo '<img src="' . $photon_url . '">';
						} else {
							  echo get_the_post_thumbnail( get_the_ID(), 'activello-slider' );
						}
								echo '<div class="flex-caption">';
							  echo get_the_category_list();
						if ( get_the_title() != '' ) { echo '<a href="' . get_permalink() . '"><h2 class="entry-title">' . get_the_title() . '</h2></a>';
						}
								echo '</div>';
								echo '</li>';
						endif;
					endwhile;
				wp_reset_query();
			endif;
			echo '</ul>';
			echo ' </div>';
		}// End if().
	}
endif;
// end slider