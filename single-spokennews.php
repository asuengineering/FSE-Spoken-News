<?php
/**
 * The template for displaying all single SpokenNews items
 */


// Add specific CSS class by filter.
add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'spokennews', 'spokennews-human' ) );
} );

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php
    while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/spoken', 'human' );

    endwhile; // End of the loop.
    ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
