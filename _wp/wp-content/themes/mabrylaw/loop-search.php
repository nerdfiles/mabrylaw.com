<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <!-- loop-page.php > do_action('custom_entry_title'); -->
                    <?php do_action('custom_entry_title'); ?>
					
					<div class="entry-content">
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mabrylaw' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'mabrylaw' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
					
				</div><!-- #post-## -->

				<?php //comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>