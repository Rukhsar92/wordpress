<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dinner Lite
 */

/**
 * Dinner Lite Footer
 * 
 * @see dinner_lite_after_content - 10
*/
do_action( 'dinner_lite_after_content' );

/**
 * Dinner Lite Footer
 * 
 * @see dinner_lite_footer_start  - 20
 * @see dinner_lite_footer_widgets    - 30
 * @see dinner_lite_footer_credit - 40
 * @see dinner_lite_footer_end    - 50
*/
do_action( 'dinner_lite_footer' );
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
