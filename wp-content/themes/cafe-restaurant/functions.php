<?php

// Add the assets
function cafe_restaurant_child_enqueue_style() {
	// Load main css file of parent theme.
    wp_enqueue_style( 'di-multipurpose-style-default', trailingslashit( get_template_directory_uri() ) . 'style.css' );

    if( class_exists( 'WooCommerce' ) ) {
	    // Load this child theme css after all parent css files including di-multipurpose-style-woo.
	    wp_enqueue_style( 'cafe-restaurant-child-style',  trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'bootstrap', 'font-awesome', 'di-multipurpose-style-default', 'di-multipurpose-style-core', 'di-multipurpose-style-woo' ), wp_get_theme()->get('Version'), 'all');
	} else {
		// Load this child theme css after all parent css files.
	    wp_enqueue_style( 'cafe-restaurant-child-style',  trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'bootstrap', 'font-awesome', 'di-multipurpose-style-default', 'di-multipurpose-style-core' ), wp_get_theme()->get('Version'), 'all');
	}

	// Load the assets if feature is in use.
	if( is_active_widget( false, false, 'cafe_restaurant_posts_carousel', true ) || is_active_widget( false, false, 'cafe_restaurant_category_posts_carousel', true )  ) {

		// Load owl.carousel css for sliders.
		wp_enqueue_style( 'owl-carousel', trailingslashit( get_template_directory_uri() ) . 'assets/css/owl.carousel.min.css', array( 'di-multipurpose-style-core' ), '2.2.1', 'all' );

		// Load owl.carousel default css.
		wp_enqueue_style( 'owl-theme-default', trailingslashit( get_template_directory_uri() ) . 'assets/css/owl.theme.default.min.css', array( 'owl-carousel', 'di-multipurpose-style-core' ), '2.2.1', 'all' );

		// Load owl.carousel js file
		wp_enqueue_script( 'owl-carousel', trailingslashit( get_template_directory_uri() ) . 'assets/js/owl.carousel.js', array( 'jquery' ), '2.2.1', true );

		// Load owl.carousel custom js file
		wp_enqueue_script( 'cafe-restaurant-owl-carousel', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/js/owl.carousel.widget-categy-posts-slider.js', array( 'jquery', 'owl-carousel' ), '1.0', true );

	}

}
add_action( 'wp_enqueue_scripts', 'cafe_restaurant_child_enqueue_style' );

// Add footer menu
add_action( 'after_setup_theme', 'cafe_restaurant_setup' );
function cafe_restaurant_setup() {

	// Add image size
	add_image_size( 'cafe-restaurant-category-posts-carousel', 360, 360, true ); // used in slider

	// Register menus, footer menu.
	register_nav_menus( array(
		'footer-menu'	=> __( 'Footer Menu', 'cafe-restaurant' ),
	) );
}

// Add the typography options for footer menu
add_action( 'di_multipurpose_typography_options', 'cafe_restaurant_options_footer_menu', 10, 1 );
function cafe_restaurant_options_footer_menu() {
	Kirki::add_field( 'di_multipurpose_config', array(
		'type'        => 'typography',
		'settings'    => 'ftr_menu_typog',
		'label'       => esc_attr__( 'Footer Menu Typography', 'cafe-restaurant' ),
		'section'     => 'typography_options',
		'default'     => array(
			'font-family'    => 'Rajdhani',
			'variant'        => '500',
			'font-size'      => '18px',
			'line-height'    => '1.7',
			'letter-spacing' => '0',
			'text-transform' => 'uppercase'
		),
		'output'      => array(
			array(
				'element' => '.footernavbarouter ul.footer-nav-footer-menu li a',
			),
		),
		'transport' => 'auto',
	) );
}

// Add widget: posts slider base on selected category.
require_once trailingslashit( get_stylesheet_directory() ) . 'classes/custom-widget-posts-slider.php';

// Add widget: posts slider base on selected category.
require_once trailingslashit( get_stylesheet_directory() ) . 'classes/custom-widget-category-posts-slider.php';
