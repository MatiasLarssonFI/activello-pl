<?php get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php
    			call_user_func(function() {
        			$args = array(
                		'category_name' => activellopinklemon_get_shop_string(),
                		'order' => 'DESC',
                		'orderby' => 'ID',
                		'limit' => 1,
                	);
                	$query = new WP_Query( $args );
                	
                	if ( $query->have_posts() ) {
                		while ( $query->have_posts() ) {
                		    $query->the_post();
                		    get_template_part( 'template-parts/content', 'page' );
                		}
                		
                		wp_reset_query();
                	}
                });
        	?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
