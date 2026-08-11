<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package eyepress
 */

if ( ! function_exists( 'eyepress_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function eyepress_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Publish on %s', 'post date', 'eyepress' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'eyepress_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function eyepress_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'eyepress' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline">' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'eyepress_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function eyepress_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'eyepress' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'eyepress' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'eyepress' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'eyepress' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'eyepress' ),
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

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'eyepress' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'eyepress_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function eyepress_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail();
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


/**
 * Add admin bar link for EyePress Pro upgrade
 */
function eyepress_admin_bar_upgrade_link($wp_admin_bar) {
	// Only show to users who can install plugins (admins)
	if (!current_user_can('install_plugins')) {
		return;
	}

	// SVG icon for upgrade link
	$svg_icon = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#00b9eb"/>
	</svg>';

	// Add the menu item
	$wp_admin_bar->add_node(array(
		'id'    => 'eyepress-upgrade-pro',
		'title' => $svg_icon . '<span class="ab-label">' . esc_html__('Upgrade to EyePress Pro', 'eyepress') . '</span>',
		'href'  => esc_url('https://wpthemespace.com/product/eyepress-pro/?add-to-cart=267'),
		'meta'  => array(
			'title' => esc_attr__('Upgrade to EyePress Pro for more features', 'eyepress'),
			'class' => 'eyepress-upgrade-pro',
		),
	));
}
add_action('admin_bar_menu', 'eyepress_admin_bar_upgrade_link', 999);

/**
 * Menu fallback function
 * Displays Home + 5 pages when no menu is assigned
 */
function eyepress_menu_fallback($args = array())
{
	// Start the menu output
	$menu = '<ul id="eyepress-menu" class="eyepress-menu">';

	// Add Home link as the first item
	$menu .= '<li class="menu-item menu-item-home"><a href="' . esc_url(home_url('/')) . '" aria-current="page">' . esc_html__('Home', 'eyepress') . '</a></li>';

	// Get up to 5 published pages
	$pages = get_pages(array(
		'number' => 5,
		'sort_column' => 'menu_order',
		'sort_order' => 'ASC',
		'post_status' => 'publish'
	));

	// Add pages to the menu
	foreach ($pages as $page) {
		$menu .= '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
	}

	// Close the menu
	$menu .= '</ul>';

	// Output the menu
	echo $menu;
}