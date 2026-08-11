<?php
Kirki::add_section( 'lazy_load_control_selction', array(
    'title'          => esc_html__( 'WP Lazy Load', 'author-personal-blog' ),
    'panel'          => 'author_personal_blog_global_panel',
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'author_personal_blog_config', [
    'type'     => 'switch',
    'settings' => 'wp_lazy_load_control',
    'label'    => esc_html__( 'WordPress Lazy Enable // Disbale', 'author-personal-blog' ),
    'section'  => 'lazy_load_control_selction',
    'default'   => 0,
    'choices' => [
        'on'  => esc_html__( 'Activate', 'author-personal-blog' ),
        'off' => esc_html__( 'Deactivate', 'author-personal-blog' )
    ]
] );
