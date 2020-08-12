<?php
/**
 * My Salon Theme Customizer.
 *
 * @package dinner_lite
 */

    $dinner_lite_settings = array( 'info', 'default', 'home'  );

    /* Option list of all post */	
    $dinner_lite_options_posts = array();
    $dinner_lite_options_posts_obj = get_posts('posts_per_page=-1');
    $dinner_lite_options_posts[''] = __( 'Choose Post', 'dinner-lite' );
    foreach ( $dinner_lite_options_posts_obj as $dinner_lite_posts ) {
    	$dinner_lite_options_posts[$dinner_lite_posts->ID] = $dinner_lite_posts->post_title;
    }
    
 	/* Option list of all page */   
    $dinner_lite_options_pages = array();
    $dinner_lite_options_pages_obj = get_pages('posts_per_page=-1');
    $dinner_lite_options_pages[''] = __( 'Choose Page', 'dinner-lite' );
    foreach ( $dinner_lite_options_pages_obj as $dinner_lite_pages ) {
        $dinner_lite_options_pages[$dinner_lite_pages->ID] = $dinner_lite_pages->post_title;
    }

    /* Option list of all categories */
    $dinner_lite_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $dinner_lite_option_categories = array();
    $dinner_lite_category_lists = get_categories( $dinner_lite_args );
    $dinner_lite_option_categories[''] = __( 'Choose Category', 'dinner-lite' );
    foreach( $dinner_lite_category_lists as $dinner_lite_category ){
        $dinner_lite_option_categories[$dinner_lite_category->term_id] = $dinner_lite_category->name;
    }

	foreach( $dinner_lite_settings as $setting ){
		require get_template_directory() . '/inc/customizer/' . $setting . '.php';
	}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dinner_lite_customize_preview_js() {
    wp_enqueue_script( 'dinner_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'dinner_lite_customize_preview_js' );
