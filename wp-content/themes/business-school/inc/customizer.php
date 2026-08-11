<?php
/**
 * Business School Theme Customizer
 *
 * @package Business School
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_school_customize_register( $wp_customize ) {

	function business_school_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	wp_enqueue_style('business-school-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	// Enable / Disable Logo
	$wp_customize->add_setting('business_school_logo_enable',array(
		'default' => true,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control( 'business_school_logo_enable', array(
		'settings' => 'business_school_logo_enable',
		'section'   => 'title_tagline',
		'label'     => __('Enable Logo','business-school'),
		'type'      => 'checkbox'
	));

	//Logo
    $wp_customize->add_setting('business_school_logo_width',array(
		'default'=> '',
		'transport' => 'refresh',
		'sanitize_callback' => 'business_school_sanitize_integer'
	));
	$wp_customize->add_control(new Business_School_Slider_Custom_Control( $wp_customize, 'business_school_logo_width',array(
		'label'	=> esc_html__('Logo Width','business-school'),
		'section'=> 'title_tagline',
		'settings'=>'business_school_logo_width',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 300,
        ),
	)));

	// color site title
	$wp_customize->add_setting('business_school_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_sitetitle_color', array(
	   'settings' => 'business_school_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'business-school'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('business_school_title_enable',array(
		'default' => false,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control( 'business_school_title_enable', array(
	   'settings' => 'business_school_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','business-school'),
	   'type'      => 'checkbox'
	));

	// color site tagline
	$wp_customize->add_setting('business_school_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_sitetagline_color', array(
	   'settings' => 'business_school_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'business-school'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('business_school_tagline_enable',array(
		'default' => false,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control( 'business_school_tagline_enable', array(
	   'settings' => 'business_school_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','business-school'),
	   'type'      => 'checkbox'
	));

	// woocommerce section
	$wp_customize->add_section('business_school_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'business-school'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('business_school_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'business_school_sanitize_checkbox'
	 ));
	 $wp_customize->add_control('business_school_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','business-school'),
		'section' => 'business_school_woocommerce_page_settings',
	 ));

    // shop page sidebar alignment
    $wp_customize->add_setting('business_school_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'business_school_sanitize_choices',
	));
	$wp_customize->add_control('business_school_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'business-school'),
		'section'        => 'business_school_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'business-school'),
			'Right Sidebar' => __('Right Sidebar', 'business-school'),
		),
	));

	$wp_customize->add_setting('business_school_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'business_school_sanitize_choices'
	));
	$wp_customize->add_control('business_school_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','business-school'),
		'choices' => array(
			 'Yes' => __('Yes','business-school'),
			 'No' => __('No','business-school'),
		 ),
		'section' => 'business_school_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'business_school_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'business_school_sanitize_checkbox'
    ) );
    $wp_customize->add_control('business_school_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','business-school'),
		'section' => 'business_school_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('business_school_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'business_school_sanitize_choices',
	));
	$wp_customize->add_control('business_school_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'business-school'),
		'section'        => 'business_school_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'business-school'),
			'Right Sidebar' => __('Right Sidebar', 'business-school'),
		),
	));	

	$wp_customize->add_setting('business_school_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'business_school_sanitize_checkbox'
	));
	$wp_customize->add_control('business_school_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','business-school'),
		'section' => 'business_school_woocommerce_page_settings',
	));	

	$wp_customize->add_setting( 'business_school_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'business_school_sanitize_integer'
    ) );
    $wp_customize->add_control(new Business_School_Slider_Custom_Control( $wp_customize, 'business_school_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Product Img Border Radius','business-school'),
		'section'=> 'business_school_woocommerce_page_settings',
		'settings'=>'business_school_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	// Add a setting for number of products per row
	$wp_customize->add_setting('business_school_products_per_row', array(
		'default'   => '4',
		'transport' => 'refresh',
		'sanitize_callback' => 'business_school_sanitize_integer'
	));
	$wp_customize->add_control('business_school_products_per_row', array(
		'label'    => __('Products Per Row', 'business-school'),
		'section'  => 'business_school_woocommerce_page_settings',
		'settings' => 'business_school_products_per_row',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	));

	// Add a setting for the number of products per page
	$wp_customize->add_setting('business_school_products_per_page', array(
		'default'   => '9',
		'transport' => 'refresh',
		'sanitize_callback' => 'business_school_sanitize_integer'
	));
	$wp_customize->add_control('business_school_products_per_page', array(
		'label'    => __('Products Per Page', 'business-school'),
		'section'  => 'business_school_woocommerce_page_settings',
		'settings' => 'business_school_products_per_page',
		'type'     => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('business_school_product_sale_position',array(
		'default' => 'Left',
		'sanitize_callback' => 'business_school_sanitize_choices'
	));
	$wp_customize->add_control('business_school_product_sale_position',array(
		'type' => 'radio',
		'label' => __('Product Sale Position','business-school'),
		'section' => 'business_school_woocommerce_page_settings',
		'choices' => array(
			'Left' => __('Left','business-school'),
			'Right' => __('Right','business-school'),
		),
	) );    

	//Theme Options
	$wp_customize->add_panel( 'business_school_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'business-school' ),
	) );

	//Site Layout Section
	$wp_customize->add_section('business_school_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','business-school'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','business-school'),
		'priority'	=> 1,
		'panel' => 'business_school_panel_area',
	));		

	$wp_customize->add_setting('business_school_preloader',array(
		'default' => false,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control( 'business_school_preloader', array(
	   'section'   => 'business_school_site_layoutsec',
	   'label'	=> __('Check to Show preloader','business-school'),
	   'type'      => 'checkbox'
 	));	

   // Add Settings and Controls for Page Layout
    $wp_customize->add_setting('business_school_sidebar_page_layout',array(
		'default' => 'full',
	 	'sanitize_callback' => 'business_school_sanitize_choices'
	));
	$wp_customize->add_control('business_school_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'business-school'),
		'section' => 'business_school_site_layoutsec',
		'choices' => array(
			'left' => __('Left','business-school'),
			'right' => __('Right','business-school'),
			'full' => __('No Sidebar','business-school'),
	),
	));	
	
	$wp_customize->add_setting( 'business_school_layout_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_layout_settings_upgraded_features', array(
		'type'=> 'hidden',
		 'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
		 'section' => 'business_school_site_layoutsec'
	));	

   //Global Color
    $wp_customize->add_section('business_school_global_color', array(
	    'title'    => __('Manage Global Color Section', 'business-school'),
	    'panel'    => 'business_school_panel_area',
    ));

    $wp_customize->add_setting('business_school_first_color', array(
        'default'           => '#0D5EF4',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'business_school_first_color', array(
	  'label'    => __('Theme Color', 'business-school'),
	  'section'  => 'business_school_global_color',
	  'settings' => 'business_school_first_color',
    )));	

    $wp_customize->add_setting('business_school_second_color', array(
        'default'           => '#0F2239',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'business_school_second_color', array(
	   'label'    => __('Theme Color', 'business-school'),
	  'section'  => 'business_school_global_color',
	  'settings' => 'business_school_second_color',
    )));
	
	$wp_customize->add_setting( 'business_school_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_global_color'
	));			

 	// Header Section
	$wp_customize->add_section('business_school_header_section', array(
        'title' => __('Manage Header Section', 'business-school'),
		'description' => __('<p class="sec-title">Manage Header Section</p>','business-school'),
        'priority' => null,
		'panel' => 'business_school_panel_area',
 	));
	
 	$wp_customize->add_setting('business_school_top_bar',array(
		'default' => false,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));	 
	$wp_customize->add_control( 'business_school_top_bar', array(
	   'section'   => 'business_school_header_section',
	   'label'	=> __('Check to show Top Bar','business-school'),
	   'type'      => 'checkbox'
 	)); 

 	$wp_customize->add_setting('business_school_stickyheader',array(
		'default' => false,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control( 'business_school_stickyheader', array(
	   'section'   => 'business_school_header_section',
	   'label'	=> __('Check To Show Sticky Header','business-school'),
	   'type'      => 'checkbox'
 	));

 	$wp_customize->add_setting('business_school_phone_number',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_phone_number',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_phone_number', array(
	   'settings' => 'business_school_phone_number',
	   'section'   => 'business_school_header_section',
	   'label' => __('Add Phone Number', 'business-school'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('business_school_email_address',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_email_address', array(
	   'settings' => 'business_school_email_address',
	   'section'   => 'business_school_header_section',
	   'label' => __('Add Email Address', 'business-school'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('business_school_contact_us_text',array(
		'default' => 'Contact Us',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_contact_us_text', array(
	   'settings' => 'business_school_contact_us_text',
	   'section'   => 'business_school_header_section',
	   'label' => __('Add Button Text', 'business-school'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('business_school_contact_us_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_contact_us_url', array(
	   'settings' => 'business_school_contact_us_url',
	   'section'   => 'business_school_header_section',
	   'label' => __('Add Button URL', 'business-school'),
	   'type'      => 'url'
	));

	// header menu
	$wp_customize->add_setting('business_school_menu_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_menu_color', array(
	   'settings' => 'business_school_menu_color',
	   'section'   => 'business_school_header_section',
	   'label' => __('Menu Color', 'business-school'),
	   'type'      => 'color'
	));

	// header menu hover color
	$wp_customize->add_setting('business_school_menuhrv_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_menuhrv_color', array(
	   'settings' => 'business_school_menuhrv_color',
	   'section'   => 'business_school_header_section',
	   'label' => __('Menu Hover Color', 'business-school'),
	   'type'      => 'color'
	));

	// header sub menu color
	$wp_customize->add_setting('business_school_submenu_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_submenu_color', array(
	   'settings' => 'business_school_submenu_color',
	   'section'   => 'business_school_header_section',
	   'label' => __('SubMenu Color', 'business-school'),
	   'type'      => 'color'
	));

	// header sub menu hover color
	$wp_customize->add_setting('business_school_submenuhrv_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_submenuhrv_color', array(
	   'settings' => 'business_school_submenuhrv_color',
	   'section'   => 'business_school_header_section',
	   'label' => __('SubMenu Hover Color', 'business-school'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'business_school_header_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_header_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_header_section'
	));	

	// Social media Section
	$wp_customize->add_section('business_school_social_media_section', array(
        'title' => __('Manage Social media Section', 'business-school'),
		'description' => __('<p class="sec-title">Manage Social media Section</p>','business-school'),
        'priority' => null,
		'panel' => 'business_school_panel_area',
 	));

	$wp_customize->add_setting('business_school_fb_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_fb_link', array(
	   'settings' => 'business_school_fb_link',
	   'section'   => 'business_school_social_media_section',
	   'label' => __('Facebook Link', 'business-school'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('business_school_insta_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_insta_link', array(
	   'settings' => 'business_school_insta_link',
	   'section'   => 'business_school_social_media_section',
	   'label' => __('Instagram Link', 'business-school'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('business_school_googleplus_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_googleplus_link', array(
	   'settings' => 'business_school_googleplus_link',
	   'section'   => 'business_school_social_media_section',
	   'label' => __('Google Plus Link', 'business-school'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('business_school_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_youtube_link', array(
	   'settings' => 'business_school_youtube_link',
	   'section'   => 'business_school_social_media_section',
	   'label' => __('Youtube Link', 'business-school'),
	   'type'      => 'url'
	));

    // Menu Text Transform
    $wp_customize->add_setting( 'business_school_menu_text_transform', array(
        'default'           => 'Capitalize',
		'transport' => 'refresh',
		'sanitize_callback' => 'business_school_sanitize_choices'
    ));

    $wp_customize->add_control( 'business_school_menu_text_transform', array(
        'label'    => __( 'Menu Text Transform', 'business-school' ),
        'section'  => 'business_school_header_section',
        'type'     => 'select',
        'choices'  => array(
			'None'       => __( 'None', 'business-school' ),
            'Capitalize' => __( 'Capitalize', 'business-school' ),
            'Uppercase'  => __( 'Uppercase', 'business-school' ),
            'Lowercase'  => __( 'Lowercase', 'business-school' ),
        ),
    ));

	$wp_customize->add_setting( 'business_school_social_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_social_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_social_media_section'
	));

	//Slider
  	$wp_customize->add_section('business_school_slider_section',array(
	    'title' => __('Manage Slider Section','business-school'),
	    'priority'  => null,
	    'description'	=> __('<p class="sec-title">Manage Slider Section</p> Select Category from the Dropdowns for slider, Also use the given image dimension (450 x 450).','business-school'),
	    'panel' => 'business_school_panel_area',
	));

	$wp_customize->add_setting('business_school_slider',array(
		'default' => false,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_slider', array(
	   'settings' => 'business_school_slider',
	   'section'   => 'business_school_slider_section',
	   'label'     => __('Check To Enable This Section','business-school'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('business_school_slider_top_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_slider_top_text',array(
		'label'	=> esc_html__('Add Top Slider Text','business-school'),
		'section'=> 'business_school_slider_section',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

    $wp_customize->add_setting('business_school_slider_cat',array(
	    'default' => '0',
	    'sanitize_callback' => 'business_school_sanitize_choices',
  	));
  	$wp_customize->add_control('business_school_slider_cat',array(
	    'type'    => 'select',
	    'choices' => $cat_post,
	    'label' => __('Select Category to display Slider','business-school'),
	    'section' => 'business_school_slider_section',
	));

	$wp_customize->add_setting('business_school_button_text',array(
		'default' => 'Get Started',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_button_text', array(
	   'settings' => 'business_school_button_text',
	   'section'   => 'business_school_slider_section',
	   'label' => __('Add Button Text', 'business-school'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('business_school_button_link_slider',array(
        'default'=> '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('business_school_button_link_slider',array(
        'label' => esc_html__('Add Button Link','business-school'),
        'section'=> 'business_school_slider_section',
        'type'=> 'url'
    ));

	$wp_customize->add_setting( 'business_school_slider_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_slider_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_slider_section'
	));	

	// about Section 
	$wp_customize->add_section('business_school_below_banner_section', array(
		'title'	=> __('Manage About Section','business-school'),
		'description'	=> __('<p class="sec-title">Manage About Section Section</p>','business-school'),
		'priority'	=> null,
		'panel' => 'business_school_panel_area',
	));
	
	$wp_customize->add_setting('business_school_disabled_pgboxes',array(
		'default' => false,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_disabled_pgboxes', array(
	   'settings' => 'business_school_disabled_pgboxes',
	   'section'   => 'business_school_below_banner_section',
	   'label'     => __('Check To Enable This Section','business-school'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('business_school_about_title',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_about_title', array(
	   'settings' => 'business_school_about_title',
	   'section'   => 'business_school_below_banner_section',
	   'label' => __('Add Title', 'business-school'),
	   'type'      => 'text'
	));
	
	$wp_customize->add_setting('business_school_about_pageboxes',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'business_school_sanitize_dropdown_pages'
	));
	$wp_customize->add_control(	'business_school_about_pageboxes',array(
		'type' => 'dropdown-pages',
	   'label'     => __('Select Page to display About','business-school'),
		'section' => 'business_school_below_banner_section',
	));	

	$wp_customize->add_setting('business_school_abt_image_first',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'business_school_abt_image_first',array(
	    'label' => __('Select First About Image','business-school'),
	     'section' => 'business_school_below_banner_section'
	)));

	$wp_customize->add_setting('business_school_abt_image_second',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'business_school_abt_image_second',array(
	    'label' => __('Select Second About Image','business-school'),
	     'section' => 'business_school_below_banner_section'
	)));

	for($i=1;$i<=3;$i++) {

	    $wp_customize->add_setting('business_school_about_sentence'.$i,array(
	        'default'=> '',
	        'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
	    ));
	    $wp_customize->add_control('business_school_about_sentence'.$i,array(
	        'label' => __('Add About Text ','business-school').$i,
	        'section'=> 'business_school_below_banner_section',
	        'settings'=> 'business_school_about_sentence'.$i,
	        'type'=> 'text'
	    ));
    }
	
	$wp_customize->add_setting( 'business_school_second_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_second_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_below_banner_section'
	));	

	//Blog post
	$wp_customize->add_section('business_school_blog_post_settings',array(
        'title' => __('Manage Post Section', 'business-school'),
        'priority' => null,
        'panel' => 'business_school_panel_area'
    ) );

	$wp_customize->add_setting('business_school_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control('business_school_metafields_date', array(
	    'settings' => 'business_school_metafields_date', 
	    'section'   => 'business_school_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'business-school'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('business_school_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control('business_school_metafields_comments', array(
		'settings' => 'business_school_metafields_comments',
		'section'  => 'business_school_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'business-school'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('business_school_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control('business_school_metafields_author', array(
		'settings' => 'business_school_metafields_author',
		'section'  => 'business_school_blog_post_settings',
		'label'    => __('Check to Enable Author', 'business-school'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('business_school_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control('business_school_metafields_time', array(
		'settings' => 'business_school_metafields_time',
		'section'  => 'business_school_blog_post_settings',
		'label'    => __('Check to Enable Time', 'business-school'),
		'type'     => 'checkbox',
	));	

	$wp_customize->add_setting('business_school_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','business-school'),
		'description' => __('Ex: "/", "|", "-", ...','business-school'),
		'section' => 'business_school_blog_post_settings'
	)); 

   // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('business_school_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'business_school_sanitize_choices'
	));
	$wp_customize->add_control('business_school_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'business-school'),
		'description'   => __('This option work for blog page, archive page and search page.', 'business-school'),
		'section' => 'business_school_blog_post_settings',
		'choices' => array(
			'left' => __('Left','business-school'),
			'right' => __('Right','business-school'),
			'three-column' => __('Three Columns','business-school'),
			'four-column' => __('Four Columns','business-school'),
			'grid' => __('Grid Layout','business-school'),
			'full' => __('No Sidebar','business-school')
     ),
	) );

	$wp_customize->add_setting('business_school_blog_post_description_option',array(
    	'default'   => 'Excerpt Content', 
        'sanitize_callback' => 'business_school_sanitize_choices'
	));
	$wp_customize->add_control('business_school_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','business-school'),
        'section' => 'business_school_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','business-school'),
            'Excerpt Content' => __('Excerpt Content','business-school'),
            'Full Content' => __('Full Content','business-school'),
        ),
	) );

	$wp_customize->add_setting('business_school_blog_post_thumb',array(
        'sanitize_callback' => 'business_school_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('business_school_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'business-school'),
        'section'     => 'business_school_blog_post_settings',
    ));

	$wp_customize->add_setting( 'business_school_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_blog_post_settings'
	));	

	//Single Post Settings
	$wp_customize->add_section('business_school_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'business-school'),
		'priority' => null,
		'panel' => 'business_school_panel_area'
	));

	$wp_customize->add_setting('business_school_single_post_date',array(
		'default' => true,
		'sanitize_callback'	=> 'business_school_sanitize_checkbox'
	));
	$wp_customize->add_control('business_school_single_post_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date ','business-school'),
		'section' => 'business_school_single_post_settings'
	));	

	$wp_customize->add_setting('business_school_single_post_author',array(
		'default' => true,
		'sanitize_callback'	=> 'business_school_sanitize_checkbox'
	));
	$wp_customize->add_control('business_school_single_post_author',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Author','business-school'),
		'section' => 'business_school_single_post_settings'
	));

	$wp_customize->add_setting('business_school_single_post_comment',array(
		'default' => true,
		'sanitize_callback'	=> 'business_school_sanitize_checkbox'
	));
	$wp_customize->add_control('business_school_single_post_comment',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Comments','business-school'),
		'section' => 'business_school_single_post_settings'
	));	

	$wp_customize->add_setting('business_school_single_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'business_school_sanitize_checkbox'
	));
	$wp_customize->add_control('business_school_single_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','business-school'),
		'section' => 'business_school_single_post_settings'
	));	

	$wp_customize->add_setting('business_school_single_post_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_single_post_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','business-school'),
		'description' => __('Ex: "/", "|", "-", ...','business-school'),
		'section' => 'business_school_single_post_settings'
	)); 

	$wp_customize->add_setting('business_school_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'business_school_sanitize_choices'
	));
	$wp_customize->add_control('business_school_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'business-school'),
     	'section' => 'business_school_single_post_settings',
     	'choices' => array(
			'left' => __('Left','business-school'),
			'right' => __('Right','business-school'),
			'full' => __('No Sidebar','business-school'),
     ),
	));


	$wp_customize->add_setting( 'business_school_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_single_post_settings'
	)); 

	//Page Settings
	$wp_customize->add_section('business_school_page_settings',array(
		'title' => __('Manage Page Section', 'business-school'),
		'priority' => null,
		'panel' => 'business_school_panel_area'
	));

	// Add Settings and Controls for Page Layout
	$wp_customize->add_setting('business_school_sidebar_page_layout',array(
		'default' => 'full',
			'sanitize_callback' => 'business_school_sanitize_choices'
	));
	$wp_customize->add_control('business_school_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'business-school'),
		'section' => 'business_school_page_settings',
		'choices' => array(
			'left' => __('Left','business-school'),
			'right' => __('Right','business-school'),
			'full' => __('No Sidebar','business-school')
		),
	));	

	// 404 Page Settings
	$wp_customize->add_section('business_school_page_not_found', array(
		'title'	=> __('Manage 404 Page Section','business-school'),
		'priority'	=> null,
		'panel' => 'business_school_panel_area',
	));

	$wp_customize->add_setting('business_school_page_not_found_heading',array(
		'default'=> __('404 Not Found','business-school'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_page_not_found_heading',array(
		'label'	=> __('404 Heading','business-school'),
		'section'=> 'business_school_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('business_school_page_not_found_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('business_school_page_not_found_content',array(
		'label'	=> __('404 Text','business-school'),
		'input_attrs' => array(
			'placeholder' => __( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'business-school' ),
		),
		'section'=> 'business_school_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('business_school_page_not_found_btn',array(
		'default' => 'Homepage',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_page_not_found_btn', array(
	   'settings' => 'business_school_page_not_found_btn',
	   'section'   => 'business_school_page_not_found',
	   'label' => __('404 Button', 'business-school'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting( 'business_school_page_not_found_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_page_not_found_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_page_not_found'
	));

	// Footer Section
	$wp_customize->add_section('business_school_footer', array(
		'title'	=> __('Manage Footer Section','business-school'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','business-school'),
		'priority'	=> null,
		'panel' => 'business_school_panel_area',
	));

	$wp_customize->add_setting('business_school_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'business_school_sanitize_checkbox',
	));
	$wp_customize->add_control('business_school_footer_widget', array(
	    'settings' => 'business_school_footer_widget', // Corrected setting name
	    'section'   => 'business_school_footer',
	    'label'     => __('Check to Enable Footer Widget', 'business-school'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('business_school_footer_bg_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'business_school_footer_bg_color', array(
        'label'    => __('Footer Background Color', 'business-school'),
        'section'  => 'business_school_footer',
    )));

	$wp_customize->add_setting('business_school_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'business_school_footer_bg_image',array(
        'label' => __('Footer Background Image','business-school'),
        'section' => 'business_school_footer',
    )));

	$wp_customize->add_setting('business_school_footer_img_position',array(
		'default' => 'center center',
		'transport' => 'refresh',
		'sanitize_callback' => 'business_school_sanitize_choices'
	));
	$wp_customize->add_control('business_school_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','business-school'),
		'section' => 'business_school_footer',
		'choices' 	=> array(
			'center center'   => esc_html__( 'Center', 'business-school' ),
			'center top'   => esc_html__( 'Top', 'business-school' ),
			'left center'   => esc_html__( 'Left', 'business-school' ),
			'right center'   => esc_html__( 'Right', 'business-school' ),
			'center bottom'   => esc_html__( 'Bottom', 'business-school' ),
		),
	));	

	$wp_customize->add_setting('business_school_copyright_line',array(
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'business_school_copyright_line', array(
	   'section' 	=> 'business_school_footer',
	   'label'	 	=> __('Copyright Line','business-school'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	$wp_customize->add_setting('business_school_copyright_link',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'business_school_copyright_link', array(
	   'section' 	=> 'business_school_footer',
	   'label'	 	=> __('Copyright Link','business-school'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	//  footer bg color
	$wp_customize->add_setting('business_school_footerbg_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_footerbg_color', array(
		'settings' => 'business_school_footerbg_color',
		'section'   => 'business_school_footer',
		'label' => __('BG Color', 'business-school'),
		'type'      => 'color'
	));

	//  footer title color
	$wp_customize->add_setting('business_school_footertitle_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_footertitle_color', array(
	   'settings' => 'business_school_footertitle_color',
	   'section'   => 'business_school_footer',
	   'label' => __('Title Color', 'business-school'),
	   'type'      => 'color'
	));

	//  footer list color
	$wp_customize->add_setting('business_school_footerlist_color',array(
		'default' => '',
		'sanitize_callback' => 'business_school_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_footerlist_color', array(
	   'settings' => 'business_school_footerlist_color',
	   'section'   => 'business_school_footer',
	   'label' => __('List Color', 'business-school'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('business_school_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'business_school_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'business_school_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'business-school' ),
        'section'        => 'business_school_footer',
        'settings'       => 'business_school_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('business_school_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'business_school_sanitize_choices'
    ));
    $wp_customize->add_control('business_school_scroll_position',array(
        'type' => 'radio',
        'section' => 'business_school_footer',
        'label'	 	=> __('Scroll To Top Positions','business-school'),
        'choices' => array(
            'Right' => __('Right','business-school'),
            'Left' => __('Left','business-school'),
            'Center' => __('Center','business-school')
        ),
    ));

	$wp_customize->add_setting('business_school_scroll_text',array(
		'default'	=> __('TOP','business-school'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('business_school_scroll_text',array(
		'label'	=> __('Scroll To Top Button Text','business-school'),
		'section'	=> 'business_school_footer',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'business_school_scroll_top_shape', array(
		'default'           => 'circle',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'business_school_scroll_top_shape', array(
		'label'    => __( 'Scroll to Top Button Shape', 'business-school' ),
		'section'  => 'business_school_footer',
		'settings' => 'business_school_scroll_top_shape',
		'type'     => 'radio',
		'choices'  => array(
			'box'        => __( 'Box', 'business-school' ),
			'curved' => __( 'Curved', 'business-school'),
			'circle'     => __( 'Circle', 'business-school' ),
		),
	));

	$wp_customize->add_setting('business_school_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'business_school_sanitize_choices',
	));
	$wp_customize->add_control('business_school_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'business_school_footer',
		'label'       => __('Footer widget area', 'business-school'),
		'choices' => array(
		   '1'     => __('One', 'business-school'),
		   '2'     => __('Two', 'business-school'),
		   '3'     => __('Three', 'business-school'),
		   '4'     => __('Four', 'business-school')
		),
	));

	$wp_customize->add_setting( 'business_school_footer_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_footer_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_footer'
	));

	// Footer Social Section
	$wp_customize->add_section('business_school_footer_social_icons', array(
		'title'	=> __('Manage Footer Social Section','business-school'),
		'description'	=> __('<p class="sec-title">Manage Footer Social Section</p>','business-school'),
		'priority'	=> null,
		'panel' => 'business_school_panel_area',
	));

	$wp_customize->add_setting('business_school_footer_facebook_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_footer_facebook_link', array(
	   'settings' => 'business_school_footer_facebook_link',
	   'section'   => 'business_school_footer_social_icons',
	   'label' => __('Facebook Link', 'business-school'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('business_school_footer_instagram_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_footer_instagram_link', array(
	   'settings' => 'business_school_footer_instagram_link',
	   'section'   => 'business_school_footer_social_icons',
	   'label' => __('Instagram Link', 'business-school'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('business_school_footer_googleplus_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_footer_googleplus_link', array(
	   'settings' => 'business_school_footer_googleplus_link',
	   'section'   => 'business_school_footer_social_icons',
	   'label' => __('Google Plus Link', 'business-school'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('business_school_footer_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'business_school_footer_youtube_link', array(
	   'settings' => 'business_school_footer_youtube_link',
	   'section'   => 'business_school_footer_social_icons',
	   'label' => __('Youtube Link', 'business-school'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting( 'business_school_footer_social_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_school_footer_social_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(BUSINESS_SCHOOL_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'business_school_footer_social_icons'
	));

	// Google Fonts
	$wp_customize->add_section( 'business_school_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'business-school' ),
		'priority'    => 24,
	) );
  
	$font_choices = array(
		'' => 'No Fonts',
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);
  
	$wp_customize->add_setting( 'business_school_headings_fonts', array(
		'sanitize_callback' => 'business_school_sanitize_fonts',
	));
	$wp_customize->add_control( 'business_school_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'business-school'),
		'section' => 'business_school_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'business_school_body_fonts', array(
		'sanitize_callback' => 'business_school_sanitize_fonts'
	));
	$wp_customize->add_control( 'business_school_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'business-school' ),
		'section' => 'business_school_google_fonts_section',
		'choices' => $font_choices
	));	

}
add_action( 'customize_register', 'business_school_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_school_customize_preview_js() {
	wp_enqueue_script( 'business_school_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'business_school_customize_preview_js' );
