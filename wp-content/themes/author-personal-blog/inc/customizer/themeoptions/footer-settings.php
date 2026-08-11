<?php
Kirki::add_section( 'footer_section_settings', array(
    'title'          => esc_html__( 'Footer Settings', 'author-personal-blog' ),
    'panel'          => 'author_personal_blog_global_panel',
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'switch',
    'settings'    => 'show_footer_social_links',
    'label'       => esc_html__( 'Show Footer Social Links', 'author-personal-blog' ),
    'section'     => 'footer_section_settings',
    'default'     => '0',
    'choices'     => [
        'on'  => esc_html__( 'Show', 'author-personal-blog' ),
        'off' => esc_html__( 'Hide', 'author-personal-blog' ),
    ],
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'color',
    'settings'    => 'footer_bg_color',
    'label'       => __( 'Footer Background Color', 'author-personal-blog' ),
    'section'     => 'footer_section_settings',
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
    'settings'    => 'footer_br_color',
    'label'       => __( 'Footer Border Color', 'author-personal-blog' ),
    'section'     => 'footer_section_settings',
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
    'type'        => 'custom',
    'settings'    => 'footer_style_before',
    'section'     => 'footer_section_settings',
    'default'         => '<hr><hr>',
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'typography',
    'settings'    => 'footer_menu_link_color',
    'label'       => esc_html__( 'Footer Menu Color', 'author-personal-blog' ),
    'section'     => 'footer_section_settings',
    'default'     => [
        'font-family'    => 'Roboto',
        'variant'        => '700',
        'font-size'      => '1rem',
        'line-height'    => '1.4',
        'letter-spacing' => '0px',
        'color'          => '#000000',
        'text-transform' => 'none',
        'text-align'     => 'left',
    ],
    'transport'   => 'auto',
    'output'      => [
        [
            'element' => '.footer-menu ul.menu li a',
        ],
    ],
] );

Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'color',
    'settings'    => 'footer_menu_link_hover_color',
    'label'       => __( 'Link Hover Color', 'author-personal-blog' ),
    'section'     => 'footer_section_settings',
    'default'     => '#fb4747',
    'choices'     => [
        'alpha' => true,
    ],
    'transport'   => 'auto',
    'output' => array(
        array(
            'element'  => '.footer-menu ul.menu li a:hover',
            'property' => 'color',
        ),
    ),
] );
Kirki::add_field( 'author_personal_blog_config', [
    'type'        => 'typography',
    'settings'    => 'copyright_text_typo',
    'label'       => esc_html__( 'Copyright Typography', 'author-personal-blog' ),
    'section'     => 'footer_section_settings',
    'default'     => [
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '1rem',
        'line-height'    => '1.4',
        'letter-spacing' => '0px',
        'color'          => '#000000',
        'text-transform' => 'none',
        'text-align'     => 'center',
    ],
    'transport'   => 'auto',
    'output'      => [
        [
            'element' => '.site-copyright-text',
        ],
    ],
] );