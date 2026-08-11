<?php

require get_stylesheet_directory() . '/customizer/blog-settings.php';

add_action( 'after_setup_theme', 'school_of_education_setup' );
function school_of_education_setup(){
    
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );

    $starter_content = array(
        'posts' => array(
             'home',
             'about',
             'contact',
             'blog'
        ),
        'options' => array(
            'show_on_front' => 'posts'
        ),
        'nav_menus' => array(
            'menu-1' => array(
                'name' => __( 'Main Menu', 'school-of-education' ),
                'items' => array(
                    'page_home',
                    'page_about',
                    'page_blog',
                    'page_news'
                ),
            ),
            'footer' => array(
                'name' => __( 'Footer Menu', 'school-of-education' ),
                'items' => array(
                    'page_home',
                    'page_about',
                    'page_blog',
                    'page_news'
                ),
            ),
        ),
    );

    if( defined( 'CDI_PLUGIN_DIR_PATH' ) ){

        $starter_content['attachments'] = array(
            'logo' => array(
                'post_title' => esc_html( 'Logo', 'school-of-education' ),
                'file' => 'images/logo.jpg'
            ),
        );

        $starter_content['theme_mods'] = array(
            'top_header_status'            => false,
            'custom_logo'                  => '{{logo}}',
            'homepage_latest_posts_limit'  => 3,
            'homepage_ignore_sticky_posts' => true,
            'hide_author'                  => true,
            'footer_social_links' => [
                [
                    'icon' => 'fab fa-facebook-f',
                    'link'  => '#',
                    'target' => true
                ],
                [
                    'icon' => 'fab fa-twitter',
                    'link'  => '#',
                    'target' => true
                ],
                [
                    'icon' => 'fab fa-instagram',
                    'link'  => '#',
                    'target' => true
                ],
                [
                    'icon' => 'fab fa-youtube',
                    'link'  => '#',
                    'target' => true
                ],
            ],
        );

    }

    add_theme_support( 'starter-content', $starter_content );

}

add_action( 'wp_enqueue_scripts', 'school_of_education_thm_parent_css' );
function school_of_education_thm_parent_css() {

    $my_theme = wp_get_theme();
    
    $theme_version = $my_theme->get( 'Version' );

    wp_enqueue_style( 
    	'school_of_education_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	)
    );

    if ( is_rtl() ) {
        wp_enqueue_style( 
            'school_of_education_parent_rtl', 
            trailingslashit( get_template_directory_uri() ) . 'rtl.css'
        );
    }

    wp_enqueue_script( 'waypoint', get_stylesheet_directory_uri() . '/js/waypoint.js', array('jquery'), $theme_version );
    wp_enqueue_script( 'counterup', get_stylesheet_directory_uri() . '/js/jquery.counterup.js', array('jquery'), $theme_version );
    wp_enqueue_script( 'school_of_education_scripts', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), $theme_version );
    wp_localize_script( 'school_of_education_scripts', 'school_of_education_object',
        array( 
            'rtl'                                => is_rtl() ? true : false,
            'background_animation_status'        => bizberg_get_theme_mod( 'school_of_education_background_animation_status' ),
            'background_animation_circle_colors' => wp_list_pluck( json_decode( bizberg_get_theme_mod( 'school_of_education_background_animation_colors' ) ), 'circle_color' ),
        )
    );
    
}

add_action( 'customize_preview_init', 'school_of_education_customize_enqueue' );
function school_of_education_customize_enqueue() {
    $school_of_education_theme = wp_get_theme();
    $theme_version = $school_of_education_theme->get( 'Version' );
    wp_enqueue_script( 'school_of_education_customizer_js', get_stylesheet_directory_uri() . '/js/customizer.js' ,array('jquery') ,$theme_version ,false );
}

/** 
* Enable Slick for this child theme
*/
add_filter( 'bizberg_slick_slider_status', function(){
    return true;
});

add_filter( 'bizberg_body_typo_heading_3_status', 'school_of_education_body_typo_heading_3_status' );
function school_of_education_body_typo_heading_3_status(){
    return true;
}

add_filter( 'bizberg_typography_h3', 'school_of_education_bizberg_typography_h3' );
function school_of_education_bizberg_typography_h3(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '500',
        'font-size'      => '31.25px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_typography_h3_tablet', 'school_of_education_typography_h3_tablet' );
function school_of_education_typography_h3_tablet(){
    return 29.30;
}

add_filter( 'bizberg_typography_h3_mobile', 'school_of_education_typography_h3_mobile' );
function school_of_education_typography_h3_mobile(){
    return 27.34;
}

add_filter( 'bizberg_body_typo_heading_4_status', 'school_of_education_body_typo_heading_4_status' );
function school_of_education_body_typo_heading_4_status(){
    return true;
}

add_filter( 'bizberg_typography_h4', 'school_of_education_bizberg_typography_h4' );
function school_of_education_bizberg_typography_h4(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '500',
        'font-size'      => '25px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_typography_h4_tablet', 'school_of_education_typography_h4_tablet' );
function school_of_education_typography_h4_tablet(){
    return 23.44;
}

add_filter( 'bizberg_typography_h4_mobile', 'school_of_education_typography_h4_mobile' );
function school_of_education_typography_h4_mobile(){
    return 21.88;
}

add_filter( 'bizberg_body_typo_heading_2_status', 'school_of_education_body_typo_heading_2_status' );
function school_of_education_body_typo_heading_2_status(){
    return true;
}

add_filter( 'bizberg_typography_h2', 'school_of_education_bizberg_typography_h2' );
function school_of_education_bizberg_typography_h2(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '500',
        'font-size'      => '39.06px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_typography_h2_tablet', 'school_of_education_typography_h2_tablet' );
function school_of_education_typography_h2_tablet(){
    return 36.62;
}

add_filter( 'bizberg_typography_h2_mobile', 'school_of_education_typography_h2_mobile' );
function school_of_education_typography_h2_mobile(){
    return 34.18;
}

add_filter( 'bizberg_body_typo_heading_1_status', 'school_of_education_body_typo_heading_1_status' );
function school_of_education_body_typo_heading_1_status(){
    return true;
}

add_filter( 'bizberg_typography_h1', 'school_of_education_bizberg_typography_h1' );
function school_of_education_bizberg_typography_h1(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '500',
        'font-size'      => '48.83px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_typography_h1_tablet', 'school_of_education_typography_h1_tablet' );
function school_of_education_typography_h1_tablet(){
    return 45.78;
}

add_filter( 'bizberg_typography_h1_mobile', 'school_of_education_typography_h1_mobile' );
function school_of_education_typography_h1_mobile(){
    return 42.72;
}

add_filter( 'bizberg_body_content_typo_status', 'school_of_education_body_content_typo_status' );
function school_of_education_body_content_typo_status(){
    return true;
}

add_filter( 'bizberg_typography_body_content', 'school_of_education_typography_body_content' );
function school_of_education_typography_body_content(){
    return [
        'font-family'    => 'Open Sans',
        'variant'        => 'regular',
        'font-size'      => '15px',
        'line-height'    => '1.8'
    ];
}

add_filter( 'bizberg_site_title_font', 'school_of_education_site_title_font' );
function school_of_education_site_title_font(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '500',
        'font-size'      => '24px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'text-align'     => 'left'
    ];
}

add_filter( 'bizberg_theme_container_width', 'school_of_education_theme_container_width' );
function school_of_education_theme_container_width(){
    return 1240;
}

add_action( 'init', 'school_of_education_colors' );
function school_of_education_colors(){

    $options = array(
        'bizberg_slider_title_box_highlight_color',
        'bizberg_slider_arrow_background_color',
        'bizberg_slider_dot_active_color',
        'bizberg_read_more_background_color',
        'bizberg_theme_color', // Change the theme color
        'bizberg_header_menu_color_hover',
        'bizberg_header_button_color',
        'bizberg_header_button_color_hover',
        'bizberg_link_color',
        'bizberg_link_color_hover',
        'bizberg_sidebar_widget_title_color',
        'bizberg_blog_listing_pagination_active_hover_color',
        'bizberg_heading_color',
        'bizberg_sidebar_widget_link_color_hover',
        'bizberg_footer_social_icon_color',
        'bizberg_footer_copyright_background',
        'bizberg_header_menu_color_hover_sticky_menu',
        'bizberg_background_color_1',
        'bizberg_background_color_2'
    );

    foreach ( $options as $value ) {
        
        add_filter( $value , function(){
            return '#00b6c7';
        });

    }

}

add_filter( 'bizberg_slider_banner_settings', 'school_of_education_slider_banner_settings' );
function school_of_education_slider_banner_settings(){
    return 'none';
}

add_filter( 'bizberg_sidebar_spacing_status' , 'school_of_education_sidebar_spacing_status' );
function school_of_education_sidebar_spacing_status(){
    return '0px';
}

add_filter( 'bizberg_sidebar_widget_background_color', 'school_of_education_sidebar_widget_background_color' );
function school_of_education_sidebar_widget_background_color(){
    return 'rgba(251,251,251,0)';
}

add_filter( 'bizberg_sidebar_widget_border_color' , 'school_of_education_sidebar_widget_border_color' );
function school_of_education_sidebar_widget_border_color(){
    return 'rgba(251,251,251,0)';
}

add_filter( 'bizberg_sidebar_widget_heading_font_size_status', 'school_of_education_sidebar_widget_heading_font_size_status' );
function school_of_education_sidebar_widget_heading_font_size_status(){
    return true;
}

add_filter( 'bizberg_number_setting_desktop_sidebar_widget_heading_font_sizes', 'school_of_education_number_setting_desktop_sidebar_widget_heading_font_sizes' );
function school_of_education_number_setting_desktop_sidebar_widget_heading_font_sizes(){
    return 25;
}

add_filter( 'bizberg_number_setting_tablet_sidebar_widget_heading_font_sizes', 'school_of_education_number_setting_tablet_sidebar_widget_heading_font_sizes' );
function school_of_education_number_setting_tablet_sidebar_widget_heading_font_sizes(){
    return 23.44;
}

add_filter( 'bizberg_number_setting_mobile_sidebar_widget_heading_font_sizes', 'school_of_education_number_setting_mobile_sidebar_widget_heading_font_sizes' );
function school_of_education_number_setting_mobile_sidebar_widget_heading_font_sizes(){
    return 21.88;
}

add_filter( 'bizberg_woo_product_color_status', 'school_of_education_woo_product_color_status' );
function school_of_education_woo_product_color_status(){
    return true;
}

add_filter( 'bizberg_shop_quick_view_background', 'school_of_education_shop_quick_view_background' );
add_filter( 'bizberg_shop_price_color', 'school_of_education_shop_quick_view_background' );
function school_of_education_shop_quick_view_background(){
    return '#00b6c7';
}

add_filter( 'bizberg_sidebar_settings', 'school_of_education_sidebar_settings' );
function school_of_education_sidebar_settings(){
    return 4;
}

add_filter( 'bizberg_three_col_listing_radius', 'school_of_education_three_col_listing_radius' );
function school_of_education_three_col_listing_radius(){
    return 0;
}

add_filter( 'bizberg_hide_author', 'school_of_education_hide_author' );
function school_of_education_hide_author(){
    return true;
}

add_action( 'customize_register', 'school_of_education_customizer_options', 100 );
function school_of_education_customizer_options( $wp_customize ){

    /**
    * Remove sections/panels/control of parent theme
    */
    
    $wp_customize->remove_section("transparent_header");
    $wp_customize->remove_section("progress_bar");

    $wp_customize->remove_control("header_menu_color_hover_sticky_menu");
    $wp_customize->remove_control("header_menu_separator_sticky_menu");
    $wp_customize->remove_control("header_menu_text_color_sticky_menu");
    $wp_customize->remove_control("header_navbar_background_2_sticky_menu");
    $wp_customize->remove_control("header_navbar_background_1_sticky_menu");
    $wp_customize->remove_control("header_site_tagline_color_sticky_menu");
    $wp_customize->remove_control("header_site_title_color_sticky_menu");
    $wp_customize->remove_control("header_sticky_menu_options_heading");
    $wp_customize->remove_control("header_menu_child_menu_background_sticky_menu");
    $wp_customize->remove_control("header_menu_child_menu_border_sticky_menu");
    $wp_customize->remove_control("header_menu_child_menu_text_color_sticky_menu");
    $wp_customize->remove_control("header_button_color_sticky_menu");
    $wp_customize->remove_control("header_button_color_hover_sticky_menu");
    $wp_customize->remove_control("header_button_border_color_sticky_menu");
    $wp_customize->remove_control("header_menu_slide_in_animation");

}

add_filter( 'bizberg_sticky_header_status', 'school_of_education_sticky_header_status' );
function school_of_education_sticky_header_status(){
    return 'false';
}

add_filter( 'bizberg_sticky_sidebar_margin_top_status', 'school_of_education_sticky_sidebar_margin_top_status' );
function school_of_education_sticky_sidebar_margin_top_status(){
    return 20;
}

add_filter( 'bizberg_footer_social_links', 'school_of_education_footer_social_links' );
function school_of_education_footer_social_links(){
    return array();
}

add_filter( 'bizberg_plugins', 'school_of_education_plugins', 999 );
function school_of_education_plugins(){

    $plugins = array(
        array(
            'slug' => 'one-click-demo-import/one-click-demo-import.php',
            'zip'  => 'one-click-demo-import'
        ), 
        array(
            'slug' => 'cyclone-demo-importer/index.php',
            'zip'  => 'cyclone-demo-importer'
        )           
    );

    return $plugins;

}

add_filter( 'bizberg_recommended_plugins', 'school_of_education_recommended_plugins' );
function school_of_education_recommended_plugins( $plugins ){

    $plugins = array(

        array(
            'name'     => esc_html__( 'One Click Demo Import', 'school-of-education' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ),
        array(
            'name'     => esc_html__( 'Cyclone Demo Importer', 'school-of-education' ),
            'slug'     => 'cyclone-demo-importer',
            'required' => false
        )

    );

    return $plugins;

}

// Show recommended plugins on customizer
add_filter( 'bizberg_show_recommended_plugins_on_customizer', function(){
    return true;
});

add_filter( 'bizberg_getting_started_screenshot', function(){
    return true;
});

add_filter( 'bizberg_required_plugins_redirect_link', function(){
    return esc_url( admin_url( '/customize.php' ) );
});