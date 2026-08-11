<?php 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
/**
 * After setup theme hook
 */
function high_school_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'high-school', get_stylesheet_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

    // remove secondary menu
    unregister_nav_menu( 'secondary' );
    
}
add_action( 'after_setup_theme', 'high_school_theme_setup', 100 );

/**
 * Enqueue scripts and styles.
 */
function high_school_styles() {
    $my_theme = wp_get_theme();
    $version  = $my_theme['Version'];

    wp_enqueue_style( 'education-zone-style', get_template_directory_uri()  . '/style.css' );
    wp_enqueue_style( 'high-school-style', get_stylesheet_directory_uri() . '/style.css', array( 'education-zone-style' ), $version );
    wp_enqueue_script( 'high-school-custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), $version, true );

}
add_action( 'wp_enqueue_scripts', 'high_school_styles');

function education_zone_fonts_url() {
    $fonts_url = '';
    $theme_style    = get_theme_mod( 'education_zone_select_theme_style_hs', 'modern' );


    /*
    * translators: If there are characters in your language that are not supported
    * by Archivo, translate this to 'off'. Do not translate into your own language.
    */
    $archivo = _x( 'on', 'Archivo font: on or off', 'high-school' );

    /*
    * translators: If there are characters in your language that are not supported
    * by Lato, translate this to 'off'. Do not translate into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'high-school' );
    
    $font_families = array();

    if( 'off' !== $archivo ){
        $font_families[] = 'Archivo:300,300i,400,400i,600,600i,700,700i,800,800i';
    }

    if( ( $theme_style == 'classic' && 'off' !== $lato )){
        $font_families[] = 'Lato:400,700,900';
    }

    $query_args = array(
        'family'  => urlencode( implode( '|', $font_families ) ),
        'display' => urlencode( 'fallback' ),
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    
    return esc_url( $fonts_url );
}

/***
 *  High School Theme Info
 */
function education_zone_customizer_theme_info( $wp_customize ) {
    
    $wp_customize->add_section( 'theme_info' , array(
        'title'       => __( 'Demo and Documentation' , 'high-school' ),
        'priority'    => 6,
        ));

    $wp_customize->add_setting('theme_info_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
        ));
    
    $theme_info = '';

    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Documentation', 'high-school' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/high-school/' ) . '" target="_blank">' . __( 'Click here', 'high-school' ) . '</a></span><br />';
    
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Demo', 'high-school' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/previews/?theme=high-school' ) . '" target="_blank">' . __( 'Click here', 'high-school' ) . '</a></span><br />';

    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme info', 'high-school' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/high-school/' ) . '" target="_blank">' . __( 'Click here', 'high-school' ) . '</a></span><br />';

    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support Ticket', 'high-school' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blank">' . __( 'Click here', 'high-school' ) . '</a></span><br />';

    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'More WordPress Themes', 'high-school' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/' ) . '" target="_blank">' . __( 'Click here', 'high-school' ) . '</a></span><br />';

    $wp_customize->add_control( new education_zone_Theme_Info( $wp_customize ,'theme_info_theme',array(
        'label' => __( 'About High School' , 'high-school' ),
        'section' => 'theme_info',
        'description' => $theme_info
        )));

    $wp_customize->add_setting('theme_info_more_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
}

/**
 * Customize resgister settings and controls 
 */
function high_school_customize_register( $wp_customize ){

    //remove quick link for secondary menu label
    $wp_customize->remove_control( 'education_zone_top_menu_label');

    // Modify default parent theme banner controls
    $wp_customize->get_setting( 'education_zone_slider_type' )->default   = 'static_banner';

    /** Address */
    $wp_customize->add_setting(
        'high_school_address',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'high_school_address',
        array(
            'label'   => __( 'Address', 'high-school' ),
            'section' => 'education_zone_top_header_settings',
            'type'    => 'text',
        )
    );

    /** Enable/Disable Search Form */
    $wp_customize->add_setting( 
        'high_school_search_form', 
        array(
            'default'           => false,
            'sanitize_callback' => 'education_zone_sanitize_checkbox'
        ) 
    );

    $wp_customize->add_control(
        'high_school_search_form',
        array(
            'section'     => 'education_zone_top_header_settings',
            'label'       => __( 'Enable Search Form', 'high-school' ),
            'description' => __( 'Enable to show search form in header.', 'high-school' ),
            'type'        => 'checkbox',
        )
    );

}
add_action( 'customize_register', 'high_school_customize_register', 100);

/**
 * Header
 */
function education_zone_site_header(){
    $email          = get_theme_mod( 'education_zone_email' );
    $phone          = get_theme_mod( 'education_zone_phone' );
    $address        = get_theme_mod( 'high_school_address' );
    $ed_search_form = get_theme_mod( 'high_school_search_form', false );  // From customizer  
    ?>
        <header id="masthead" class="site-header header-four" role="banner" itemscope itemtype="https://schema.org/WPHeader">
            <div class="container">
                <div class="header-m">
                    <?php 
                        education_zone_site_branding();
                        echo '<div class="site-info-wrap">';
                            if( $email || $phone || $address ){ ?>
                                <div class="more-info">
                                    <?php if( ! empty( $email ) ) { ?>
                                        <span><i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            <a href="<?php echo esc_url ('mailto:'.sanitize_email( $email ) ); ?>"><?php echo esc_html( $email ); ?></a>
                                        </span>
                                    <?php } if( ! empty( $phone ) ) { ?>
                                        <span><i class="fa fa-phone" aria-hidden="true"></i>
                                            <a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                                        </span>
                                    <?php } if( ! empty( $address ) ) { ?>
                                    <span><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <?php echo esc_html( $address ); ?>
                                    </span>
                                    <?php } ?>
                                </div>

                            <?php } 
                            if( get_theme_mod('education_zone_ed_social') ) do_action('education_zone_social'); 
                        echo '</div>';
                    ?>
                </div>
                <div class="header-bottom">
                    <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">                        
                        <?php wp_nav_menu( array( 
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'fallback_cb'    => 'high_school_primary_menu_fallback'
                            ) ); ?>
                    </nav><!-- #site-navigation -->
                    <?php
                    if( $ed_search_form ){ ?>
                        <div class="form-section">
                            <a href="#" id="search-btn" class="search-toggle-btn" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal .search-field">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                            <div class="example head-search-form search header-searh-wrap header-search-modal cover-modal" data-modal-target-string=".header-search-modal">                       
                                <?php get_search_form(); ?>
                                <button class="btn-form-close" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal">  </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </header>
    <?php
}

/**
 * Fallback for primary menu
*/
function high_school_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'high-school' ) . '</a></li>';
        echo '</ul>';
    }
}

// Site Footer
function education_zone_footer_bottom(){ ?>
    <div class="site-info">
        <?php if( get_theme_mod('education_zone_ed_social') ) do_action('education_zone_social'); 
        $copyright_text = get_theme_mod( 'education_zone_footer_copyright_text' ); ?>
        <p> 
        <?php 
            if( $copyright_text ){
                echo '<span>' .wp_kses_post( $copyright_text ) . '</span>';
            }else{
                echo '<span>';
                echo  esc_html__( 'Copyright &copy;', 'high-school' ) . date_i18n( esc_html__( 'Y', 'high-school' ) ); 
                echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>.</span>';
            }?>
            <span class="by">
                <?php echo esc_html__( 'High School | Developed By', 'high-school' ); ?>
                <a rel="nofollow" href="<?php echo esc_url( 'https://rarathemes.com/' ); ?>" target="_blank"><?php echo esc_html__( 'Rara Themes', 'high-school' ); ?></a>.
                <?php printf( esc_html__( 'Powered by %s.', 'high-school' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'high-school' ) ) .'" target="_blank">WordPress</a>' ); ?>
            </span>
            <?php 
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            ?>
        </p>
    </div><!-- .site-info -->
    <?php
}