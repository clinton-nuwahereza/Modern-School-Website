<?php
/**
 * Subscribe Settings
 */

Kirki::add_section( 'subscribe_form_settings', array(
    'title'          => esc_html__( 'Subscribe Form', 'author-personal-blog' ),
    'panel'          => 'author_personal_blog_global_panel',
) );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'switch',
    'settings'    => 'show_subscribe_form_section',
    'label'       => esc_html__( 'Show Subscribe Form Section', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
    'default'     => '0',
    'choices'     => [
        'on'  => esc_html__( 'Show', 'author-personal-blog' ),
        'off' => esc_html__( 'Hide', 'author-personal-blog' ),
    ],
] );
Kirki::add_field( 'author_personal_blog_config', [
	'type'        => 'image',
	'settings'    => 'subscribe_form_book_image',
	'label'       => esc_html__( 'Book Image', 'author-personal-blog' ),
	'section'     => 'subscribe_form_settings',
	'choices' => [
			'save_as' => 'array',
		],
] );
Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'textarea',
    'settings'    => 'subscribe_form_title',
    'label'       => esc_html__( 'Title', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'textarea',
    'settings'    => 'form_shortcode',
    'label'       => esc_html__( 'Form Shortcode', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
] );
Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'custom',
    'settings'    => 'subscribe_form_background_before',
    'section'     => 'subscribe_form_settings',
    'default'         => '<hr><hr>',
] );
Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'color',
    'settings'    => 'subscribe_form_background',
    'label'       => __( 'Section Background Color', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
    'default'     => '#f4f4ec',
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.subscribe-form-area',
            'property' => 'background-color',
        ),
    ),
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'custom',
    'settings'    => 'subscribe_form_btn_before',
    'section'     => 'subscribe_form_settings',
    'default'         => '<hr><hr>',
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'color',
    'settings'    => 'subscribe_form_btn_bg',
    'label'       => __( 'Button Background Color', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
    'default'     => '#fb4747',
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="submit"]',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="submit"]',
            'property' => 'border-color',
        ),
    ),
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'color',
    'settings'    => 'subscribe_form_btn_text_color',
    'label'       => __( 'Button Text Color', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
    'default'     => '#ffffff',
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="submit"]',
            'property' => 'color',
        ),
    ),
] );
Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'custom',
    'settings'    => 'subscribe_form_btn_after',
    'section'     => 'subscribe_form_settings',
    'default'         => '<hr><hr>',
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'color',
    'settings'    => 'subscribe_form_input_bg',
    'label'       => __( 'Input Background Color', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
    'default'     => '#ffffff',
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="email"]',
            'property' => 'background-color',
        ),
    ),
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'color',
    'settings'    => 'subscribe_form_input_text_color',
    'label'       => __( 'Input Text Color', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
    'default'     => '#000000',
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="email"]',
            'property' => 'color',
        ),
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="email"]::placeholder',
            'property' => 'color',
        ),
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="email"]::-webkit-input-placeholder',
            'property' => 'color',
        ),
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="email"]::-moz-placeholder',
            'property' => 'color',
        ),
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="email"]:-ms-input-placeholder',
            'property' => 'color',
        ),
        array(
            'element'  => '.subscribe-form-wrapper .mc4wp-form-fields input[type="email"]::-ms-input-placeholder',
            'property' => 'color',
        ),
    ),
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'typography',
    'settings'    => 'subscribe_form_title_typography',
    'label'       => esc_html__( 'Title Typography', 'author-personal-blog' ),
    'section'     => 'subscribe_form_settings',
    'default'     => [
        'font-family'    => 'Roboto',
        'variant'        => '700',
        'font-size'      => '2.5rem',
        'line-height'    => '1.4',
        'letter-spacing' => '0px',
        'color'          => '#000000',
        'text-transform' => 'none',
        'text-align'     => 'center',
    ],
    'transport'   => 'auto',
    'output'      => [
        [
            'element' => '.subscribe-form-wrapper .subscribe-form-title h2',
        ],
    ],
] );