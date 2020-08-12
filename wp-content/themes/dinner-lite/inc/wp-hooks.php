<?php
/**
 * WP hooks for this theme.
 *
 * @package dinner_lite
 */

/**
 * @see dinner_lite_setup
*/
add_action( 'after_setup_theme', 'dinner_lite_setup' );

/**
 * @see dinner_lite_content_width
*/
add_action( 'after_setup_theme', 'dinner_lite_content_width', 0 );

/**
 * @see dinner_lite_template_redirect_content_width
*/
add_action( 'template_redirect', 'dinner_lite_template_redirect_content_width' );

/**
 * @see dinner_lite_scripts 
*/
add_action( 'wp_enqueue_scripts', 'dinner_lite_scripts' );

/**
 * @see dinner_lite_body_classes
*/
add_filter( 'body_class', 'dinner_lite_body_classes' );

/**
 * @see dinner_lite_category_transient_flusher
*/
add_action( 'edit_category', 'dinner_lite_category_transient_flusher' );
add_action( 'save_post',     'dinner_lite_category_transient_flusher' );

/**
 * @see dinner_lite_excerpt_more
 * @see dinner_lite_excerpt_length
*/
add_filter( 'excerpt_more', 'dinner_lite_excerpt_more' );
add_filter( 'excerpt_length', 'dinner_lite_excerpt_length', 999 );

/**
 * Move comment field to the bottm
 * @see dinner_lite_move_comment_field_to_bottom
*/
add_filter( 'comment_form_fields', 'dinner_lite_move_comment_field_to_bottom' );
