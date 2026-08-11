<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Author Personal Blog
 */

function author_personal_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	global $post;
	if (is_page()) {
		$get_page_sidebar_settings = get_theme_mod('page_sidebar', 'no');
		$sidebar_layouts = $get_page_sidebar_settings;
		$indvPageSidebarSettings = get_post_meta( $post->ID, 'author_personal_blog_sidebar-settings', true );
		if ('customizer' === $indvPageSidebarSettings || empty($indvPageSidebarSettings)) {
			$sidebar_layouts = $get_page_sidebar_settings;
		}else{
			$sidebar_layouts = $indvPageSidebarSettings;
		}
		$classes[] = $sidebar_layouts . '-sidebar';
	}elseif (is_single()) {
		$get_post_sidebar_settings = get_theme_mod('post_sidebar', 'no');
		$sidebar_layouts = $get_post_sidebar_settings;
		$indvPostSidebarSettings = get_post_meta( $post->ID, 'author_personal_blog_sidebar-settings', true );
		if ('customizer' === $indvPostSidebarSettings || empty($indvPostSidebarSettings)) {
			$sidebar_layouts = $get_post_sidebar_settings;
		}else{
			$sidebar_layouts = $indvPostSidebarSettings;
		}
		$classes[] = $sidebar_layouts . '-sidebar';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'author_personal_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function author_personal_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'author_personal_blog_pingback_header' );

/**
 * Author VCard
 */
function author_personal_blog_author_vcard() {
	?>
	<div class="author-vcard">
		<div class="author-vcard__image">
			<?php
			echo get_avatar( get_the_author_meta( 'ID' ), 100, '', '', null );
			?>
		</div>
		<div class="author-vcard__about">
			<h4><?php echo esc_html( get_the_author_meta( 'nickname' ) ); ?></h4>
			<?php if(!empty(get_the_author_meta( 'description' ))): ?>
			<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
			<?php endif; ?>
			<p>
			<?php
			$userpost_count = count_user_posts( get_the_author_meta( 'ID' ), 'post', false );
			if ( $userpost_count > 1 ) {
				$numberingtext = 'posts';
			} else {
				$numberingtext = 'post';
			}
			$userposts = esc_html__( 'The author has %1$s %2$s', 'author-personal-blog' );
			printf( $userposts, $userpost_count, $numberingtext );
			?>
			 </p>
		</div>
	</div>
	<?php
	return;
}

/**
 * Get Current Year
 */

 function author_personal_blog_currentYear(){
    return date('Y');
}

/**
 * Get theme Data
 */
function author_personal_blog_author_uri(){
	$themeData = wp_get_theme();
	return $authorURI = $themeData->get( 'AuthorURI' );
}

/**
 * Masonry Layout Control
 */
function author_personal_blog_masonry_layout_control(){
	$get_masonry_layout = get_theme_mod('active_masonry_layout', true);
	if (true === $get_masonry_layout) {
		return ' masonry_active';
	}
	return '';
}

/**
 * Limit Excerpt length
 */
function author_personal_blog_post_excerpt_limit( $length ) {
	$length = get_theme_mod('post_loop_excerpt_limit', 42);
   return $length;
}
add_filter( 'excerpt_length', 'author_personal_blog_post_excerpt_limit', 999 );

/**
 * Social Links
 */

function author_personal_blog_social_links(){
	$social_media_fields = array(
	    'facebook' => 'Facebook',
	    'twitter' => 'Twitter',
	    'instagram' => 'Instagram',
	    'tiktok' => 'Tiktok',
	    'linkedin' => 'Linkedin',
	    'pinterest' => 'Pinterest',
	    'line' => 'Line',
	    'github' => 'Github',
	    'discord' => 'Discord',
	    'youtube' => 'Youtube',
	    'wordpress' => 'WordPress',
	    'slack' => 'Slack',
	    'apple' => 'Apple',
	    'stack-overflow' => 'Stack-overflow',
	    'kickstarter' => 'kickstarter',
	    'dribbble' => 'Dribbble',
	    'codepen' => 'Codepen',
	    'whatsapp' => 'Whatsapp',
	    'medium' => 'Medium',
	    'goodreads-g' => 'Goodreads'
	);
	foreach ( $social_media_fields as $field => $label ) {
	    $value = get_theme_mod( $field, '#' );
	    if ( ! empty( $value ) && '#' != $value) {
	        echo '<div class="social-link"><a target="_blank" href="' . esc_url( $value ) . '" class="rswpthemes-icon icon-'.$field.'"></a></div>';
	    }
	}
	wp_reset_query();
}



function author_personal_blog_get_books_layout(){
	$getBooksLayout = get_theme_mod('books_layout', 'product');
	return $getBooksLayout;
}

function author_personal_blog_template_chooser($template){
	  global $wp_query;
	  $post_type = get_query_var('post_type');
	  if( $wp_query->is_search && $post_type == 'books-gallery' )
	  {
	    return locate_template('search-books.php');  //  redirect to archive-search.php
	  }
	  return $template;
}
add_filter('template_include', 'author_personal_blog_template_chooser');


add_action( 'pre_get_posts', function ( $query )
{
    if (    !is_admin()
         && $query->is_main_query()
         && $query->is_tax('book-author')
    ) {
        $query->set( 'posts_per_page', 20   );
    }
   wp_reset_query();
});
add_action('admin_menu', 'author_personal_blog_personalize');
function author_personal_blog_personalize(){
	remove_submenu_page( 'sb-instagram-feed', 'sb-instagram-feed-about' );
}

add_action('sbi_before_feed', 'author_personal_blog_sbi_before_feed');
function author_personal_blog_sbi_before_feed(){
	?>
	<div class="author-personal-blog-instagram-section">
	<?php
}

add_action('sbi_after_feed', 'author_personal_blog_sbi_after_feed');
function author_personal_blog_sbi_after_feed(){
	?>
	</div>
	<?php
}

function author_personal_blog_utm_url($medium){
    $rawUrl = sprintf(
        'https://rswpthemes.com/author-portfolio-pro-wordpress-theme/?utm_source=free_theme&utm_medium=%s&utm_campaign=author_personal_blog',
        rawurlencode($medium)
    );
    return $rawUrl;
}

function author_personal_blog_page_header_control(){
	$get_page_header = true;
	if (is_archive()) {
		$get_page_header = get_theme_mod('show_archive_page_header', true);
	}elseif(is_page()){
		$get_page_header = get_theme_mod('show_custom_page_header', true);
	}
	$page_header = $get_page_header;
	$page_meta_header = true;
	if (is_page()) :
		$get_page_meta_header_settings = get_post_meta( get_the_ID(), 'author_personal_blog_show-page-banner', true );
		if ('show' == $get_page_meta_header_settings) {
			$page_meta_header = true;
		}elseif('hide' == $get_page_meta_header_settings){
			$page_meta_header = false;
		}
		if ('customizer' === $get_page_meta_header_settings || NULL === $get_page_meta_header_settings) {
			$page_header = $get_page_header;
		}else{
			$page_header = $page_meta_header;
		}
	endif;
	return $page_header;
}