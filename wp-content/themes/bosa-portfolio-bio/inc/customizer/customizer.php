<?php
/**
 * Bosa Portfolio Bio Theme Customizer
 *
 * @package Bosa Portfolio Bio
 */

/**
 * Add Bosa Header Footer info for Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bosa_portfolio_bio_header_footer_info_section( $wp_customize ) {

	// Load custom section functions.
	require get_template_directory() . '/inc/customizer/header-footer-info-section.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Bosa_Portfolio_Bio_Header_Footer_Info_Section' );

	// Add sections.
	$args = array(
		'title'    => esc_html__( "Bosa now supports ElementsKit Header and Footer Builder.", 'bosa-portfolio-bio' ),
		'text'    => esc_html__( "You can easily customize your header and footer directly with the Elementor editor.", 'bosa-portfolio-bio' ),
		'note'    => esc_html__( "Note: If the options below are not functioning as expected, it is likely because the header and footer in your selected demo were built using ElementsKit Header and Footer Builder.", 'bosa-portfolio-bio' ),
		'link'    => esc_html__( "For more information, please refer to our", 'bosa-portfolio-bio' ),
		'url_text'    => esc_html__( "documentation.", 'bosa-portfolio-bio' ),
		'url'  => 'https://bosathemes.com/docs/bosa/how-to-setup-recommended-plugins-features/elementskit-how-to-set-up-header-footer-with-the-builder/',
		'priority'  => 1,
	);

	$header_args = array_merge( $args, array(
		'panel'		=> 'bosa_portfolio_bio_header_options',
	) );

	$footer_args = array_merge( $args, array(
		'panel'		=> 'bosa_portfolio_bio_footer_options',
	) );

	$wp_customize->add_section(
		new Bosa_Portfolio_Bio_Header_Footer_Info_Section(
			$wp_customize,
			'bosa_portfolio_bio_header_info',
			$header_args,
		)
	);
	$wp_customize->add_section(
		new Bosa_Portfolio_Bio_Header_Footer_Info_Section(
			$wp_customize,
			'bosa_portfolio_bio_footer_info',
			$footer_args,
		)
	);
}
add_action( 'customize_register', 'bosa_portfolio_bio_header_footer_info_section' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bosa_portfolio_bio_customize_register( $wp_customize ) {

	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/controls.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

	// Register custom section types.
	$wp_customize->register_section_type( 'Bosa_Portfolio_Bio_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Bosa_Portfolio_Bio_Customize_Section_Upsell(
			$wp_customize,
			'bosa_portfolio_bio_theme_upsell',
			array(
				'title'    => esc_html__( 'Bosa Pro', 'bosa-portfolio-bio' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'bosa-portfolio-bio' ),
				'pro_url'  => 'https://bosathemes.com/bosa-pro',
				'priority'  => 1,
			)
		)
	);
}
add_action( 'customize_register', 'bosa_portfolio_bio_customize_register' );

/**
 * Restructures WooCommerce product catalog customizer options.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bosa_portfolio_bio_woocommerce_customizer_structure( $wp_customize ) {

	if ( class_exists( 'WooCommerce') ) {
		$wp_customize->get_control( 'woocommerce_shop_page_display' )->priority  = '600';
		$wp_customize->get_control( 'woocommerce_category_archive_display' )->priority  = '610';
		$wp_customize->get_control( 'woocommerce_default_catalog_orderby' )->priority  = '620';
	}
}
add_action( 'customize_register', 'bosa_portfolio_bio_woocommerce_customizer_structure', 15 );

/**
 * Enqueue style for custom customize control.
 */
add_action( 'customize_controls_enqueue_scripts', 'bosa_portfolio_bio_custom_customize_enqueue' );
function bosa_portfolio_bio_custom_customize_enqueue() {
	wp_enqueue_style( 'bosa-portfolio-bio-customize-controls', get_template_directory_uri() . '/inc/customizer/customizer.css' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bosa_portfolio_bio_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bosa_portfolio_bio_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bosa_portfolio_bio_customize_preview_js() {
	wp_enqueue_script( 'bosa-portfolio-bio-customizer', get_template_directory_uri() . '/inc/customizer/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bosa_portfolio_bio_customize_preview_js' );

function bosa_portfolio_bio_customize_getting_js() {
	wp_enqueue_script( 'bosa-portfolio-bio-customizer-getting-started', get_template_directory_uri() . '/inc/getting-started/getting-started.js', array( 'customize-controls', 'jquery' ), true );
}
add_action( 'customize_controls_enqueue_scripts', 'bosa_portfolio_bio_customize_getting_js' );


/**
 * Sanitize checkboxes
 */

function bosa_portfolio_bio_sanitize_checkbox( $input ){
	if ( $input === true ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Sanitize Selects
 */
function bosa_portfolio_bio_sanitize_select( $input, $setting ){
          
    $input = sanitize_key($input);

    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
      
}

/**
 * Talent Infos section callback
 */
function bosa_portfolio_bio_is_enable_talent_infos() {
	$value = get_theme_mod( 'bosa_portfolio_bio_disable_talent_info_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}


/**
 * projects section callback
 */
function bosa_portfolio_bio_is_enable_projects() {
	$value = get_theme_mod( 'bosa_portfolio_bio_disable_project_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}

/**
 * Followers section callback
 */
function bosa_portfolio_bio_is_enable_followers() {
	$value = get_theme_mod( 'bosa_portfolio_bio_disable_followers_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	}  
}

function bosa_portfolio_bio_customizer_structure( $wp_customize ) {

	// Blog Homepage Options
	$wp_customize->add_panel( 'bosa_portfolio_bio_blog_homepage_options', array(
	    'title' 	 => esc_html__( 'Blog Homepage', 'bosa-portfolio-bio' ),
	    'priority'	 => 120,
	    'capability' => 'edit_theme_options',
	) );

	// Responsive
	$wp_customize->add_section( 'bosa_portfolio_bio_blog_page_responsive', array(
	    'title'		 => esc_html__( 'Responsive', 'bosa-portfolio-bio' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-portfolio-bio' ),
	    'panel' 	 => 'bosa_portfolio_bio_blog_homepage_options',
	    'priority'	 => 50,
	    'capability' => 'edit_theme_options',
	) );
	
	// Blog Talent Info
	$wp_customize->add_section( 'bosa_portfolio_bio_blog_talent_info', array(
	    'title'          => esc_html__( 'Talent Infos', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 26,
	) );

	$wp_customize->add_setting( 'bosa_portfolio_bio_disable_talent_info_section', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_portfolio_bio_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_disable_talent_info_section', array(
	    'label'        => esc_html__( 'Disable Talent Infos Section', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'section'      => 'bosa_portfolio_bio_blog_talent_info',
		'priority'	   => 10, 
	) );

	$wp_customize->add_setting( 'bosa_portfolio_bio_talent_info_page_one', array(
		'sanitize_callback' => 'bosa_portfolio_bio_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_talent_info_page_one', array(
		'label'       => esc_html__( 'Page 1', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'section'     => 'bosa_portfolio_bio_blog_talent_info',
		'placeholder' => esc_html__( 'Select Page 1', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_pages(),
		'priority'	  => 20,
	) );

	$wp_customize->add_setting( 'bosa_portfolio_bio_talent_info_page_two', array(
		'sanitize_callback' => 'bosa_portfolio_bio_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_talent_info_page_two', array(
		'label'       => esc_html__( 'Page 2', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'section'     => 'bosa_portfolio_bio_blog_talent_info',
		'placeholder' => esc_html__( 'Select Page 2', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_pages(),
		'priority'	  => 30,
	) );

	$wp_customize->add_setting( 'bosa_portfolio_bio_talent_info_page_three', array(
		'sanitize_callback' => 'bosa_portfolio_bio_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_talent_info_page_three', array(
		'label'       => esc_html__( 'Page 3', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'section'     => 'bosa_portfolio_bio_blog_talent_info',
		'placeholder' => esc_html__( 'Select Page 3', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_pages(),
		'priority'	  => 40,
	) );

	$wp_customize->add_setting( 'bosa_portfolio_bio_talent_info_page_four', array(
		'sanitize_callback' => 'bosa_portfolio_bio_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_talent_info_page_four', array(
		'label'       => esc_html__( 'Page 4', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'section'     => 'bosa_portfolio_bio_blog_talent_info',
		'placeholder' => esc_html__( 'Select Page 4', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_pages(),
		'priority'	  => 50,
	) );
	$wp_customize->add_setting( 'bosa_portfolio_bio_talent_info_page_five', array(
		'sanitize_callback' => 'bosa_portfolio_bio_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_talent_info_page_five', array(
		'label'       => esc_html__( 'Page 5', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'section'     => 'bosa_portfolio_bio_blog_talent_info',
		'placeholder' => esc_html__( 'Select Page 5', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_pages(),
		'priority'	  => 60,
	) );

	// responsive talent_info
	$wp_customize->add_setting( 'bosa_portfolio_bio_disable_mobile_talent_infos', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_portfolio_bio_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_disable_mobile_talent_infos', array(
	    'label'        	=> esc_html__( 'Disable Talent Infos Section', 'bosa-portfolio-bio' ),
	    'type'			=> 'checkbox',
	    'priority' 		=> 26,
	    'section' 		=> 'bosa_portfolio_bio_blog_page_responsive',
	    'active_callback' => 'bosa_portfolio_bio_is_enable_talent_infos',
	) );

	// Blog project
	$wp_customize->add_section( 'bosa_portfolio_bio_blog_projects', array(
	    'title'          => esc_html__( 'Projects', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 27,
	) );

	$wp_customize->add_setting( 'bosa_portfolio_bio_disable_project_section', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_portfolio_bio_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_disable_project_section', array(
	    'label'        => esc_html__( 'Disable Projects Section', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'section'      => 'bosa_portfolio_bio_blog_projects',
		'priority'	   => 10, 
	) );

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_project_image_one', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_project_image_one',
			array(
				'label'           => esc_html__( 'Project One Image', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_projects',
				'mime_type'       => 'image',
				'priority'	      => 20
			)
		)
	);

	$wp_customize->add_setting('bosa_portfolio_bio_project_label_one', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('bosa_portfolio_bio_project_label_one', array(
		'label'     => esc_html__( 'Project Label One', 'bosa-portfolio-bio' ),
		'section'	=> 'bosa_portfolio_bio_blog_projects',
		'type'		=> 'text',
		'priority'	=> 30,
	));

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_project_image_two', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_project_image_two',
			array(
				'label'           => esc_html__( 'Project Two Image', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_projects',
				'mime_type'       => 'image',
				'priority'	      => 40
			)
		)
	);

	$wp_customize->add_setting('bosa_portfolio_bio_project_label_two', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('bosa_portfolio_bio_project_label_two', array(
		'label'     => esc_html__( 'Project Label Two', 'bosa-portfolio-bio' ),
		'section'	=> 'bosa_portfolio_bio_blog_projects',
		'type'		=> 'text',
		'priority'	=> 50,
	));

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_project_image_three', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_project_image_three',
			array(
				'label'           => esc_html__( 'Project Three Image', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_projects',
				'mime_type'       => 'image',
				'priority'	      => 60
			)
		)
	);

	$wp_customize->add_setting('bosa_portfolio_bio_project_label_three', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('bosa_portfolio_bio_project_label_three', array(
		'label'     => esc_html__( 'Project Label Three', 'bosa-portfolio-bio' ),
		'section'	=> 'bosa_portfolio_bio_blog_projects',
		'type'		=> 'text',
		'priority'	=> 70,
	));

	// responsive project
	$wp_customize->add_setting( 'bosa_portfolio_bio_disable_mobile_projects', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_portfolio_bio_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_disable_mobile_projects', array(
	    'label'        	=> esc_html__( 'Disable Projects Section', 'bosa-portfolio-bio' ),
	    'type'			=> 'checkbox',
	    'priority' 		=> 27,
	    'section' 		=> 'bosa_portfolio_bio_blog_page_responsive',
	    'active_callback' => 'bosa_portfolio_bio_is_enable_projects',
	) );

	//Followers
	$wp_customize->add_section( 'bosa_portfolio_bio_blog_followers', array(
	    'title'          => esc_html__( 'Followers', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 28,	
	) );

	$wp_customize->add_setting( 'bosa_portfolio_bio_disable_followers_section', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_portfolio_bio_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_disable_followers_section', array(
	    'label' 	=> esc_html__( 'Disable Followers Section', 'bosa-portfolio-bio' ),
	    'type' 		=> 'checkbox',
	    'priority'	=> 10,
	    'section' 	=> 'bosa_portfolio_bio_blog_followers', 
	) );

	$wp_customize->add_setting('bosa_portfolio_bio_follower_title', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('bosa_portfolio_bio_follower_title', array(
		'label'     => esc_html__( 'Title', 'bosa-portfolio-bio' ),
		'section'	=> 'bosa_portfolio_bio_blog_followers',
		'type'		=> 'text',
		'priority'	=> 20,
	));

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_follower_one', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_follower_one',
			array(
				'label'           => esc_html__( 'Follower Image 1', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 30
			)
		)
	);

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_follower_two', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_follower_two',
			array(
				'label'           => esc_html__( 'Follower Image 2', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 40
			)
		)
	);

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_follower_three', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_follower_three',
			array(
				'label'           => esc_html__( 'Follower Image 3', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 50
			)
		)
	);

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_follower_four', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_follower_four',
			array(
				'label'           => esc_html__( 'Follower Image 4', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 60
			)
		)
	);

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_follower_five', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_follower_five',
			array(
				'label'           => esc_html__( 'Follower Image 5', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 70
			)
		)
	);

	$wp_customize->add_setting( 'bosa_portfolio_bio_blog_follower_six', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bosa_portfolio_bio_blog_follower_six',
			array(
				'label'           => esc_html__( 'Follower Image 6', 'bosa-portfolio-bio' ),
				'section'         => 'bosa_portfolio_bio_blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 80
			)
		)
	);

	// responsive follower
	$wp_customize->add_setting( 'bosa_portfolio_bio_disable_mobile_followers', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_portfolio_bio_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'bosa_portfolio_bio_disable_mobile_followers', array(
	    'label'        => esc_html__( 'Disable Followers', 'bosa-portfolio-bio' ),
	    'type' => 'checkbox',
	    'priority' => 28,
	    'section' => 'bosa_portfolio_bio_blog_page_responsive',
	    'active_callback' => 'bosa_portfolio_bio_is_enable_followers',
	) );


}
add_action( 'customize_register', 'bosa_portfolio_bio_customizer_structure', 15 );

/**
 * Kirki Customizer
 *
 * @return void
 */
add_action( 'init' , 'bosa_portfolio_bio_kirki_fields', 999, 1 );

function bosa_portfolio_bio_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config( 'bosa-portfolio-bio', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	) );

	// Site Identity - Title & Tagline
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Logo Image Width', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_logo_width',
		'section'      => 'bosa_portfolio_bio_title_tagline',
		'transport'    => 'postMessage',
		'priority'     => '8',
		'default'      => 270,
		'choices'      => array(
			'min'  => 50,
			'max'  => 270,
			'step' => 5,
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Site Title', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_site_title',
		'section'      => 'bosa_portfolio_bio_title_tagline',
		'priority'     => '10',
		'default'      => false,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Site Tagline', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_site_tagline',
		'section'      => 'bosa_portfolio_bio_title_tagline',
		'priority'     => '20',
		'default'      => false,
	) );

	// Colors Options
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Body Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_body_text_color',
		'section'      => 'bosa_portfolio_bio_colors',
		'default'      => '#333333',
		'priority'     => '20',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),

	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'General Heading Text Color (H1 - H6)', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_heading_text_color',
		'section'      => 'bosa_portfolio_bio_colors',
		'default'      => '#030303',
		'priority'     => '30',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),

	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'General Link Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_general_link_color',
		'section'      => 'bosa_portfolio_bio_colors',
		'default'      => '#a6a6a6',
		'priority'     => '35',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Page and Single Post Title', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_header_textcolor',
		'section'      => 'bosa_portfolio_bio_colors',
		'default'      => '#101010',
		'priority'     => '40',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Primary Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_primary_color',
		'section'      => 'bosa_portfolio_bio_colors',
		'default'      => '#E5FF01',
		'priority'     => '50',
	) );
	
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_hover_color',
		'section'      => 'bosa_portfolio_bio_colors',
		'default'     => '#AABC0D',
		'priority'    => '60',
	) );

	// Header Options
	Kirki::add_panel( 'bosa_portfolio_bio_header_options', array(
	    'title' => esc_html__( 'Header', 'bosa-portfolio-bio' ),
	    'priority' => '10',
	) );

	// Header Style Options
	Kirki::add_section( 'bosa_portfolio_bio_header_style_options', array(
	    'title'      => esc_html__( 'Style', 'bosa-portfolio-bio' ),
	    'panel'      => 'bosa_portfolio_bio_header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '30',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Header Layouts', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_header_layout',
		'section'     => 'bosa_portfolio_bio_header_style_options',
		'default'     => 'header_one',
		'priority'	  => '40',
		'choices'     => apply_filters( 'bosa_portfolio_bio_header_layout_filter', array(
			'header_one'    => get_template_directory_uri() . '/assets/images/header-layout-1.png',
			'header_two'    => get_template_directory_uri() . '/assets/images/header-layout-2.png',
			'header_three'  => get_template_directory_uri() . '/assets/images/header-layout-3.png',
			'header_fourteen'   => get_stylesheet_directory_uri() . '/assets/images/header-layout-14.png'
		) ),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Top Header Section', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_top_header_section',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => false,
		'priority'	   => '50',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_header_two_home_separator',
	    'section'     => 'bosa_portfolio_bio_header_style_options',
	    'default'     => esc_html__( 'Transparent Header Options', 'bosa-portfolio-bio' ),
	    'priority'	  => '60',
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	// Header two 
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Header Site Logo', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'Fully white or light color with image dimensions 320 by 120 pixels is recommended.', 'bosa-portfolio-bio' ),
		'type'         => 'image',
		'settings'     => 'bosa_portfolio_bio_header_separate_logo',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	  =>  '70',
		'choices'     => array(
			'save_as' => 'id',
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Header Site Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_title_color_transparent_header',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#ffffff',
		'priority'	   => '80',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_site_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Header Site Tagline Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_tagline_color_transparent_header',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#e6e6e6',
		'priority'	   => '90',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Top Header Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_transparent_header_top_background_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	   => '100',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Top Header Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_transparent_header_top_header_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#ffffff',
		'priority'	   => '110',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Top Header Text Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_hover_color_transparent_header',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#AABC0D',
		'priority'	   => '120',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Bottom Header Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_transparent_header_bottom_background_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	   => '130',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Header Menu Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_content_color_transparent_header',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#ffffff',
		'priority'	   => '140',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Bottom Header Text Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_content_hover_color_transparent_header',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#AABC0D',
		'priority'	   => '150',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_header_two_general_separator',
	    'section'     => 'bosa_portfolio_bio_header_style_options',
	    'default'     => esc_html__( 'Non Transparent Header Options', 'bosa-portfolio-bio' ),
	    'priority'	  => '160',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Header Site Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_title_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#030303',
		'priority'	   => '170',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_site_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Header Site Tagline Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_tagline_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#767676',
		'priority'	   => '180',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Top Header Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_header_background_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	   => '190',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Top Header Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_header_text_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#333333',
		'priority'	   => '200',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Top Header Text Link Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_header_text_link_hover_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#AABC0D',
		'priority'	  =>  '210',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Top Header Section Border', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_top_header_border',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => false,
		'priority'	   => '220',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Mid Header Background Color', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_mid_header_background_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	   => '230',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Mid Header Text Link Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_mid_header_text_link_hover_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#AABC0D',
		'priority'	   => '240',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Mid Header Section Border', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_mid_header_border',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => false,
		'priority'	   => '250',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Bottom Header Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_bottom_header_background_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	  =>  '260',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Bottom Header Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_bottom_header_text_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#333333',
		'priority'	   => '270',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Non Transparent Bottom Header Text Link Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_bottom_header_text_link_hover_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#AABC0D',
		'priority'	   =>  '280',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Sub Menu Link Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_sub_menu_link_hover_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#AABC0D',
		'priority'	   =>  '290',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Header Height (in px)', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-portfolio-bio' ),
		'type'        => 'slider',
		'settings'    => 'bosa_portfolio_bio_header_image_height',
		'section'     => 'bosa_portfolio_bio_header_style_options',
		'transport'   => 'postMessage',
		'default'     => 100,
		'priority'	  => '300',
		'choices'     => array(
			'min'  => 50,
			'max'  => 1200,
			'step' => 10,
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_contact_details_separator',
	    'section'     => 'bosa_portfolio_bio_header_style_options',
	    'default'     => esc_html__( 'Contact Details Options', 'bosa-portfolio-bio' ),
	    'priority'	  => '310',
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

    // Contact Detail Options
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Contact Details', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_contact_detail',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => false,
		'priority'	   => '320',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	// Header contact labels for header 14
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Contact Detail Icon color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_header_icon_color',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '#B7B7B7',
		'priority'	   => '330',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_fourteen' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Phone Number Label', 'bosa-portfolio-bio' ),
		'type'         => 'text',
		'settings'     => 'bosa_portfolio_bio_header_phone_label',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => "",
		'priority'	   => '340',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_fourteen' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Phone Number', 'bosa-portfolio-bio' ),
		'type'         => 'text',
		'settings'     => 'bosa_portfolio_bio_contact_phone',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	   => '350',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Email', 'bosa-portfolio-bio' ),
		'type'         => 'text',
		'settings'     => 'bosa_portfolio_bio_contact_email',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	   => '360',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Address', 'bosa-portfolio-bio' ),
		'type'         => 'text',
		'settings'     => 'bosa_portfolio_bio_contact_address',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => '',
		'priority'	   => '370',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_header_button_separator',
	    'section'     => 'bosa_portfolio_bio_header_style_options',
	    'default'     => esc_html__( 'Header Button Options', 'bosa-portfolio-bio' ),
	    'priority'	  => '380',
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	// Header button
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Header Buttons', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_header_button',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'      => false,
		'priority'	   => '390',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Header Buttons', 'bosa-portfolio-bio' ),
		'type'         => 'repeater',
		'settings'     => 'bosa_portfolio_bio_header_button_repeater',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'priority'	   => '400',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-portfolio-bio' ),
		),
		'default' => array(
			array(
				'header_btn_type' 			=> 'button-outline',
				'header_btn_bg_color'		=> '#E5FF01',
				'header_btn_border_color'	=> '#1a1a1a',
				'header_btn_text_color'		=> '#1a1a1a',
				'header_btn_hover_color'	=> '#AABC0D',
				'header_btn_text' 			=> '',
				'header_btn_link' 			=> '',
				'header_btn_target'			=> true,
				'header_btn_radius'			=> 0,
			),		
		),
		'fields' => array(
			'header_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-portfolio-bio' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  	  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-portfolio-bio' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-portfolio-bio' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-portfolio-bio' ),
				),
			),
			'header_btn_bg_color' 	=> array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Background Color', 'bosa-portfolio-bio' ),
				'description' 		=> esc_html__( 'For background button type only.', 'bosa-portfolio-bio' ),
				'type'        		=> 'color',
				'default'     		=> '#E5FF01',
			),
			'header_btn_border_color' 	=> array(
				'label'      	 		=> esc_html__( 'Non Transparent Header Button Border Color', 'bosa-portfolio-bio' ),
				'description' 			=> esc_html__( 'For border button type only.', 'bosa-portfolio-bio' ),
				'type'       		 	=> 'color',
				'default'     			=> '#1a1a1a',
			),
			'header_btn_text_color' => array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Text Color', 'bosa-portfolio-bio' ),
				'type'        		=> 'color',
				'default'     		=> '#1a1a1a',
			),
			'header_btn_hover_color' => array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Hover Color', 'bosa-portfolio-bio' ),
				'type'        		=> 'color',
				'default'     		=> '#AABC0D',
			),
			'header_btn_text' => array(
				'label'       => esc_html__( 'Button Text', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'header_btn_link' => array(
				'label'       => esc_html__( 'Button Link', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'header_btn_target' => array(
				'label'       	=> esc_html__( 'Open Link in New Window', 'bosa-portfolio-bio' ),	
				'type'        	=> 'checkbox',
				'default'	  	=> true,
			),
			'header_btn_radius' => array(
				'label'       	=> esc_html__( 'Button Radius (px)', 'bosa-portfolio-bio' ),
				'type'        	=> 'number',
				'default'	  	=> 0,
				'choices'     	=> array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),	
		),
		'choices' => array(
			'limit' => 2,
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Header Buttons', 'bosa-portfolio-bio' ),
		'type'         => 'repeater',
		'settings'     => 'bosa_portfolio_bio_transparent_header_button_repeater',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'priority'	   => '410',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-portfolio-bio' ),
		),
		'default' => array(
			array(
				'transparent_header_btn_type' 				=> 'button-outline',
				'transparent_header_home_btn_bg_color'		=> '#E5FF01',
				'transparent_header_home_btn_border_color'	=> '#ffffff',
				'transparent_header_home_btn_text_color'	=> '#ffffff',
				'transparent_header_btn_bg_color'			=> '#E5FF01',
				'transparent_header_btn_border_color'		=> '#1a1a1a',
				'transparent_header_btn_text_color'			=> '#1a1a1a',
				'transparent_header_btn_hover_color'		=> '#AABC0D',
				'transparent_header_btn_text' 				=> '',
				'transparent_header_btn_link' 				=> '',
				'transparent_header_btn_target'				=> true,
				'transparent_header_btn_radius'				=> 0,
			),		
		),
		'fields' => array(
			'transparent_header_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-portfolio-bio' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  	  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-portfolio-bio' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-portfolio-bio' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-portfolio-bio' ),
				),
			),
			'transparent_header_home_btn_bg_color' 	=> array(
				'label'       		=> esc_html__( 'Transparent Header Button Background Color', 'bosa-portfolio-bio' ),
				'description' 		=> esc_html__( 'For background button type only.', 'bosa-portfolio-bio' ),
				'type'        		=> 'color',
				'default'     		=> '#E5FF01',
			),
			'transparent_header_home_btn_border_color' 	=> array(
				'label'      	 		=> esc_html__( 'Transparent Header Button Border Color', 'bosa-portfolio-bio' ),
				'description' 			=> esc_html__( 'For border button type only.', 'bosa-portfolio-bio' ),
				'type'       		 	=> 'color',
				'default'     			=> '#ffffff',
			),
			'transparent_header_home_btn_text_color' => array(
				'label'       		=> esc_html__( 'Transparent Header Button Text Color', 'bosa-portfolio-bio' ),
				'type'        		=> 'color',
				'default'     		=> '#ffffff',
			),
			'transparent_header_btn_bg_color' 	=> array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Background Color', 'bosa-portfolio-bio' ),
				'description' 		=> esc_html__( 'For background button type only.', 'bosa-portfolio-bio' ),
				'type'        		=> 'color',
				'default'     		=> '#E5FF01',
			),
			'transparent_header_btn_border_color' 	=> array(
				'label'      	 		=> esc_html__( 'Non Transparent Header Button Border Color', 'bosa-portfolio-bio' ),
				'description' 			=> esc_html__( 'For border button type only.', 'bosa-portfolio-bio' ),
				'type'       		 	=> 'color',
				'default'     			=> '#1a1a1a',
			),
			'transparent_header_btn_text_color' => array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Text Color', 'bosa-portfolio-bio' ),
				'type'        		=> 'color',
				'default'     		=> '#1a1a1a',
			),
			'transparent_header_btn_hover_color' => array(
				'label'       		=> esc_html__( 'Button Hover Color', 'bosa-portfolio-bio' ),
				'type'        		=> 'color',
				'default'     		=> '#AABC0D',
			),
			'transparent_header_btn_text' => array(
				'label'       => esc_html__( 'Button Text', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'transparent_header_btn_link' => array(
				'label'       => esc_html__( 'Button Link', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'transparent_header_btn_target' => array(
				'label'       	=> esc_html__( 'Open Link in New Window', 'bosa-portfolio-bio' ),	
				'type'        	=> 'checkbox',
				'default'	  	=> true,
			),
			'transparent_header_btn_radius' => array(
				'label'       	=> esc_html__( 'Button Radius (px)', 'bosa-portfolio-bio' ),
				'type'        	=> 'number',
				'default'	  	=> 0,
				'choices'     	=> array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),	
		),
		'choices' => array(
			'limit' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Search', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_search_icon',
		'section'     => 'bosa_portfolio_bio_header_style_options',
		'default'     => false,
		'priority'	  => '420',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Hamburger Widget Menu Icon', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_hamburger_menu_icon',
		'section'     => 'bosa_portfolio_bio_header_style_options',
		'default'     => false,
		'priority'	  =>  '430',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Header Buttons Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_header_buttons_font_control',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'priority'	   => '440',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '600',
			'font-size'      => '14px',
			'text-transform' => 'none',
			'line-height'    => '1',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-header .header-btn a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	// Header contact labels typography for header 14

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Contact Label Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_contact_label_font_control',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '13px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	  => '450',
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.header-fourteen .bottom-contact a span' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Contact Content Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_contact_content_font_control',
		'section'      => 'bosa_portfolio_bio_header_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	  => '460',
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.header-fourteen .bottom-contact a' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_fourteen' ),
			),
		),
	) );

	// Header Media Options
	Kirki::add_section( 'bosa_portfolio_bio_header_wrap_media_options', array(
	    'title'      => esc_html__( 'Media', 'bosa-portfolio-bio' ),
	    'panel'      => 'bosa_portfolio_bio_header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '30',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Header Image Slider', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel. Add only one image to make header banner.', 'bosa-portfolio-bio' ),
		'type'        => 'repeater',
		'section'     => 'bosa_portfolio_bio_header_wrap_media_options',
		'row_label' => array(
			'type'  => 'text',
		),
		'button_label' => esc_html__('Add New Image', 'bosa-portfolio-bio' ),
		'settings'     => 'bosa_portfolio_bio_header_image_slider',
		'default'      => array(
				array(
					'slider_item' 	=> '',
					)			
		),
		'fields' => array(
			'slider_item' => array(
				'label'       => esc_html__( 'Image', 'bosa-portfolio-bio' ),
				'type'        => 'image',
				'default'     => '',
				'choices'     => array(
					'save_as' => 'id',
				),
			)
		),
		'choices' => array(
			'limit' => 2,
		),
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_header_image_size',
		'section'     => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'	  =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-portfolio-bio' ),
		'type'         => 'radio',
		'settings'     => 'bosa_portfolio_bio_header_image_size',
		'section'      => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-portfolio-bio' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-portfolio-bio' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  30,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Slide Effect', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_header_slider_effect',
		'section'     => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'     => 'fade',
		'choices'  => array(
			'fade'             => esc_html__( 'Fade', 'bosa-portfolio-bio' ),
			'horizontal-slide' => esc_html__( 'Slide', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  40,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Fade Control Time ( in sec )', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_slider_header_fade_control',
		'section'      => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'      => 5,
		'choices' => array(
				'min' => '3',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	  =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_slider_effect',
				'operator' => '==',
				'value'    => 'fade',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Arrows', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_header_slider_arrows',
		'section'      => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'      => false,
		'priority'	  =>  60,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Dots', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_header_slider_dots',
		'section'      => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'      => false,
		'priority'	  =>  70,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Auto Play', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_header_slider_autoplay',
		'section'      => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'      => true,
		'priority'	  =>  80,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Auto Play Timeout ( in sec )', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_slider_header_autoplay_speed',
		'section'      => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'      => 4,
		'choices' => array(
				'min' => '1',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	  =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_slider_autoplay',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Parallax Scrolling', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_parallax_scrolling',
		'section'     => 'bosa_portfolio_bio_header_wrap_media_options',
		'default'     => true,
		'priority'	  =>  100,
	) );

	// Header Elements Options
	Kirki::add_section( 'bosa_portfolio_bio_header_elements_options', array(
	    'title'      => esc_html__( 'Elements', 'bosa-portfolio-bio' ),
	    'panel'      => 'bosa_portfolio_bio_header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '30',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_fixed_header_separator',
	    'section'     => 'bosa_portfolio_bio_header_elements_options',
	    'default'     => esc_html__( 'Fixed Header Options', 'bosa-portfolio-bio' ),
	    'priority'	  =>  10,
	) );
	
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Fixed Header', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_fixed_header',
		'section'     => 'bosa_portfolio_bio_header_elements_options',
		'default'     => true,
		'priority'	  =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Logo', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_fixed_header_logo',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => false,
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Separate Logo for Fixed Header', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'Image dimensions 320 by 120 pixels is recommended. It will change in fixed header only.', 'bosa-portfolio-bio' ),
		'type'         => 'image',
		'settings'     => 'bosa_portfolio_bio_fixed_header_separate_logo',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	  =>  40,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header_logo',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
		),

	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Logo Image Width', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_fixed_header_logo_width',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'transport'    => 'postMessage',
		'default'      => 270,
		'choices'      => array(
			'min'  => 50,
			'max'  => 270,
			'step' => 5,
		),
		'priority'	  =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header_logo',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Site Title', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_fixed_header_site_title',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => false,
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_site_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Fixed Header Site Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_title_color_fixed_header',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'priority'	  =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header_site_title',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_site_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Site Tagline', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_fixed_header_site_tagline',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => false,
		'priority'	  =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Fixed Header Site Tagline Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_site_tagline_color_fixed_header',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'priority'	  =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Fixed Header Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_bg_color_fixed_header',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'priority'	  =>  100,	
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Fixed Header Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_text_color_fixed_header',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'priority'	  =>  110,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Fixed Header Text Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_text_hover_color_fixed_header',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'priority'	  =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Fixed Header Button Background Color', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'For background button type only.', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_fixed_header_button_background_color',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'priority'	  =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Fixed Header Button Border Color', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'For border button type only.', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_fixed_header_button_border_color',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'priority'	  =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Fixed Header Button Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_fixed_header_button_text_color',
		'section'      => 'bosa_portfolio_bio_header_elements_options',
		'default'      => '',
		'priority'	  =>  150,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Responsive
	Kirki::add_section( 'bosa_portfolio_bio_header_responsive', array(
	    'title'      => esc_html__( 'Responsive', 'bosa-portfolio-bio' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-portfolio-bio' ),
	    'capability' => 'edit_theme_options',
	    'priority'   => '80',
	    'panel'      => 'bosa_portfolio_bio_header_options',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Top Header Menu Section', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_mobile_top_header',
		'section'      => 'bosa_portfolio_bio_header_responsive',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(	
		'label'       => esc_html__( 'Top Header Bar Name', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_top_bar_name',
		'section'     => 'bosa_portfolio_bio_header_responsive',
		'default'     => esc_html__( 'TOP MENU', 'bosa-portfolio-bio' ),
		'priority'	  =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Header Menu Text', 'bosa-portfolio-bio' ),
		'type'         => 'text',
		'settings'     => 'bosa_portfolio_bio_responsive_header_menu_text',
		'section'      => 'bosa_portfolio_bio_header_responsive',
		'default'      => esc_html__( 'MENU', 'bosa-portfolio-bio' ),
		'priority'	   =>  30,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Top Header Section Border', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_mobile_top_header_border',
		'section'      => 'bosa_portfolio_bio_header_responsive',
		'default'      => false,
		'priority'	   =>  40,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Mid Header Section Border', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_mobile_mid_header_border',
		'section'      => 'bosa_portfolio_bio_header_responsive',
		'default'      => false,
		'priority'	   =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Fixed Header', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_mobile_fixed_header',
		'section'     => 'bosa_portfolio_bio_header_responsive',
		'default'     => true,
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Header Secondary Menu', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_secondary_menu',
		'section'     => 'bosa_portfolio_bio_header_responsive',
		'default'     => false,
		'priority'	  =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Header Contact Details', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_mobile_contact_details',
		'section'     => 'bosa_portfolio_bio_header_responsive',
		'default'     => false,
		'priority'	  =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Header Search', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_mobile_search_icon',
		'section'     => 'bosa_portfolio_bio_header_responsive',
		'default'     => false,
		'priority'	  =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_search_icon',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Header Buttons', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_mobile_header_buttons',
		'section'     => 'bosa_portfolio_bio_header_responsive',
		'default'     => false,
		'priority'	  =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' , 'header_fourteen'),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );


	// Theme Skin Options
	Kirki::add_section( 'bosa_portfolio_bio_skins_options', array(
	    'title'      => esc_html__( 'Site Skins', 'bosa-portfolio-bio' ),
	    'description' => esc_html__( 'All color options except primary color will be overridden by the theme in dark and B&W skin.', 'bosa-portfolio-bio' ),
	    'capability' => 'edit_theme_options',
	    'priority'   => '80',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Select Theme Skin', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_skin_select',
		'section'     => 'bosa_portfolio_bio_skins_options',
		'default'     => 'default',
		'priority'	  =>  10,
		'choices'  => array(
			'default'    => esc_html__( 'Default', 'bosa-portfolio-bio' ),
			'dark'       => esc_html__( 'Dark', 'bosa-portfolio-bio' ),
			'blackwhite' => esc_html__( 'Black & White', 'bosa-portfolio-bio' ),
		)
	) );

	// Social Media Options
	Kirki::add_panel( 'bosa_portfolio_bio_social_media_options', array(
	    'title'          => esc_html__( 'Social Media', 'bosa-portfolio-bio' ),
	    'priority'       => '96',
	) );

	Kirki::add_section( 'bosa_portfolio_bio_social_media_elements_options', array(
	    'title'          => esc_html__( 'Elements', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '10',
	    'panel'			 => 'bosa_portfolio_bio_social_media_options',		
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable from Header', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_header_social_links',
		'section'      => 'bosa_portfolio_bio_social_media_elements_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable from Footer', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_footer_social_links',
		'section'      => 'bosa_portfolio_bio_social_media_elements_options',
		'default'      => false,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Footer Social Icons Size', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Only applicable to the footer social icons.', 'bosa-portfolio-bio' ),
		'type'        => 'number',
		'settings'    => 'bosa_portfolio_bio_social_icons_size',
		'section'     => 'bosa_portfolio_bio_social_media_elements_options',
		'transport'   => 'postMessage',
		'default'     => 15,
		'choices'     => array(
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		),
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_footer_social_links',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Social Links', 'bosa-portfolio-bio' ),
		'type'        => 'repeater',
		'description' => esc_html__( 'By default, Social Icons will appear in both header and footer section.', 'bosa-portfolio-bio' ),
		'section'     => 'bosa_portfolio_bio_social_media_elements_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Social Link', 'bosa-portfolio-bio' ),
		),
		'settings' => 'bosa_portfolio_bio_social_media_links',
		'default' => array(
			array(
				'icon' 		=> '',
				'link' 		=> '',
				'target' 	=> true,
				),		
		),
		'fields' => array(
			'icon' => array(
				'label'       => esc_html__( 'Fontawesome Icon', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'description' => esc_html__( 'Input Icon name. For Example:- fab fa-facebook For more icons https://fontawesome.com/icons?d=gallery&m=free', 'bosa-portfolio-bio' ),
			),
			'link' => array(
				'label'       => esc_html__( 'Link', 'bosa-portfolio-bio' ),
				'type'        => 'text',
			),
			'target' => array(
				'label'       => esc_html__( 'Open Link in New Window', 'bosa-portfolio-bio' ),
				'type'        => 'checkbox',
				'default' 	  => true,
			),			
		),
		'choices' => array(
			'limit' => 20,
		),
		'priority' =>  40,
	) );

	// Responsive
	Kirki::add_section( 'bosa_portfolio_bio_social_responsive', array(
	    'title'          => esc_html__( 'Responsive', 'bosa-portfolio-bio' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '20',
	    'panel'			 => 'bosa_portfolio_bio_social_media_options',		
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Social Icons from Header', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_mobile_social_icons_header',
		'section'     => 'bosa_portfolio_bio_social_responsive',
		'default'     => false,
		'priority'	  =>  10,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_header_social_links',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Social Icons from Footer', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_mobile_social_icons_footer',
		'section'     => 'bosa_portfolio_bio_social_responsive',
		'default'     => false,
		'priority'	  =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_footer_social_links',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	//Typography Options
	Kirki::add_section( 'bosa_portfolio_bio_typography', array(
	    'title'          => esc_html__( 'Typography', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '95',
	    'reset'          => 'typography',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Site Title', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_site_title_font_control',
		'section'      => 'bosa_portfolio_bio_typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '22px',
			'text-transform' => 'none',
		),
		'priority'	  =>  10,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-header .site-branding .site-title',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Site Description', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_site_description_font_control',
		'section'      => 'bosa_portfolio_bio_typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'text-transform' => 'none',
		),
		'priority'	  =>  20,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => '.site-header .site-branding .site-description',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Main Menu', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_menu_font_control',
		'section'      => 'bosa_portfolio_bio_typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'font-size'      => '15px',
			'text-transform' => 'uppercase',
			'variant'        => '600',
			'line-height'    => '1.5',
		),
		'priority'	  =>  30,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.main-navigation ul.menu li a', '.slicknav_menu .slicknav_nav li a' )
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_main_menu_description_info',
	    'section'     => 'bosa_portfolio_bio_typography',
	    'default'     => esc_html__( 'Below Main Menu Description setting will work after enabling description section in the menu. Please check https://bosathemes.com/docs/bosa/how-to-setup/how-to-setup-menu-description Documentation for more information.', 'bosa-portfolio-bio' ),
	    'priority'	  =>  40,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Main Menu Description', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_menu_description_font_control',
		'section'      => 'bosa_portfolio_bio_typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'font-size'      => '11px',
			'text-transform' => 'none',
			'variant'        => 'regular',
			'line-height'    => '1.3',
		),
		'priority'	  =>  50,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.main-navigation .menu-description, .slicknav_menu .menu-description' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Body', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_body_font_control',
		'section'      => 'bosa_portfolio_bio_typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '15px',
		),
		'priority'	  =>  60,
		'transport'   => 'auto',
		'output' => array( 
			array(
				'element' => 'body',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'General Title (H1 - H6)', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_general_title_font_control',
		'section'      => 'bosa_portfolio_bio_typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'text-transform' => 'none',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
			),
		),	
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Page & Single Post Title', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_page_title_font_control',
		'section'      => 'bosa_portfolio_bio_typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '48px',
			'text-transform' => 'none',
		),
		'priority'	  =>  80,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.page-title' ),
			),
		),
	) );

	// Site Layouts Options
	Kirki::add_panel( 'bosa_portfolio_bio_site_layout_options', array(
	    'title' => esc_html__( 'Site Layouts', 'bosa-portfolio-bio' ),
	    'priority' => '90',
	) );

	Kirki::add_section( 'bosa_portfolio_bio_site_layout_style_options', array(
	    'title'          => esc_html__( 'Style', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_site_layout_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Site Layouts', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Default / Box / Frame / Full / Extend', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_site_layout',
		'section'     => 'bosa_portfolio_bio_site_layout_style_options',
		'default'     => 'default',
		'choices'  => array(
			'default' => get_template_directory_uri() . '/assets/images/default-layout.png',
			'box'     => get_template_directory_uri() . '/assets/images/box-layout.png',
			'frame'   => get_template_directory_uri() . '/assets/images/frame-layout.png',
			'full'    => get_template_directory_uri() . '/assets/images/full-layout.png',
			'extend'  => get_template_directory_uri() . '/assets/images/extend-layout.png',
		),
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_box_frame_background_color',
		'section'      => 'bosa_portfolio_bio_site_layout_style_options',
		'default'      => '',
		'priority'	   =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Image', 'bosa-portfolio-bio' ),
		'type'         => 'image',
		'settings'     => 'bosa_portfolio_bio_box_frame_background_image',
		'section'      => 'bosa_portfolio_bio_site_layout_style_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-portfolio-bio' ),
		'type'         => 'radio',
		'settings'     => 'bosa_portfolio_bio_box_frame_image_size',
		'section'      => 'bosa_portfolio_bio_site_layout_style_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-portfolio-bio' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-portfolio-bio' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  40,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	Kirki::add_section( 'bosa_portfolio_bio_site_layout_elements_options', array(
	    'title'          => esc_html__( 'Elements', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_site_layout_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Site Layouts (Box & Frame) Shadow', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_site_layout_shadow',
		'section'      => 'bosa_portfolio_bio_site_layout_elements_options',
		'default'      => false,
		'priority'	   =>  10,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	// Sidebar Options
	Kirki::add_section( 'bosa_portfolio_bio_sidebar_options', array(
	    'title'          => esc_html__( 'Sidebar', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '98',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Sidebar Layouts', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Right / Left / Both / None', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_sidebar_settings',
		'section'     => 'bosa_portfolio_bio_sidebar_options',
		'default'     => 'right',
		'choices'  => array(
			'right'      => get_template_directory_uri() . '/assets/images/right-sidebar.png',
			'left'       => get_template_directory_uri() . '/assets/images/left-sidebar.png',
			'right-left' => get_template_directory_uri() . '/assets/images/right-left-sidebar.png',
			'no-sidebar' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
		),
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Widget Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_sidebar_widget_title_font_control',
		'section'      => 'bosa_portfolio_bio_sidebar_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '16px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  20,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.sidebar .widget .widget-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Sidebar Widget Title Border', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_sidebar_widget_title_border',
		'section'      => 'bosa_portfolio_bio_sidebar_options',
		'default'      => false,
		'priority'	   =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Sticky Position', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_sticky_sidebar',
		'section'      => 'bosa_portfolio_bio_sidebar_options',
		'default'      => false,
		'priority'	   =>  40,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Sidebar in Blog Page', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_sidebar_blog_page',
		'section'     => 'bosa_portfolio_bio_sidebar_options',
		'default'     => false,
		'priority'	  =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Sidebar in Single Post', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_sidebar_single_post',
		'section'     => 'bosa_portfolio_bio_sidebar_options',
		'default'     => false,
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Sidebar in Page', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_sidebar_page',
		'section'     => 'bosa_portfolio_bio_sidebar_options',
		'default'     => true,
		'priority'	  =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Sidebar in WooCommerce', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_sidebar_woocommerce_page',
		'section'     => 'bosa_portfolio_bio_sidebar_options',
		'default'     => false,
		'priority'	  =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Sidebar in WooCommerce Shop', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_sidebar_woocommerce_shop',
		'section'     => 'bosa_portfolio_bio_sidebar_options',
		'default'     => false,
		'priority'	  =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_sidebar_woocommerce_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Sidebar in WooCommerce Single Product', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_sidebar_woocommerce_single',
		'section'     => 'bosa_portfolio_bio_sidebar_options',
		'default'     => false,
		'priority'	  =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_sidebar_woocommerce_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Footer Options
	Kirki::add_panel( 'bosa_portfolio_bio_footer_options', array(
	    'title' => esc_html__( 'Footer', 'bosa-portfolio-bio' ),
	    'priority' => '110',
	) );

	// Footer Widgets Options
	Kirki::add_section( 'bosa_portfolio_bio_footer_widgets_options', array(
	    'title'          => esc_html__( 'Footer Widgets', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority' 		 => 10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Footer Widget Area', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_footer_widget',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Footer Widget Title Border', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_footer_widget_title_border',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => false,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Footer Widget Item List Border ', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_footer_widget_list_item_border',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => false,
		'priority'	   =>  30,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Widget Columns Layouts', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_footer_widget_layout',
		'section'     => 'bosa_portfolio_bio_footer_widgets_options',
		'default'     => 'footer_widget_layout_one',
		'choices'  => array(
			'footer_widget_layout_one'    => get_template_directory_uri() . '/assets/images/widget-layout-1.png',
			'footer_widget_layout_two'    => get_template_directory_uri() . '/assets/images/widget-layout-2.png',
			'footer_widget_layout_three'    => get_template_directory_uri() . '/assets/images/widget-layout-3.png',
			'footer_widget_layout_four' => get_template_directory_uri() . '/assets/images/widget-layout-4.png',
		),
		'priority'	   =>  40,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Footer Widget Area Top Padding(in px)', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_footer_widget_area_top_padding',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => 0,
		'priority'	   =>  50,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Footer Widget Area Bottom Padding(in px)', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_footer_widget_area_bottom_padding',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => 50,
		'priority'	   =>  60,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Section Background Color', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_footer_background_color',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => '',
		'priority'	   =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Widget Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_footer_widget_title_color',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => '#030303',
		'priority'	   =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Widgets Link Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_footer_widget_link_color',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => '#656565',
		'priority'	   =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Widgets Content Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_footer_widget_content_color',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => '#656565',
		'priority'	   =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Widgets Link Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_top_footer_widget_link_hover_color',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'      => '#AABC0D',
		'priority'	   =>  110,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Widget Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_footer_widget_title_font_control',
		'section'      => 'bosa_portfolio_bio_footer_widgets_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'priority'	  =>  120,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-footer .widget .widget-title',
			),
		),
	) );

	// Footer Style Options
	Kirki::add_section( 'bosa_portfolio_bio_footer_style_options', array(
	    'title'          => esc_html__( 'Style', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority' 		 => 20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Bottom Footer Area', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_bottom_footer',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => false,
		'priority'	   => 10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Footer Layouts', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_footer_layout',
		'section'     => 'bosa_portfolio_bio_footer_style_options',
		'default'     => 'footer_one',
		'choices'  	  => apply_filters( 'bosa_portfolio_bio_footer_layout_filter', array(
			'footer_one'   => get_template_directory_uri() . '/assets/images/footer-layout-1.png',
			'footer_two'   => get_template_directory_uri() . '/assets/images/footer-layout-2.png',
			'footer_three' => get_template_directory_uri() . '/assets/images/footer-layout-3.png',
		) ),
		'priority'	   => 20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Bottom Footer Area Top Padding(in px)', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_bottom_footer_area_top_padding',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => 30,
		'priority'	   => 30,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Bottom Footer Area Bottom Padding(in px)', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_bottom_footer_area_bottom_padding',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => 30,
		'priority'	   => 40,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Color', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_bottom_footer_background_color',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => '',
		'priority'	   => 50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_bottom_footer_text_color',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => '#656565',
		'priority'	   => 60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Text Link Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_bottom_footer_text_link_color',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => '#383838',
		'priority'	   => 70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Text Link Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_bottom_footer_text_link_hover_color',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => '#AABC0D',
		'priority'	   => 80,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Bottom Footer Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_footer_style_font_control',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '14px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	   => 90,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.site-footer .site-info', '.site-footer .footer-menu ul li a' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Select Image', 'bosa-portfolio-bio' ),
		'type'         => 'image',
		'settings'     => 'bosa_portfolio_bio_bottom_footer_image',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	   => 100,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'    => esc_html__( 'Image Link', 'bosa-portfolio-bio' ),
		'type'     => 'link',
		'settings' => 'bosa_portfolio_bio_bottom_footer_image_link',
		'section'  => 'bosa_portfolio_bio_footer_style_options',
		'default'  => '',
		'priority'	   => 110,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'    => esc_html__( 'Image Target', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'If enabled, the page will be open in an another browser tab.', 'bosa-portfolio-bio' ),
		'type'     => 'checkbox',
		'settings' => 'bosa_portfolio_bio_bottom_footer_image_target',
		'section'  => 'bosa_portfolio_bio_footer_style_options',
		'default'  => true,
		'priority'	   => 120,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Image Width', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_bottom_footer_image_width',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'transport'    => 'postMessage',
		'default'      => 270,
		'choices'      => array(
			'min'  => 10,
			'max'  => 1140,
			'step' => 5,
		),
		'priority'	   => 130,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_bottom_footer_image_size',
		'section'     => 'bosa_portfolio_bio_footer_style_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'	   => 140,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Footer Menu', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_footer_menu',
		'section'      => 'bosa_portfolio_bio_footer_style_options',
		'default'      => false,
		'priority'	   => 150,
	) );

	// Media Footer Options
	Kirki::add_section( 'bosa_portfolio_bio_media_footer_options', array(
	    'title'          => esc_html__( 'Media', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority' 		 => 30,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Select Background Image', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel.', 'bosa-portfolio-bio' ),
		'type'        => 'image',
		'settings'    => 'bosa_portfolio_bio_footer_image',
		'section'     => 'bosa_portfolio_bio_media_footer_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_footer_image_size',
		'section'     => 'bosa_portfolio_bio_media_footer_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'	  =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-portfolio-bio' ),
		'type'         => 'radio',
		'settings'     => 'bosa_portfolio_bio_footer_image_size',
		'section'      => 'bosa_portfolio_bio_media_footer_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-portfolio-bio' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-portfolio-bio' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  30,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Parallax Scrolling', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_footer_parallax_scrolling',
		'section'     => 'bosa_portfolio_bio_media_footer_options',
		'default'     => true,
		'priority'	  =>  40,
	) );

	// Footer Elements Options
	Kirki::add_section( 'bosa_portfolio_bio_elements_footer_options', array(
	    'title'          => esc_html__( 'Elements', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority' 		 => 40,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Scroll to Top', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_scroll_top',
		'section'     => 'bosa_portfolio_bio_elements_footer_options',
		'default'     => false,
		'priority'	  =>  10,
	) );

	// Responsive
	Kirki::add_section( 'bosa_portfolio_bio_footer_responsive', array(
	    'title'          => esc_html__( 'Responsive', 'bosa-portfolio-bio' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'bosa_portfolio_bio_footer_options',
	    'priority' 		 => 50,		
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Footer Widget Area', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_responsive_footer_widget',
		'section'     => 'bosa_portfolio_bio_footer_responsive',
		'default'     => false,
		'priority'	  =>  10,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_footer_widget',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Scroll Top', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_mobile_scroll_top',
		'section'     => 'bosa_portfolio_bio_footer_responsive',
		'default'     => true,
		'priority'	  =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_scroll_top',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	// Blog Homepage Options

	// Main Banner / Post Slider 
	Kirki::add_section( 'bosa_portfolio_bio_main_slider_options', array(
	    'title'          => esc_html__( 'Banner / Post Slider', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '10',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Section', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_main_slider',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Slider / Banner', 'bosa-portfolio-bio' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'bosa_portfolio_bio_main_slider_controls',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'slider',
		'choices'  => array(
			'slider' => esc_html__( 'Slider', 'bosa-portfolio-bio' ),
			'banner' => esc_html__( 'Banner', 'bosa-portfolio-bio' ),

		),
		'priority'	  =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Height (in px)', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-portfolio-bio' ),
		'type'        => 'slider',
		'settings'    => 'bosa_portfolio_bio_main_slider_height',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'transport'   => 'postMessage',
		'default'     => 550,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'priority'	  =>  30,
	) );

	// Slider settings
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_slider_image_size',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'bosa-portfolio-bio-1370-550',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'	  =>  40,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen. Recommended posts containing feature images size with 1920x940 pixel.', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_slider_category',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_post_categories(),
		'priority'	  =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Slider Layout', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_main_slider_layout',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'main_slider_one',
		'choices'     => apply_filters( 'bosa_portfolio_bio_slider_layout_filter', array(
			'main_slider_one'    => get_template_directory_uri() . '/assets/images/slider-layout-1.png',
		) ),
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'type'        => 'color',
		'label'       => esc_html__( 'Slider Background Color', 'bosa-portfolio-bio' ),
		'settings'    => 'bosa_portfolio_bio_background_color_main_slider',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => '',
		'priority'	  =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_slider_post_title_color',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => '#ffffff',
		'priority'	   =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_slider_post_category_color',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => '#ebebeb',
		'priority'	   =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_slider_post_meta_color',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => '#ebebeb',
		'priority'	   =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_hide_slider_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_slider_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_slider_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_slider_post_meta_icon_color',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  110,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_hide_slider_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_slider_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_slider_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_slider_post_text_color',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => '#ffffff',
		'priority'	   =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'type'        => 'color',
		'label'       => esc_html__( 'Hover Color', 'bosa-portfolio-bio' ),
		'settings'    => 'bosa_portfolio_bio_separate_hover_color_for_main_slider',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => '#AABC0D',
		'priority'	  =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-portfolio-bio' ),
		'type'         => 'radio',
		'settings'     => 'bosa_portfolio_bio_main_slider_image_size',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-portfolio-bio' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-portfolio-bio' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Width Controls', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_slider_width_controls',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'full',
		'choices'  => array(
			'full'   => esc_html__( 'Full', 'bosa-portfolio-bio' ),
			'boxed'  => esc_html__( 'Boxed', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  150,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Slide Effect', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_main_slider_effect',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'fade',
		'choices'  => array(
			'fade'             => esc_html__( 'Fade', 'bosa-portfolio-bio' ),
			'horizontal-slide' => esc_html__( 'Slide', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  160,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Fade Control Time ( in sec )', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_slider_fade_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => 5,
		'choices' => array(
				'min' => '3',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	   =>  170,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_effect',
				'operator' => '==',
				'value'    => 'fade',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Content Alignment', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_main_slider_content_alignment',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'center',
		'choices'  => array(
			'center' => esc_html__( 'Center', 'bosa-portfolio-bio' ),
			'left'   => esc_html__( 'Left', 'bosa-portfolio-bio' ),
			'right'  => esc_html__( 'Right', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  180,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Display Slider on', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_display_main_slider_on',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'below_header',
		'choices'  => array(
			'below_header'            => esc_html__( 'Below Header', 'bosa-portfolio-bio' ),
			'below_featured_posts' => esc_html__( 'Below Featured Posts', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  190,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Arrows', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_slider_arrows',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => false,
		'priority'	   =>  200,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Dots', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_slider_dots',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => false,
		'priority'	   =>  210,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Auto Play', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_slider_autoplay',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => true,
		'priority'	   =>  220,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Auto Play Timeout ( in sec )', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_slider_autoplay_speed',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => 4,
		'choices' => array(
				'min' => '1',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	   =>  230,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_slider_autoplay',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post View Number', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'Number of posts to show.', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_slider_posts_number',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => 6,
		'choices' => array(
				'min' => '1',
				'max' => '20',
				'step' => '1',
		),
		'priority'	   =>  240,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Title', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_slider_title',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,	
		'priority'	  =>  250,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_slider_title_font_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '50px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  260,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable category', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_slider_category',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  270,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );	

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Category Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_slider_cat_font_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.6',
		),
		'priority'	  =>  280,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-header .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_category',
				'operator' => '==',
				'value'    => false,
				),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Date', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_slider_date',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  290,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Author', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_slider_author',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  300,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Comments Link', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_slider_comment',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  310,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Meta Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_slider_meta_font_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  =>  320,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Excerpt', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_slider_excerpt',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  330,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Excerpt Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_slider_excerpt_font_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'initial',
			'line-height'    => '1.8',
		),
		'priority'	  =>  340,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-text p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Excerpt Length', 'bosa-portfolio-bio' ),
		'type'        => 'number',
		'settings'    => 'bosa_portfolio_bio_slider_excerpt_length',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 25,
		'choices' => array(
			'min' => '5',
			'max' => '100',
			'step' => '5',
		),
		'priority'	  =>  350,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_excerpt',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Slider Button', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_slider_button',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  360,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Slider Button', 'bosa-portfolio-bio' ),
		'type'        => 'repeater',
		'settings'    => 'bosa_portfolio_bio_main_slider_button_repeater',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-portfolio-bio' ),
		),
		'default' => array(
			array(
				'slider_btn_type' 			=> 'button-outline',
				'slider_btn_bg_color' 		=> '#E5FF01',
				'slider_btn_border_color' 	=> '#ffffff',
				'slider_btn_text_color' 	=> '#ffffff',
				'slider_btn_hover_color' 	=> '#AABC0D',
				'slider_btn_text' 			=> '',
				'slider_btn_radius' 		=> 0,
			),		
		),
		'fields' => array(
			'slider_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-portfolio-bio' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-portfolio-bio' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-portfolio-bio' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-portfolio-bio' ),
				),
			),
			'slider_btn_bg_color' => array(
				'label'       => esc_html__( 'Button Background Color', 'bosa-portfolio-bio' ),
				'description' => esc_html__( 'For background button type only.', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#E5FF01',
			),
			'slider_btn_border_color' => array(
				'label'       => esc_html__( 'Button Border Color', 'bosa-portfolio-bio' ),
				'description' => esc_html__( 'For border button type only.', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#ffffff',
			),
			'slider_btn_text_color' => array(
				'label'       => esc_html__( 'Button Text Color', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#ffffff',
			),
			'slider_btn_hover_color' => array(
				'label'       => esc_html__( 'Button Hover Color', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#AABC0D',
			),
			'slider_btn_text' => array(
				'label'       => esc_html__( 'Text', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'default'	  => '',
			),
			'slider_btn_radius' => array(
				'label'       => esc_html__( 'Button Radius (px)', 'bosa-portfolio-bio' ),
				'type'        => 'number',
				'default'	  => 0,
				'choices'     => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),
		),
		'choices' => array(
			'limit' => 1,
		),
		'priority'	  =>  370,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Slider Button Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_slider_button_font_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '500',
			'font-size'      => '15px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  =>  380,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .slide-inner .banner-content .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_slider_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Banner settings
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_banner_image_size',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'bosa-portfolio-bio-1920-550',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'	  =>  390,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'type'        => 'color',
		'label'       => esc_html__( 'Banner Background Color', 'bosa-portfolio-bio' ),
		'settings'    => 'bosa_portfolio_bio_background_color_main_banner',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => '',
		'priority'	  =>  400,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_banner_title_color',
		'section'	   => 'bosa_portfolio_bio_main_slider_options',
		'default'      => '#ffffff',
		'priority'	   =>  410,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_banner_title',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Subtitle Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_banner_subtitle_color',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => '#ffffff',
		'priority'	   =>  420,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_banner_subtitle',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Select Image', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Recommended image size 1920x940 pixel.', 'bosa-portfolio-bio' ),
		'type'        => 'image',
		'settings'    => 'bosa_portfolio_bio_banner_image',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'	  => '',
		'priority'	  =>  430,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-portfolio-bio' ),
		'type'         => 'radio',
		'settings'     => 'bosa_portfolio_bio_main_banner_image_size',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-portfolio-bio' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-portfolio-bio' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  440,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Width Controls', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_banner_width_controls',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'full',
		'choices'  => array(
			'full'   => esc_html__( 'Full', 'bosa-portfolio-bio' ),
			'boxed'  => esc_html__( 'Boxed', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  450,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Content Alignment', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_main_banner_content_alignment',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'center',
		'choices'  => array(
			'center' => esc_html__( 'Center', 'bosa-portfolio-bio' ),
			'left'   => esc_html__( 'Left', 'bosa-portfolio-bio' ),
			'right'  => esc_html__( 'Right', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  460,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Display Banner on', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_display_banner_on',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => 'below_header',
		'choices'  => array(
			'below_header'            => esc_html__( 'Below Header', 'bosa-portfolio-bio' ),
			'below_featured_posts' => esc_html__( 'Below Featured Posts', 'bosa-portfolio-bio' ),
		),
		'priority'	  =>  470,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Title', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_banner_title',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  480,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Title', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_banner_title',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => '',
		'priority'	  =>  490,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_banner_title',
				'operator' => '==',
				'value'    => false,
			),
		),
		'partial_refresh' => array(
			'bosa_portfolio_bio_banner_title' => array(
				'selector'        => '.banner_title',
				'render_callback' => 'bosa_portfolio_bio_get_banner_title',
			)
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_banner_title_font_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '50px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  500,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_banner_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Subtitle', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_banner_subtitle',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  510,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Subtitle', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_banner_subtitle',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => '',
		'priority'	  =>  520,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_banner_subtitle',
				'operator' => '==',
				'value'    => false,
			),
		),
		'partial_refresh' => array(
			'bosa_portfolio_bio_banner_subtitle' => array(
				'selector'        => '.banner_subtitle',
				'render_callback' => 'bosa_portfolio_bio_get_banner_subtitle',
			)
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Subtitle Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_banner_subtitle_font_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'initial',
			'line-height'    => '1.8',
		),
		'priority'	  =>  530,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-subtitle',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_banner_subtitle',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Banner Buttons', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_banner_buttons',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'default'     => false,
		'priority'	  =>  540,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Banner Buttons', 'bosa-portfolio-bio' ),
		'type'        => 'repeater',
		'settings'    => 'bosa_portfolio_bio_main_banner_buttons_repeater',
		'section'     => 'bosa_portfolio_bio_main_slider_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-portfolio-bio' ),
		),
		'default' => array(
			array(
				'banner_btn_type' 			=> 'button-outline',
				'banner_btn_bg_color' 		=> '#E5FF01',
				'banner_btn_border_color' 	=> '#ffffff',
				'banner_btn_text_color' 	=> '#ffffff',
				'banner_btn_hover_color' 	=> '#AABC0D',
				'banner_btn_text' 			=> '',
				'banner_btn_link' 			=> '',
				'banner_btn_target'			=> true,
				'banner_btn_radius' 		=> 0,
			),		
		),
		'fields' => array(
			'banner_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-portfolio-bio' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-portfolio-bio' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-portfolio-bio' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-portfolio-bio' ),
				),
			),
			'banner_btn_bg_color' => array(
				'label'       => esc_html__( 'Button Background Color', 'bosa-portfolio-bio' ),
				'description' => esc_html__( 'For background button type only.', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#E5FF01',
			),
			'banner_btn_border_color' => array(
				'label'       => esc_html__( 'Button Border Color', 'bosa-portfolio-bio' ),
				'description' => esc_html__( 'For border button type only.', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#ffffff',
			),
			'banner_btn_text_color' => array(
				'label'       => esc_html__( 'Button Text Color', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#ffffff',
			),
			'banner_btn_hover_color' => array(
				'label'       => esc_html__( 'Button Hover Color', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#AABC0D',
			),
			'banner_btn_text' => array(
				'label'       => esc_html__( 'Text', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'default'	  => '',
			),
			'banner_btn_link' => array(
				'label'       => esc_html__( 'Link', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'default'	  => '',	
			),
			'banner_btn_target' => array(
				'label'       => esc_html__( 'Open Link in New Window', 'bosa-portfolio-bio' ),
				'type'        => 'checkbox',
				'default'	  => true,	
			),
			'banner_btn_radius' => array(
				'label'       => esc_html__( 'Button Radius (px)', 'bosa-portfolio-bio' ),
				'type'        => 'number',
				'default'	  => 0,
				'choices'     => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),
		),
		'choices' => array(
			'limit' => 1,
		),
		'priority'	  =>  550,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_banner_buttons',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Banner Button Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_main_banner_button_font_control',
		'section'      => 'bosa_portfolio_bio_main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '500',
			'font-size'      => '15px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  =>  560,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_banner_buttons',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Featured Posts Options
	Kirki::add_section( 'bosa_portfolio_bio_feature_posts_options', array(
	    'title'          => esc_html__( 'Featured Posts', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '20',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Featured Posts Section', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_feature_posts_section',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Section Title', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_feature_posts_section_title',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => true,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Title', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_feature_posts_section_title',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => '',
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_feature_posts_section_title_font_control',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '24px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-area .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Section Description', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_feature_posts_section_description',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => true,
		'priority'	   =>  50,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Description', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_feature_posts_section_description',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => '',
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_feature_posts_section_description_font_control',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-area .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Title and Description Alignment', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_feature_posts_section_title_desc_alignment',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => 'left',
		'choices'     => array(
			'left'	 	=> esc_html__( 'Left', 'bosa-portfolio-bio' ),
			'center'  	=> esc_html__( 'Center', 'bosa-portfolio-bio' ),   
			'right'		=> esc_html__( 'Right', 'bosa-portfolio-bio' ),
		),
		'priority'	  	  =>  80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_disable_feature_posts_section_title',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_disable_feature_posts_section_description',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Layout', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_feature_posts_section_layouts',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => 'feature_one',
		'choices'     => apply_filters( 'bosa_portfolio_bio_feature_posts_section_layouts_filter', array(
			'feature_one'    => get_template_directory_uri() . '/assets/images/feature-post-layout-1.png',
		) ),
		'priority'	  =>  90,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_featured_post_title_color',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_featured_post_category_bgcolor',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => '#E5FF01',
		'priority'	   =>  110,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_featured_post_category_color',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_featured_post_meta_color',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_hide_featured_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_featured_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_featured_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_featured_post_meta_icon_color',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_hide_featured_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_featured_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_featured_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_featured_post_hover_color',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => '#AABC0D',
		'priority'	   =>  150,
	) );


	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Columns', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_feature_posts_columns',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => 'three_columns',
		'placeholder' => esc_attr__( 'Select category', 'bosa-portfolio-bio' ),
		'choices'  => array(
			'one_column'    => esc_html__( '1 Column', 'bosa-portfolio-bio' ),
			'two_columns'   => esc_html__( '2 Columns', 'bosa-portfolio-bio' ),
			'three_columns' => esc_html__( '3 Columns', 'bosa-portfolio-bio' ),
			'four_columns'  => esc_html__( '4 Columns', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  160,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen.', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_feature_posts_category',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-portfolio-bio' ), 
		'choices'     => bosa_portfolio_bio_get_post_categories(),
		'priority'	   =>  170,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Featured Posts Overlay Opacity', 'bosa-portfolio-bio' ),
		'type'        => 'number',
		'settings'    => 'bosa_portfolio_bio_feature_posts_overlay_opacity',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'priority'	   =>  180,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post View Number', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'Number of posts to show.', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_feature_posts_posts_number',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => 6,
		'choices' => array(
			'min' => '1',
			'max' => '48',
			'step' => '1',
		),
		'priority'	   =>  190,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Height (in px)', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_feature_posts_height',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'transport'    => 'postMessage',
		'default'      => 250,
		'choices' => array(
			'min' => '100',
			'max' => '1200',
			'step' => '10',
		),
		'priority'	   =>  200,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_feature_post_image_size',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => 'bosa-portfolio-bio-420-300',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'	  =>  210,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-portfolio-bio' ),
		'type'         => 'radio',
		'settings'     => 'bosa_portfolio_bio_feature_posts_image_size',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-portfolio-bio' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-portfolio-bio' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  220,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Posts Border Radius (px)', 'bosa-portfolio-bio' ),
		'type'        => 'slider',
		'settings'    => 'bosa_portfolio_bio_feature_posts_radius',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'transport'	  => 'postMessage', 
		'default'     =>  0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   =>  230,
	) );

		Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Post Text Alignment', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_feature_posts_text_alignment',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => 'text-left',
		'choices'     => array(
			'text-left'	 	=> esc_html__( 'Left', 'bosa-portfolio-bio' ),
			'text-center'  	=> esc_html__( 'Center', 'bosa-portfolio-bio' ),   
			'text-right'	=> esc_html__( 'Right', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  240,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Post Content Alignment', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_feature_posts_title_alignment',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => 'align-bottom',
		'choices'     => array(
			'align-top'	 	=> esc_html__( 'Top', 'bosa-portfolio-bio' ),
			'align-center'  => esc_html__( 'Center', 'bosa-portfolio-bio' ),   
			'align-bottom'  => esc_html__( 'Bottom', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  250,
	) ); 

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Title', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_feature_posts_title',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => false,
		'priority'	  =>  260,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_feature_posts_font_control',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  270,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.post .feature-posts-content .feature-posts-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Title Divider', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_feature_title_divider',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => false,
		'priority'	  =>  280,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Posts category', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_featured_posts_category',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => false,
		'priority'	  =>  290,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_featured_posts_cat_font_control',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  =>  300,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.post .feature-posts-content .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Date', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_featured_posts_date',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => false,
		'priority'	  =>  310,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Author', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_featured_posts_author',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => false,
		'priority'	  =>  320,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Comment', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_featured_posts_comment',
		'section'     => 'bosa_portfolio_bio_feature_posts_options',
		'default'     => false,
		'priority'	  =>  330,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_featured_posts_meta_font_control',
		'section'      => 'bosa_portfolio_bio_feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  =>  340,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.post .feature-posts-content .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'bosa_portfolio_bio_hide_featured_posts_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'bosa_portfolio_bio_hide_featured_posts_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'bosa_portfolio_bio_hide_featured_posts_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	// Latest Posts Options
	Kirki::add_section( 'bosa_portfolio_bio_latest_posts_options', array(
	    'title'          => esc_html__( 'Latest Posts', 'bosa-portfolio-bio' ),
	    'description'    => esc_html__( 'More options are available in Blog Page Section.', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '30',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Latest Posts Section From Homepage', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_latest_posts_section',
		'section'     => 'bosa_portfolio_bio_latest_posts_options',
		'default'     => false,
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Section Title', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_latest_posts_section_title',
		'section'      => 'bosa_portfolio_bio_latest_posts_options',
		'default'      => true,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Title', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_latest_posts_section_title',
		'section'     => 'bosa_portfolio_bio_latest_posts_options',
		'default'     => '',
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_latest_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_latest_posts_section_title_font_control',
		'section'      => 'bosa_portfolio_bio_latest_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '24px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-post-area .section-title-wrap .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_latest_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Section Description', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_latest_posts_section_description',
		'section'      => 'bosa_portfolio_bio_latest_posts_options',
		'default'      => true,
		'priority'	   =>  50,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Description', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_latest_posts_section_description',
		'section'     => 'bosa_portfolio_bio_latest_posts_options',
		'default'     => '',
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_latest_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_latest_posts_section_description_font_control',
		'section'      => 'bosa_portfolio_bio_latest_posts_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-post-area .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_latest_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Title and Description Alignment', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_latest_posts_section_title_desc_alignment',
		'section'     => 'bosa_portfolio_bio_latest_posts_options',
		'default'     => 'left',
		'choices'     => array(
			'left'	 	=> esc_html__( 'Left', 'bosa-portfolio-bio' ),
			'center'  	=> esc_html__( 'Center', 'bosa-portfolio-bio' ),   
			'right'		=> esc_html__( 'Right', 'bosa-portfolio-bio' ),
		),
		'priority'	   =>  80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_disable_latest_posts_section_title',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_disable_latest_posts_section_description',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen.', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_latest_posts_category',
		'section'     => 'bosa_portfolio_bio_latest_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-portfolio-bio' ), 
		'choices'     => bosa_portfolio_bio_get_post_categories(),
		'priority'	  =>  90,
	) );

	// Highlighted Posts Options
	Kirki::add_section( 'bosa_portfolio_bio_highlight_posts_options', array(
	    'title'          => esc_html__( 'Highlighted Posts', 'bosa-portfolio-bio' ),
	    'panel'          => 'bosa_portfolio_bio_blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '40',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Highlighted Posts Section', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_highlight_posts_section',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Section Title', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_highlight_posts_section_title',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => true,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Title', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_highlight_posts_section_title',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => '',
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_highlight_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_section_title_font_control',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '24px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-highlight-post .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_highlight_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Section Description', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_highlight_posts_section_description',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => true,
		'priority'	   =>  50,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Description', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_highlight_posts_section_description',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => '',
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_highlight_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_section_description_font_control',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-highlight-post .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_highlight_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Title and Description Alignment', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_highlight_posts_section_title_desc_alignment',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => 'left',
		'choices'     => array(
			'left'	 	=> esc_html__( 'Left', 'bosa-portfolio-bio' ),
			'center'  	=> esc_html__( 'Center', 'bosa-portfolio-bio' ),   
			'right'		=> esc_html__( 'Right', 'bosa-portfolio-bio' ),
		),
		'priority'	   => 80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_disable_highlight_posts_section_title',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_disable_highlight_posts_section_description',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Section Layout', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_highlight_posts_section_layouts',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => 'highlighted_one',
		'choices'     => array(
			'highlighted_one'    => get_template_directory_uri() . '/assets/images/highlight-layout-1.png',
			'highlighted_two'    => get_template_directory_uri() . '/assets/images/highlight-layout-2.png',
		),
		'priority'	   =>  90,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen.', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_highlight_posts_category',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_post_categories(),
		'priority'	  =>  100,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_highlight_post_image_size',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'	  =>  110,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_highlight_post_title_color',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => '#030303',
		'priority'	   =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );
	
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_highlight_post_category_bgcolor',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => '#E5FF01',
		'priority'	   =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_highlight_posts_section_layouts',
				'operator' => '==',
				'value'    => 'highlighted_one',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_highlight_post_category_color',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_highlight_post_meta_color',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => '#7a7a7a',
		'priority'	   =>  150,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_highlight_post_meta_icon_color',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => '#E5FF01',
		'priority'	   =>  160,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),

	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_highlight_post_hover_color',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => '#AABC0D',
		'priority'	   =>  170,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Post Border Radius (px)', 'bosa-portfolio-bio' ),
		'type'        => 'slider',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_radius',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'transport'   => 'postMessage',
		'default'      =>  0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   =>  180,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Slider Columns', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_slides_show',
 		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => 3,
		'priority'	   => 190,
		'choices' => array(
			'min' => '2',
			'max' => '4',
			'step'=> '1',
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Arrows', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_highlight_posts_arrows',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => false,
		'priority'	   => 200,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Dots', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_highlight_posts_dots',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => false,
		'priority'	   => 210,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Slider Auto Play', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_highlight_posts_autoplay',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => true,
		'priority'	   => 220,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Slider Auto Play Timeout ( in sec )', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_autoplay_speed',
 		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => 4,
		'choices' => array(
			'min' => '1',
			'max' => '60',
			'step'=> '1',
		),
		'priority'	   => 230,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_highlight_posts_autoplay',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Slider Post View Number', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'Number of posts to show.', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_posts_number',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'      => 6,
		'choices' => array(
			'min' => '1',
			'max' => '20',
			'step' => '1',
		),
		'priority'	   => 240,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post category', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_highlight_posts_category',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => false,
		'priority'	  => 250,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_cat_font_control',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  => 260,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Title', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_highlight_posts_title',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => false,
		'priority'	  => 270,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_title_font_control',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'priority'	  => 280,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .entry-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Date', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_highlight_posts_date',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => false,
		'priority'	  => 290,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Author', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_highlight_posts_author',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => false,
		'priority'	  => 300,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Comment', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_highlight_posts_comment',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => false,
		'priority'	  => 310,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_highlight_posts_meta_font_control',
		'section'      => 'bosa_portfolio_bio_highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  => 320,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'bosa_portfolio_bio_hide_highlight_posts_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Image', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_highlight_posts_image',
		'section'     => 'bosa_portfolio_bio_highlight_posts_options',
		'default'     => false,
		'priority'	  => 330,
	) );

	// Responsive
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Main Slider / Banner', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_mobile_main_slider',
		'section'     => 'bosa_portfolio_bio_blog_page_responsive',
		'default'     => false,
		'priority'	  => 10,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_main_slider',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Featured Posts', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_mobile_feature_posts',
		'section'      => 'bosa_portfolio_bio_blog_page_responsive',
		'default'      => false,
		'priority'	   => 20,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_feature_posts_section',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Latest Posts', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_mobile_latest_posts',
		'section'      => 'bosa_portfolio_bio_blog_page_responsive',
		'default'      => false,
		'priority'	   => 30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_latest_posts_section',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Highlighted Posts', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_mobile_highlight_posts',
		'section'      => 'bosa_portfolio_bio_blog_page_responsive',
		'default'      => false,
		'priority'	   => 40,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_disable_highlight_posts_section',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );


	// Blog Page Options
    Kirki::add_panel( 'bosa_portfolio_bio_blog_page_options', array(
	    'title'          => esc_html__( 'Blog Page', 'bosa-portfolio-bio' ),
	    'priority'       => '130',
	) );

    // Blog Page Style Options
	Kirki::add_section( 'bosa_portfolio_bio_blog_page_style_options', array(
	    'title'      => esc_html__( 'Style', 'bosa-portfolio-bio' ),
	    'panel'      => 'bosa_portfolio_bio_blog_page_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '10',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Post Layouts', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Grid / List / Single', 'bosa-portfolio-bio' ),
		'type'        => 'radio-image',
		'settings'    => 'bosa_portfolio_bio_archive_post_layout',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => 'list',
		'choices'  	  => apply_filters( 'bosa_portfolio_bio_archive_post_layout_filter', array(
			'grid'           => get_template_directory_uri() . '/assets/images/grid-layout.png',
			'list'           => get_template_directory_uri() . '/assets/images/list-layout.png',
			'single'         => get_template_directory_uri() . '/assets/images/single-layout.png',
		) ),
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Post View Number', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Number of posts to show.', 'bosa-portfolio-bio' ),
		'type'        => 'number',
		'settings'    => 'bosa_portfolio_bio_archive_post_per_page',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => 10,
		'choices'  => array(
			'min' => '0',
			'max' => '20',
			'step' => '1',
		),
		'priority'    => 20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_post_image_size',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'    => 30,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Posts Border Radius (px)', 'bosa-portfolio-bio' ),
		'type'        => 'slider',
		'settings'    => 'bosa_portfolio_bio_latest_posts_radius',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     =>  0,
		'transport'   => 'postMessage',
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 40,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_blog_post_title_color',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'      => '#101010',
		'priority'     => 50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_post_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_blog_post_category_color',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'      => '#E5FF01',
		'priority'     => 60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_blog_post_meta_color',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'      => '#7a7a7a',
		'priority'     => 70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_hide_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_blog_post_meta_icon_color',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'      => '#E5FF01',
		'priority'     => 80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_hide_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_hide_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_blog_post_text_color',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'      => '#333333',
		'priority'     => 90,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_hide_blog_page_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Hover Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_blog_post_hover_color',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'      => '#AABC0D',
		'priority'     => 100,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Title', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_post_title',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => false,
		'priority'    => 110,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_blog_post_title_font_control',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '21px',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'priority'    => 120,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary article .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_post_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Category', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_category',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => false,
		'priority'    => 130,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_blog_post_cat_font_control',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.6',
		),
		'priority'    => 140,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .post .entry-content .entry-header .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Date', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_date',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => false,
		'priority'    => 150,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Author', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_author',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => false,
		'priority'    => 160,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Comments Link', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_comment',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => false,
		'priority'    => 170,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_blog_post_meta_font_control',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'    => 180,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .entry-meta',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'bosa_portfolio_bio_hide_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'bosa_portfolio_bio_hide_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'bosa_portfolio_bio_hide_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Excerpt', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_blog_page_excerpt',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => false,
		'priority'    => 190,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Excerpt Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_blog_post_excerpt_font_control',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'initial',
			'line-height'    => '1.8',
		),
		'priority'    => 200,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .entry-text p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_blog_page_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Excerpt Length', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Select number of words to display in excerpt', 'bosa-portfolio-bio' ),
		'type'        => 'number',
		'settings'    => 'bosa_portfolio_bio_post_excerpt_length',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => 15,
		'choices' => array(
			'min'  => '5',
			'max'  => '60',
			'step' => '5',
		),
		'priority'    => 210,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_blog_page_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Post Button', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_post_button',
		'section'     => 'bosa_portfolio_bio_blog_page_style_options',
		'default'     => true,
		'priority'    => 220,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Button', 'bosa-portfolio-bio' ),
		'type'         => 'repeater',
		'settings'     => 'bosa_portfolio_bio_blog_page_button_repeater',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-portfolio-bio' ),
		),
		'default' => array(
			array(
				'blog_btn_type' 		=> 'button-text',
				'blog_btn_bg_color'		=> '#E5FF01',
				'blog_btn_border_color'	=> '#1a1a1a',
				'blog_btn_text_color'	=> '#1a1a1a',
				'blog_btn_hover_color'	=> '#AABC0D',
				'blog_btn_text' 		=> '',
				'blog_btn_radius'		=> 0,
			),		
		),
		'priority'    => 230,
		'fields' => array(
			'blog_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-portfolio-bio' ),
				'type'        => 'select',
				'default'     => 'button-text',
				'choices'  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-portfolio-bio' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-portfolio-bio' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-portfolio-bio' ),
				),
			),
			'blog_btn_bg_color' => array(
				'label'       => esc_html__( 'Button Background Color', 'bosa-portfolio-bio' ),
				'description' => esc_html__( 'For background button type only.', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#E5FF01',
			),
			'blog_btn_border_color' => array(
				'label'       => esc_html__( 'Button Border Color', 'bosa-portfolio-bio' ),
				'description' => esc_html__( 'For border button type only.', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#1a1a1a',
			),
			'blog_btn_text_color' => array(
				'label'       => esc_html__( 'Button Text Color', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#1a1a1a',
			),
			'blog_btn_hover_color' => array(
				'label'       => esc_html__( 'Button Hover Color', 'bosa-portfolio-bio' ),
				'type'        => 'color',
				'default'     => '#AABC0D',
			),
			'blog_btn_text' => array(
				'label'       => esc_html__( 'Button Text', 'bosa-portfolio-bio' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'blog_btn_radius' => array(
				'label'       => esc_html__( 'Button Radius (px)', 'bosa-portfolio-bio' ),
				'type'        => 'number',
				'default'	  => 0,
				'choices'     => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),	
		),
		'choices' => array(
			'limit' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_post_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Post Button Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_blog_post_button_font_control',
		'section'      => 'bosa_portfolio_bio_blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '600',
			'font-size'      => '14px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'    => 240,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .post .entry-text .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_post_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Blog Page Elements Options
	Kirki::add_section( 'bosa_portfolio_bio_blog_page_elements_options', array(
	    'title'      => esc_html__( 'Elements', 'bosa-portfolio-bio' ),
	    'panel'      => 'bosa_portfolio_bio_blog_page_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '20',
	) );

	Kirki::add_field( 'bosa-portfolio-bio',  array(
		'label'       => esc_html__( 'Blog Archive Pages Title', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_disable_blog_page_title',
		'section'     => 'bosa_portfolio_bio_blog_page_elements_options',
		'default'     => 'enable_all_pages',
		'choices'     => array(
			'enable_all_pages'  => esc_html__( 'Enable in all', 'bosa-portfolio-bio' ),
			'disable_all_pages' => esc_html__( 'Disable from all', 'bosa-portfolio-bio' ),
		),
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Pagination', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_pagination',
		'section'     => 'bosa_portfolio_bio_blog_page_elements_options',
		'default'     => false,
		'priority'    => 20,
	) );

	// Single Post Options
	Kirki::add_section( 'bosa_portfolio_bio_single_post_options', array(
	    'title'          => esc_html__( 'Single Post', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '140',
	) );

	Kirki::add_field( 'bosa-portfolio-bio',  array(
		'label'       => esc_html__( 'Post Title', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_disable_single_post_title',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => 'enable_all_pages',
		'choices'     => array(
			'enable_all_pages'    => esc_html__( 'Enable in all', 'bosa-portfolio-bio' ),
			'disable_all_pages'   => esc_html__( 'Disable from all', 'bosa-portfolio-bio' ),
		),
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio',  array(
		'label'       => esc_html__( 'Post Title Position', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_post_title_position',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => 'above_feature_image',
		'choices'     => array(
			'below_feature_image' => esc_html__( 'Below Feature Image', 'bosa-portfolio-bio' ),
			'above_feature_image' => esc_html__( 'Top of the Page', 'bosa-portfolio-bio' ),
		),
		'priority'    => 20,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_disable_transparent_header_post',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_header_layout',
					'operator' => '!=',
					'value'    => 'header_two',
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Feature Image', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_single_feature_image',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => 'show_in_all_pages',
		'choices' => array(
			'show_in_all_pages'    => esc_html__( 'Show in all Pages', 'bosa-portfolio-bio' ),
			'disable_in_all_pages' => esc_html__( 'Disable in all Pages', 'bosa-portfolio-bio' ),
		),
		'priority'    => 30,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_disable_transparent_header_post',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_header_layout',
					'operator' => '!=',
					'value'    => 'header_two',
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_single_post_image_size',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => 'bosa-portfolio-bio-1370-550',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'    => 40,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_single_feature_image',
					'operator' => '==',
					'value'    => 'show_in_all_pages',
				),
				array(
					'setting'  => 'bosa_portfolio_bio_disable_transparent_header_post',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Transparent Header', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_transparent_header_post',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => true,
		'priority'    => 50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Transparent Header Banner Height (in px)', 'bosa-portfolio-bio' ),
		'type'        => 'slider',
		'settings'    => 'bosa_portfolio_bio_transparent_header_banner_post_height',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'transport'   => 'postMessage',
		'default'     => 400,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'priority'    => 60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_transparent_header_post',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Header Banner Image Size', 'bosa-portfolio-bio' ),
		'type'         => 'radio',
		'settings'     => 'bosa_portfolio_bio_transparent_header_banner_post_size',
		'section'      => 'bosa_portfolio_bio_single_post_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-portfolio-bio' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-portfolio-bio' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-portfolio-bio' ),
		),
		'priority'    => 70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_transparent_header_post',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Transparent Header Banner Overlay Opacity', 'bosa-portfolio-bio' ),
		'type'        => 'number',
		'settings'    => 'bosa_portfolio_bio_transparent_header_banner_post_opacity',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'priority'    => 80,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_transparent_header_post',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Date', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_single_post_date',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => false,
		'priority'    => 90,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Comments Link', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_single_post_comment',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => false,
		'priority'    => 100,
	) );
	
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable category', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_single_post_category',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => false,
		'priority'    => 110,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Tag Links', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_single_post_tag_links',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => false,
		'priority'    => 120,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Author', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_single_post_author',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => false,
		'priority'    => 130,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Author Section Title', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_single_post_author_title',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => esc_html__( 'About the Author', 'bosa-portfolio-bio' ),
		'priority'    => 140,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_single_post_author',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Related Posts', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_hide_related_posts',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => false,
		'priority'    => 150,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Related Posts Section Title', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_related_posts_title',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => esc_html__( 'You may also like these', 'bosa-portfolio-bio' ),
		'priority'    => 160,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_related_posts',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'For related posts.', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_related_post_image_size',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => 'bosa-portfolio-bio-420-300',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'    => 170,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_related_posts',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Related Posts Items', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Total number of related posts to show.', 'bosa-portfolio-bio' ),
		'type'        => 'number',
		'settings'    => 'bosa_portfolio_bio_related_posts_count',
		'section'     => 'bosa_portfolio_bio_single_post_options',
		'default'     => 4,
		'choices' => array(
			'min' => '1',
			'max' => '12',
			'step' => '1',
		),
		'priority'    => 180,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_hide_related_posts',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Pages Options
	Kirki::add_section( 'bosa_portfolio_bio_pages_options', array(
	    'title'          => esc_html__( 'Pages', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '150',
	) );

	Kirki::add_field( 'bosa-portfolio-bio',  array(
		'label'       => esc_html__( 'Page Title', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_disable_page_title',
		'section'     => 'bosa_portfolio_bio_pages_options',
		'default'     => 'disable_front_page',
		'choices'     => array(
			'disable_all_pages'   => esc_html__( 'Disable from all', 'bosa-portfolio-bio' ),
			'enable_all_pages'    => esc_html__( 'Enable in all', 'bosa-portfolio-bio' ),
			'disable_front_page'  => esc_html__( 'Disable from frontpage only', 'bosa-portfolio-bio' ),
		),
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio',  array(
		'label'       => esc_html__( 'Page Title Position', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_page_title_position',
		'section'     => 'bosa_portfolio_bio_pages_options',
		'default'     => 'above_feature_image',
		'choices'     => array(
			'below_feature_image' => esc_html__( 'Below Feature Image', 'bosa-portfolio-bio' ),
			'above_feature_image' => esc_html__( 'Top of the Page', 'bosa-portfolio-bio' ),
		),
		'priority'    => 20,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_disable_transparent_header_page',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_header_layout',
					'operator' => '!=',
					'value'    => 'header_two',
				),
			),
		),
	) );
	
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Feature Image', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_page_feature_image',
		'section'     => 'bosa_portfolio_bio_pages_options',
		'default'     => 'show_in_all_pages',
		'choices' => array(
			'show_in_all_pages'    => esc_html__( 'Show in all Pages', 'bosa-portfolio-bio' ),
			'disable_in_all_pages' => esc_html__( 'Disable in all Pages', 'bosa-portfolio-bio' ),
			'disable_in_frontpage' => esc_html__( 'Disable in Frontpage only', 'bosa-portfolio-bio' ),
			'show_in_frontpage'    => esc_html__( 'Show in Frontpage only', 'bosa-portfolio-bio' ),
		),
		'priority'    => 30,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_disable_transparent_header_page',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'bosa_portfolio_bio_header_layout',
					'operator' => '!=',
					'value'    => 'header_two',
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_pages_image_size',
		'section'     => 'bosa_portfolio_bio_pages_options',
		'default'     => 'bosa-portfolio-bio-1370-550',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'    => 40,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'bosa_portfolio_bio_page_feature_image',
					'operator' => 'contains',
					'value'    => array( 'show_in_all_pages', 'show_in_frontpage', 'disable_in_frontpage' ),
				),
				array(
					'setting'  => 'bosa_portfolio_bio_disable_transparent_header_page',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Transparent Header', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_transparent_header_page',
		'section'     => 'bosa_portfolio_bio_pages_options',
		'default'     => true,
		'priority'    => 50,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Transparent Header Banner Height (in px)', 'bosa-portfolio-bio' ),
		'type'        => 'slider',
		'settings'    => 'bosa_portfolio_bio_transparent_header_banner_page_height',
		'section'     => 'bosa_portfolio_bio_pages_options',
		'transport'   => 'postMessage',
		'default'     => 400,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'priority'    => 60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_transparent_header_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Transparent Header Banner Image Size', 'bosa-portfolio-bio' ),
		'type'         => 'radio',
		'settings'     => 'bosa_portfolio_bio_transparent_header_banner_page_size',
		'section'      => 'bosa_portfolio_bio_pages_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-portfolio-bio' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-portfolio-bio' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-portfolio-bio' ),
		),
		'priority'    => 70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_transparent_header_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Transparent Header Banner Overlay Opacity', 'bosa-portfolio-bio' ),
		'type'        => 'number',
		'settings'    => 'bosa_portfolio_bio_transparent_header_banner_page_opacity',
		'section'     => 'bosa_portfolio_bio_pages_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'priority'    => 80,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_disable_transparent_header_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// 404 Error Page
	Kirki::add_section( 'bosa_portfolio_bio_error404_options', array(
	    'title'          => esc_html__( '404 Page', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '160',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Image', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Recommended image size 360x200 pixel.', 'bosa-portfolio-bio' ),
		'type'        => 'image',
		'settings'    => 'bosa_portfolio_bio_error404_image',
		'section'     => 'bosa_portfolio_bio_error404_options',
		'default'     => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'    => 10,
	) );
	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_render_error404_image_size',
		'section'     => 'bosa_portfolio_bio_error404_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-portfolio-bio' ),
		'choices'     => bosa_portfolio_bio_get_intermediate_image_sizes(),
		'priority'    => 20,
	) );

	// Preloader Options
	Kirki::add_section( 'bosa_portfolio_bio_preloader_options', array(
	    'title'          => esc_html__( 'Preloader', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '170',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Disable Preloading', 'bosa-portfolio-bio' ),
		'type'        => 'checkbox',
		'settings'    => 'bosa_portfolio_bio_disable_preloader',
		'section'     => 'bosa_portfolio_bio_preloader_options',
		'default'     => false,
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Preloading Animations', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_preloader_animation',
		'section'     => 'bosa_portfolio_bio_preloader_options',
		'default'     => 'animation_one',
		'choices'  => array(
			'animation_one'       => esc_html__( 'Animation One', 'bosa-portfolio-bio' ),
			'animation_two'       => esc_html__( 'Animation Two', 'bosa-portfolio-bio' ),
			'animation_three'     => esc_html__( 'Animation Three', 'bosa-portfolio-bio' ),
			'animation_four'      => esc_html__( 'Animation Four', 'bosa-portfolio-bio' ),
			'animation_five'      => esc_html__( 'Animation Five', 'bosa-portfolio-bio' ),
		),
		'priority'    => 20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Image Width', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_preloader_custom_image_width',
		'section'      => 'bosa_portfolio_bio_preloader_options',
		'transport'    => 'postMessage',
		'default'      => 40,
		'choices'      => array(
			'min'  => 10,
			'max'  => 200,
			'step' => 1,
		),
		'priority'    => 30,
	) );


	// Breadcrumbs
	Kirki::add_section( 'bosa_portfolio_bio_breadcrumbs_options', array(
	    'title'          => esc_html__( 'Breadcrumbs', 'bosa-portfolio-bio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '180',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Breadcrumbs', 'bosa-portfolio-bio' ),
		'type'        => 'select',
		'settings'    => 'bosa_portfolio_bio_breadcrumbs_controls',
		'section'     => 'bosa_portfolio_bio_breadcrumbs_options',
		'default'     => 'show_in_all_page_post',
		'choices'  => array(
			'disable_in_all_pages'     => esc_html__( 'Disable in all Pages Only', 'bosa-portfolio-bio' ),
			'disable_in_all_page_post' => esc_html__( 'Disable in all Pages & Posts', 'bosa-portfolio-bio' ),
			'show_in_all_page_post'    => esc_html__( 'Show in all Pages & Posts', 'bosa-portfolio-bio' ),
		),
		'priority'    => 10,
	) );

	// WooCommerce

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'General / Style', 'bosa-portfolio-bio' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
		'section'     => 'woocommerce_product_catalog',
		'default'     => 'product_catalog_general_tab',
		'choices'  => array(
			'product_catalog_general_tab'     => esc_html__( 'General', 'bosa-portfolio-bio' ),
			'product_catalog_style_tab'     => esc_html__( 'Style', 'bosa-portfolio-bio' ),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Shop Page Title', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_shop_page_title',
		'section'      => 'woocommerce_product_catalog',
		'default'      => false,
		'priority'     => 10,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_product_card_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Product Wrapper Options', 'bosa-portfolio-bio' ),
	    'priority'    => 20,
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'			=> esc_html__( 'Product Layout Type', 'bosa-portfolio-bio' ),
		'type'			=> 'radio-image',
		'settings'		=> 'bosa_portfolio_bio_woocommerce_product_layout_type',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'product_layout_grid',
		'choices'		=> array(
			'product_layout_grid'		=> get_template_directory_uri() . '/assets/images/product-layout-type-one.png',
			'product_layout_list'		=> get_template_directory_uri() . '/assets/images/product-layout-type-two.png',
		),
		'priority'      => 30,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'			=> esc_html__( 'Product Card Layout', 'bosa-portfolio-bio' ),
		'type'			=> 'radio-image',
		'settings'		=> 'bosa_portfolio_bio_woocommerce_product_card_layout',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'product_layout_one',
		'choices'		=> array(
			'product_layout_one'		=> get_template_directory_uri() . '/assets/images/product-card-layout-one.png',
			'product_layout_two'		=> get_template_directory_uri() . '/assets/images/product-card-layout-two.png',
		),
		'priority'      => 40,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'			=> esc_html__( 'Text Alignment', 'bosa-portfolio-bio' ),
		'type'			=> 'select',
		'settings'		=> 'bosa_portfolio_bio_woocommerce_product_card_text_alignment',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'text-center',
		'choices'		=> array(
			'text-left'		=> esc_html__( 'Left', 'bosa-portfolio-bio' ),
			'text-center'	=> esc_html__( 'Center', 'bosa-portfolio-bio' ),
			'text-right'	=> esc_html__( 'Right', 'bosa-portfolio-bio' ),
		),
		'priority'       => 50,
		'transport'		 => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Products Per Row', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'How many products should be shown per row?', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_woocommerce_shop_product_column',
		'section'      => 'woocommerce_product_catalog',
		'default'      => 3,
		'choices' => array(
			'min' => '1',
			'max' => '4',
			'step'=> '1',
		),
		'priority'     => 60,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_layout_type',
				'operator' => '==',
				'value'    => 'product_layout_grid',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Products Per Row', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'How many products should be shown per row?', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_woocommerce_shop_list_column',
		'section'      => 'woocommerce_product_catalog',
		'default'      => 2,
		'choices' => array(
			'min' => '1',
			'max' => '3',
			'step'=> '1',
		),
		'priority'     => 70,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_layout_type',
				'operator' => '==',
				'value'    => 'product_layout_list',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Product Display Per Page', 'bosa-portfolio-bio' ),
		'type'         => 'number',
		'settings'     => 'bosa_portfolio_bio_woocommerce_product_per_page',
		'section'      => 'woocommerce_product_catalog',
		'default'      => 9,
		'choices' => array(
			'min' => '1',
			'max' => '60',
			'step'=> '1',
		),
		'priority'    => 80,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Rating', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_shop_page_rating',
		'section'      => 'woocommerce_product_catalog',
		'default'      => false,
		'priority'     => 85,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_add_to_cart_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Add To Cart Button Options', 'bosa-portfolio-bio' ),
	    'priority'    => 90,
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'			=> esc_html__( 'Add To Cart Button Layout', 'bosa-portfolio-bio' ),
		'type'			=> 'radio-image',
		'settings'		=> 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'cart_button_two',
		'choices'		=> array(
			'cart_button_one'		=> get_template_directory_uri() . '/assets/images/cart-button-one.png',
			'cart_button_two'		=> get_template_directory_uri() . '/assets/images/cart-button-two.png',
			'cart_button_three'		=> get_template_directory_uri() . '/assets/images/cart-button-three.png',
			'cart_button_four'		=> get_template_directory_uri() . '/assets/images/cart-button-four.png',
		),
		'priority'      => 100,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_icon_group_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Icon Group Options', 'bosa-portfolio-bio' ),
	    'priority'    => 110,
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'			=> esc_html__( 'Icon Group Layout', 'bosa-portfolio-bio' ),
		'description'	=> esc_html__( 'Yith WooCommerce Compare, Wishlist and Quick View are grouped together. Install these plugins to use this option.', 'bosa-portfolio-bio' ),
		'type'			=> 'radio-image',
		'settings'		=> 'bosa_portfolio_bio_icon_group_layout',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'group_layout_one',
		'choices'		=> array(
			'group_layout_one'		=> get_template_directory_uri() . '/assets/images/iconbox-layout-one.png',
			'group_layout_two'		=> get_template_directory_uri() . '/assets/images/iconbox-layout-two.png',
			'group_layout_three'	=> get_template_directory_uri() . '/assets/images/iconbox-layout-three.png',
			'group_layout_four'		=> get_template_directory_uri() . '/assets/images/iconbox-layout-four.png',
		),
		'priority'      => 120,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_sale_tag_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Sale Tag Options', 'bosa-portfolio-bio' ),
	    'priority'    => 130,
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'			=> esc_html__( 'Sale Tag Layout', 'bosa-portfolio-bio' ),
		'type'			=> 'radio-image',
		'settings'		=> 'bosa_portfolio_bio_woocommerce_sale_tag_layout',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'sale_tag_layout_one',
		'choices'		=> array(
			'sale_tag_layout_one'		=> get_template_directory_uri() . '/assets/images/product-badge-style-one.png',
			'sale_tag_layout_two'		=> get_template_directory_uri() . '/assets/images/product-badge-style-two.png',
		),
		'priority'      => 140,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_icon_group_layout',
				'operator' => '!=',
				'value'    => 'group_layout_four',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Sale Badge Text', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_woocommerce_sale_badge_text',
		'section'     => 'woocommerce_product_catalog',
		'default'     => esc_html__( 'Sale!', 'bosa-portfolio-bio' ),
		'priority'    => 150,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Enable Sale Badge Percentage', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Replaces sale badge text with sale percent.', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_enable_sale_badge_percent',
		'section'      => 'woocommerce_product_catalog',
		'default'      => false,
		'priority'     => 160,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'       => esc_html__( 'Sale Badge Percentage Text', 'bosa-portfolio-bio' ),
		'description' => esc_html__( 'Input text to accompany with percentage {value} tag. Example: {value}% OFF!', 'bosa-portfolio-bio' ),
		'type'        => 'text',
		'settings'    => 'bosa_portfolio_bio_woocommerce_sale_badge_percent',
		'section'     => 'woocommerce_product_catalog',
		'default'     => esc_html__( '-{value}%', 'bosa-portfolio-bio' ),
		'priority'    => 170,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_enable_sale_badge_percent',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_product_card_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Product Wrapper Options', 'bosa-portfolio-bio' ),
	    'priority'    => 210,
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'			=> esc_html__( 'Product Card Style', 'bosa-portfolio-bio' ),
		'type'			=> 'radio-image',
		'settings'		=> 'bosa_portfolio_bio_woocommerce_product_card_style',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'card_style_one',
		'choices'		=> array(
			'card_style_one'		=> get_template_directory_uri() . '/assets/images/product-card-style-one.png',
			'card_style_two'		=> get_template_directory_uri() . '/assets/images/product-card-style-two.png',
			'card_style_three'		=> get_template_directory_uri() . '/assets/images/product-card-style-three.png',
		),
		'priority'    => 220,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Product Image Radius', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_shop_menu_image_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'priority'    => 230,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Product Card Border Radius', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_shop_product_card_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'priority'    => 240,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_card_style',
				'operator' => 'contains',
				'value'    => array( 'card_style_two', 'card_style_three' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_add_to_cart_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Add To Cart Button Options', 'bosa-portfolio-bio' ),
	    'priority'    => 250,
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Add to Cart Button Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_add_to_cart_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#333333',
		'priority'    => 260,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Add to Cart Button Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_add_to_cart_white_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'    => 260,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Add to Cart Button Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_add_to_cart_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'    => 270,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Add to Cart Button Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_add_to_cart_black_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#333333',
		'priority'    => 270,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_three' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Add to Cart Button Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_cart_four_black_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#333333',
		'priority'     => 270,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Add to Cart Button Radius', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_add_cart_button_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 280,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_two', 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Add to Cart Button Spacing', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_cart_four_diagonal_spacing',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 10,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 290,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_icon_group_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Icon Group Options', 'bosa-portfolio-bio' ),
	    'priority'    => 300,
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Icon Group Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_icon_group_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'    => 303,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Icon Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_icon_group_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#383838',
		'priority'    => 305,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Icon Group Border Radius', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_icon_group_one_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 100,
		'choices'      => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'priority'    => 310,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_icon_group_layout',
				'operator' => '==',
				'value'    => 'group_layout_one',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Icon Group Border Radius', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_icon_group_two_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 310,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_icon_group_layout',
				'operator' => '==',
				'value'    => 'group_layout_two',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Icon Group Border Radius', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_icon_group_three_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 310,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_icon_group_layout',
				'operator' => '==',
				'value'    => 'group_layout_three',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Icon Group Border Radius', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_icon_group_four_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 100,
		'choices'      => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'priority'    => 310,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_icon_group_layout',
				'operator' => '==',
				'value'    => 'group_layout_four',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Icon Group Spacing', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_icon_group_diagonal_spacing',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 10,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 320,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_icon_group_layout',
				'operator' => 'contains',
				'value'    => array( 'group_layout_three', 'group_layout_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
	    'type'        => 'custom',
	    'settings'    => 'bosa_portfolio_bio_sale_tag_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Sale Tag Options', 'bosa-portfolio-bio' ),
	    'priority'    => 330,
	    'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Sale Tag Background Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_sale_tag_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#E5FF01',
		'priority'    => 340,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Sale Tag Text Color', 'bosa-portfolio-bio' ),
		'type'         => 'color',
		'settings'     => 'bosa_portfolio_bio_sale_tag_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'    => 350,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Sale Button Border Radius', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_sale_button_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 360,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Sale Button Spacing', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_sale_button_diagonal_spacing',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 8,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 370,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Product Title Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_shop_product_title_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Poppins',
			'variant'         => '400',
			'font-style'      => 'normal',
			'font-size'       => '15px',
			'text-transform'  => 'none',
			'line-height'     => '1.4',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'color'			  => '',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.woocommerce ul.products li.product .woocommerce-loop-product__title',
			),
		),
		'priority'    => 380,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Product Price Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_shop_product_price_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Open Sans',
			'variant'         => '700',
			'font-style'      => 'normal',
			'font-size'       => '16px',
			'text-transform'  => 'none',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'color'			  => '',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.woocommerce ul.products li.product .price .amount',
			),
		),
		'priority'    => 390,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Add to Cart Button Typography', 'bosa-portfolio-bio' ),
		'type'         => 'typography',
		'settings'     => 'bosa_portfolio_bio_shop_cart_button_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Poppins',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '14px',
			'text-transform'  => 'none',
			'line-height'     => '1.5',
			'letter-spacing'  => '0',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.woocommerce .product-inner .button, .woocommerce .product-inner .added_to_cart',
			),
		),
		'priority'    => 400,
		'active_callback' => array(
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'bosa_portfolio_bio_woocommerce_add_to_cart_button',
				'operator' => '!=',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_section( 'bosa_portfolio_bio_woocommerce_single_product', array(
	    'title'      => esc_html__( 'Single Products', 'bosa-portfolio-bio' ),
	    'panel'      => 'woocommerce',	   
	    'capability' => 'edit_theme_options',
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Image Zoom / Magnification', 'bosa-portfolio-bio' ),
		'description'  => esc_html__( 'Every slider step changes 10% zoom to the previous zoom level. For example: 1.1 zoom level is now 110% zoom.', 'bosa-portfolio-bio' ),
		'type'         => 'slider',
		'settings'     => 'bosa_portfolio_bio_single_product_iamge_magnify',
		'section'      => 'bosa_portfolio_bio_woocommerce_single_product',
		'default'      => 1,
		'choices'      => array(
			'min'  => 0,
			'max'  => 3,
			'step' => 0.1,
		),
		'priority'     => 10,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Single Product Page Title', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_single_product_title',
		'section'      => 'bosa_portfolio_bio_woocommerce_single_product',
		'default'      => true,
		'priority'     => 20,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Breadcrumbs', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_single_product_breadcrumbs',
		'section'      => 'bosa_portfolio_bio_woocommerce_single_product',
		'default'      => false,
		'priority'     => 30,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable SKU', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_single_product_sku',
		'section'      => 'bosa_portfolio_bio_woocommerce_single_product',
		'default'      => false,
		'priority'     => 40,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Category', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_single_product_category',
		'section'      => 'bosa_portfolio_bio_woocommerce_single_product',
		'default'      => false,
		'priority'     => 50,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Tags', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_single_product_tags',
		'section'      => 'bosa_portfolio_bio_woocommerce_single_product',
		'default'      => false,
		'priority'     => 60,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Product Tabs', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_single_product_tabs',
		'section'      => 'bosa_portfolio_bio_woocommerce_single_product',
		'default'      => false,
		'priority'     => 70,
	) );

	Kirki::add_field( 'bosa-portfolio-bio', array(
		'label'        => esc_html__( 'Disable Related Products', 'bosa-portfolio-bio' ),
		'type'         => 'checkbox',
		'settings'     => 'bosa_portfolio_bio_disable_single_product_related_products',
		'section'      => 'bosa_portfolio_bio_woocommerce_single_product',
		'default'      => false,
		'priority'     => 80,
	) );
}