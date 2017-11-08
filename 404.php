<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package activello
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="post-inner-content">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Hakemaasi sivua ei löytynyt.', 'activello' ); ?></h1>
					</header> <!-- .page-header -->

					<div class="page-content">
                        
					</div>


				</section><!-- .error-404 -->
			</div>
		</main><!-- #main -->
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
