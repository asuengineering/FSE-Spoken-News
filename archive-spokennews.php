<?php
/**
 * The template for displaying Spoken News Archives
 * This is the page to be "scraped" by the service
 */

// Add specific CSS class by filter.
add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'spokennews', 'spokennews-machine' ) );
} );

// get Carbon Field values for opening and closing text.
$opening = carbon_get_theme_option( 'asufse_spokenword_openingtext' );
$closing = carbon_get_theme_option( 'asufse_spokenword_closingtext' );

/* Page Template 
============================ */
get_header(); ?>
		
	<div id="primary" class="content-area">
		<main id="main" class="site-main spokennews-start">
			
			<?php if ( have_posts() ) : ?>

			<h4 class="spoken-wrap spoken-wrap-open"><?php echo $opening; ?></h4>

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
			<h4 class="spoken-wrap spoken-wrap-close"><?php echo $closing;?></h4>

			<?php else :

				get_template_part( 'template-parts/spoken', 'none' );

			endif;

			wp_reset_query(); ?>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

