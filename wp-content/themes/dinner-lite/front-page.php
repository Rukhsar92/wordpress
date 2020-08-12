<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dinner_lite
 * @since 1.0.1
 * @version 1.0.3
 */

$banner_enable       = get_theme_mod( 'dinner_lite_ed_banner_section' );
$service_enable     = get_theme_mod( 'dinner_lite_ed_services_section' );
$special_enable      = get_theme_mod( 'dinner_lite_ed_special_section' );
$blog_enable         = get_theme_mod( 'dinner_lite_ed_blog_section' );
$portfolio_enable     = get_theme_mod( 'dinner_lite_ed_portfolio_section' );
$testimonials_enable = get_theme_mod( 'dinner_lite_ed_testimonials_section' );

get_header(); 
           
    if ( 'posts' == get_option( 'show_on_front' ) ) {
        include( get_home_template() );
    }elseif( $banner_enable || $service_enable || $special_enable || $blog_enable || $portfolio_enable || $testimonials_enable ){ ?>
        
        <?php
        /**
         * Home Page Contents
         * 
         * @hooked dinner_lite_banner      - 20
         * @hooked dinner_lite_services    - 30
         * @hooked dinner_lite_special     - 35
         * @hooked dinner_lite_portfolio   - 40
         * @hooked dinner_lite_testimonial - 50
         * @hooked dinner_lite_blog        - 60
        */
        do_action( 'dinner_lite_home_page' );
        ?>
   
    <?php        
    }else {
        include( get_page_template() );
    }


get_footer();