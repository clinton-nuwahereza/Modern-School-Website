<?php
Kirki::add_section( 'page_header_settings_section', array(
    'title'          => esc_html__( 'Page Header Settings', 'author-personal-blog' ),
    'panel'          => 'author_personal_blog_global_panel',
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'author_personal_blog_config', [
    'type'     => 'toggle',
    'settings' => 'show_archive_page_header',
    'label'    => esc_html__( 'Show Archive Page Header', 'author-personal-blog' ),
    'section'  => 'page_header_settings_section',
    'default'   => '1',
    'choices' => [
        'on'  => esc_html__( 'Show', 'author-personal-blog' ),
        'off' => esc_html__( 'Hide', 'author-personal-blog' )
    ]
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'     => 'toggle',
    'settings' => 'show_custom_page_header',
    'label'    => esc_html__( 'Show Custom Page Header', 'author-personal-blog' ),
    'section'  => 'page_header_settings_section',
    'default'   => '1',
    'choices' => [
        'on'  => esc_html__( 'Show', 'author-personal-blog' ),
        'off' => esc_html__( 'Hide', 'author-personal-blog' )
    ]
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'background',
    'settings'    => 'page_header_background',
    'label'       => esc_html__( 'Page Header Background', 'author-personal-blog' ),
    'description' => esc_html__( 'Define The Background Of Page Header Section', 'author-personal-blog' ),
    'section'     => 'page_header_settings_section',
    'default'     => [
        'background-color'      => '#fff0e2',
        'background-image'      => '',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
    ],
    'transport'   => 'auto',
    'output'      => [
        [
            'element' => 'section.page-header-area',
        ],
    ],
    'active_callback' => [
        [
            'setting'  => 'show_page_header',
            'operator' => '==',
            'value'    => true,
        ]
    ],
] );


Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'typography',
	'settings'    => 'page_header_title_typography',
	'label'       => esc_html__( 'Page Title Typography', 'author-personal-blog' ),
	'section'     => 'page_header_settings_section',
	'default'     => [
		'font-family'    => 'Roboto',
		'variant'        => '700',
		'font-size'      => '2.5rem',
		'line-height'    => '1.6',
		'letter-spacing' => '0px',
		'color'          => '#000000',
		'text-transform' => 'none',
		'text-align'     => 'center',
	],
	'active_callback' => [
		[
			'setting'  => 'show_page_header',
			'operator' => '==',
			'value'    => true,
		]
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => 'section.page-header-area h1',
		],
	],
] );