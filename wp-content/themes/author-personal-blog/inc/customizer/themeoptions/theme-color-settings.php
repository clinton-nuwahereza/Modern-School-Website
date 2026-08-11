<?php
Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'color',
	'settings'    => 'primary_color',
	'label'       => __( 'Primary Background Color', 'author-personal-blog' ),
	'section'     => 'colors',
	'default'     => '#fb4747',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.author-personal-blog-standard-post__overlay-category span.cat-links a, .widget .tagcloud a, blockquote.wp-block-quote.is-style-red-qoute, .scrooltotop a:hover, .discover-me-button a, .woocommerce .woocommerce-pagination .page-numbers li a, .woocommerce .woocommerce-pagination .page-numbers li span, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce table.shop_table tr td.product-remove a, .woocommerce-info, .woocommerce-noreviews, p.no-comments, .author-personal-blog-single-page .entry-footer a,nav.woocommerce-MyAccount-navigation ul li a, .rs-wp-themes-cookies-banner-area .cookies_accept_button, .widget_search button, aside.widget-area .widget .widget-title:before, .pagination li.page-item a, .pagination li.page-item span, .author-personal-blog-standard-post__overlay-content.no-post-thumbnail .author-personal-blog-standard-post__overlay-category span.cat-links a, .author-personal-blog-standard-post__overlay-content.no-post-thumbnail .author-personal-blog-standard-post__post-meta span.cat-links a, .author-personal-blog-standard-post__overlay-category span.cat-links a:hover, .widget .tagcloud a:hover, .discover-me-button a:hover, .author-personal-blog-standard-post__post-meta span.cat-links a:hover, .author-personal-blog-standard-post__overlay-content.no-post-thumbnail .author-personal-blog-standard-post__blog-meta>span i.dote, .scrooltotop a, .about-section-social-links a:hover, .about-section-social-links a:focus, .about-section-social-links a:hover, .about-section-social-links a:active,.author-personal-blog-standard-post__post-meta-single .posted-on:before, .author-personal-blog-standard-post__post-meta-single .posted-on:after, form#commentform p.form-submit button.btn-primary, .footer-social-links .social-link a:hover, .woocommerce ul.products li.product .button:hover, .author-personal-blog-standard-post .author-personal-blog-standard-post__full-summery .wp-block-post-terms a, nav.wp-block-query-pagination .wp-block-query-pagination-numbers > span, nav.wp-block-query-pagination .wp-block-query-pagination-numbers > a, nav.wp-block-query-pagination a.wp-block-query-pagination-next, nav.wp-block-query-pagination a.wp-block-query-pagination-prev, .author-personal-blog-standard-post .author-personal-blog-standard-post__full-summery .wp-block-post-navigation-link a, .author-personal-blog-standard-post__full-summery .page-links a',
			'property' => 'background-color',
		),
		array(
			'element'  => '#cssmenu ul ul li:first-child',
			'property' => 'border-top-color',
		),
		array(
			'element'  => '.author-personal-blog-standard-post__full-summery blockquote',
			'property' => 'border-left-color',
		),
		array(
			'element'  => '.author-personal-blog-standard-post__full-summery blockquote.has-text-align-right',
			'property' => 'border-right-color',
		),
		array(
			'element'  => '.widget_search button ',
			'property' => 'border-color',
		),
	),
] );

Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'color',
	'settings'    => 'primary_text_color',
	'label'       => __( 'Primary Text Color', 'author-personal-blog' ),
	'section'     => 'colors',
	'transport'   => 'auto',
	'default'     => '#fb4747',
	'output' => array(
		array(
			'element'  => '.widget-area .widget.widget_rss a.rsswidget, .widget ul li a:hover, .widget ul li a:visited, .widget ul li a:focus, .widget ul li a:active, .widget ol li a:hover, .widget ol li a:visited, .widget ol li a:focus, .widget ol li a:active, .author-personal-blog-standard-post .author-personal-blog-standard-post__full-summery a:hover, a:hover, a:focus, a:active, span.opacity-none:before, header.archive-page-header span, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce .product_meta > * a, .woocommerce-account .woocommerce-MyAccount-content a, .author-personal-blog-standard-post_post-meta .tags-links a:hover, .post-details-page .author-personal-blog-standard-post__blog-meta .fa, .books-loop-item .loop-book-content-wrapper .book-price, .about-section-social-links a, #cssmenu>ul>li:hover>a',
			'property' => 'color',
		),
		array(
			'element'  => '.author-personal-blog-standard-post__blog-meta>span.posted-on i.line',
			'property' => 'background-color',
		),
	),
] );

Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'color',
	'settings'    => 'footer_bg_color',
	'label'       => __( 'Footer Background Color', 'author-personal-blog' ),
	'section'     => 'colors',
	'default'     => '#f4f4ec',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => 'footer.site-footer, .site-copyright',
			'property' => 'background-color',
		),
	),
] );



Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'color',
	'settings'    => 'footer_title_color',
	'label'       => __( 'Footer Title Color', 'author-personal-blog' ),
	'section'     => 'colors',
	'default'     => '#000000',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.footer-content .widget h2.widget-title.footer-title',
			'property' => 'color',
		),
		array(
			'element'  => '.footer-content .widget h2.widget-title.footer-title:before',
			'property' => 'background-color',
		),
	),
] );


Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'color',
	'settings'    => 'footer_br_color',
	'label'       => __( 'Copyright Top Border Color', 'author-personal-blog' ),
	'section'     => 'colors',
	'default'     => '#dddddd',
	'choices'     => [
		'alpha' => true,
	],
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-copyright',
			'property' => 'border-color',
		),
	),
] );

Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'color',
	'settings'    => 'copyright_text_color',
	'label'       => __( 'Copyright Text Color', 'author-personal-blog' ),
	'section'     => 'colors',
	'default'     => '#000000',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-copyright',
			'property' => 'color',
		),
	),
] );
