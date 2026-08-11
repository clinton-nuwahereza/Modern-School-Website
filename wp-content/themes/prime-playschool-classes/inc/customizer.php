<?php
/**
 * Prime Playschool Classes Theme Customizer.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package prime_playschool_classes
 */

if( ! function_exists( 'prime_playschool_classes_customize_register' ) ):  
/**
 * Add postMessage support for site title and description for the Theme Customizer.F
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prime_playschool_classes_customize_register( $wp_customize ) {
    require get_parent_theme_file_path('/inc/controls/changeable-icon.php');

    require get_parent_theme_file_path('/inc/controls/sortable-control.php');
    
    //Register the sortable control type.
    $wp_customize->register_control_type( 'Prime_Playschool_Classes_Control_Sortable' ); 
    
    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'prime-playschool-classes' );
    }
	
    /* Option list of all post */	
    $prime_playschool_classes_options_posts = array();
    $prime_playschool_classes_options_posts_obj = get_posts('posts_per_page=-1');
    $prime_playschool_classes_options_posts[''] = esc_html__( 'Choose Post', 'prime-playschool-classes' );
    foreach ( $prime_playschool_classes_options_posts_obj as $prime_playschool_classes_posts ) {
    	$prime_playschool_classes_options_posts[$prime_playschool_classes_posts->ID] = $prime_playschool_classes_posts->post_title;
    }
    
    /* Option list of all categories */
    $prime_playschool_classes_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $prime_playschool_classes_option_categories = array();
    $prime_playschool_classes_category_lists = get_categories( $prime_playschool_classes_args );
    $prime_playschool_classes_option_categories[''] = esc_html__( 'Choose Category', 'prime-playschool-classes' );
    foreach( $prime_playschool_classes_category_lists as $prime_playschool_classes_category ){
        $prime_playschool_classes_option_categories[$prime_playschool_classes_category->term_id] = $prime_playschool_classes_category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Default Settings', 'prime-playschool-classes' ),
            'description' => esc_html__( 'Default section provided by wordpress customizer.', 'prime-playschool-classes' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel                  = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel                         = 'wp_default_panel';
    $wp_customize->get_section( 'header_image' )->panel                   = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel               = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel              = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /** Default Settings Ends */
    
    /** Site Title control */
    $wp_customize->add_setting( 
        'header_site_title', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_site_title',
        array(
            'label'       => __( 'Show / Hide Site Title', 'prime-playschool-classes' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    /** Tagline control */
    $wp_customize->add_setting( 
        'header_tagline', 
        array(
            'default'           => false,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_tagline',
        array(
            'label'       => __( 'Show / Hide Tagline', 'prime-playschool-classes' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('logo_width', array(
        'sanitize_callback' => 'absint', 
    ));

    // Add a control for logo width
    $wp_customize->add_control('logo_width', array(
        'label' => __('Logo Width', 'prime-playschool-classes'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'min' => '50', 
            'max' => '500', 
            'step' => '5', 
    ),
        'default' => '100', 
    ));

    $wp_customize->add_setting( 'prime_playschool_classes_site_title_size', array(
        'default'           => 27, // Default font size in pixels
        'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
    ) );

    // Add control for site title size
    $wp_customize->add_control( 'prime_playschool_classes_site_title_size', array(
        'type'        => 'number',
        'section'     => 'title_tagline', // You can change this section to your preferred section
        'label'       => __( 'Site Title Font Size (px)', 'prime-playschool-classes' ),
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 1,
        ),
    ) );

    /** Post Layouts */

    $wp_customize->add_panel( 
        'prime_playschool_classes_post_settings',
         array(
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Post & Pages Settings', 'prime-playschool-classes' ),
            'description' => esc_html__( 'Customize Post & Pages Settings', 'prime-playschool-classes' ),
        ) 
    );
    
    $wp_customize->add_section(
        'prime_playschool_classes_post_layout_section',
        array(
            'title' => esc_html__( 'Post Layout Settings', 'prime-playschool-classes' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_post_settings',
        )
    );

    $wp_customize->add_setting('prime_playschool_classes_post_layout_setting', array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_post_layout',
    ));

    $wp_customize->add_control('prime_playschool_classes_post_layout_setting', array(
        'label'    => __('Post Column Settings', 'prime-playschool-classes'),
        'section'  => 'prime_playschool_classes_post_layout_section',
        'settings' => 'prime_playschool_classes_post_layout_setting',
        'type'     => 'select',
        'choices'  => array(
            'one-column'   => __('One Column', 'prime-playschool-classes'),
            'right-sidebar'   => __('Right Sidebar', 'prime-playschool-classes'),
            'left-sidebar'   => __('Left Sidebar', 'prime-playschool-classes'),
            'three-column'   => __('Three Columns', 'prime-playschool-classes'),
            'four-column'   => __('Four Columns', 'prime-playschool-classes'),
        ),
    ));

    $wp_customize->add_setting('prime_playschool_classes_archive_pagination_alignment',array(
        'default' => 'left-align',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_pagination_alignment'
    ));
    $wp_customize->add_control('prime_playschool_classes_archive_pagination_alignment',array(
        'type' => 'select',
        'label' => __('Pagination Alignment','prime-playschool-classes'),
        'section' => 'prime_playschool_classes_post_layout_section',
        'choices' => array(
            'right-align' => __('Right Alignment','prime-playschool-classes'),
            'center-align' => __('Center Alignment','prime-playschool-classes'),
            'left-align' => __('Left Alignment','prime-playschool-classes'),
        ),
    ) );

     /** Post Layouts Ends */

    /** Post Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_post_settings',
        array(
            'title' => esc_html__( 'Post Settings', 'prime-playschool-classes' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_post_settings',
        )
    );

    /** Post Heading control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_post_heading_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_post_heading_setting',
        array(
            'label'       => __( 'Show / Hide Post Heading', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Meta control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Post Meta', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Image control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_post_image_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_post_image_setting',
        array(
            'label'       => __( 'Show / Hide Post Image', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Content control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Post Content', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_post_settings',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('prime_playschool_classes_single_post_align',array(
        'default' => 'left-align',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_single_post_align'
    ));
    $wp_customize->add_control('prime_playschool_classes_single_post_align',array(
        'type' => 'select',
        'label' => __('Post Content Alignment','prime-playschool-classes'),
        'section' => 'prime_playschool_classes_post_settings',
        'choices' => array(
            'left-align' => __('Left Alignment','prime-playschool-classes'),
            'right-align' => __('Right Alignment','prime-playschool-classes'),
            'center-align' => __('Center Alignment','prime-playschool-classes'),
        ),
    ) );

    $wp_customize->add_setting('prime_playschool_classes_blog_meta_order', array(
        'default' => array('heading', 'author', 'featured-image', 'content','button'),
        'sanitize_callback' => 'prime_playschool_classes_sanitize_sortable',
    ));
    $wp_customize->add_control(new Prime_Playschool_Classes_Control_Sortable($wp_customize, 'prime_playschool_classes_blog_meta_order', array(
        'label' => esc_html__('Post Meta Ordering', 'prime-playschool-classes'),
        'description' => __('Drag & drop post items to rearrange the ordering ( this control will not function by post format )', 'prime-playschool-classes') ,
        'section' => 'prime_playschool_classes_post_settings',
        'choices' => array(
            'heading' => __('heading', 'prime-playschool-classes') ,
            'author' => __('author', 'prime-playschool-classes') ,
            'featured-image' => __('featured-image', 'prime-playschool-classes') ,
            'content' => __('content', 'prime-playschool-classes') ,
            'button' => __('button', 'prime-playschool-classes') ,
        ) ,
    )));

    /** Post Settings Ends */

    //Global Color
    $wp_customize->add_section(
        'prime_playschool_classes_global_color',
        array(
            'title' => esc_html__( 'Global Color Settings', 'prime-playschool-classes' ),
            'priority' => 1,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_general_settings',
        )
    );

    $wp_customize->add_setting('prime_playschool_classes_primary_color', array(
        'default'           => '#fe598b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prime_playschool_classes_primary_color', array(
        'label'    => __('Theme Primary Color', 'prime-playschool-classes'),
        'section'  => 'prime_playschool_classes_global_color',
        'settings' => 'prime_playschool_classes_primary_color',
    )));    

    $wp_customize->add_setting('prime_playschool_classes_secondary_color', array(
        'default'           => '#3a3d72',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prime_playschool_classes_secondary_color', array(
        'label'    => __('Theme Secondary Color', 'prime-playschool-classes'),
        'section'  => 'prime_playschool_classes_global_color',
        'settings' => 'prime_playschool_classes_secondary_color',
    )));

    // Typography Settings Section
    $wp_customize->add_section('prime_playschool_classes_typography_settings', array(
        'title'      => esc_html__('Typography Settings', 'prime-playschool-classes'),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
        'panel' => 'prime_playschool_classes_general_settings',
    ));

    // Array of fonts to choose from
    $font_choices = array(
        ''               => __('Select', 'prime-playschool-classes'),
        'Arial'          => 'Arial, sans-serif',
        'Verdana'        => 'Verdana, sans-serif',
        'Helvetica'      => 'Helvetica, sans-serif',
        'Times New Roman'=> '"Times New Roman", serif',
        'Georgia'        => 'Georgia, serif',
        'Courier New'    => '"Courier New", monospace',
        'Trebuchet MS'   => '"Trebuchet MS", sans-serif',
        'Tahoma'         => 'Tahoma, sans-serif',
        'Palatino'       => '"Palatino Linotype", serif',
        'Garamond'       => 'Garamond, serif',
        'Impact'         => 'Impact, sans-serif',
        'Comic Sans MS'  => '"Comic Sans MS", cursive, sans-serif',
        'Lucida Sans'    => '"Lucida Sans Unicode", sans-serif',
        'Arial Black'    => '"Arial Black", sans-serif',
        'Gill Sans'      => '"Gill Sans", sans-serif',
        'Segoe UI'       => '"Segoe UI", sans-serif',
        'Open Sans'      => '"Open Sans", sans-serif',
        'Roboto'         => 'Roboto, sans-serif',
        'Lato'           => 'Lato, sans-serif',
        'Montserrat'     => 'Montserrat, sans-serif',
        'Libre Baskerville' => 'Libre Baskerville',
    );

    // Heading Font Setting
    $wp_customize->add_setting('prime_playschool_classes_heading_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_choicess',
    ));
    $wp_customize->add_control('prime_playschool_classes_heading_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Heading', 'prime-playschool-classes'),
        'section' => 'prime_playschool_classes_typography_settings',
    ));

    // Body Font Setting
    $wp_customize->add_setting('prime_playschool_classes_body_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_choicess',
    ));
    $wp_customize->add_control('prime_playschool_classes_body_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Body', 'prime-playschool-classes'),
        'section' => 'prime_playschool_classes_typography_settings',
    ));

    /** Typography Settings Section End */

     /** Single Post Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_single_post_settings',
        array(
            'title' => esc_html__( 'Single Post Settings', 'prime-playschool-classes' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_post_settings',
        )
    );

    /** Single Post Meta control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_single_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_single_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Meta', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Content control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_single_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_single_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Content', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Settings Ends */

    $wp_customize->add_panel( 
        'prime_playschool_classes_general_settings',
         array(
            'priority' => 11,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'General Settings', 'prime-playschool-classes' ),
            'description' => esc_html__( 'Customize General Settings', 'prime-playschool-classes' ),
        ) 
    );

    /** General Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_general_settings',
        array(
            'title' => esc_html__( 'Loader Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_general_settings',
        )
    );

    /** Preloader control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_preloader_setting', 
        array(
            'default'           => false,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_preloader_setting',
        array(
            'label'       => __( 'Show / Hide Preloader', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_general_settings',
            'type'        => 'checkbox',
        )
    );

    /** Header Section Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_header_section_settings',
        array(
            'title' => esc_html__( 'Header Section Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_home_page_settings',
        )
    );

    /** Header Section control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_header_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_header_setting',
        array(
            'label'       => __( 'Show Header', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_header_section_settings',
            'type'        => 'checkbox',
        )
    );

    /**  Location */
    $wp_customize->add_setting(
        'prime_playschool_classes_header_location',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_header_location',
        array(
            'label' => esc_html__( 'Add Location', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_header_section_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting('prime_playschool_classes_marker_icon',array(
        'default'   => 'fas fa-map-marker-alt',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Prime_Playschool_Classes_Changeable_Icon(
        $wp_customize,'prime_playschool_classes_marker_icon',array(
        'label' => __('Location Icon','prime-playschool-classes'),
        'transport' => 'refresh',
        'section'   => 'prime_playschool_classes_header_section_settings',
        'type'      => 'icon'
    )));
    /** Email */
    $wp_customize->add_setting(
        'prime_playschool_classes_header_email',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_header_email',
        array(
            'label' => esc_html__( 'Add Email', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_header_section_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting('prime_playschool_classes_mail_icon',array(
        'default'   => 'fas fa-envelope',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Prime_Playschool_Classes_Changeable_Icon(
        $wp_customize,'prime_playschool_classes_mail_icon',array(
        'label' => __('Mail Icon','prime-playschool-classes'),
        'transport' => 'refresh',
        'section'   => 'prime_playschool_classes_header_section_settings',
        'type'      => 'icon'
    )));

   

    /** Phone */
    $wp_customize->add_setting(
        'prime_playschool_classes_header_phone',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_header_phone',
        array(
            'label' => esc_html__( 'Add Phone', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_header_section_settings',
            'type' => 'text',
        )
    );
    $wp_customize->add_setting('prime_playschool_classes_phone_icon',array(
        'default'   => 'fas fa-phone',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Prime_Playschool_Classes_Changeable_Icon(
        $wp_customize,'prime_playschool_classes_phone_icon',array(
        'label' => __('Phone Icon','prime-playschool-classes'),
        'transport' => 'refresh',
        'section'   => 'prime_playschool_classes_header_section_settings',
        'type'      => 'icon'
    )));

    /** Sticky Header control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_sticky_header', 
        array(
            'default' => false,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'prime_playschool_classes_sticky_header',
        array(
            'label'       => __( 'Show Sticky Header', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_header_section_settings',
            'type'        => 'checkbox',
        )
    );


    // Add Setting for Menu Font Weight
    $wp_customize->add_setting( 'prime_playschool_classes_menu_font_weight', array(
        'default'           => '400',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_font_weight',
    ) );

    // Add Control for Menu Font Weight
    $wp_customize->add_control( 'prime_playschool_classes_menu_font_weight', array(
        'label'    => __( 'Menu Font Weight', 'prime-playschool-classes' ),
        'section'  => 'prime_playschool_classes_header_section_settings',
        'type'     => 'select',
        'choices'  => array(
            '100' => __( '100 - Thin', 'prime-playschool-classes' ),
            '200' => __( '200 - Extra Light', 'prime-playschool-classes' ),
            '300' => __( '300 - Light', 'prime-playschool-classes' ),
            '400' => __( '400 - Normal', 'prime-playschool-classes' ),
            '500' => __( '500 - Medium', 'prime-playschool-classes' ),
            '600' => __( '600 - Semi Bold', 'prime-playschool-classes' ),
            '700' => __( '700 - Bold', 'prime-playschool-classes' ),
            '800' => __( '800 - Extra Bold', 'prime-playschool-classes' ),
            '900' => __( '900 - Black', 'prime-playschool-classes' ),
        ),
    ) );

    // Add Setting for Menu Text Transform
    $wp_customize->add_setting( 'prime_playschool_classes_menu_text_transform', array(
        'default'           => 'capitalize',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_text_transform',
    ) );

    // Add Control for Menu Text Transform
    $wp_customize->add_control( 'prime_playschool_classes_menu_text_transform', array(
        'label'    => __( 'Menu Text Transform', 'prime-playschool-classes' ),
        'section'  => 'prime_playschool_classes_header_section_settings',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __( 'None', 'prime-playschool-classes' ),
            'capitalize' => __( 'Capitalize', 'prime-playschool-classes' ),
            'uppercase'  => __( 'Uppercase', 'prime-playschool-classes' ),
            'lowercase'  => __( 'Lowercase', 'prime-playschool-classes' ),
        ),
    ) );

    $wp_customize->add_setting('prime_playschool_classes_menus_style',array(
        'default' => '',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_choices'
	));
	$wp_customize->add_control('prime_playschool_classes_menus_style',array(
        'type' => 'select',
		'label' => __('Menu Hover Style','prime-playschool-classes'),
		'section' => 'prime_playschool_classes_header_section_settings',
		'choices' => array(
         'None' => __('None','prime-playschool-classes'),
         'Zoom In' => __('Zoom In','prime-playschool-classes'),
      ),
	));

    /** Header Section Settings End */

    /** Socail Section Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_social_section_settings',
        array(
            'title' => esc_html__( 'Social Media Section Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_home_page_settings',
        )
    );

    /** Socail Section control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_social_icon_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_social_icon_setting',
        array(
            'label'       => __( 'Show Social Icon', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_social_section_settings',
            'type'        => 'checkbox',
        )
    );

    /**  Social Link 1 */
    $wp_customize->add_setting(
        'prime_playschool_classes_social_link_1',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_social_link_1',
        array(
            'label' => esc_html__( 'Add Facebook Link', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 2 */
    $wp_customize->add_setting(
        'prime_playschool_classes_social_link_2',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_social_link_2',
        array(
            'label' => esc_html__( 'Add Twitter Link', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 3 */
    $wp_customize->add_setting(
        'prime_playschool_classes_social_link_3',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_social_link_3',
        array(
            'label' => esc_html__( 'Add Instagram Link', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 4 */
    $wp_customize->add_setting(
        'prime_playschool_classes_social_link_4',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_social_link_4',
        array(
            'label' => esc_html__( 'Add Pintrest Link', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_social_section_settings',
            'type' => 'url',
        )
    );

    /** Socail Section Settings End */

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'prime_playschool_classes_home_page_settings',
         array(
            'priority' => 9,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Home Page Settings', 'prime-playschool-classes' ),
            'description' => esc_html__( 'Customize Home Page Settings', 'prime-playschool-classes' ),
        ) 
    );

    /** Slider Section Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_slider_section_settings',
        array(
            'title' => esc_html__( 'Slider Section Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_home_page_settings',
        )
    );

    /** Slider Section control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_slider_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_slider_setting',
        array(
            'label'       => __( 'Show Slider', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_slider_section_settings',
            'type'        => 'checkbox',
        )
    );
    
    $categories = get_categories();
        $cat_posts = array();
            $i = 0;
            $cat_posts[]='Select';
        foreach($categories as $category){
            if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting(
        'prime_playschool_classes_blog_slide_category',
        array(
            'default'   => 'select',
            'sanitize_callback' => 'prime_playschool_classes_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'prime_playschool_classes_blog_slide_category',
        array(
            'type'    => 'select',
            'choices' => $cat_posts,
            'label' => __('Select Category to display Latest Post','prime-playschool-classes'),
            'section' => 'prime_playschool_classes_slider_section_settings',
        )
    );

    /** Classes Section Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_classes_section_settings',
        array(
            'title' => esc_html__( 'Classes Section Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_home_page_settings',
        )
    );

    /** Classes Section control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_classes_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_classes_setting',
        array(
            'label'       => __( 'Show Classes', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_classes_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Section Title
    $wp_customize->add_setting(
        'prime_playschool_classes_section_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'prime_playschool_classes_section_title', 
        array(
            'label'       => __('Section Title', 'prime-playschool-classes'),
            'section'     => 'prime_playschool_classes_classes_section_settings',
            'settings'    => 'prime_playschool_classes_section_title',
            'type'        => 'text'
        )
    );

    // Section Text
    $wp_customize->add_setting(
        'prime_playschool_classes_section_text', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'prime_playschool_classes_section_text', 
        array(
            'label'       => __('Section Text', 'prime-playschool-classes'),
            'section'     => 'prime_playschool_classes_classes_section_settings',
            'settings'    => 'prime_playschool_classes_section_text',
            'type'        => 'text'
        )
    );

    $categories = get_categories();
        $cat_posts = array();
            $i = 0;
            $cat_posts[]='Select';
        foreach($categories as $category){
            if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting(
        'prime_playschool_classes_student_category',
        array(
            'default'   => 'select',
            'sanitize_callback' => 'prime_playschool_classes_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'prime_playschool_classes_student_category',
        array(
            'type'    => 'select',
            'choices' => $cat_posts,
            'label' => __('Select Category to display classes post','prime-playschool-classes'),
            'section' => 'prime_playschool_classes_classes_section_settings',
        )
    );
    
    /** Home Page Settings Ends */
    
    /** Footer Section */
    $wp_customize->add_section(
        'prime_playschool_classes_footer_section',
        array(
            'title' => __( 'Footer Settings', 'prime-playschool-classes' ),
            'priority' => 70,
            'panel' => 'prime_playschool_classes_home_page_settings',
        )
    );

    /** Footer Copyright control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_footer_setting', 
        array(
            'default' => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_footer_setting',
        array(
            'label'       => __( 'Show Footer Copyright', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_footer_section',
            'type'        => 'checkbox',
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'prime_playschool_classes_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_footer_section',
            'type' => 'text',
        )
    );  

    /* Footer Background Color*/
    $wp_customize->add_setting(
        'footer_background_color',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_background_color',
            array(
                'label' => __('Footer Widget Area Background Color', 'prime-playschool-classes'),
                'section' => 'prime_playschool_classes_footer_section',
                'type' => 'color',
            )
        )
    );

    $wp_customize->add_setting('footer_background_image',
        array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
         new WP_Customize_Cropped_Image_Control($wp_customize, 'footer_background_image',
            array(
                'label' => esc_html__('Footer Background Image', 'prime-playschool-classes'),
                'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'prime-playschool-classes'), 1024, 800),
                'section' => 'prime_playschool_classes_footer_section',
                'width' => 1024,
                'height' => 800,
                'flex_width' => true,
                'flex_height' => true,
            )
        )
    );

    /** Footer Background Image Attachment */
    $wp_customize->add_setting('prime_playschool_classes_background_attatchment', array(
        'default'           => 'scroll',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_choices',
    ));

    $wp_customize->add_control('prime_playschool_classes_background_attatchment', array(
        'label'    => __('Footer Background Attachment', 'prime-playschool-classes'),
        'section'  => 'prime_playschool_classes_footer_section',
        'settings' => 'prime_playschool_classes_background_attatchment',
        'type'     => 'select',
        'choices'  => array(
            'fixed' => __('fixed','prime-playschool-classes'),
            'scroll' => __('scroll','prime-playschool-classes'),
        ),
    ));

    /** Scroll to top control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_footer_scroll_to_top', 
        array(
            'default' => 1,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_footer_scroll_to_top',
        array(
            'label'       => __( 'Show Scroll To Top', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_footer_section',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('prime_playschool_classes_scroll_top_alignment',array(
        'default' => 'right-align',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_scroll_top_alignment'
    ));
    $wp_customize->add_control('prime_playschool_classes_scroll_top_alignment',array(
        'type' => 'select',
        'label' => __('Scroll Top Alignment','prime-playschool-classes'),
        'section' => 'prime_playschool_classes_footer_section',
        'choices' => array(
            'right-align' => __('Right Alignment','prime-playschool-classes'),
            'center-align' => __('Center Alignment','prime-playschool-classes'),
            'left-align' => __('Left Alignment','prime-playschool-classes'),
        ),
    ) );

    /** Scroll to top button shape */
    $wp_customize->add_setting('prime_playschool_classes_scroll_to_top_radius', array(
        'default'           => 'curved-box',
        'sanitize_callback' => 'prime_playschool_classes_sanitize_choices',
    ));

    $wp_customize->add_control('prime_playschool_classes_scroll_to_top_radius', array(
        'label'    => __('Scroll Top Button Shape', 'prime-playschool-classes'),
        'section'  => 'prime_playschool_classes_footer_section',
        'settings' => 'prime_playschool_classes_scroll_to_top_radius',
        'type'     => 'select',
        'choices'  => array(
            'box'        => __( 'Box', 'prime-playschool-classes' ),
            'curved-box' => __( 'Curved Box', 'prime-playschool-classes' ),
            'circle'     => __( 'Circle', 'prime-playschool-classes' ),
        ),
    ));

    // 404 PAGE SETTINGS
    $wp_customize->add_section(
        'prime_playschool_classes_404_section',
        array(
            'title' => __( '404 Page Settings', 'prime-playschool-classes' ),
            'priority' => 70,
            'panel' => 'prime_playschool_classes_general_settings',
        )
    );
   
    $wp_customize->add_setting('404_page_image', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw', // Sanitize as URL
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, '404_page_image', array(
        'label' => __('404 Page Image', 'prime-playschool-classes'),
        'section' => 'prime_playschool_classes_404_section',
        'settings' => '404_page_image',
    )));

    $wp_customize->add_setting('404_pagefirst_header', array(
        'default' => __('404', 'prime-playschool-classes'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('404_pagefirst_header', array(
        'type' => 'text',
        'label' => __('Heading', 'prime-playschool-classes'),
        'section' => 'prime_playschool_classes_404_section',
    ));

    // Setting for 404 page header
    $wp_customize->add_setting('404_page_header', array(
        'default' => __('Sorry, that page can\'t be found!', 'prime-playschool-classes'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('404_page_header', array(
        'type' => 'text',
        'label' => __('Heading', 'prime-playschool-classes'),
        'section' => 'prime_playschool_classes_404_section',
    ));
}
add_action( 'customize_register', 'prime_playschool_classes_customize_register' );
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function prime_playschool_classes_customize_preview_js() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $prime_playschool_classes_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $prime_playschool_classes_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'prime_playschool_classes_customizer', get_template_directory_uri() . '/js' . $prime_playschool_classes_build . '/customizer' . $prime_playschool_classes_suffix . '.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'prime_playschool_classes_customize_preview_js' );