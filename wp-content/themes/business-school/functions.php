<?php
/**
 * Business School functions and definitions
 *
 * @package Business School
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'business_school_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function business_school_setup() {
	global $business_school_content_width;
	if ( ! isset( $business_school_content_width ) )
		$business_school_content_width = 680;

	load_theme_textdomain( 'business-school', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'custom-header', array(
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'business-school' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_editor_style( 'editor-style.css' );

	global $pagenow;

    if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        add_action('admin_notices', 'business_school_deprecated_hook_admin_notice');
    }
}
endif; // business_school_setup
add_action( 'after_setup_theme', 'business_school_setup' );

function business_school_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a>";

        if (is_category() || is_single()) {
            the_category(' ');
            if (is_single()) {
                echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function business_school_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'business-school' ),
		'description'   => __( 'Appears on blog page sidebar', 'business-school' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'business-school' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'business-school' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'business-school' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'business-school' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	$business_school_widget_areas = get_theme_mod('business_school_footer_widget_areas', '4');
	for ($business_school_i=1; $business_school_i <= 4; $business_school_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'business-school' ) . $business_school_i,
			'id'            => 'footer-' . $business_school_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	register_sidebar(array(
        'name'          => __('Shop Sidebar', 'business-school'),
        'description'   => __('Sidebar for WooCommerce shop pages', 'business-school'),
		'id'            => 'woocommerce_sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'business-school'),
        'description'   => __('Sidebar for single product pages', 'business-school'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));	
}
add_action( 'widgets_init', 'business_school_widgets_init' );

// Change number of products per row to 4
add_filter('loop_shop_columns', 'business_school_loop_columns');
if (!function_exists('business_school_loop_columns')) {
    function business_school_loop_columns() {
        $colm = get_theme_mod('business_school_products_per_row', 4); // Default to 4 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function business_school_products_per_page($cols) {
    $cols = get_theme_mod('business_school_products_per_page', 9); // Default to 9 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'business_school_products_per_page', 9);

function business_school_scripts() {	
	
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style('business-school-style', get_stylesheet_uri(), array() );
		wp_style_add_data('business-school-style', 'rtl', 'replace');

	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'business-school-style',$business_school_color_scheme_css );
	
	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/css/owl.carousel.css" );
	wp_enqueue_style( 'business-school-default', esc_url(get_template_directory_uri())."/css/default.css" );
	
	wp_enqueue_style( 'business-school-style', get_stylesheet_uri() );
	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/js/owl.carousel.js', array('jquery') );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'business-school-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );
	wp_enqueue_style( 'business-school-block-style', esc_url( get_template_directory_uri() ).'/css/blocks.css' );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// font-family
	$business_school_headings_font = esc_html(get_theme_mod('business_school_headings_fonts'));
	$business_school_body_font = esc_html(get_theme_mod('business_school_body_fonts'));

	if ($business_school_headings_font) {
	    wp_enqueue_style('business-school-headings-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($business_school_headings_font));
	} else {
	    wp_enqueue_style('josh-headings', 'https://fonts.googleapis.com/css?family=Josh:wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}

	if ($business_school_body_font) {
	    wp_enqueue_style('business-school-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($business_school_body_font));
	} else {
	    wp_enqueue_style('josh-body', 'https://fonts.googleapis.com/css?family=Josh:wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}

}
add_action( 'wp_enqueue_scripts', 'business_school_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Sanitization Callbacks.
 */
require get_template_directory() . '/inc/sanitization-callbacks.php';

/**
 * Webfont-Loader.
 */
require get_template_directory() . '/inc/wptt-webfont-loader.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

/**
 * select .
 */
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

function business_school_setup_theme() {
	if ( ! defined( 'BUSINESS_SCHOOL_PRO_NAME' ) ) {
		define( 'BUSINESS_SCHOOL_PRO_NAME', __( 'About Business School', 'business-school' ));
	}
	if ( ! defined( 'BUSINESS_SCHOOL_PREMIUM_PAGE' ) ) {
	define('BUSINESS_SCHOOL_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/school-wordpress-theme','business-school'));
	}
	if ( ! defined( 'BUSINESS_SCHOOL_THEME_PAGE' ) ) {
	define('BUSINESS_SCHOOL_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','business-school'));
	}
	if ( ! defined( 'BUSINESS_SCHOOL_SUPPORT' ) ) {
	define('BUSINESS_SCHOOL_SUPPORT',__('https://wordpress.org/support/theme/business-school/','business-school'));
	}
	if ( ! defined( 'BUSINESS_SCHOOL_REVIEW' ) ) {
	define('BUSINESS_SCHOOL_REVIEW',__('https://wordpress.org/support/theme/business-school/reviews/','business-school'));
	}
	if ( ! defined( 'BUSINESS_SCHOOL_PRO_DEMO' ) ) {
	define('BUSINESS_SCHOOL_PRO_DEMO',__('https://live.theclassictemplates.com/business-school-pro/','business-school'));
	}
	if ( ! defined( 'BUSINESS_SCHOOL_THEME_DOCUMENTATION' ) ) {
	define('BUSINESS_SCHOOL_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/business-school-free/','business-school'));
	}
	if ( ! defined( 'BUSINESS_SCHOOL_BUNDLE_PAGE' ) ) {
		define('BUSINESS_SCHOOL_BUNDLE_PAGE',__('https://www.theclassictemplates.com/products/wordpress-theme-bundle','business-school'));
	}
}
add_action( 'after_setup_theme', 'business_school_setup_theme' );

// logo
if ( ! function_exists( 'business_school_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function business_school_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/* Activation Notice */
function business_school_deprecated_hook_admin_notice() {
    $business_school_theme = wp_get_theme();
    $business_school_dismissed = get_user_meta( get_current_user_id(), 'business_school_dismissable_notice', true );
    if ( !$business_school_dismissed) { ?>
        <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class">
            <div class="admin-image">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
            <div class="admin-content" >
                <h1><?php 
				/* translators: 1: Theme name, 2: Theme version. */
				printf( esc_html__( 'Welcome to %1$s %2$s', 'business-school' ), esc_html($business_school_theme->get( 'Name' )), esc_html($business_school_theme->get( 'Version' ))); ?>
                </h1>
                <p><?php _e('Get Started With Theme By Clicking On Getting Started.', 'business-school'); ?></p>
                <div style="display: grid;">
                    <a class="admin-notice-btn button button-hero upgrade-pro" target="_blank" href="<?php echo esc_url( BUSINESS_SCHOOL_PREMIUM_PAGE ); ?>"><?php esc_html_e('Upgrade Pro', 'business-school') ?><i class="dashicons dashicons-cart"></i></a>
                    <a class="admin-notice-btn button button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=business-school' )); ?>"><?php esc_html_e( 'Get started', 'business-school' ) ?><i class="dashicons dashicons-backup"></i></a>
                    <a class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( BUSINESS_SCHOOL_THEME_DOCUMENTATION ); ?>"><?php esc_html_e('Free Doc', 'business-school') ?><i class="dashicons dashicons-visibility"></i></a>
                    <a  class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( BUSINESS_SCHOOL_PRO_DEMO ); ?>"><?php esc_html_e('View Demo', 'business-school') ?><i class="dashicons dashicons-awards"></i></a>
                </div>
            </div>
			<div class="admin-bundle-image">
				<a href="<?php echo esc_url( BUSINESS_SCHOOL_BUNDLE_PAGE ); ?>" target="_blank"><img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/images/image_1.webp'; ?>" /></a>
			</div>
        </div>
    <?php }
}