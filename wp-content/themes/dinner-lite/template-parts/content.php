<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dinner_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		/**
		 * Before Post entry content
		 * 
		 * @see dinner_lite_post_content_image - 10
		 * @see dinner_lite_post_entry_header  - 20
		*/
		do_action( 'dinner_lite_before_post_entry_content' ); 
	?>

	<div class="entry-content">
		<?php
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php dinner_lite_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
