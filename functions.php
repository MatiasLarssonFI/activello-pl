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
