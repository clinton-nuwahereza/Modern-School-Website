<?php
Kirki::add_section( 'social_links_settings_section', array(
    'title'          => esc_html__( 'Social Links Settings', 'author-personal-blog' ),
    'panel'          => 'author_personal_blog_global_panel',
    'capability'     => 'edit_theme_options',
) );

$social_media_fields = array(
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'instagram' => 'Instagram',
    'tiktok' => 'Tiktok',
    'linkedin' => 'Linkedin',
    'pinterest' => 'Pinterest',
    'line' => 'Line',
    'github' => 'Github',
    'discord' => 'Discord',
    'youtube' => 'Youtube',
    'wordpress' => 'WordPress',
    'slack' => 'Slack',
    'apple' => 'Apple',
    'stack-overflow' => 'Stack-overflow',
    'kickstarer' => 'Kickstarer',
    'dribble' => 'Dribble',
    'codepen' => 'Codepen',
    'whatsapp' => 'Whatsapp',
    'medium' => 'Medium',
    'goodreads-g' => 'Goodreads'
);

foreach ( $social_media_fields as $field => $label ) {
    Kirki::add_field( 'author_personal_blog_config', array(
        'type' => 'text',
        'settings' => $field,
        'label' => $label . ' URL',
        'section' => 'social_links_settings_section',
        'default' => '#',
    ) );
}
