<?php
/**
 * Dinner Lite Widgets
 *
 * @package dinner_lite
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dinner_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'dinner-lite' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'dinner-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	 register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar One', 'dinner-lite' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	  register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Two', 'dinner-lite' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	   register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Three', 'dinner-lite' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
 
}
add_action( 'widgets_init', 'dinner_lite_widgets_init' );