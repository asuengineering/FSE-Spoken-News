<?php
 /*
 * Template Name: Spoken News for Humans
 * The template for displaying the user-friendly page that displays all spoken word items.
 * Based on page.php
 * @link https://codex.wordpress.org/Template_Hierarchy
 */


// Add specific CSS class by filter.
add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'spokennews', 'spokennews-human' ) );
} );

/* Page Template 
============================ */
get_header();?>
	
	<?php
		// get Carbon Field values for opening and closing text.
		$opening = carbon_get_theme_option( 'asufse_spokenword_openingtext' );
		$closing = carbon_get_theme_option( 'asufse_spokenword_closingtext' );

		// Quick Page loop for the contents of the page. 
		while ( have_posts() ) : the_post();
			the_content();
		endwhile; // End of the loop.
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<article class="theme-option hentry">
			<p class="spoken-wrap spoken-wrap-open"><strong>Preface text: </strong><?php echo $opening; ?></p>
		</article>

			<?php
			/* Secondary Loop Posts */
			$args = array(
			    'post_type' => 'spokennews',
			    'orderby' => 'menu_order title',
			    'order'   => 'ASC',
			    'posts_per_page' => 8,
			);	

			$spokennews_posts = new WP_Query($args);

			while ( $spokennews_posts->have_posts() ) : $spokennews_posts->the_post(); ?>

				<?php get_template_part( 'template-parts/spoken', 'human' );

			endwhile; // End of the loop. ?>

			<article class="theme-option hentry">
				<p class="spoken-wrap spoken-wrap-close"><strong>Closing text: </strong><?php echo $closing;?></p>
			</article>

			<?php
			$pagination_args = array(
			    'mid_size' => 2,
			    'prev_text' => __( 'Newer', 'textdomain' ),
			    'next_text' => __( 'Older', 'textdomain' ),
			);
			echo get_the_posts_pagination($pagination_args);
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
