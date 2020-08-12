<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package dinner_lite
 */

if( ! function_exists( 'dinner_lite_categories' ) ) :
/**
 * Function that list categories
*/
function dinner_lite_categories( $blog = false ){
    
    $categories_list = get_the_category_list( esc_html( ', ' ) ); 
    if ( $categories_list && dinner_lite_categorized_blog() ) {
        printf( '<span class="category">' . esc_html( '%1$s' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    }
}
endif;

if( ! function_exists( 'dinner_lite_comments' ) ) :
/**
 * Function that list categories
*/
function dinner_lite_comments( $blog = false ){

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'dinner-lite' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
}
endif;


if ( ! function_exists( 'dinner_lite_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function dinner_lite_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		echo '<span class="byline">'.__('By ','dinner-lite').'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span><span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>'; // WPCS: XSS OK.

	}
endif;



if ( ! function_exists( 'dinner_lite_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function dinner_lite_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'dinner-lite' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'dinner-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'dinner-lite' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if( ! function_exists( 'dinner_lite_sidebar_layout' ) ) :
/**
 * Return sidebar layouts for pages
 */
function dinner_lite_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'dinner_lite_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'dinner_lite_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
    
}
endif;


if( ! function_exists( ' dinner_lite_get_the_archive_title' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function  dinner_lite_get_the_archive_title( $title ){

    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author() ;
    }	else {
    	$title = ( single_month_title(' ',false) ); 
    }
return $title;
}
endif;
add_filter( 'get_the_archive_title', 'dinner_lite_get_the_archive_title' );

if( ! function_exists( 'dinner_lite_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function dinner_lite_change_comment_form_default_fields( $fields ){
    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'dinner-lite' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'dinner-lite' ) . '" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'dinner-lite' ) . '" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;
    
}
endif;
add_filter( 'comment_form_default_fields', 'dinner_lite_change_comment_form_default_fields' );

if( ! function_exists( 'dinner_lite_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function dinner_lite_change_comment_form_defaults( $defaults ){
    
    // Change the "cancel" to "I would rather not comment" and use a span instead
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment"></label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'dinner-lite' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    
    $defaults['label_submit'] = esc_attr__( 'Submit', 'dinner-lite' );
    
    return $defaults;
    
}
endif;
add_filter( 'comment_form_defaults', 'dinner_lite_change_comment_form_defaults' );


if( ! function_exists( 'dinner_lite_pg_header' ) ) :
/**
 * Page Header for inner pages
*/
function dinner_lite_pg_header(){    
    if( ! is_front_page() ){

    	if( !is_single() ){
        ?>
        <!-- Page Header for inner pages only -->
        <div class="top-bar">
            <header class="page-header">
                <h1 class="page-title">
                <?php                
                
                    if( is_home() ) single_post_title();
                    
                    if( is_page() ) the_title(); //For Page, Post & Attachment
                    
                    if( is_search() ) printf( esc_html__( 'Search Results for "%s"', 'dinner-lite' ), get_search_query() ); 
                    
                    if( is_404() ) echo esc_html__( '404 - Page not Found', 'dinner-lite' ); //For 404
                    
                    if( is_archive() ) the_archive_title();
                    
                ?>
                </h1>
            </header>
    	</div>
    <?php
		}
    }else{

		$banner_enable       = get_theme_mod( 'dinner_lite_ed_banner_section' );
		$service_enable      = get_theme_mod( 'dinner_lite_ed_services_section' );
		$special_enable      = get_theme_mod( 'dinner_lite_ed_special_section' );
		$blog_enable         = get_theme_mod( 'dinner_lite_ed_blog_section' );
		$portfolio_enable    = get_theme_mod( 'dinner_lite_ed_portfolio_section' );
		$testimonials_enable = get_theme_mod( 'dinner_lite_ed_testimonials_section' );
		
		if( ($banner_enable != 1) && ($service_enable != 1) && ($special_enable != 1) && ($blog_enable != 1) && ($portfolio_enable != 1) && ($testimonials_enable != 1) ){
			echo '<div class="top-bar">';
	            echo '<header class="page-header">';
	                echo '<h1 class="page-title">';
	                
	                    if( is_home() ) single_post_title();
	                    
	                    if( is_page() ) the_title(); //For Page, Post & Attachment
	                
	                echo '</h1>';
	            echo '</header>';
    	echo '</div>';
    	}
    }
}
endif;

add_action( 'dinner_lite_before_content', 'dinner_lite_pg_header',5 );