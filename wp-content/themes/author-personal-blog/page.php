<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress Author Personal Blogt of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Author Personal Blog
 */
get_header();
if (true == author_personal_blog_page_header_control()) {
	get_template_part('template-parts/page-header/page', 'header');
}
$get_page_content_layouts = get_post_meta( get_the_ID(), 'author_personal_blog_content-layout', true );
if ('stretched' !== $get_page_content_layouts) :
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
		do_action('author_personal_blog_before_default_page');
	else:
		echo '<div id="author-personal-blog-stretched-layout" class="author-personal-blog-stretched-layout">';
	endif;
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content/content', 'page' );
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile; // End of the loop.
		if ('stretched' !== $get_page_content_layouts) :
		do_action('author_personal_blog_after_default_page');
		?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
else:
	echo '</div>';
endif;
get_footer(); ?>
