<?php
/**
 * Template part for displaying page content in spokennews-human.php
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header group">
		<?php the_title( '<h2 class="entry-title">', '</h2>' );	?>
		<span class="post-meta">
			<?php 
				echo "Word Count: " . str_word_count( get_the_content() ) ;
				edit_post_link('Edit');
			?>
		</span>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<p>
				<strong>Created: </strong>
                <?php echo get_the_time('F j, Y \a\t g:i a'); ?>
                </br>
                <strong>Expires: </strong>
                <?php echo do_shortcode('[postexpirator]'); ?>
                </br></br>
				<strong>Category: </strong>
				<?php $terms = get_the_terms( $post->ID , 'spokennews_category' ); 
                    foreach ( $terms as $term ) {
                        if( $term->name == 'Expired' ) {
                        	 echo '<span class="red">' . $term->name . '</span>';
                        } else {
                    		echo '<span>' . $term->name . '</span>';
                    	}
                	} 
                ?>
			</p>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
