<?php

/**
 * [personal_blogs_enqueue_style description]
 * @return [type] [description]
 */
function personal_blogs_enqueue_style() {

	/**
	 * If using WooCommerce, child style will also depend on di-blog-style-woo.
	 * @var array
	 */
	$dependency = array( 'bootstrap', 'font-awesome', 'di-blog-style-default', 'di-blog-style-core' );
	if( class_exists( 'WooCommerce' ) ) {
		$dependency = array( 'bootstrap', 'font-awesome', 'di-blog-style-default', 'di-blog-style-core', 'di-blog-style-woo' ); 
	}

	/**
	 * Load parent theme default style files.
	 */
    wp_enqueue_style( 'di-blog-style-default', get_template_directory_uri() . '/style.css' );

    /**
     * Load style file of this child theme.
     */
    wp_enqueue_style( 'personal-blogs-style',  get_stylesheet_directory_uri() . '/style.css', $dependency, wp_get_theme()->get('Version'), 'all' );
}
add_action( 'wp_enqueue_scripts', 'personal_blogs_enqueue_style' );

/**
 * [personal_blogs_default_a_color description]
 * @param  [type] $default_a_color [description]
 * @return [type]                  [description]
 */
function personal_blogs_default_a_color( $default_a_color ) {
	$default_a_color = '#08b3c0';
	return $default_a_color;
}
add_filter( 'di_blog_default_a_color', 'personal_blogs_default_a_color' );

/**
 * [personal_blogs_woo_onsale_lbl_bg_clr description]
 * @param  [type] $woo_onsale_lbl_bg_clr [description]
 * @return [type]                        [description]
 */
function personal_blogs_woo_onsale_lbl_bg_clr( $woo_onsale_lbl_bg_clr ) {
	$woo_onsale_lbl_bg_clr = '#08b3c0';
	return $woo_onsale_lbl_bg_clr;
}
add_filter( 'di_blog_woo_onsale_lbl_bg_clr', 'personal_blogs_woo_onsale_lbl_bg_clr' );

/**
 * [personal_blogs_woo_price_clr description]
 * @param  [type] $woo_price_clr [description]
 * @return [type]                [description]
 */
function personal_blogs_woo_price_clr( $woo_price_clr ) {
	$woo_price_clr = '#08b3c0';
	return $woo_price_clr;
}
add_filter( 'di_blog_woo_price_clr', 'personal_blogs_woo_price_clr' );
