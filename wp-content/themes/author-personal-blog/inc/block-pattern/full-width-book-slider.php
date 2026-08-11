<?php
add_action( 'init', 'author_personal_blog_register_block_pattern' );
function author_personal_blog_register_block_pattern(){
	if (function_exists('register_block_pattern')) :
		register_block_pattern(
		    'author_personal_blog/full_width_book_slider',
		    array(
		        'title'       => __( 'Full Width Book Slider', 'author-personal-blog' ),
		        'description' => _x( 'Full Width Book Slider display book slider in full width with background image.', 'Block pattern description', 'author-personal-blog' ),
		        'content'     => '<!-- wp:cover {"url":"http://localhost/freetheme/free-demo/personal-author-blog/wp-content/uploads/sites/10/2022/03/italy-4093227_1920.jpg","id":529,"dimRatio":60,"overlayColor":"black","align":"full","className":"fullwidth-featured-slider-pattern","layout":{"type":"constrained"}} -->
	<div class="wp-block-cover alignfull fullwidth-featured-slider-pattern"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-60 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-529" alt="" src="http://localhost/freetheme/free-demo/personal-author-blog/wp-content/uploads/sites/10/2022/03/italy-4093227_1920.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:shortcode -->
	[rswpbs_book_slider books_per_page="8" categories_include="false" categories_exclude="false" authors_include="false" authors_exclude="false" exclude_books="false" order="DESC" orderby="date" show_author="true" show_title="true" title_type="title" show_image="true" image_type="book_cover" image_position="right" show_excerpt="true" excerpt_type="excerpt" excerpt_limit="30" show_price="true" show_buy_button="true" show_msl="false" msl_title_align="center" content_align="left" sts_l_screen="1" sts_m_screen="1" sts_s_screen="1" slider_style="featured" show_read_more_button="false"]
	<!-- /wp:shortcode --></div></div>
	<!-- /wp:cover -->',
		        'categories'  => array( 'columns', 'images' ),
		        'keywords'    => array( 'custom', 'layout' ),
		    )
		);
	endif;
}