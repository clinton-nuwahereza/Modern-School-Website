<?php
Kirki::add_section( 'about_section_settings', array(
    'title'          => esc_html__( 'About Section Settings', 'author-personal-blog' ),
    'description'    => esc_html__( 'Customize About Section section', 'author-personal-blog' ),
    'panel'          => 'author_personal_blog_global_panel',
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'show_about_section',
    'label'       => esc_html__( 'Show About Section', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'default'     => '0',
    'choices'     => [
        'on'  => esc_html__( 'Show', 'author-personal-blog' ),
        'off' => esc_html__( 'Hide', 'author-personal-blog' ),
    ],
] );

Kirki::add_field( 'author_personal_blog_config', array(
    'type'        => 'custom',
    'settings'    => 'about_settings_sep_for_content_section',
    'label'       => '',
    'section'     => 'about_section_settings',
    'default'     => '<h2 class="settings-section-separator">'.esc_html__('Content', 'author-personal-blog').'</h2>',
) );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'image',
    'settings'    => 'author_image',
    'label'       => esc_html__( 'Image', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'choices'     => [
                'save_as' => 'array',
            ],
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'textarea',
    'settings'    => 'author_title',
    'label'       => esc_html__( 'Title', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'default'    => __( 'Hi,
        My Name
        Johan Smih', 'author-personal-blog' ),
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'textarea',
    'settings'    => 'author_subtitle',
    'label'       => esc_html__( 'Sub Title', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'default'    => __( 'New York Times & International Bestselling Author', 'author-personal-blog' ),
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'editor',
    'settings'    => 'author_description',
    'label'       => esc_html__( 'Description', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'show_social_icon',
    'label'       => esc_html__( 'Show Social Links', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'default'    => false,
] );

Kirki::add_field( 'author_personal_blog_config', array(
    'type'        => 'custom',
    'settings'    => 'about_settings_sep_for_design_section',
    'label'       => '',
    'section'     => 'about_section_settings',
    'default'     => '<h2 class="settings-section-separator">'.esc_html__('Design', 'author-personal-blog').'</h2>',
) );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'background',
    'settings'    => 'about_section_background',
    'label'       => esc_html__( 'About Section Background', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'default'     => [
        'background-color'      => '#fff0e2',
        'background-image'      => '',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
    ],
    'transport'   => 'refresh',
    'output'      => [
        [
            'element' => '.about-section-area',
        ],
    ],

] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'typography',
    'settings'    => 'about_section_title_typography',
    'label'       => esc_html__( 'Title Typography', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'default'     => [
        'font-family'    => 'Roboto',
        'variant'        => '700',
        'font-size'      => '5rem',
        'line-height'    => '1.3',
        'letter-spacing' => '0px',
        'color'          => '#000000',
        'text-transform' => 'uppercase',
        'text-align'     => 'left',
    ],
    'transport'   => 'auto',
    'output'      => [
        [
            'element' => '.about-section-content h2',
        ],
    ],
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'typography',
    'settings'    => 'about_section_subtitle_typography',
    'label'       => esc_html__( 'Subtitle Typography', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'default'     => [
        'font-family'    => 'Roboto',
        'variant'        => '700',
        'font-size'      => '1.3rem',
        'line-height'    => '1.3',
        'letter-spacing' => '0px',
        'color'          => '#000000',
        'text-transform' => 'none',
        'text-align'     => 'left',
    ],
    'transport'   => 'auto',
    'output'      => [
        [
            'element' => '.about-section-content h4',
        ],
    ],
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'typography',
    'settings'    => 'about_section_content_typography',
    'label'       => esc_html__( 'Description Typography', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'default'     => [
        'font-family'    => 'Roboto',
        'variant'        => '300',
        'font-size'      => '1rem',
        'line-height'    => '1.4',
        'letter-spacing' => '0px',
        'color'          => '#444',
        'text-transform' => 'none',
        'text-align'     => 'left',
    ],
    'transport'   => 'auto',
    'output'      => [
        [
            'element' => '.about-section-content .author-short-text',
        ],
    ],
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'color',
    'settings'    => 'content_link_color',
    'label'       => esc_html__( 'Content Link Color', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'transport'   => 'auto',
    'default'     => '#000',
    'output'      => array(
        array(
            'element'  => '.about-section-content .author-short-text a',
            'property' => 'color',
        ),
    ),
] );

Kirki::add_field( 'author_personal_blog_config', array(
    'type'        => 'custom',
    'settings'    => 'about_settings_sep_for_social_icons_design',
    'label'       => '',
    'section'     => 'about_section_settings',
    'default'     => '<h2 class="social-design settings-section-separator">'.esc_html__('Social Icons Design', 'author-personal-blog').'</h2>',
) );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'multicolor',
    'settings'    => 'about_section_social_links_colorss',
    'label'       => esc_html__( 'Social Links Colors', 'author-personal-blog' ),
    'section'     => 'about_section_settings',
    'transport'   => 'auto',
    'choices'   => array(
            'icon_bg_color'     => esc_html__( 'Background Color', 'author-personal-blog' ),
            'icon_text_color'    => esc_html__( 'Text Color', 'author-personal-blog' ),
            'icon_bg_h_color'   => esc_html__( 'Background Hover Color', 'author-personal-blog' ),
            'icon_text_h_color'   => esc_html__( 'Text Hover Color', 'author-personal-blog' ),
        ),
    'default'   => array(
        'icon_bg_color'   => '#f1f1f1',
        'icon_text_color'  => '#000000',
        'icon_bg_h_color' => '#39b152',
        'icon_text_h_color' => '#ffffff',
    ),
    'output' => array(
        array(
            'element'  => '.about-section-social-links .social-link a',
            'property' => 'background-color',
            'choice'   => 'icon_bg_color',
        ),
        array(
            'element'  => '.about-section-social-links .social-link a',
            'property' => 'color',
            'choice'   => 'icon_text_color',
        ),
        array(
            'element'  => '.about-section-social-links .social-link a:hover, .about-section-social-links .social-link a:active',
            'property' => 'background-color',
            'choice'   => 'icon_bg_h_color',
        ),
        array(
            'element'  => '.about-section-social-links .social-link a:hover, .about-section-social-links .social-link a:active',
            'property' => 'color',
            'choice'   => 'icon_text_h_color',
        ),
    ),
] );