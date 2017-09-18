<?php

function activellopinklemon_get_catalog_string() {
    return "hinnasto";
}


function activellopinklemon_get_shop_string() {
    return "kahvila";
}

function activello_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

		printf( '<span class="posted-on">%1$s</span>',
			sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_permalink() ),
				$time_string
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
}


add_action( 'wp_enqueue_scripts', function() {
	$parent_styles = [];
    wp_enqueue_style( $parent_styles[] = 'activello-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'activellopinklemon-style',
        get_stylesheet_directory_uri() . '/style.css',
        $parent_styles,
        wp_get_theme()->get('Version')
    );
    $parent_styles[] = 'activellopinklemon-style';
    if (is_page(activellopinklemon_get_catalog_string())) {
        wp_enqueue_style(
            'activellopinklemon-catalog-style',
            get_stylesheet_directory_uri() . '/catalog-style.css',
            $parent_styles,
            wp_get_theme()->get('Version')
        );
    }
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