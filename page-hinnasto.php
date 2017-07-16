<?php get_header(); ?>

<header class="entry-header page-header">
	<h1 class="entry-title">Hinnasto</h1>
</header>

<?php

call_user_func(function() {
	$args = array(
		'category_name' => activellopinklemon_get_catalog_string(),
		'order' => 'ASC',
		'orderby' => 'ID',
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id',
				'compare' => 'EXISTS',
			),
		),
	);
	$query = new WP_Query( $args );
	
	echo '<div class="row">';
	if ( $query->have_posts() ) :
    
		while ( $query->have_posts() ) :
		    $query->the_post();
		    
			if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) :
				echo '<div class="col-xs-12 col-md-6 plcatalog-product-container">';
				echo '<div class="plcatalog-product">';
				echo '    <div class="plcatalog-product-caption">';
				
				if ( get_the_title() != '' ) {
				    echo '    <h3 class="entry-title plcatalog-product-title">' . get_the_title() . '</h3>';
				}
				echo '    </div>';
				
				echo '    <div class="plcatalog-product-image">';
				echo get_the_post_thumbnail( get_the_ID(), "full" );
				echo '    </div>';
				
				echo '    <div class="plcatalog-product-text">';
				echo get_the_content();
				echo "    </div>";
				echo '</div>';
				echo '</div>';
			endif;
		endwhile;
		
		wp_reset_query();
	endif;
	
	echo '</div>';
});
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>