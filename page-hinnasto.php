<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
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
	
	if ( $query->have_posts() ) :
    
		while ( $query->have_posts() ) :
		    $query->the_post();
		    
			if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) :
				echo '<div class="col-xs-12 plcatalog-product-container">';
				echo '<div class="plcatalog-product row">';
				echo '    <div class="col-xs-12">';
				
				if ( get_the_title() != '' ) {
				    echo '    <h3 class="entry-title plcatalog-product-title">' . get_the_title() . '</h3>';
				}
				echo '    </div>';
				
				echo '<div class="col-xs-12 col-md-4">';
    				echo '    <div class="plcatalog-product-image">';
    				echo get_the_post_thumbnail( get_the_ID(), "full" );
    				echo '    </div>';
    			echo '</div>';
    			
    			echo '<div class="col-xs-12 col-md-8">';
    				echo '    <div class="plcatalog-product-text">';
    				echo apply_filters("the_content", get_the_content());
    				echo "    </div>";
    			echo '</div>';
    			
				echo '</div>'; // .plcatalog-product
				echo '</div>'; // .plcatalog-product-container
			endif;
		endwhile;
		
		wp_reset_query();
	endif;
	
});
?>
    <div><p><a href="https://pinklemon.fi/tarjouspyynto/" title="Tarjouspyyntö" class="entry-title" style="color:#ec80a8 !important;">Tästä tarjouspyyntölomakkeeseen</a></p></div>
    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>