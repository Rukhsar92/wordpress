<?php
/**
 * Home Page Options
 *
 * @package dinner_lite
 */

function dinner_lite_customize_register_home( $wp_customize ) {
    
    global $dinner_lite_options_pages;
    global $dinner_lite_options_posts;
    global $dinner_lite_option_categories;
    global $dinner_lite_default_post;
    global $dinner_lite_default_page;
    
    /** Home Page Settings */
    $wp_customize->add_panel( 
        'dinner_lite_home_page_settings',
         array(
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'title' => __( 'Home Page Settings', 'dinner-lite' ),
            'description' => __( 'Customize Home Page Settings', 'dinner-lite' ),
        ) 
    );
    

    /** Banner Section Settings */
    $wp_customize->add_section(
        'dinner_lite_banner_section_settings',
        array(
            'title' => __( 'Banner Section', 'dinner-lite' ),
            'priority' => 15,
            'capability' => 'edit_theme_options',
            'panel' => 'dinner_lite_home_page_settings'
        )
    );
    
    /** Enable Banner Section */   
    $wp_customize->add_setting(
        'dinner_lite_ed_banner_section',
        array(
            'default' => '',
            'sanitize_callback' => 'dinner_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'dinner_lite_ed_banner_section',
        array(
            'label' => __( 'Enable Banner Section', 'dinner-lite' ),
            'section' => 'dinner_lite_banner_section_settings',
            'type' => 'checkbox',
        )
    );

    /** Section Sub Title */
    $wp_customize->add_setting(
        'dinner_lite_banner_section_sub_title',
        array(
            'default'=> '',
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_banner_section_sub_title',
        array(
              'label' => __('Section Sub Title','dinner-lite'),
              'type' => 'text',
              'section' => 'dinner_lite_banner_section_settings', 
            ) 
        );

    /** Button */
    $wp_customize->add_setting(
        'dinner_lite_banner_section_btn',
        array(
            'default'=> __('Book A Table','dinner-lite'),
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_banner_section_btn',
        array(
              'label' => __('Button Text','dinner-lite'),
              'type' => 'text',
              'section' => 'dinner_lite_banner_section_settings', 
            ) 
        );

    $wp_customize->add_setting(
        'dinner_lite_banner_section_btn_url',
        array(
            'default'=> '#',
            'sanitize_callback'=> 'esc_url_raw'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_banner_section_btn_url',
        array(
              'label' => __('Button Url','dinner-lite'),
              'type' => 'text',
              'section' => 'dinner_lite_banner_section_settings', 
            ) 
        );


    /** Services Section */
    $wp_customize->add_section(
        'dinner_lite_services_section_settings',
        array(
            'title' => __( 'Services Section', 'dinner-lite' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'dinner_lite_home_page_settings'
        )
    );
    
    /** Enable/Disable Services Section */
    $wp_customize->add_setting(
        'dinner_lite_ed_services_section',
        array(
            'default' => '',
            'sanitize_callback' => 'dinner_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'dinner_lite_ed_services_section',
        array(
            'label' => __( 'Enable Services Post Section', 'dinner-lite' ),
            'section' => 'dinner_lite_services_section_settings',
            'type' => 'checkbox',
        )
    );

    /** Section Sub Title */
    $wp_customize->add_setting(
        'dinner_lite_about_section_sub_title',
        array(
            'default'=> '',
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_about_section_sub_title',
        array(
              'label' => __('Section Sub Title','dinner-lite'),
              'type' => 'text',
              'section' => 'dinner_lite_services_section_settings', 
            ) 
        );

    /** Section Title */
    $wp_customize->add_setting(
        'dinner_lite_services_section_title',
        array(
            'default'=> $dinner_lite_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_services_section_title',
        array(
              'label' => __('Select About Info Page','dinner-lite'),
              'type' => 'select',
              'choices' => $dinner_lite_options_pages,
              'section' => 'dinner_lite_services_section_settings', 
         
            )
    );

    for( $i=1; $i<=6; $i++){  
    
        /** Services Post */
        $wp_customize->add_setting(
            'dinner_lite_services_post_'.$i,
            array(
                'default' => $dinner_lite_default_post,
                'sanitize_callback' => 'dinner_lite_sanitize_select',
            ));
        
        $wp_customize->add_control(
            'dinner_lite_services_post_'.$i,
            array(
                'label' => __( 'Select Services Post ', 'dinner-lite' ) .$i ,
                'section' => 'dinner_lite_services_section_settings',
                'type' => 'select',
                'choices' => $dinner_lite_options_posts
            ));

    }


    /** Today's Special Section Settings */
    $wp_customize->add_section(
        'dinner_lite_special_section_settings',
        array(
            'title' => __( 'Today Special Section', 'dinner-lite' ),
            'priority' => 60,
            'capability' => 'edit_theme_options',
            'panel' => 'dinner_lite_home_page_settings'
        )
    );
    
    /** Enable Special Section */
    $wp_customize->add_setting(
        'dinner_lite_ed_special_section',
        array(
            'default' => '',
            'sanitize_callback' => 'dinner_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'dinner_lite_ed_special_section',
        array(
            'label' => __( 'Enable Today Special Section', 'dinner-lite' ),
            'section' => 'dinner_lite_special_section_settings',
            'type' => 'checkbox',
        )
    );

    /** Section Title */
    $wp_customize->add_setting(
        'dinner_lite_special_section_page',
        array(
            'default'=> $dinner_lite_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    
    $wp_customize-> add_control(
        'dinner_lite_special_section_page',
        array(
              'label' => __('Select Title Page','dinner-lite'),
              'type' => 'select',
              'choices' => $dinner_lite_options_pages,
              'section' => 'dinner_lite_special_section_settings', 
              
        ));


    for( $i=1; $i<=4; $i++){  
        /** Special Post */
        $wp_customize->add_setting(
            'dinner_lite_special_post_'.$i,
            array(
                'default' => $dinner_lite_default_post,
                'sanitize_callback' => 'dinner_lite_sanitize_select',
            ));
        
        $wp_customize->add_control(
            'dinner_lite_special_post_'.$i,
            array(
                'label' => __( 'Select Special Post ', 'dinner-lite' ). $i,
                'section' => 'dinner_lite_special_section_settings',
                'type' => 'select',
                'choices' => $dinner_lite_options_posts
            ));
    }

    /** Button */
        $wp_customize->add_setting(
        'dinner_lite_special_section_btn',
        array(
            'default'=> __('View More','dinner-lite'),
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_special_section_btn',
        array(
              'label' => __('Button Text','dinner-lite'),
              'type' => 'text',
              'section' => 'dinner_lite_special_section_settings', 
            ) 
        );

    $wp_customize->add_setting(
        'dinner_lite_special_section_btn_url',
        array(
            'default'=> '#',
            'sanitize_callback'=> 'esc_url_raw'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_special_section_btn_url',
        array(
              'label' => __('Button Url','dinner-lite'),
              'type' => 'text',
              'section' => 'dinner_lite_special_section_settings', 
            ) 
        );

    
    /** Portfolio Section Settings */
    $wp_customize->add_section(
        'dinner_lite_portfolio_section_settings',
        array(
            'title' => __( 'Portfolio Section', 'dinner-lite' ),
            'priority' => 60,
            'capability' => 'edit_theme_options',
            'panel' => 'dinner_lite_home_page_settings'
        )
    );
    
    /** Enable Portfolio Section */
    $wp_customize->add_setting(
        'dinner_lite_ed_portfolio_section',
        array(
            'default' => '',
            'sanitize_callback' => 'dinner_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'dinner_lite_ed_portfolio_section',
        array(
            'label' => __( 'Enable Portfolio Section', 'dinner-lite' ),
            'section' => 'dinner_lite_portfolio_section_settings',
            'type' => 'checkbox',
        )
    );

    /** Section Title */
    $wp_customize->add_setting(
        'dinner_lite_portfolio_section_page',
        array(
            'default'=> $dinner_lite_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    
    $wp_customize-> add_control(
        'dinner_lite_portfolio_section_page',
        array(
              'label' => __('Select Title Page','dinner-lite'),
              'type' => 'select',
              'choices' => $dinner_lite_options_pages,
              'section' => 'dinner_lite_portfolio_section_settings', 
              
        ));


    for( $i=1; $i<=8; $i++){  
        /** Portfolio Post */
        $wp_customize->add_setting(
            'dinner_lite_portfolio_post_'.$i,
            array(
                'default' => $dinner_lite_default_post,
                'sanitize_callback' => 'dinner_lite_sanitize_select',
            ));
        
        $wp_customize->add_control(
            'dinner_lite_portfolio_post_'.$i,
            array(
                'label' => __( 'Select Post ', 'dinner-lite' ). $i,
                'section' => 'dinner_lite_portfolio_section_settings',
                'type' => 'select',
                'choices' => $dinner_lite_options_posts
            ));
    }
    
    /** Testimonials Section Settings */
    $wp_customize->add_section(
        'dinner_lite_testimonials_section_settings',
        array(
            'title' => __( 'Testimonials Section', 'dinner-lite' ),
            'priority' => 80,
            'capability' => 'edit_theme_options',
            'panel' => 'dinner_lite_home_page_settings'
        )
    );

    /** Enable Testimonials Section */   
    $wp_customize->add_setting(
        'dinner_lite_ed_testimonials_section',
        array(
            'default' => '',
            'sanitize_callback' => 'dinner_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'dinner_lite_ed_testimonials_section',
        array(
            'label' => __( 'Enable Testimonials Section', 'dinner-lite' ),
            'section' => 'dinner_lite_testimonials_section_settings',
            'type' => 'checkbox',
        ));
    
    /** Section Title */
    $wp_customize->add_setting(
        'dinner_lite_testimonials_section_title',
        array(
            'default'=> $dinner_lite_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_testimonials_section_title',
        array(
              'label' => __('Select Page','dinner-lite'),
              'type' => 'select',
              'choices' => $dinner_lite_options_pages,
              'section' => 'dinner_lite_testimonials_section_settings', 
         
            ));

    /** Select Testimonials Category */
    $wp_customize->add_setting(
        'dinner_lite_testimonial_category',
        array(
            'default' => '',
            'sanitize_callback' => 'dinner_lite_sanitize_select',
        ));
    
    $wp_customize->add_control(
        'dinner_lite_testimonial_category',
        array(
            'label' => __( 'Select Testimonial Category', 'dinner-lite' ),
            'section' => 'dinner_lite_testimonials_section_settings',
            'type' => 'select',
            'choices' => $dinner_lite_option_categories
        ));


    /** blogs Section Settings */
    $wp_customize->add_section(
        'dinner_lite_blogs_section_settings',
        array(
            'title' => __( 'Blog Section', 'dinner-lite' ),
            'priority' => 80,
            'capability' => 'edit_theme_options',
            'panel' => 'dinner_lite_home_page_settings'
        )
    );

    /** Enable blogs Section */   
    $wp_customize->add_setting(
        'dinner_lite_ed_blog_section',
        array(
            'default' => '',
            'sanitize_callback' => 'dinner_lite_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'dinner_lite_ed_blog_section',
        array(
            'label' => __( 'Enable blogs Section', 'dinner-lite' ),
            'section' => 'dinner_lite_blogs_section_settings',
            'type' => 'checkbox',
        ));
    
    /** Section Title */
    $wp_customize->add_setting(
        'dinner_lite_blog_section_title',
        array(
            'default'=> $dinner_lite_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_blog_section_title',
        array(
              'label' => __('Select Page','dinner-lite'),
              'type' => 'select',
              'choices' => $dinner_lite_options_pages,
              'section' => 'dinner_lite_blogs_section_settings', 
         
            ));

    /** Select blogs Category */
    $wp_customize->add_setting(
        'dinner_lite_blog_category',
        array(
            'default' => '',
            'sanitize_callback' => 'dinner_lite_sanitize_select',
        ));
    
    $wp_customize->add_control(
        'dinner_lite_blog_category',
        array(
            'label' => __( 'Select blog Category', 'dinner-lite' ),
            'section' => 'dinner_lite_blogs_section_settings',
            'type' => 'select',
            'choices' => $dinner_lite_option_categories
        ));

    /** Button */
    $wp_customize->add_setting(
        'dinner_lite_blog_section_btn',
        array(
            'default'=> __('View More','dinner-lite'),
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_blog_section_btn',
        array(
              'label' => __('Button Text','dinner-lite'),
              'type' => 'text',
              'section' => 'dinner_lite_blogs_section_settings', 
            ) 
        );

    $wp_customize->add_setting(
        'dinner_lite_blog_section_btn_url',
        array(
            'default'=> '#',
            'sanitize_callback'=> 'esc_url_raw'
            )
        );
    $wp_customize-> add_control(
        'dinner_lite_blog_section_btn_url',
        array(
              'label' => __('Button Url','dinner-lite'),
              'type' => 'text',
              'section' => 'dinner_lite_blogs_section_settings', 
            ) 
        );


}
add_action( 'customize_register', 'dinner_lite_customize_register_home' );
