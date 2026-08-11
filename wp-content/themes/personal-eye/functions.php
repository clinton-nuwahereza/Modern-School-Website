<?php
/*This file is part of eyepress child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/
if (!defined('PERSONAL_EYE_VERSION')) {
	$personal_eye_theme = wp_get_theme();
	define('PERSONAL_EYE_VERSION', $personal_eye_theme->get('Version'));
}
function personal_eye_fonts_url()
{
	$fonts_url = '';

	$font_families = array();

	$font_families[] = 'ource+Sans+Pro:400,600';
	$font_families[] = 'Oswald:400,600,700';

	$query_args = array(
		'family' => urlencode(implode('|', $font_families)),
		'subset' => urlencode('latin,latin-ext'),
	);

	$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');


	return esc_url_raw($fonts_url);
}


function personal_eye_enqueue_child_styles()
{
	wp_enqueue_style('eyepersonal-font', personal_eye_fonts_url(), array(), null);
	wp_enqueue_style('eyepersonal-parent-style', get_template_directory_uri() . '/style.css', array('bootstrap', 'eyepress-google-font', 'slick.min', 'eyepress-default'), PERSONAL_EYE_VERSION, 'all');
	wp_enqueue_style('eyepersonal-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), PERSONAL_EYE_VERSION, 'all');
	
	// Enqueue RTL stylesheet if site is in RTL mode
	if (is_rtl()) {
		wp_enqueue_style('eyepersonal-rtl', get_stylesheet_directory_uri() . '/rtl.css', array('eyepersonal-main'), PERSONAL_EYE_VERSION, 'all');
	}
}
add_action('wp_enqueue_scripts', 'personal_eye_enqueue_child_styles');


/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';



function eyepress_custom_header_setup()
{
	add_theme_support('custom-header', apply_filters('eyepress_custom_header_args', array(
		'default-image'          => get_stylesheet_directory_uri() . '/assets/img/header-img.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1900,
		'height'                 => 950,
		'flex-height'            => true,
	)));
}

add_action('after_setup_theme', 'eyepress_custom_header_setup');


function personal_eye_excerpt_more($more)
{
	return ' .....';
}
add_filter('excerpt_more', 'personal_eye_excerpt_more');

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
add_filter('excerpt_more', '__return_empty_string', 999);
function personal_eye_excerpt_length($length)
{
	return 35;
}
add_filter('excerpt_length', 'personal_eye_excerpt_length', 999);
