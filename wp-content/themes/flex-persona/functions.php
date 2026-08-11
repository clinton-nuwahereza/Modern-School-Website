<?php
/**
 * functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package flex-persona
 */

if (!function_exists('flex_persona_setup')):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flex_persona_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Flex Persona, use a find and replace
		 * to change 'flex-persona' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('flex-persona', get_template_directory() . '/languages');
	}
endif; 
add_action('after_setup_theme', 'flex_persona_setup');

if (!function_exists('flex_persona_enqueue')):
	/**
	 * Enqueue theme styles and scripts
	 *
	 * @since 1.0
	 * @return void
	 */
	function flex_persona_enqueue()
	{
		// rtl style
		wp_enqueue_style('flex-persona-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
		wp_style_add_data('flex-persona-style', 'rtl', 'replace');

		// enqueue script
		wp_enqueue_script('flex-persona-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '', true);
	}
endif;
add_action('wp_enqueue_scripts', 'flex_persona_enqueue');

if (!function_exists('flex_persona_body_classes')):
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function flex_persona_body_classes($classes)
	{

		$classes[] = get_stylesheet();

		$theme = wp_get_theme();
		$classes[] = $theme->get('TextDomain');

		return $classes;
	}
endif;
add_filter('body_class', 'flex_persona_body_classes');

/**
 * Registers block patterns and categories.
 */
if (!function_exists('flex_persona_register_block_patterns')):
	/**
	 * Register pattern categories
	 *
	 * @since 1.0
	 * @return void
	 */
	function flex_persona_register_block_patterns()
	{

		register_block_pattern_category(
			'flex-persona',
			array(
				'label' => _x('Flex Persona', 'Block pattern category', 'flex-persona'),
			)
		);
	}
endif;

add_action('init', 'flex_persona_register_block_patterns');

/**
 * wpopus
 */
require get_template_directory() . '/inc/wpopus.php';

/**
 * WooCommerce
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}
