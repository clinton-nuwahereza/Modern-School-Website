<?php
/**
 * Sidear Control
 */
add_action( 'author_personal_blog_before_default_page', 'author_personal_blog_before_default_page_markup' );
function author_personal_blog_before_default_page_markup() {
	global $post;
	if (is_home()) {
		$sidebar_layouts = get_theme_mod( 'blog_page_sidebar', 'no' );
	}elseif (is_archive()) {
		$sidebar_layouts = get_theme_mod('archive_page_sidebar', 'no');
	}elseif (is_page()) {
		$get_page_sidebar_settings = get_theme_mod('page_sidebar', 'no');
		$sidebar_layouts = $get_page_sidebar_settings;
		$indvPageSidebarSettings = get_post_meta( $post->ID, 'author_personal_blog_sidebar-settings', true );
		if ('customizer' === $indvPageSidebarSettings || empty($indvPageSidebarSettings)) {
			$sidebar_layouts = $get_page_sidebar_settings;
		}else{
			$sidebar_layouts = $indvPageSidebarSettings;
		}
	}elseif (is_single()) {
		$get_post_sidebar_settings = get_theme_mod('post_sidebar', 'no');
		$sidebar_layouts = $get_post_sidebar_settings;
		$indvPostSidebarSettings = get_post_meta( $post->ID, 'author_personal_blog_sidebar-settings', true );
		if ('customizer' === $indvPostSidebarSettings || empty($indvPostSidebarSettings)) {
			$sidebar_layouts = $get_post_sidebar_settings;
		}else{
			$sidebar_layouts = $indvPostSidebarSettings;
		}
	}elseif (is_search()) {
		$sidebar_layouts = get_theme_mod('search_page_sidebar', 'no');
	}
	$blogcontent    = 'col-md-12';
	if ( $sidebar_layouts === 'right' ) {
		$blogcontent = 'col-md-7 col-lg-8 order-0';
	} elseif ( $sidebar_layouts === 'left' ) {
		$blogcontent = 'col-md-7 col-lg-8 order-1';
	} elseif ( $sidebar_layouts === 'no' ) {
		$blogcontent = 'col-md-12';
	} else {
		$blogcontent = 'col-md-12';
	}
	?>
		<div class="blog-post-section">
			<div class="container">
				<div class="row">
					<div class="<?php echo esc_attr( $blogcontent ); ?>">
	<?php
}

add_action( 'author_personal_blog_after_default_page', 'author_personal_blog_after_default_page_markup' );
function author_personal_blog_after_default_page_markup() {
	global $post;
	if (is_home()) {
		$sidebar_layouts = get_theme_mod( 'blog_page_sidebar', 'no' );
	}elseif (is_archive()) {
		$sidebar_layouts = get_theme_mod('archive_page_sidebar', 'no');
	}elseif (is_page()) {
		$get_page_sidebar_settings = get_theme_mod('page_sidebar', 'no');
		$sidebar_layouts = $get_page_sidebar_settings;
		$indvPageSidebarSettings = get_post_meta( $post->ID, 'author_personal_blog_sidebar-settings', true );
		if ('customizer' === $indvPageSidebarSettings || empty($indvPageSidebarSettings)) {
			$sidebar_layouts = $get_page_sidebar_settings;
		}else{
			$sidebar_layouts = $indvPageSidebarSettings;
		}
	}elseif (is_single()) {
		$get_post_sidebar_settings = get_theme_mod('post_sidebar', 'no');
		$sidebar_layouts = $get_post_sidebar_settings;
		$indvPostSidebarSettings = get_post_meta( $post->ID, 'author_personal_blog_sidebar-settings', true );
		if ('customizer' === $indvPostSidebarSettings || empty($indvPostSidebarSettings)) {
			$sidebar_layouts = $get_post_sidebar_settings;
		}else{
			$sidebar_layouts = $indvPostSidebarSettings;
		}
	}elseif (is_search()) {
		$sidebar_layouts = get_theme_mod('search_page_sidebar', 'no');
	}

	$blogsidebar    = 'col-md-5 col-lg-4 order-1 pl-xl-5';
	$sidebarshow    = true;
	if ( $sidebar_layouts === 'right' ) {
		$blogsidebar = 'col-md-5 col-lg-4 order-1 pl-xl-5';
		$sidebarshow = true;
	} elseif ( $sidebar_layouts === 'left' ) {
		$blogsidebar = 'col-md-5 col-lg-4 order-0 pl-xl-5';
		$sidebarshow = true;
	} elseif ( $sidebar_layouts === 'no' ) {
		$blogsidebar = 'sidebar-hide';
		$sidebarshow = false;
	} else {
		$blogsidebar = 'col-md-5 col-lg-4 order-1 pl-xl-5';
	}
	?>
					 </div>
					<?php if ( $sidebarshow === true ) : ?>
						<div class="<?php echo esc_attr( $blogsidebar ); ?>">
							<?php get_sidebar(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
}
