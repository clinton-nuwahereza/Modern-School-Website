<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package prime_playschool_classes
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function prime_playschool_classes_body_classes( $classes ) {
  global $prime_playschool_classes_post;
  
    if( !is_page_template( 'template-home.php' ) ){
        $classes[] = 'inner';
        // Adds a class of group-blog to blogs with more than 1 published author.
    }

    if ( is_multi_author() ) {
        $classes[] = 'group-blog ';
    }

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    

    if( prime_playschool_classes_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }    

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_page() ) {
        $classes[] = 'hfeed ';
    }
  
    if( is_404() ||  is_search() ){
        $classes[] = 'full-width';
    }
  
    if( ! is_active_sidebar( 'right-sidebar' ) ) {
        $classes[] = 'full-width'; 
    }

    return $classes;
}
add_filter( 'body_class', 'prime_playschool_classes_body_classes' );

 /**
 * 
 * @link http://www.altafweb.com/2011/12/remove-specific-tag-from-php-string.html
 */
function prime_playschool_classes_strip_single( $tag, $string ){
    $string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
    $string=preg_replace('/<\/'.$tag.'>/i', '', $string);
    return $string;
}

if ( ! function_exists( 'prime_playschool_classes_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function prime_playschool_classes_excerpt_more($more) {
  return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'prime_playschool_classes_excerpt_more' );

if ( ! defined( 'PRIME_PLAYSCHOOL_CLASSES_FOOTER_URL' ) ) {
  define( 'PRIME_PLAYSCHOOL_CLASSES_FOOTER_URL', esc_url( 'https://themeignite.com/products/free-playschool-wordpress-theme', 'prime-playschool-classes') );
}

if( ! function_exists( 'prime_playschool_classes_footer_credit' ) ):
/**
 * Footer Credits
*/
function prime_playschool_classes_footer_credit(){
    $prime_playschool_classes_footer_setting = get_theme_mod( 'prime_playschool_classes_footer_setting', true );
    if ( $prime_playschool_classes_footer_setting ){ 
        $prime_playschool_classes_copyright_text = get_theme_mod( 'prime_playschool_classes_footer_copyright_text' );

        $prime_playschool_classes_text  = '<div class="site-info"><div class="container"><span class="copyright">';
        if( $prime_playschool_classes_copyright_text ){
            $prime_playschool_classes_text .= wp_kses_post( $prime_playschool_classes_copyright_text ); 
        }else{
            $prime_playschool_classes_text .= esc_html__( '&copy; ', 'prime-playschool-classes' ) . date_i18n( esc_html__( 'Y', 'prime-playschool-classes' ) ); 
            $prime_playschool_classes_text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'. esc_html__( '. All Rights Reserved.', 'prime-playschool-classes' );
        }
        $prime_playschool_classes_text .= '</span>';
        $prime_playschool_classes_text .= '<span class="by"> <a href="' . esc_url( PRIME_PLAYSCHOOL_CLASSES_FOOTER_URL ) .'" rel="nofollow" target="_blank">' . PRIME_PLAYSCHOOL_CLASSES_THEME_NAME . '</a>' . esc_html__( ' By ', 'prime-playschool-classes' ) . '' . '<a href="' . esc_url( 'https://themeignite.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Themeignite', 'prime-playschool-classes' ) . '</a>';
        $prime_playschool_classes_text .= sprintf( esc_html__( ' Powered By %s', 'prime-playschool-classes' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'prime-playschool-classes' ) ) .'" target="_blank">WordPress</a>.' );
        if ( function_exists( 'the_privacy_policy_link' ) ) {
            $prime_playschool_classes_text .= get_the_privacy_policy_link();
        }
        $prime_playschool_classes_text .= '</span></div></div>';
        echo apply_filters( 'prime_playschool_classes_footer_text', $prime_playschool_classes_text );
    } 
}
add_action( 'prime_playschool_classes_footer', 'prime_playschool_classes_footer_credit' );
endif;

/**
 * Is Woocommerce activated
*/
if ( ! function_exists( 'prime_playschool_classes_woocommerce_activated' ) ) {
  function prime_playschool_classes_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}

if( ! function_exists( 'prime_playschool_classes_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function prime_playschool_classes_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $prime_playschool_classes_commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $prime_playschool_classes_aria_req = ( $req ? " aria-required='true'" : '' );
    $prime_playschool_classes_required = ( $req ? " required" : '' );
    $prime_playschool_classes_author   = ( $req ? __( 'Name*', 'prime-playschool-classes' ) : __( 'Name', 'prime-playschool-classes' ) );
    $prime_playschool_classes_email    = ( $req ? __( 'Email*', 'prime-playschool-classes' ) : __( 'Email', 'prime-playschool-classes' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'prime-playschool-classes' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $prime_playschool_classes_author ) . '" type="text" value="' . esc_attr( $prime_playschool_classes_commenter['comment_author'] ) . '" size="30"' . $prime_playschool_classes_aria_req . $prime_playschool_classes_required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'prime-playschool-classes' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $prime_playschool_classes_email ) . '" type="text" value="' . esc_attr(  $prime_playschool_classes_commenter['comment_author_email'] ) . '" size="30"' . $prime_playschool_classes_aria_req . $prime_playschool_classes_required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'prime-playschool-classes' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'prime-playschool-classes' ) . '" type="text" value="' . esc_attr( $prime_playschool_classes_commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'prime_playschool_classes_change_comment_form_default_fields' );

if( ! function_exists( 'prime_playschool_classes_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function prime_playschool_classes_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'prime-playschool-classes' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'prime-playschool-classes' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'prime_playschool_classes_change_comment_form_defaults' );

if( ! function_exists( 'prime_playschool_classes_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function prime_playschool_classes_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
    /**
     * Triggered after the opening <body> tag.
    */
    do_action( 'wp_body_open' );
}
endif;

if ( ! function_exists( 'prime_playschool_classes_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function prime_playschool_classes_get_fallback_svg( $prime_playschool_classes_post_thumbnail ) {
    if( ! $prime_playschool_classes_post_thumbnail ){
        return;
    }
    
    $prime_playschool_classes_image_size = prime_playschool_classes_get_image_sizes( $prime_playschool_classes_post_thumbnail );
     
    if( $prime_playschool_classes_image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $prime_playschool_classes_image_size['width'] ); ?> <?php echo esc_attr( $prime_playschool_classes_image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $prime_playschool_classes_image_size['width'] ); ?>" height="<?php echo esc_attr( $prime_playschool_classes_image_size['height'] ); ?>" style="fill:#dedddd;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

function prime_playschool_classes_enqueue_google_fonts() {

    require get_template_directory() . '/inc/wptt-webfont-loader.php';

    wp_enqueue_style(
        'google-fonts-rubik',
        wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
        array(),
        '1.0'
    );

    wp_enqueue_style(
        'google-fontsfredoka',
        wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap' ),
        array(),
        '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'prime_playschool_classes_enqueue_google_fonts' );


if( ! function_exists( 'prime_playschool_classes_site_branding' ) ) :
/**
 * Site Branding
*/
function prime_playschool_classes_site_branding(){
    $prime_playschool_classes_logo_site_title = get_theme_mod( 'header_site_title', 1 );
    $prime_playschool_classes_tagline = get_theme_mod( 'header_tagline', false );
    $prime_playschool_classes_logo_width = get_theme_mod('logo_width', 100); // Retrieve the logo width setting

    ?>
    <div class="site-branding text-right" style="max-width: <?php echo esc_attr(get_theme_mod('logo_width', '-1'))?>px;">
        <?php 
        // Check if custom logo is set and display it
        if (function_exists('has_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        }
        if ($prime_playschool_classes_logo_site_title):
             if (is_front_page()): ?>
            <h1 class="site-title" style="font-size: <?php echo esc_attr(get_theme_mod('prime_playschool_classes_site_title_size', '27')); ?>px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
          </h1>
            <?php else: ?>
                <p class="site-title" itemprop="name">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>
        <?php endif; 
    
        if ($prime_playschool_classes_tagline) :
            $prime_playschool_classes_description = get_bloginfo('description', 'display');
            if ($prime_playschool_classes_description || is_customize_preview()) :
        ?>
                <p class="site-description" itemprop="description"><?php echo $prime_playschool_classes_description; ?></p>
            <?php endif;
        endif;
        ?>
    </div>
    <?php
}
endif;
if( ! function_exists( 'prime_playschool_classes_navigation' ) ) :
/**
 * Site Navigation
*/
function prime_playschool_classes_navigation(){
    ?>
    <nav class="main-navigation" id="site-navigation"  role="navigation">
        <?php 
        wp_nav_menu( array( 
            'theme_location' => 'primary', 
            'menu_id' => 'primary-menu' 
        ) ); 
        ?>
    </nav>
    <?php
}
endif;


if( ! function_exists( 'prime_playschool_classes_top_header' ) ) :
/**
 * Header Start
*/
function prime_playschool_classes_top_header(){
    $prime_playschool_classes_header_setting     = get_theme_mod( 'prime_playschool_classes_header_setting', false );
    $prime_playschool_classes_location     = get_theme_mod( 'prime_playschool_classes_header_location' );
    $prime_playschool_classes_phone        = get_theme_mod( 'prime_playschool_classes_header_phone' );
    $prime_playschool_classes_email        = get_theme_mod( 'prime_playschool_classes_header_email' );
    $prime_playschool_classes_social_icon  = get_theme_mod( 'prime_playschool_classes_social_icon_setting', false);
    ?>
    <?php if ( $prime_playschool_classes_header_setting ){?>
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 align-self-center">
                        <?php if ( $prime_playschool_classes_location ){?>
                            <span><i class="<?php echo esc_attr(get_theme_mod('prime_playschool_classes_marker_icon','fas fa-map-marker-alt')); ?>"></i> <?php echo esc_html( $prime_playschool_classes_location );?></span>
                        <?php } ?>
                        <?php if ( $prime_playschool_classes_phone ){?>
                            <span><a href="tel:<?php echo esc_attr($prime_playschool_classes_phone);?>"><i class="<?php echo esc_attr(get_theme_mod('prime_playschool_classes_phone_icon','fas fa-phone')); ?>"></i> <?php echo esc_html( $prime_playschool_classes_phone);?></a></span>
                        <?php } ?>
                        <?php if ( $prime_playschool_classes_email ){?>
                            <span><a href="mailto:<?php echo esc_attr($prime_playschool_classes_email);?>"><i class="<?php echo esc_attr(get_theme_mod('prime_playschool_classes_mail_icon','fas fa-envelope')); ?>"></i> <?php echo esc_html($prime_playschool_classes_email);?></a></span>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4 col-md-5 align-self-center">
                        <?php if ( $prime_playschool_classes_social_icon ){?>
                            <div class="social-links">
                              <?php 
                                $prime_playschool_classes_social_link1 = get_theme_mod( 'prime_playschool_classes_social_link_1' );
                                $prime_playschool_classes_social_link2 = get_theme_mod( 'prime_playschool_classes_social_link_2' );
                                $prime_playschool_classes_social_link3 = get_theme_mod( 'prime_playschool_classes_social_link_3' );
                                $prime_playschool_classes_social_link4 = get_theme_mod( 'prime_playschool_classes_social_link_4' );

                                if ( ! empty( $prime_playschool_classes_social_link1 ) ) {
                                  echo '<a class="social1" href="' . esc_url( $prime_playschool_classes_social_link1 ) . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                                }
                                if ( ! empty( $prime_playschool_classes_social_link2 ) ) {
                                  echo '<a class="social2" href="' . esc_url( $prime_playschool_classes_social_link2 ) . '" target="_blank"><i class="fab fa-twitter"></i></a>';
                                } 
                                if ( ! empty( $prime_playschool_classes_social_link3 ) ) {
                                  echo '<a class="social3" href="' . esc_url( $prime_playschool_classes_social_link3 ) . '" target="_blank"><i class="fab fa-instagram"></i></a>';
                                }
                                if ( ! empty( $prime_playschool_classes_social_link4 ) ) {
                                  echo '<a class="social4" href="' . esc_url( $prime_playschool_classes_social_link4 ) . '" target="_blank"><i class="fab fa-pinterest-p"></i></a>';
                                }
                              ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php
}
endif;
add_action( 'prime_playschool_classes_top_header', 'prime_playschool_classes_top_header', 20 );


if( ! function_exists( 'prime_playschool_classes_header' ) ) :
/**
 * Header Start
*/
function prime_playschool_classes_header(){
      $prime_playschool_classes_header_image = get_header_image();
      $prime_playschool_classes_sticky_header = get_theme_mod('prime_playschool_classes_sticky_header');
    ?>
        <header id="masthead" data-sticky="<?php echo $prime_playschool_classes_sticky_header; ?>" class="site-header header-inner" role="banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 align-self-center">
                        <?php prime_playschool_classes_site_branding(); ?>
                    </div>
                    <div class="col-lg-9 col-md-1 align-self-center">
                        <?php prime_playschool_classes_navigation(); ?>
                    </div>
                </div>
            </div>
        </header>
    <?php
}
endif;
add_action( 'prime_playschool_classes_header', 'prime_playschool_classes_header', 20 );
