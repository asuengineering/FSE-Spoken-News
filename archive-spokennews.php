<?php
/**
 * The template for displaying Spoken News Archives
 * This is the page to be "scraped" by the service
 */

// Add specific CSS class by filter.
add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'spokennews', 'spokennews-machine' ) );
} );

/* Page Template 
============================ */
get_header(); ?>
		
	<div id="primary" class="content-area">
		<main id="main" class="site-main spokennews-start">
			
			<?php if ( have_posts() ) : ?>

			<h4 class="spoken-wrap spoken-wrap-open">Inner Circle brings you the news and events from ASU's Fulton Schools of Engineering.</h4>

			<?php
				/* Query Posts */
				$args = array(
				    'post_type' => 'spokennews',
				    'orderby' => 'menu_order title',
				    'order'   => 'ASC',
				    'nopaging' => 'true',
				    'posts_per_page' => 8,
				    'tax_query' => array (
				    	array (
					    	'taxonomy' => 'spokennews_category',
					    	'field' => 'slug',
					    	'terms' => 'expired',
					    	'operator' => 'NOT IN',
				    	),
			    	),
				);	

				query_posts($args);

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/spoken' );

				endwhile; 
			?>

			<hr>
			<h4 class="spoken-wrap spoken-wrap-close">For more news, visit inner circle dot engineering dot A. S. U. dot E. D. U. and check your email inbox Tuesday after five p. m. for the latest weekly newsletter.</h4>

			<?php else :

				get_template_part( 'template-parts/spoken', 'none' );

			endif;

			wp_reset_query(); ?>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

