<?php
/**
 * Prime Playschool Classes functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package prime_playschool_classes
 */

$prime_playschool_classes_theme_data = wp_get_theme();
if( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_THEME_VERSION' ) ) define ( 'PRIME_PLAYSCHOOL_CLASSES_THEME_VERSION', $prime_playschool_classes_theme_data->get( 'Version' ) );
if( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_THEME_TITLE' ) ) define ( 'PRIME_PLAYSCHOOL_CLASSES_THEME_TITLE', 'Prime Playschool Classes' );
if( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_THEME_NAME' ) ) define( 'PRIME_PLAYSCHOOL_CLASSES_THEME_NAME', $prime_playschool_classes_theme_data->get( 'Name' ) );

if ( ! function_exists( 'prime_playschool_classes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function prime_playschool_classes_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'prime-playschool-classes' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
        'status',
        'audio', 
        'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'prime_playschool_classes_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	/* Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

    load_theme_textdomain( 'prime-playschool-classes', get_template_directory() . '/languages' );
}
endif;
add_action( 'after_setup_theme', 'prime_playschool_classes_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $prime_playschool_classes_content_width
 */
function prime_playschool_classes_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'prime_playschool_classes_content_width', 780 );
}
add_action( 'after_setup_theme', 'prime_playschool_classes_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function prime_playschool_classes_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Option', 'prime-playschool-classes' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Two', 'prime-playschool-classes' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Three', 'prime-playschool-classes' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'prime-playschool-classes' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'prime-playschool-classes' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'prime-playschool-classes' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'prime-playschool-classes' ),
		'id'            => 'footer-four',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'prime_playschool_classes_widgets_init' );

if( ! function_exists( 'prime_playschool_classes_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function prime_playschool_classes_scripts() {

	// Use minified libraries if SCRIPT_DEBUG is false
    $prime_playschool_classes_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $prime_playschool_classes_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/css/build/bootstrap.css' );
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/build/owl.carousel.css' );
    wp_enqueue_style( 'fontawesome-all', esc_url(get_template_directory_uri()).'/css/all.min.css');

	wp_enqueue_style( 'prime-playschool-classes-style', get_stylesheet_uri(), array(), PRIME_PLAYSCHOOL_CLASSES_THEME_VERSION );

	wp_style_add_data('prime-playschool-classes-style', 'rtl', 'replace');

	require get_parent_theme_file_path( '/inc/css_custom.php' );
	wp_add_inline_style( 'prime-playschool-classes-style',$prime_playschool_classes_custom_css );

	if( prime_playschool_classes_woocommerce_activated() ) 
    wp_enqueue_style( 'prime-playschool-classes-woocommerce-style', get_template_directory_uri(). '/css' . $prime_playschool_classes_build . '/woocommerce' . $prime_playschool_classes_suffix . '.css', array('prime-playschool-classes-style'), PRIME_PLAYSCHOOL_CLASSES_THEME_VERSION );
	
  	wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $prime_playschool_classes_build . '/all' . $prime_playschool_classes_suffix . '.js', array( 'jquery' ), '6.1.1', true );
  	wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $prime_playschool_classes_build . '/v4-shims' . $prime_playschool_classes_suffix . '.js', array( 'jquery' ), '6.1.1', true );
  	wp_enqueue_script( 'prime-playschool-classes-modal-accessibility', get_template_directory_uri() . '/js' . $prime_playschool_classes_build . '/modal-accessibility' . $prime_playschool_classes_suffix . '.js', array( 'jquery' ), PRIME_PLAYSCHOOL_CLASSES_THEME_VERSION, true );
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/build/owl.carousel.js', array('jquery'), '2.6.0', true );
	wp_enqueue_script( 'prime-playschool-classes-js', get_template_directory_uri() . '/js/build/custom.js', array('jquery'), PRIME_PLAYSCHOOL_CLASSES_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'prime_playschool_classes_scripts' );

if( ! function_exists( 'prime_playschool_classes_admin_scripts' ) ) :
/**
 * Addmin scripts
*/
function prime_playschool_classes_admin_scripts() {
	wp_enqueue_style( 'prime-playschool-classes-admin-style',get_template_directory_uri().'/inc/css/admin.css', PRIME_PLAYSCHOOL_CLASSES_THEME_VERSION, 'screen' );
}
endif;
add_action( 'admin_enqueue_scripts', 'prime_playschool_classes_admin_scripts' );

function prime_playschool_classes_customize_enque_js(){
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/inc/js/customizer.js', array('jquery'), '2.6.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'prime_playschool_classes_customize_enque_js', 0 );


if( ! function_exists( 'prime_playschool_classes_block_editor_styles' ) ) :
/**
 * Enqueue editor styles for Gutenberg
 */
function prime_playschool_classes_block_editor_styles() {
	// Use minified libraries if SCRIPT_DEBUG is false
	$prime_playschool_classes_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
	$prime_playschool_classes_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	
	// Block styles.
	wp_enqueue_style( 'prime-playschool-classes-block-editor-style', get_template_directory_uri() . '/css' . $prime_playschool_classes_build . '/editor-block' . $prime_playschool_classes_suffix . '.css' );
}
endif;
add_action( 'enqueue_block_editor_assets', 'prime_playschool_classes_block_editor_styles' );

/**
 * Display the admin notice unless dismissed.
 */
function prime_playschool_classes_dashboard_notice() {
    // Check if the notice is dismissed
    $dismissed = get_user_meta( get_current_user_id(), 'prime_playschool_classes_dismissable_notice', true );

    // Display the notice only if not dismissed
    if ( ! $dismissed ) {

        // Get the theme name dynamically
        $theme_name = wp_get_theme()->get( 'Name' );
        ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get-start">
            <div class="notice-details">
                <div class="notice-content">
                    <h2>
                        <?php 
                        /* translators: %s: Theme name */
                        printf(
                            esc_html__( 'Thank you for installing %s.', 'prime-playschool-classes' ),
                            '<strong>' . esc_html( $theme_name ) . '</strong>'
                        );
                        ?>
                    </h2>
                    <p><?php echo esc_html__( 'Your journey to a powerful and stylish website begins here. Let’s get everything set up in just a few clicks!', 'prime-playschool-classes' ); ?></p>
                    <div class="notice-btns">
                        <a style="margin-bottom: 15px; padding: 8px 15px;" class="button button-primary getstart"
                           href="<?php echo esc_url( admin_url( 'themes.php?page=prime-playschool-classes' ) ); ?>">
                           <?php esc_html_e( 'Getting Started', 'prime-playschool-classes' ); ?>
                        </a>
						<a style="margin-left: 30px; margin-bottom: 15px; padding: 8px 15px;" class="button button-primary import"
			               href="<?php echo esc_url(admin_url('themes.php?page=primeplayschoolclasses-wizard')); ?>"><?php esc_html_e('Demo Importer', 'prime-playschool-classes') ?></a>                        
                        <a style="margin-left: 30px; padding: 8px 15px;" class="button button-primary premium"
                           target="_blank" href="<?php echo esc_url( 'https://themeignite.com/products/prime-classes-wordpress-theme' ); ?>">
                           <?php esc_html_e( 'Go To Premium', 'prime-playschool-classes' ); ?>
                        </a>
                    </div>
                </div>
                <div class="notice-img">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/notice.png' ); ?>" alt="<?php echo esc_attr( $theme_name ); ?>">
                </div>  
            </div>
        </div>
        <?php
    }
}


/**
 * AJAX handler to dismiss the notice.
 */
function prime_playschool_classes_dismissable_notice() {
    // Set user meta to indicate the notice is dismissed
    update_user_meta(get_current_user_id(), 'prime_playschool_classes_dismissable_notice', true);
    die();
}

// Hook for the AJAX action
add_action('wp_ajax_prime_playschool_classes_dismissable_notice', 'prime_playschool_classes_dismissable_notice');

/**
 * Clear dismissed notice state when switching themes.
 */
function prime_playschool_classes_switch_theme() {
    // Clear the dismissed notice state when switching themes
    delete_user_meta(get_current_user_id(), 'prime_playschool_classes_dismissable_notice');
}

// Hook for switching themes
add_action('after_switch_theme', 'prime_playschool_classes_switch_theme');

// /**
//  * setup wizard
//  */
// require get_parent_theme_file_path( '/theme-wizard/config.php' );

/**
 * Remove header text setting and control from the Customizer.
 */
function prime_playschool_classes_remove_customizer_setting($wp_customize) {
    // Replace 'your_setting_id' with the actual ID or name of the setting you want to remove
    $wp_customize->remove_control('display_header_text');
    $wp_customize->remove_setting('display_header_text');
}
add_action('customize_register', 'prime_playschool_classes_remove_customizer_setting');


function prime_playschool_classes_customizer_css() { ?>
    <style type="text/css">
        .main-navigation ul li a {
            font-weight: <?php echo esc_html( get_theme_mod( 'prime_playschool_classes_menu_font_weight', '400' ) ); ?>;
            text-transform: <?php echo esc_html( get_theme_mod( 'prime_playschool_classes_menu_text_transform', 'capitalize' ) ); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'prime_playschool_classes_customizer_css');

function prime_playschool_classes_custom_blog_banner_title() {
    if (is_404()) {
        echo '<h1 class="entry-title">'. esc_html( 'Comments are closed.', 'prime-playschool-classes' ).'</h1>';
    } elseif (is_search()) {
        echo '<h1 class="entry-title">'. esc_html( 'Search Result For.', 'prime-playschool-classes' ).' ' . get_search_query() . '</h1>';
    } elseif (is_home() && !is_front_page()) {
        echo '<h1 class="entry-title">'. esc_html( 'Blogs', 'prime-playschool-classes' ).'</h1>';
    } elseif (function_exists('is_shop') && is_shop()) {
        echo '<h1 class="entry-title">'. esc_html( 'Shop', 'prime-playschool-classes' ).'</h1>';
    } elseif (is_page_template('template-homepage.php')) {
    } elseif (is_page()) {
        the_title('<h1 class="entry-title">', '</h1>');
    } elseif (is_single()) {
        the_title('<h1 class="entry-title">', '</h1>');
    } elseif (is_archive()) {
        the_archive_title('<h1 class="entry-title">', '</h1>');
    } else {
        the_archive_title('<h1 class="entry-title">', '</h1>');
    }
}


function prime_playschool_classes_body_classess( $classes ) {
    // Get the customizer setting value
    $hide_post_meta = get_theme_mod( 'prime_playschool_classes_single_post_meta_setting', true );

    // Check if the setting is set to hide
    if ( !$hide_post_meta ) {
        $classes[] = 'hide-post-meta';
    }

    return $classes;
}
add_filter( 'body_class', 'prime_playschool_classes_body_classess' );

function prime_playschool_classes_hide_single_header_img() {
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            if (document.body.classList.contains('page-template-template-home')) {
                var headerImg = document.querySelector('.single-header-img');
                if (headerImg) {
                    headerImg.style.display = 'none';
                }
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'prime_playschool_classes_hide_single_header_img');

function prime_playschool_classes_enqueue_google_fontss() {
    $prime_playschool_classes_heading_font_family = get_theme_mod('prime_playschool_classes_heading_font_family', '');
    $prime_playschool_classes_body_font_family = get_theme_mod('prime_playschool_classes_body_font_family', '');

    // Google Fonts URL builder
    $google_fonts = array(
        'Arial'          => '',
        'Verdana'        => '',
        'Helvetica'      => '',
        'Times New Roman'=> '',
        'Georgia'        => '',
        'Courier New'    => '',
        'Trebuchet MS'   => '',
        'Tahoma'         => '',
        'Palatino'       => '',
        'Garamond'       => '',
        'Impact'         => '',
        'Comic Sans MS'  => '',
        'Lucida Sans'    => '',
        'Arial Black'    => '',
        'Gill Sans'      => '',
        'Segoe UI'       => '',
        'Open Sans'      => 'Open+Sans:wght@400;700',
        'Roboto'         => 'Roboto:wght@400;700',
        'Lato'           => 'Lato:wght@400;700',
        'Montserrat'     => 'Montserrat:wght@400;700',
        'Libre Baskerville' => 'Libre+Baskerville:wght@400;700'
    );

    $prime_playschool_classes_google_fonts_url = '';

    if (!empty($google_fonts[$prime_playschool_classes_heading_font_family]) || !empty($google_fonts[$prime_playschool_classes_body_font_family])) {
        $fonts = array();

        if (!empty($google_fonts[$prime_playschool_classes_heading_font_family])) {
            $fonts[] = $google_fonts[$prime_playschool_classes_heading_font_family];
        }

        if (!empty($google_fonts[$prime_playschool_classes_body_font_family])) {
            $fonts[] = $google_fonts[$prime_playschool_classes_body_font_family];
        }

        // Build Google Fonts URL
        $prime_playschool_classes_google_fonts_url = add_query_arg(
            'family',
            implode('|', $fonts),
            'https://fonts.googleapis.com/css2'
        );
    }

    if ($prime_playschool_classes_google_fonts_url) {
        wp_enqueue_style('prime-playschool-classes-google-fonts', $prime_playschool_classes_google_fonts_url, false);
    }
}
add_action('wp_enqueue_scripts', 'prime_playschool_classes_enqueue_google_fontss');


function prime_playschool_classes_apply_typography() {
    // Get the font family settings from the customizer
    $prime_playschool_classes_heading_font_family = get_theme_mod('prime_playschool_classes_heading_font_family');
    $prime_playschool_classes_body_font_family = get_theme_mod('prime_playschool_classes_body_font_family');

    // Only output CSS if one or both fonts are set
    if ($prime_playschool_classes_body_font_family || $prime_playschool_classes_heading_font_family) {
        ?>
        <style type="text/css">
            <?php if ($prime_playschool_classes_body_font_family): ?>
            body, a, a:active, a:hover {
                font-family: <?php echo esc_html($prime_playschool_classes_body_font_family); ?> !important;
            }
            <?php endif; ?>

            <?php if ($prime_playschool_classes_heading_font_family): ?>
            h1, h2, h3, h4, h5, h6 {
                font-family: <?php echo esc_html($prime_playschool_classes_heading_font_family); ?> !important;
            }
            <?php endif; ?>
        </style>
        <?php
    }
}
add_action('wp_head', 'prime_playschool_classes_apply_typography');

function prime_playschool_classes_template_setup() {

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extra.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Social Links Widget
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Info Theme
 */
require get_template_directory() . '/inc/info.php';

/**
 * Load plugin for right and no sidebar
 */
if( prime_playschool_classes_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce-functions.php';
}

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * sanitization Theme
 */
require get_template_directory() . '/inc/sanitization.php';

/**
 * Setup Wizard
 */
if ( wp_get_theme()->get('Name') === PRIME_PLAYSCHOOL_CLASSES_THEME_TITLE ) {
    require get_theme_file_path() . '/theme-wizard/config.php';

// Hook to display the notice
add_action( 'admin_notices', 'prime_playschool_classes_dashboard_notice' );
}

if ( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_URL' ) ) {
    define( 'PRIME_PLAYSCHOOL_CLASSES_URL', esc_url( 'https://themeignite.com/products/prime-classes-wordpress-theme', 'prime-playschool-classes') );
}
if ( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_FREE_DOC_URL' ) ) {
    define( 'PRIME_PLAYSCHOOL_CLASSES_FREE_DOC_URL', esc_url( 'https://demo.themeignite.com/documentation/prime-playschool-classes-free	
', 'prime-playschool-classes') );
}
if ( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_PRO_DOC_URL' ) ) {
    define( 'PRIME_PLAYSCHOOL_CLASSES_PRO_DOC_URL', esc_url( 'https://demo.themeignite.com/documentation/playschool-classes-pro', 'prime-playschool-classes') );
}
if ( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_DEMO_URL' ) ) {
    define( 'PRIME_PLAYSCHOOL_CLASSES_DEMO_URL', esc_url( 'https://demo.themeignite.com/prime-playschool-classes', 'prime-playschool-classes') );
}
if ( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_REVIEW_URL' ) ) {
    define( 'PRIME_PLAYSCHOOL_CLASSES_REVIEW_URL', esc_url( 'https://wordpress.org/support/theme/prime-playschool-classes/reviews/#new-post', 'prime-playschool-classes') );
}
if ( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_SUPPORT_URL' ) ) {
    define( 'PRIME_PLAYSCHOOL_CLASSES_SUPPORT_URL', esc_url( 'https://wordpress.org/support/theme/prime-playschool-classes', 'prime-playschool-classes') );
}
if ( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_BUNDLE_URL' ) ) {
    define( 'PRIME_PLAYSCHOOL_CLASSES_BUNDLE_URL', esc_url( 'https://www.themeignite.com/products/wp-theme-bundle', 'prime-playschool-classes') );
}

}
add_action('after_setup_theme', 'prime_playschool_classes_template_setup');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';