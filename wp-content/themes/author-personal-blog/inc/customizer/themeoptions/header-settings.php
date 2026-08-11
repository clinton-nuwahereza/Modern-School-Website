<?php
Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'typography',
	'settings'    => 'site_title_typography',
	'label'       => esc_html__( 'Site Title Typography', 'author-personal-blog' ),
	'section'     => 'title_tagline',
	'priority'    => 80,
	'default'     => [
		'font-family'    => 'Roboto',
		'variant'        => '700',
		'font-size'      => '1.4rem',
		'line-height'    => '1.6',
		'letter-spacing' => '0px',
		'color'          => '#000000',
		'text-transform' => 'none',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.site-branding .site-title',
		],
	],
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'typography',
    'settings'    => 'site_description_typography',
    'label'       => esc_html__( 'Site Description Typography', 'author-personal-blog' ),
    'section'     => 'title_tagline',
    'priority'    => 85,
    'default'     => [
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '1rem',
        'line-height'    => '1.6',
        'letter-spacing' => '0px',
        'color'          => '#000000',
        'text-transform' => 'none',
    ],
    'transport'   => 'auto',
    'output'      => [
        [
            'element' => '.site-branding p.site-description',
        ],
    ],
] );