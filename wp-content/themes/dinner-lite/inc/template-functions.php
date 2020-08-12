<?php
/**
 * Custom template function for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package dinner_lite
 */

if( ! function_exists( 'dinner_lite_header_end' ) ) :
/**
 * Header End
 * 
 * @since 1.0.0
*/
function dinner_lite_header_end(){
    ?>
    </header><!-- #masthead -->
    <?php 
}
endif;


/* Home page */

if( ! function_exists( 'dinner_lite_template_header' ) ) :
/**
 * Template Section Header
 * 
 * @since 1.0.0
*/
function dinner_lite_template_header( $section_title ){
    $header_query = new WP_Query( array( 
        'p'         => absint( $section_title ),
        'post_type' => 'page'
    ));

        if( absint( $section_title ) && $header_query->have_posts() ){ 
            while( $header_query->have_posts() ){ $header_query->the_post();
    ?>
                <header class="main-header">
                    <?php 
                        echo '<h2 class="section-title">';
                        the_title();
                        echo '</h2>';
                        
                        if( has_excerpt() ){
                            echo the_excerpt();
                        } 
                    ?>
                </header>
    <?php   }
        wp_reset_postdata();
        }   

}
endif;

if( ! function_exists( 'dinner_lite_banner' ) ) :
/**
 * Home Page banner Section
 * 
 * @since 1.0.0
*/
function dinner_lite_banner(){
    global $dinner_lite_default_page;
    
    $banner_enable     = get_theme_mod( 'dinner_lite_ed_banner_section' );
    $banner_sub_title  = get_theme_mod( 'dinner_lite_banner_section_sub_title' ); 
    $banner_button     = get_theme_mod( 'dinner_lite_banner_section_btn', __( 'Book A Table', 'dinner-lite' ) );
    $banner_button_url = get_theme_mod( 'dinner_lite_banner_section_btn_url', '#');

    if( $banner_enable ){
        if( have_posts() ){
            while( have_posts() ){
                the_post(); 

                if( has_post_thumbnail() ){
                    $img_url = get_the_post_thumbnail_url();
                }else{
                    $img_url = get_template_directory_uri() . '/images/banner.png';
                }

                ?>
                <section id="banner-section" class="banner-section" <?php echo 'style="background: url(' . esc_url( $img_url ) . ')no-repeat; background-size: cover; background-position: center;"';?>>
                    <div class="banner-text-holder">
                        <div class="banner-text vh-center">

                            <?php 
                            if( !empty( $banner_sub_title ) ){
                                echo '<h2>';
                                    echo esc_attr( $banner_sub_title );
                                echo '</h2>';
                            }
                            the_title( '<h1>','</h1>'); ?>
                            <div class="section-content">
                                <?php the_content(); ?>
                            </div>
                            <?php if( !empty( $banner_button ) && !empty( $banner_button_url ) ){ ?>
                                <a href="<?php echo esc_url( $banner_button_url ); ?> " class="btn-primary coffee"><?php echo esc_attr( $banner_button ); ?></a>
                            <?php } ?>
                        </div>
                    </div> 
                </section>            
                <?php
            }
        }
        wp_reset_postdata();  
    }    
    
}

endif;

if( ! function_exists( 'dinner_lite_special' ) ) :
/**
 * Home Page services Section
 * 
 * @since 1.0.0
*/
function dinner_lite_special(){
global $dinner_lite_default_post;
global $dinner_lite_default_page; 
    
    $section_title   = get_theme_mod( 'dinner_lite_special_section_page', $dinner_lite_default_page );
    $special_enable  = get_theme_mod( 'dinner_lite_ed_special_section' );
    $section_btn     = get_theme_mod( 'dinner_lite_special_section_btn', __( 'View More', 'dinner-lite') );
    $section_btn_url = get_theme_mod( 'dinner_lite_special_section_btn_url', '#' );

    if( $special_enable ){ 
        if( absint( $section_title ) ) {   
        $header_query = new WP_Query( array( 
            'p'         => absint( $section_title ),
            'post_type' => 'page'
        ));

        if( absint( $section_title ) && $header_query->have_posts() ){ 
            while( $header_query->have_posts() ){ $header_query->the_post(); ?>
                <section id="product-section" class="product-section" <?php if( has_post_thumbnail() ) echo 'style="background: url(' . esc_url( get_the_post_thumbnail_url() ) . ')no-repeat; background-size: cover; background-position: center;"';?> >
        <?php   }
            wp_reset_postdata();
            }   
        }else{
            echo '<section id="product-section" class="product-section">';
        } ?>

            <div class="container">
                <div class="row">
                    <?php if( $section_title ) {  dinner_lite_template_header( $section_title ); } ?>
                    <div class="product-slider-item">
                        <?php
                        for( $i = 1; $i <= 4; $i++ ){
                            $dinner_lite_special_post_id = get_theme_mod( 'dinner_lite_special_post_'.$i, $dinner_lite_default_post ); 

                            if( $dinner_lite_special_post_id ){
                            $qry = new WP_Query ( array( 'p' => absint( $dinner_lite_special_post_id ) ) );
                                if( $qry->have_posts() ){
                                    while( $qry->have_posts() ){
                                        $qry->the_post();
                                    ?>
                                        <div class="col-3">
                                            <?php
                                                if( has_post_thumbnail() ){ 
                                                    echo '<a href="' . esc_url( get_the_permalink() ) .'">';
                                                        the_post_thumbnail( 'dinner-lite-portfolio' ); 
                                                    echo '</a>';
                                                }
                                            ?>
                                            <div class="product-info">
                                                <a href="<?php the_permalink(); ?>" class="product-name"><h2><?php the_title(); ?></h2></a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                                wp_reset_postdata();  
                            }
                        } ?>
                    </div>
                    <?php 
                        if( !empty( $section_btn ) && !empty( $section_btn_url ) ){
                            echo '<div class="button-holder">';
                                echo '<a href="'. esc_url( $section_btn_url ) .'" class="btn-primary orange">';
                                    echo esc_attr( $section_btn );
                                echo '</a>';
                            echo '</div>';
                        }
                    ?>
                </div> 
            </div> 
        </section>
    <?php  
    }   

}
endif;

if( ! function_exists( 'dinner_lite_services' ) ) :
/**
 * Home Page services Section
 * 
 * @since 1.0.0
*/
function dinner_lite_services(){
global $dinner_lite_default_post;
global $dinner_lite_default_page; 
    
    $section_title     = get_theme_mod( 'dinner_lite_services_section_title', $dinner_lite_default_page );
    $services_enable   = get_theme_mod( 'dinner_lite_ed_services_section' );
    $service_sub_title = get_theme_mod( 'dinner_lite_about_section_sub_title' ); 

    if( $services_enable ){ ?>
        <section id="about-section" class="about-section" >
            <div class="container">
                <div class="row">
                    <?php
                        if( absint( $section_title ) ) {   
                        $header_query = new WP_Query( array( 
                            'p'         => absint( $section_title ),
                            'post_type' => 'page'
                        ));

                        if( absint( $section_title ) && $header_query->have_posts() ){ 
                            while( $header_query->have_posts() ){ $header_query->the_post();
                    ?>
                            <div class="col-4">
                                <div class="about-banner" <?php if( has_post_thumbnail() ) echo 'style="background: url(' . esc_url( get_the_post_thumbnail_url() ) . ')no-repeat; background-size: cover; background-position: center;"';?>> 
                                    <div class="about-text">
                                        <?php 
                                            if ( $service_sub_title ) {
                                                echo '<h3 class="section-sub-title">' . esc_attr( $service_sub_title ) . '</h3>';
                                            }
                                            the_title( '<h2 class="section-title">', '</h2>' ); 
                                            the_content(); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php   }
                        wp_reset_postdata();
                        }   
                    }
                    echo '<div class="col-8">';
                        echo '<div class="row about-service">';
                            for( $i = 1; $i <= 6; $i++ ){
                                $dinner_lite_services_post_id = get_theme_mod( 'dinner_lite_services_post_'.$i, $dinner_lite_default_post ); 

                                if( $dinner_lite_services_post_id ){
                                $qry = new WP_Query ( array( 'p' => absint( $dinner_lite_services_post_id ) ) );
                                    if( $qry->have_posts() ){
                                        while( $qry->have_posts() ){
                                            $qry->the_post();
                                        ?>
                                            <div class="col-4">
                                                <div class="about-item">
                                                    <?php
                                                        if( has_post_thumbnail() ){ 
                                                            echo '<a href="' . esc_url( get_the_permalink() ) .'">';
                                                                the_post_thumbnail( 'dinner-lite-tiny' ); 
                                                            echo '</a>';
                                                        }
                                                    ?>
                                                    <div class="service-text">
                                                        <a href="<?php the_permalink(); ?>" class="about-title"><?php the_title('<h4>','</h4>'); ?></a>
                                                        <?php the_excerpt();?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                    wp_reset_postdata();  
                                }
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>'; 
            echo '</div>'; 
        echo '</section>';  
    }   

}
endif;


if( ! function_exists( 'dinner_lite_portfolio' ) ) :
/**
 * Home Page Latest Post Section
 * 
 * @since 1.0.0
*/
function dinner_lite_portfolio(){
    global $dinner_lite_default_post;
    global $dinner_lite_default_page;
    
    $portfolios_enable     = get_theme_mod( 'dinner_lite_ed_portfolio_section' );
    $portfolios_page       = get_theme_mod( 'dinner_lite_portfolio_section_page', $dinner_lite_default_page );
   
    if( $portfolios_enable ){

        echo '<section id="portfolio-section" class="portfolio-section">';
            echo '<div class="container">';
                if( $portfolios_page ) {  dinner_lite_template_header( $portfolios_page ); } 

                for( $i = 1; $i <= 8; $i++ ){
                    $dinner_lite_portfolio_post_id = get_theme_mod( 'dinner_lite_portfolio_post_'.$i, $dinner_lite_default_post ); 

                    if( $dinner_lite_portfolio_post_id ){
    
                        $qry = new WP_Query( array( 'p' => absint( $dinner_lite_portfolio_post_id ) ) );                 

                        if( $qry->have_posts() ){ 
                            while( $qry->have_posts() ){
                                $qry->the_post();

                                if( has_post_thumbnail() ){ 
                            ?>
                                    <div class="col-3">
                                        <div class="portfolio-item">
                                            <?php the_post_thumbnail( 'dinner-lite-portfolio' ); ?>
                                            <div class="portfolio-mask">
                                                <?php 
                                                    the_title('<h2>', '</h2>' );
                                                ?>
                                            </div>
                                        </div>
                                    </div> 
                                <?php
                                }
                            }
                        }
                    wp_reset_postdata();  
                    }
                }
            echo '</div>'; 
        echo '</section>';     
    }    
 
}
endif;

if( ! function_exists( 'dinner_lite_testimonial' ) ) :
/**
 * Home Page testimonials Section
 * 
 * @since 1.0.0
*/
function dinner_lite_testimonial(){
    global $dinner_lite_default_page;
    
    $testimonial_enable    = get_theme_mod( 'dinner_lite_ed_testimonials_section' );
    $testimonial_title     = get_theme_mod( 'dinner_lite_testimonials_section_title', $dinner_lite_default_page );  
    $testimonial_category  = get_theme_mod( 'dinner_lite_testimonial_category' ); 
   
    if( $testimonial_enable ){
        $args = array( 
            'post_type'          => 'post', 
            'post_status'        => 'publish',
            'posts_per_page'     => 3,        
            'ignore_sticky_post' => true  
        );

        if( $testimonial_category ){
            $args[ 'cat' ] = absint( $testimonial_category );
        }
        $qry = new WP_Query( $args );

        echo '<section id="testimonial" class="testimonial-section"  >';
            echo '<div class="container">';

            if( $testimonial_title ) {  dinner_lite_template_header( $testimonial_title ); }
           
                echo '<div class="row">';
                    if( $qry->have_posts() ){ 
                        while( $qry->have_posts() ){
                            $qry->the_post(); 
                        ?>
                        
                        <div class="col-4">
                            <div class="testimonial-holder">
                                <div class="testimonial-thumbnail">
                                    <?php if( has_post_thumbnail() ){ the_post_thumbnail( 'thumbnail' ); }
                                    else{
                                        echo '<img src="' . esc_url( get_template_directory_uri() ).'/images/team-profile-non.jpg">';
                                    } ?>
                                </div>
                                <div class="testimonial-text">
                                     <?php the_content(); ?>
                                </div>
                                <div class="testimonial-info">
                                    <?php the_title( '<h3>', '</h3>'); ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        }
                    }
                    wp_reset_postdata();  
                echo '</div>'; 
            echo '</div>'; 
        echo '</section>';     
          
    }    
 
}
endif;

if( ! function_exists( 'dinner_lite_blog' ) ) :
/**
 * Home Page testimonials Section
 * 
 * @since 1.0.0
*/
function dinner_lite_blog(){
    global $dinner_lite_default_page;
    
    $blog_enable    = get_theme_mod( 'dinner_lite_ed_blog_section' );
    $blog_title     = get_theme_mod( 'dinner_lite_blog_section_title', $dinner_lite_default_page );  
    $blog_category  = get_theme_mod( 'dinner_lite_blog_category' ); 
    $blog_btn       = get_theme_mod( 'dinner_lite_blog_section_btn',__('Read More','dinner-lite') ); 
    $blog_url       = get_theme_mod( 'dinner_lite_blog_section_btn_url','#' );
   
    if( $blog_enable ){
        $args = array( 
            'post_type'          => 'post', 
            'post_status'        => 'publish',
            'posts_per_page'     => 4,        
            'ignore_sticky_post' => true  
        );

        if( $blog_category ){
            $args[ 'cat' ] = absint( $blog_category );
        }
        $qry = new WP_Query( $args );

        echo '<section id="blog-section" class="blog-section"  >';
            echo '<div class="container">';

            if( $blog_title ) {  dinner_lite_template_header( $blog_title ); }
           
                echo '<div class="row">';
                    if( $qry->have_posts() ){ 
                        while( $qry->have_posts() ){
                            $qry->the_post(); 
                        ?>
                        
                        <div class="col-3">
                            <div class="blog-holder">
                                <div class="blog-thumbnail">
                                    <?php if( has_post_thumbnail() ){ the_post_thumbnail( 'dinner-lite-three-col' ); }
                                    else{
                                        echo '<img src="' . esc_url( get_template_directory_uri() ).'/images/default-thumb-3col.png">';
                                    } ?>
                                </div>

                                <div class="blog-info">
                                    <?php 
                                    dinner_lite_categories();
                                    echo '<a href="'.esc_url( get_the_permalink() ).'">' ;
                                    the_title( '<h3>', '</h3>'); 
                                    echo '</a>'; ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        }
                    }
                    wp_reset_postdata();  
                echo '</div>'; 
                        if( !empty( $blog_btn ) && !empty( $blog_url ) ){
                            echo '<div class="button-holder">';
                                echo '<a href="'. esc_url( $blog_url ) .'" class="btn-primary orange">';
                                    echo esc_attr( $blog_btn );
                                echo '</a>';
                            echo '</div>';
                        }
                    
            echo '</div>'; 
        echo '</section>';     
          
    }    
 
}
endif;


/**
 * Home Page Contents
 * @see dinner_lite_banner      - 20
 * @see dinner_lite_services    - 30
 * @see dinner_lite_special     - 35
 * @see dinner_lite_portfolio   - 40
 * @see dinner_lite_testimonial - 50
 * @see dinner_lite_blog        - 60
*/
add_action( 'dinner_lite_home_page', 'dinner_lite_banner', 20 );
add_action( 'dinner_lite_home_page', 'dinner_lite_services', 30 );
add_action( 'dinner_lite_home_page', 'dinner_lite_special', 35 );
add_action( 'dinner_lite_home_page', 'dinner_lite_portfolio', 40 );
add_action( 'dinner_lite_home_page', 'dinner_lite_testimonial', 50 );
add_action( 'dinner_lite_home_page', 'dinner_lite_blog', 60 );

if( ! function_exists( 'dinner_lite_content_start' ) ) :
/**
 * Content Start
 * 
 * @since 1.0.0
*/
function dinner_lite_content_start(){ 
    $ed_banner = get_theme_mod( 'dinner_lite_ed_banner_section' );
    $class = is_404() ? 'error-holder' : 'row' ;
    
    if( !( $ed_banner && is_front_page() && !is_home()) ){
    ?>
    <div id="content" class="site-content">
        <div class="container">
             <div class="<?php echo esc_attr( $class ); ?>">
    <?php
    }
}
endif;
add_action( 'dinner_lite_before_content','dinner_lite_content_start' );

if( ! function_exists( 'dinner_lite_page_content_image' ) ) :
/**
 * Page Featured Image
 * 
 * @since 1.0.0
*/
function dinner_lite_page_content_image(){
    $sidebar_layout = dinner_lite_sidebar_layout();
    if( has_post_thumbnail() ){
        echo '<div class="post-thumbnail">';
            if( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) {
                the_post_thumbnail( 'dinner-lite-with-sidebar' );    
            }else{
                the_post_thumbnail( 'dinner-lite-no-sidebar' );
            }
        echo '</div>';
    }
}
endif;

add_action( 'dinner_lite_before_page_entry_content', 'dinner_lite_page_content_image' );

if( ! function_exists( 'dinner_lite_post_content_image' ) ) :
/**
 * Post Featured Image
 * 
 * @since 1.0.0
*/
function dinner_lite_post_content_image(){
    if( has_post_thumbnail() ){
    echo ( !is_single() ) ? '<a href="' . esc_url( get_the_permalink() ) . '" class="post-thumbnail">' : '<div class="post-thumbnail">'; 
         ( is_active_sidebar( 'right-sidebar' ) ) ? the_post_thumbnail( 'dinner-lite-with-sidebar' ) : the_post_thumbnail( 'dinner-lite-without-sidebar' ) ; 
    echo ( !is_single() ) ? '</a>' : '</div>' ;    
    }
}
endif;

if( ! function_exists( 'dinner_lite_post_entry_header' ) ) :
/**
 * Post Entry Header
 * 
 * @since 1.0.0
*/
function dinner_lite_post_entry_header(){
    ?>
    
    <header class="entry-header">
        <?php
            if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php  
                        dinner_lite_posted_on(); 
                        dinner_lite_categories();
                        dinner_lite_comments();
                    ?>
                </div><!-- .entry-meta -->
        <?php
            endif; 
            
            if ( is_single() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
            } else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }

        ?>
    </header>

    <?php
}
endif;

/**
 * Before Post entry content
 * 
 * @see dinner_lite_post_content_image - 10
 * @see dinner_lite_post_entry_header  - 20
*/
add_action( 'dinner_lite_before_post_entry_content', 'dinner_lite_post_content_image', 10 ); 
add_action( 'dinner_lite_before_post_entry_content', 'dinner_lite_post_entry_header', 20 ); 

if( ! function_exists( 'dinner_lite_archive_entry_header_before' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.0
*/
function dinner_lite_archive_entry_header_before(){
    echo '<div class = "text-holder" >';
}    
endif;   
    
if( ! function_exists( 'dinner_lite_archive_entry_header' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.0
*/
function dinner_lite_archive_entry_header(){
    ?>
    <header class="entry-header">
        <div class="entry-meta">
            <?php dinner_lite_posted_on_date(); ?>
        </div><!-- .entry-meta -->
        <h2 class="entry-title"><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>
    </header>   
    <?php
}
endif;

if( ! function_exists( 'dinner_lite_post_author' ) ) :
/**
 * Post Author Bio
 * 
 * @since 1.0.0
*/
function dinner_lite_post_author(){
    if( get_the_author_meta( 'description' ) ){
        global $post;
    ?>
    <section class="author-section">
        <div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></div>
            <div class="text-holder">
                <strong class="name"><?php the_author_meta( 'display_name', $post->post_author ); ?></strong>
                <?php the_author_meta( 'description' ); ?>
            </div>
    </section>
    <?php  
    }  
}
endif;

if( ! function_exists( 'dinner_lite_get_comment_section' ) ) :
/**
 * Comment template
 * 
 * @since 1.0.0
*/
function dinner_lite_get_comment_section(){
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
}
endif;

if( ! function_exists( 'dinner_lite_content_end' ) ) :
/**
 * Content End
 * 
 * @since 1.0.0
*/
function dinner_lite_content_end(){
    
    $ed_banner = get_theme_mod( 'dinner_lite_ed_banner_section' );
        
    if( !( $ed_banner && is_front_page() && ! is_home() ) ){
        echo '</div></div></div>';// .row /#content /.container
    }
}
endif;
add_action( 'dinner_lite_after_content','dinner_lite_content_end' );

if( ! function_exists( 'dinner_lite_footer_start' ) ) :
/**
 * Footer Start
 * 
 * @since 1.0.0
*/
function dinner_lite_footer_start(){
    echo '<footer id="colophon" class="site-footer" role="contentinfo">';

}
endif;


if( ! function_exists( 'dinner_lite_footer_widgets' ) ) :
/**
 * Footer Widgets
 * 
 * @since 1.0.0 
*/
function dinner_lite_footer_widgets(){
    if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){?>
        <div class="widget-area">
            <div class="container">
                <div class="row">
                    
                    <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
                    <div class="col-4">
                        <?php dynamic_sidebar( 'footer-one' ); ?>
                    </div>
                    <?php } ?>
                    
                    <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                    <div class="col-4">
                        <?php dynamic_sidebar( 'footer-two' ); ?>
                    </div>
                    <?php } ?>
                    
                    <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                    <div class="col-4">
                        <?php dynamic_sidebar( 'footer-three' ); ?>
                    </div>
                    <?php } ?>
                    
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .widget-area -->
<?php } 
}
endif;

if( ! function_exists( 'dinner_lite_footer_credit' ) ) :
/**
 * Footer Credits 
 */

function dinner_lite_footer_credit(){
    echo '<div class="footer-b">';
        echo '<div class="site-info">'; 
            echo '<div class="container">';
                echo '<span class="left">';
                    echo esc_html( '&copy;&nbsp;'. date_i18n( 'Y' ), 'dinner-lite' );
                        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
                        printf( '&nbsp;%s', '<a href="'. esc_url( __( 'https://astaporthemes.com/downloads/dinner-lite-free-theme/', 'dinner-lite' ) ) .'" target="_blank">'. esc_html__( 'My Salon By Astapor Theme. ', 'dinner-lite' ) .'</a>' );
                echo '</span>';
                echo '<span class="right">';
                    printf( esc_html__( 'Powered by %s', 'dinner-lite' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'dinner-lite' ) ) .'" target="_blank">'. esc_html__( 'WordPress', 'dinner-lite' ) . '</a>' );
                echo '</span>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
endif;

if( ! function_exists( 'dinner_lite_footer_end' ) ) :
/**
 * Footer End
 * 
 * @since 1.0.0 
*/
function dinner_lite_footer_end(){
    echo '</footer>'; // #colophon 
}
endif;


add_action( 'dinner_lite_footer', 'dinner_lite_footer_start', 10 );
add_action( 'dinner_lite_footer', 'dinner_lite_footer_widgets', 20 );
add_action( 'dinner_lite_footer', 'dinner_lite_footer_credit', 30 );
add_action( 'dinner_lite_footer', 'dinner_lite_footer_end', 40 );