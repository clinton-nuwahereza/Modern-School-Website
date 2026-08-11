<?php
/**
 * Author Personal Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Author Personal Blog
 */
if ( ! function_exists( 'author_personal_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function author_personal_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Author Personal Blog, use a find and replace
		 * to change 'author-personal-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'author-personal-blog', get_template_directory() . '/languages' );
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'author-personal-blog-recent-post', 120, 132, true );
		add_image_size( 'author-personal-blog-thumbnail-mobile', 350, 350, true );
		add_image_size( 'author-personal-blog-list-thumbnail', 380, 360, true );
		add_image_size( 'author-personal-blog-overlay-thumbnail', 400, 400, true );
		add_image_size( 'author-personal-blog-grid-thumbnail', 380, 320, true );
		add_image_size( 'author-personal-blog-thumbnail-medium', 770, 433.13, true );
		add_image_size( 'author-personal-blog-thumbnail-large', 1200, 675, true );
		add_image_size( 'author-personal-blog-thumbnail-featured', 930, 650, true );
		add_image_size( 'author-personal-blog-header-single-product', 1080, 1080, true );
		add_image_size( 'author-personal-blog-header-full', 1920, 1080, true );
		add_image_size( 'author-personal-blog-latest-post-widget-thumb', 120, 120, true );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'main-menu' => esc_html__( 'Primary', 'author-personal-blog' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'author-personal-blog' ),
			)
		);
		add_theme_support( 'woocommerce' );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		$html5_support_args = array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			);
		add_theme_support( 'html5', $html5_support_args );
		// Set up the WordPress core custom background feature.
		$custom_bg_args = apply_filters( 'author_personal_blog_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			);
		add_theme_support( 'custom-background', $custom_bg_args);
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		/**
		 * Remove Theme Support
		 */
		remove_theme_support( 'widgets-block-editor' );
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$custom_logo_args = array(
				'height'      => 100,
				'width'       => 300,
				'flex-width'  => true,
				'flex-height' => true,
			);
		add_theme_support( 'custom-logo', $custom_logo_args );
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'author_personal_blog_content_width', 640 );
	}
endif;
add_action( 'after_setup_theme', 'author_personal_blog_setup' );

if (!function_exists('author_personal_blog_get_theme_settings')) :
    /**
     * Retrieves and caches all theme settings.
     *
     * @return array Theme settings.
     */
    function author_personal_blog_get_theme_settings() {
        $cache_key = 'author_personal_blog_theme_settings';
        $settings = wp_cache_get($cache_key);

        if (false === $settings) {
            $settings = [
                // Post layout settings (post-layout.php)
                'blog_page_post_column' => get_theme_mod('blog_page_post_column', '3'),
                'search_page_post_column' => get_theme_mod('search_page_post_column', '3'),
                'archive_page_post_column' => get_theme_mod('archive_page_post_column', '3'),
                'show_post_category' => get_theme_mod('show_post_category', true),
                'show_post_thumbnail' => get_theme_mod('show_post_thumbnail', true),
                'show_post_date' => get_theme_mod('show_post_date', true),
                'show_post_author' => get_theme_mod('show_post_author', true),
                'show_post_title' => get_theme_mod('show_post_title', true),
                'show_post_excerpt' => get_theme_mod('show_post_excerpt', true),
                // Single post settings (single.php, content-single.php)
                'show_single_post_category' => get_theme_mod('show_single_post_category', true),
                'show_single_post_thumbnail' => get_theme_mod('show_single_post_thumbnail', true),
                'show_single_post_date' => get_theme_mod('show_single_post_date', true),
                'show_single_post_comments' => get_theme_mod('show_single_post_comments', true),
                'show_single_post_author' => get_theme_mod('show_single_post_author', true),
                'show_single_post_title' => get_theme_mod('show_single_post_title', true),
                'show_recommend_posts' => get_theme_mod('show_recommend_posts', true),
                'show_post_navigation' => get_theme_mod('show_post_navigation', true),
                'show_single_post_tags' => get_theme_mod('show_single_post_tags', true),
                'post_page_layout' => get_theme_mod('post_page_layout', '1'),
                'show_post_author_box' => get_theme_mod('show_post_author_box', true),
                // Archive settings (archive.php)
                'show_archive_page_header' => get_theme_mod('show_archive_page_header', true),
                // Index settings (index.php)
                'show_about_section' => get_theme_mod('show_about_section', false),
                'books_slider_on_off' => get_theme_mod('books_slider_on_off', false),
                'blog_section_title_on_off' => get_theme_mod('blog_section_title_on_off', false),
                'blog_section_title' => get_theme_mod('blog_section_title', __('Latest Articles', 'author-personal-blog')),
                // Other settings
                'wp_lazy_load_control' => get_theme_mod('wp_lazy_load_control', false),
                'books_per_page' => get_theme_mod('books_per_page', 5),
			    'slide_to_show' => get_theme_mod('slide_to_show', 4),
			    'book_section_title_on_off' => get_theme_mod('book_section_title_on_off', false),
			    'show_section_title_border' => get_theme_mod('show_section_title_border', true),
			    'book_section_title' => get_theme_mod('book_section_title', __('Read My Books', 'author-personal-blog')),
            ];
            wp_cache_set($cache_key, $settings, '', 3600); // Cache for 1 hour
        }

        return $settings;
    }
endif;


/**
 * Required and Recommended Plugins
 */
require get_template_directory() . '/inc/plugins/tgm/required-plugins.php';
/**
 * Register widgets
 */
require get_template_directory() . '/inc/register-widgets.php';
/**
 * Register Block Style
 */
require get_template_directory() . '/inc/reg-block-style.php';
/**
 * Enqueue scripts
 */
require get_template_directory() . '/inc/enqueue-scripts.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Author Personal Blog Comment Template.
 */
require get_template_directory() . '/inc/comment-functions.php';
/**
 * Author Personal Blog sanitize functions.
 */
require get_template_directory() . '/inc/sanitize-functions.php';
/**
 * Checkout Fields
 */
require get_template_directory() . '/inc/checkout-fields.php';

/**
 * Kirki Plugin Activation
 */
require get_template_directory() . '/inc/plugins/kirki/kirki.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Sidebar Control
 */
require get_template_directory() . '/inc/sidebar-control.php';

/**
 * Related Posts.
 */
require get_template_directory() . '/inc/recomended-posts.php';

/**
 * Full Width Book Slider
 */
require get_template_directory() . '/inc/block-pattern/full-width-book-slider.php';


/**
 * Welcome Notice Box
 */
require get_template_directory() . '/inc/welcome-notice.php';

/**
 * Plugin Installer
 */
require get_template_directory() . '/inc/plugins-installer.php';

/**
 * Meta Fields
 */
require get_template_directory() . '/inc/meta-fields.php';

/**
 * These files are used for the internal demo setup process.
 * However, starting from version 3.2.35, I will switch back to using a third-party demo setup solution.
 */
require get_template_directory() . '/inc/demo-page.php';

/**
 * Plugin Installer
 */
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * Go Pro
 */
require get_template_directory() . '/inc/customizer/go-pro/class-customize.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * WooCommerce Medifications
 */
if ( class_exists( 'woocommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce-modification.php';
}

// Set a custom option when switching themes.
add_action('switch_theme', 'author_personal_blog_set_previous_theme_flag');
function author_personal_blog_set_previous_theme_flag() {
    update_option('rswp_previous_theme', 'author-personal-blog'); // Replace with your theme name.
}

/**
 * Disable Elementor Redirect Page
 */
add_action( 'admin_init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
	}
}, 1 );