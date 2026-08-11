<?php
/**
 * Custom comment functions for the Author Personal Blog theme.
 *
 * This file contains functions to customize the comment form fields, form defaults,
 * field order, and comment list display.
 *
 * @package Author Personal Blog
 */

/**
 * Customizes the default comment form fields.
 *
 * Modifies the HTML for the author, email, and URL fields to include Bootstrap classes
 * and custom placeholders.
 *
 * @param array $author_personal_blog_comment_field The default comment form fields.
 * @return array The modified comment form fields.
 */
add_filter( 'comment_form_default_fields', 'author_personal_blog_comment_form' );
function author_personal_blog_comment_form( $author_personal_blog_comment_field ) {
	// Define the author field with Bootstrap styling and localized placeholder.
	$author_personal_blog_comment_field['author'] = '<input type="text" class="form-control" name="author" id="name-cmt" placeholder="' . esc_attr__( 'Your Name', 'author-personal-blog' ) . '">';

	// Define the email field with Bootstrap styling and localized placeholder.
	$author_personal_blog_comment_field['email']  = '<input type="email" class="form-control" name="email" id="email-cmt" placeholder="' . esc_attr__( 'Your Email', 'author-personal-blog' ) . '">';

	// Define the URL field with Bootstrap styling and localized placeholder.
	$author_personal_blog_comment_field['url']    = '<input type="text" class="form-control" name="url" id="website" placeholder="' . esc_attr__( 'Your Website', 'author-personal-blog' ) . '">';

	return $author_personal_blog_comment_field;
}

/**
 * Customizes the default comment form settings.
 *
 * Modifies the comment textarea, submit button, and reply title, and adds a nonce field
 * for security.
 *
 * @param array $default_form The default comment form settings.
 * @return array The modified comment form settings.
 */
add_filter( 'comment_form_defaults', 'author_personal_blog_comment_default_form' );
function author_personal_blog_comment_default_form( $default_form ) {
	// Customize the comment textarea with Bootstrap styling and placeholder.
	$default_form['comment_field']        = '<textarea class="form-control" name="comment" rows="7" placeholder="' . esc_attr__( 'Message goes here', 'author-personal-blog' ) . '"></textarea>';

	// Customize the submit button with Bootstrap styling.
	$default_form['submit_button']        = '<button type="submit" class="btn btn-primary">' . esc_attr__( 'Post Comment', 'author-personal-blog' ) . '</button>';
	// Add a nonce field for CSRF protection.
	$default_form['comment_notes_before'] = $default_form['comment_notes_before'] . wp_nonce_field( 'comment_form_nonce', 'comment_form_nonce', true, false );

	// Set the reply title with localized text.
	$default_form['title_reply']          = esc_attr__( 'Leave A Comment', 'author-personal-blog' );

	// Wrap the reply title in h4 tags.
	$default_form['title_reply_before']   = '<h4>';
	$default_form['title_reply_after']    = '</h4>';

	return $default_form;
}

/**
 * Reorders the comment form fields.
 *
 * Ensures fields are displayed in the order: author, email, URL (if not WooCommerce),
 * comment, cookies.
 *
 * @param array $fields The default comment form fields.
 * @return array The reordered comment form fields.
 */
add_filter( 'comment_form_fields', 'author_personal_blog_comment_form_structure' );
function author_personal_blog_comment_form_structure( $fields ) {
	// Initialize an array to store reordered fields.
	$reordered_fields = array();

	// Add author field.
	$reordered_fields['author'] = $fields['author'];

	// Add email field.
	$reordered_fields['email'] = $fields['email'];

	// Conditionally add URL field if not on a WooCommerce page.
	if ( function_exists( 'is_woocommerce' ) && is_callable( 'is_woocommerce' ) && ! is_woocommerce() ) {
		$reordered_fields['url'] = $fields['url'];
	}

	// Add comment field.
	$reordered_fields['comment'] = $fields['comment'];

	// Add cookies consent field.
	$reordered_fields['cookies'] = $fields['cookies'];

	return $reordered_fields;
}

/**
 * Customizes the display of individual comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() to render each comment with a custom layout,
 * including avatar, author, date, content, and reply link.
 *
 * @since Shape 1.0
 * @param WP_Comment $comment The comment object.
 * @param array      $args    An array of arguments for comment display.
 * @param int        $depth   The depth of the comment in the thread.
 */
if ( ! function_exists( 'author_personal_blog_comment_list' ) ) :
	function author_personal_blog_comment_list( $comment, $args, $depth ) {
		// Determine the HTML tag based on style (div or li).
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		// Set the add_below value for reply links.
		$add_below = ( 'div' === $args['style'] ) ? 'comment' : 'div-comment';
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
			<?php if ( 'div' === $args['style'] ) : ?>
				<div id="div-comment-<?php comment_ID(); ?>" class="comment-body review-list">
			<?php endif; ?>
			<div class="single-comment">
				<div class="commenter-image">
					<?php
					// Display the commenter's avatar if avatar_size is non-zero.
					if ( 0 != $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
				</div>
				<div class="commnenter-details">
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'author-personal-blog' ); ?></em>
						<br />
					<?php endif; ?>
					<div class="comment-meta">
						<div class="comment-time">
							<p>
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
										// Output the comment date and time.
										echo esc_html( get_comment_date() . ' ' );
										echo esc_html( get_comment_time() );
									?>
								</time>
							</p>
						</div>
						<h4><?php printf( wp_kses_post( '%s', 'author-personal-blog' ), sprintf( '%s', get_comment_author_link() ) ); ?></h4>
					</div>
					<?php
					// Output the comment content.
					comment_text();
					?>
					<?php
					// Output the reply link with custom styling.
					comment_reply_link(
						array_merge(
							$args,
							array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="reply">',
								'after'     => '</div>',
							)
						)
					);
					?>
				</div>
			</div>
			<?php if ( 'div' === $args['style'] ) : ?>
				</div>
			<?php endif; ?>
		<?php
	}
endif;