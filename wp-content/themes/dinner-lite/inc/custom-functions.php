<?php
/**
 * My Salon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dinner_lite
 */

if ( ! function_exists( 'dinner_lite_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dinner_lite_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on My Salon, use a find and replace
		 * to change 'dinner-lite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dinner-lite', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'dinner-lite' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'dinner_lite_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Custom Image Size
		
	    add_image_size( 'dinner-lite-with-sidebar', 833, 474, true );
	    add_image_size( 'dinner-lite-without-sidebar', 1110, 474, true );
	    add_image_size( 'dinner-lite-tiny', 78, 78, true );
	    add_image_size( 'dinner-lite-portfolio', 400, 400, true ); 
	    add_image_size( 'dinner-lite-services-thumb', 100 , 100, true );
	    add_image_size( 'dinner-lite-three-col', 360 , 300, true );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'header-text' => array( 'site-title', 'site-description' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'dinner_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dinner_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dinner_lite_content_width', 750 );
}
add_action( 'after_setup_theme', 'dinner_lite_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function dinner_lite_template_redirect_content_width() {
	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = dinner_lite_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1140;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1170;
	}
}

/**
 * Enqueue scripts and styles.
 */
function dinner_lite_scripts() {
	$dinner_lite_query_args = array(
		'family' => 'Source Sans Pro:400,700|Merienda:400 ',
		);

	wp_enqueue_style( 'dinner-lite-google-fonts', add_query_arg( $dinner_lite_query_args, "//fonts.googleapis.com/css" ) );

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/all.min.css' );
    wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/css/meanmenu.min.css' );
    wp_enqueue_style( 'dinner-lite-style', get_stylesheet_uri(), DINNER_LITE_THEME_VERSION );   

    wp_enqueue_script( 'jquery-meanumenu', get_template_directory_uri() . '/js/jquery.meanmenu.js', array('jquery'), '2.2.1', true );
    wp_register_script( 'dinner-lite-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), DINNER_LITE_THEME_VERSION, true );

    $array = array();
    
    wp_localize_script( 'dinner-lite-custom', 'dinner_lite_data', $array );
    wp_enqueue_script( 'dinner-lite-custom' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dinner_lite_scripts' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dinner_lite_body_classes( $classes ) {
	global $post;
    $ed_slider = get_theme_mod( 'dinner_lite_ed_banner_section' );

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if( $ed_slider && is_front_page() && !is_home() ) {
        $classes[] = 'has-slider';
    }

	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
	$classes[] = 'custom-background-image';
	}

	// Adds a class of custom-background-color to sites with a custom background color.
	if ( get_background_color() != 'ffffff' ) {
	$classes[] = 'custom-background-color';
	}

	if(is_page()){
	$dinner_lite_post_class = dinner_lite_sidebar_layout(); 
	if( $dinner_lite_post_class == 'no-sidebar' )
	$classes[] = 'full-width';
	}

	if( !( is_active_sidebar( 'right-sidebar' )) || is_404() ) {
	  $classes[] = 'full-width'; 
	}

	return $classes;
}
add_filter( 'body_class', 'dinner_lite_body_classes' );

/** 
 * Hook to move comment text field to the bottom in WP 4.4 
 *
 * @link http://www.wpbeginner.com/wp-tutorials/how-to-move-comment-text-field-to-bottom-in-wordpress-4-4/  
 */
function dinner_lite_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}


/* Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function dinner_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'dinner_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'dinner_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so dinner_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so dinner_lite_categorized_blog should return false.
		return false;
	}
}


/**
 * Flush out the transients used in dinner_lite_categorized_blog.
 */
function dinner_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'dinner_lite_categories' );
}


if ( ! function_exists( 'dinner_lite_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function dinner_lite_excerpt_more( $more ) {
	if ( ! is_admin() ){
		return ' &hellip; ';
	}
	else{
		return $more;
	}
}
endif;

if ( ! function_exists( 'dinner_lite_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function dinner_lite_excerpt_length( $length ) {
	if ( ! is_admin() ){
		if( is_front_page() && ! is_home() ){
			return 20;
		}else{
    		return 40;
    	}
	}
}
endif;