<?php
/**
 * Theme functions and definitions
 *
 * @package Bosa Portfolio Resume 1.0.0
 */

require get_stylesheet_directory() . '/inc/customizer/customizer.php';
require get_stylesheet_directory() . '/inc/customizer/loader.php';

if ( ! function_exists( 'bosa_portfolio_resume_enqueue_styles' ) ) :
	/**
	 * @since Bosa Portfolio Resume 1.0.0
	 */
	function bosa_portfolio_resume_enqueue_styles() {
        require_once get_theme_file_path ( 'inc/wptt-webfont-loader.php');

		wp_enqueue_style( 'bosa-portfolio-resume-style-parent', get_template_directory_uri() . '/style.css',
			array(
				'bootstrap',
				'slick',
				'slicknav',
				'slick-theme',
				'fontawesome',
				'bosa-blocks',
				'bosa-google-font'
				)
		);

	    wp_enqueue_style(
            'bosa-portfolio-resume-google-fonts',
            wptt_get_webfont_url( "https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" ),
            false
        );

        wp_enqueue_style(
            'bosa-portfolio-resume-google-fonts-two',
            wptt_get_webfont_url( "https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" ),
            false
        );

	}

endif;
add_action( 'wp_enqueue_scripts', 'bosa_portfolio_resume_enqueue_styles', 10 );



/**
* Check if all getting started recommended plugins are active.
* @since Bosa Portfolio Resume 1.0.0
*/
if( !function_exists( 'bosa_are_plugin_active' ) ){
    function bosa_are_plugin_active() {
        if ( is_plugin_active( 'advanced-import/advanced-import.php' ) && is_plugin_active( 'keon-toolset/keon-toolset.php' ) && is_plugin_active( 'kirki/kirki.php' ) && is_plugin_active( 'elementor/elementor.php' ) && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) && is_plugin_active( 'elementskit-lite/elementskit-lite.php' ) && is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) && is_plugin_active( 'bosa-elementor-for-woocommerce/bosa-elementor-for-woocommerce.php' ) ){
            return true;
        }else{
            return false;
        }
    }
}

//Stop WooCommerce redirect on activation
add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

/**
* Get pages by post id.
* 
* @since Bosa Portfolio Resume 1.0.0
* @return array.
*/
function bosa_portfolio_resume_get_pages(){
    $page_array = get_pages();
    $pages_list = array();
    foreach ( $page_array as $key => $value ){
        $page_id = absint( $value->ID );
        $pages_list[ $page_id ] = $value->post_title;
    }
    return $pages_list;
}

/**
* Add a blog advertisement banner
* @since Bosa Portfolio Resume 1.0.0
*/
if( !function_exists( 'bosa_portfolio_resume_blog_advertisement_banner' ) ){
    function bosa_portfolio_resume_blog_advertisement_banner(){
        $blogAdvertID                   = get_theme_mod( 'blog_advertisement_banner', '' );
        $render_blog_ad_image_size      = get_theme_mod( 'render_blog_ad_image_size', 'full' );
        $blog_advertisement_banner_obj  = wp_get_attachment_image_src( $blogAdvertID,  $render_blog_ad_image_size );
        if ( is_array(  $blog_advertisement_banner_obj ) ){
            $blog_advertisement_banner = $blog_advertisement_banner_obj[0];
            $advert_target = get_theme_mod( 'blog_advertisement_banner_target', true );
            $alt = get_post_meta( $blogAdvertID, '_wp_attachment_image_alt', true); ?>
            <div class="section-advert text-center">
                <a href="<?php echo esc_url( get_theme_mod( 'blog_advertisement_banner_link', '#' ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>" target="<?php echo esc_attr( $advert_target ); ?>">
                    <img src="<?php echo esc_url( $blog_advertisement_banner ); ?>">
                </a>
            </div>
        <?php }
    }
}

if ( ! function_exists( 'bosa_portfolio_resume_grid_thumbnail_date' ) ) :
    /**
     * Prints HTML with meta information for the tags and comments.
     */
    function bosa_portfolio_resume_grid_thumbnail_date() {

        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date( 'M j, Y' ) ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date( 'M j, Y' ) )
        );
        $year = get_the_date( 'Y' );
        $month = get_the_date( 'm' );
        $link = ( is_single() ) ? get_month_link( $year, $month ) : get_permalink();

        $posted_on = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $time_string . '</a>';

        if ( !is_single() && !get_theme_mod( 'hide_date', false ) ){
            if ( !get_theme_mod( 'disable_date_thumbnail', false ) ){
                echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
            }
        }

        $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

        if ( !is_single() && !get_theme_mod( 'hide_author', false ) ){
            if ( !get_theme_mod( 'disable_author_thumbnail', true ) ){
                echo '<span class="byline"> ' . $byline . '</span>';
            }
        }

        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            if( !is_single() && !get_theme_mod( 'hide_comment', false ) ){ 
                if ( !get_theme_mod( 'disable_comment_thumbnail', true ) ){
                    echo '<span class="comments-link">';
                    comments_popup_link(
                        sprintf(
                            wp_kses(
                                /* translators: %s: post title */
                                __( 'Comment<span class="screen-reader-text"> on %s</span>', 'bosa-portfolio-resume' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        )
                    );
                    echo '</span>';
                }
            }
        } 
    }
endif;

if( !function_exists( 'bosa_get_intermediate_image_sizes' ) ){
    /**
    * Array of image sizes.
    * 
    * @since Bosa Portfolio Resume 1.0.0
    * @return array
    */
    function bosa_get_intermediate_image_sizes(){

        $data   = array(
            'full'          => esc_html__( 'Full Size', 'bosa-portfolio-resume' ),
            'large'         => esc_html__( 'Large Size', 'bosa-portfolio-resume' ),
            'medium'        => esc_html__( 'Medium Size', 'bosa-portfolio-resume' ),
            'medium_large'  => esc_html__( 'Medium Large Size', 'bosa-portfolio-resume' ),
            'thumbnail'     => esc_html__( 'Thumbnail Size', 'bosa-portfolio-resume' ),
            '1536x1536'     => esc_html__( '1536x1536 Size', 'bosa-portfolio-resume' ),
            '2048x2048'     => esc_html__( '2048x2048 Size', 'bosa-portfolio-resume' ),
            'bosa-1920-550' => esc_html__( '1920x550 Size', 'bosa-portfolio-resume' ),
            'bosa-1370-550' => esc_html__( '1370x550 Size', 'bosa-portfolio-resume' ),
            'bosa-590-310'  => esc_html__( '590x310 Size', 'bosa-portfolio-resume' ),
            'bosa-420-380'  => esc_html__( '420x380 Size', 'bosa-portfolio-resume' ),
            'bosa-420-300'  => esc_html__( '420x300 Size', 'bosa-portfolio-resume' ),
            'bosa-420-200'  => esc_html__( '420x200 Size', 'bosa-portfolio-resume' ),
            'bosa-290-150'  => esc_html__( '290x150 Size', 'bosa-portfolio-resume' ),
            'bosa-80-60'    => esc_html__( '80x60 Size', 'bosa-portfolio-resume' ),
        );
        
        return $data;

    }
}

if( !function_exists( 'bosa_portfolio_resume_archive_post_layout_filter' ) ){
    /**
    * Filter of archive post layout choices.
    * 
    * @since Bosa Portfolio Resume 1.0.0
    * @return array
    */
    add_filter( 'bosa_archive_post_layout_filter', 'bosa_portfolio_resume_archive_post_layout_filter' );
    function bosa_portfolio_resume_archive_post_layout_filter( $post_layout ){
        $added_post_layout = array(
            'grid-thumbnail' => get_stylesheet_directory_uri() . '/assets/images/thumbnail-layout.png',
        );
        return array_merge( $post_layout, $added_post_layout );
    }
}

if( !function_exists( 'bosa_portfolio_resume_footer_layout_filter' ) ){
    /**
    * Filter of footer layout choices.
    * 
    * @since Bosa Portfolio Resume 1.0.0
    * @return array
    */
    add_filter( 'bosa_footer_layout_filter', 'bosa_portfolio_resume_footer_layout_filter' );
    function bosa_portfolio_resume_footer_layout_filter( $footer_layout ){
        $added_footer = array(
            'footer_eight'  => get_stylesheet_directory_uri() . '/assets/images/footer-layout-8.png',
        );
        return array_merge( $footer_layout, $added_footer );
    }
}

/**
* Get woocommerce product categories.
* 
* @since Bosa Portfolio Resume 1.0.0
* @uses get_categories()
* @return array
*/
function bosa_portfolio_resume_get_product_categories(){

    $categories = get_categories( 'taxonomy=product_cat' );

    if( empty($categories) || !is_array( $categories ) ){
        return array();
    }

    $data = array();
    foreach ( $categories as $key => $value) {
        $cat_ID = absint( $value->cat_ID );
        $data[$cat_ID] =  esc_html( $value->name );
    }
    return $data;

}


add_theme_support( "title-tag" );
add_theme_support( 'automatic-feed-links' );