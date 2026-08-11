<?php

add_action( 'init', 'school_of_education_featured_posts' );
function school_of_education_featured_posts(){

	Kirki::add_section( 'school_of_education_featured_posts_section', array(
        'title'     => esc_html__( 'Featured Posts', 'school-of-education' ),
        'section'   => 'homepage'
    ) );
    
    Kirki::add_field( 'bizberg', [
		'type'        => 'checkbox',
		'settings'    => 'featured_post_status',
		'label'       => esc_html__( 'Enable / Disable', 'school-of-education' ),
		'section'     => 'school_of_education_featured_posts_section',
		'default'     => false,
	] );

    Kirki::add_field( 'bizberg', [
        'type'        => 'custom',
        'settings'    => 'school_of_education_title_options',
        'section'     => 'school_of_education_featured_posts_section',
        'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Title Options', 'school-of-education' ) . '</div>',
        'active_callback'    => array(
            array(
                'setting'  => 'featured_post_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
    ] );

    Kirki::add_field( 'bizberg', [
		'type'     => 'text',
		'settings' => 'featured_post_title',
		'label'    => esc_html__( 'Title', 'school-of-education' ),
		'section'  => 'school_of_education_featured_posts_section',
		'default'  => esc_html__( 'Featured Blog Posts', 'school-of-education' ),
		'active_callback' => [
			[
				'setting'  => 'featured_post_status',
				'operator' => '==',
				'value'    => true,
			]
		],
	] );

	Kirki::add_field( 'bizberg', [
        'type'        => 'typography',
        'settings'    => 'featured_post_title_font_family',
        'label'       => esc_html__( 'Title Font', 'school-of-education' ),
        'section'     => 'school_of_education_featured_posts_section',
        'default'     => [
            'font-family'    => 'Poppins',
            'variant'        => '700',
            'font-size'      => '40px',
            'line-height'    => '1.5',
            'letter-spacing' => '0',
            'text-transform' => 'none',
            'color'          => '#00b6c7'
        ],
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body .featured-post h2.featured_title',
            ],
        ],
        'active_callback'    => array(
            array(
                'setting'  => 'featured_post_status',
                'operator' => '==',
                'value'    => true
            )
        )
    ] );

    Kirki::add_field( 'bizberg', [
        'type'        => 'custom',
        'settings'    => 'school_of_education_subtitle_options',
        'section'     => 'school_of_education_featured_posts_section',
        'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Subtitle Options', 'school-of-education' ) . '</div>',
        'active_callback'    => array(
            array(
                'setting'  => 'featured_post_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
    ] );

    Kirki::add_field( 'bizberg', [
		'type'     => 'text',
		'settings' => 'featured_post_subtitle',
		'label'    => esc_html__( 'Subtitle', 'school-of-education' ),
		'section'  => 'school_of_education_featured_posts_section',
		'default'  => esc_html__( 'Lorem ipsum dolor', 'school-of-education' ),
		'active_callback' => [
			[
				'setting'  => 'featured_post_status',
				'operator' => '==',
				'value'    => true,
			]
		],
	] );

	Kirki::add_field( 'bizberg', [
        'type'        => 'typography',
        'settings'    => 'featured_post_subtitle_font_family',
        'label'       => esc_html__( 'Subtitle Font', 'school-of-education' ),
        'section'     => 'school_of_education_featured_posts_section',
        'default'     => [
            'font-family'    => 'Crimson Text',
            'variant'        => 'italic',
            'font-size'      => '20px',
            'line-height'    => '1',
            'letter-spacing' => '0',
            'text-transform' => 'none',
            'color'          => '#999999'
        ],
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.featured-post p.subtitle',
            ],
        ],
        'active_callback'    => array(
            array(
                'setting'  => 'featured_post_status',
                'operator' => '==',
                'value'    => true
            )
        )
    ] );

    Kirki::add_field( 'bizberg', [
        'type'        => 'custom',
        'settings'    => 'school_of_education_conference_content_options',
        'section'     => 'school_of_education_featured_posts_section',
        'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Content Options', 'school-of-education' ) . '</div>',
        'active_callback'    => array(
            array(
                'setting'  => 'featured_post_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
    ] );

    Kirki::add_field( 'bizberg', array(
        'type'        => 'select',
        'settings'    => 'school_of_education_featured_category',
        'label'       => esc_html__( 'Select Post Category', 'school-of-education' ),
        'section'     => 'school_of_education_featured_posts_section',
        'multiple'    => 1,
        'choices'     => bizberg_get_post_categories(),
        'active_callback'    => array(
            array(
                'setting'  => 'featured_post_status',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    ) );

    Kirki::add_field( 'bizberg', [
        'type'        => 'typography',
        'settings'    => 'featured_post_date_font_family',
        'label'       => esc_html__( 'Date Font', 'school-of-education' ),
        'section'     => 'school_of_education_featured_posts_section',
        'default'     => [
            'font-family'    => 'Crimson Text',
            'variant'        => 'italic',
            'font-size'      => '16px',
            'line-height'    => '1',
            'letter-spacing' => '0',
            'text-transform' => 'none',
            'color'          => '#878787'
        ],
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.featured-post .featured-post-content .featured-date',
            ],
        ],
        'active_callback'    => array(
            array(
                'setting'  => 'featured_post_status',
                'operator' => '==',
                'value'    => true
            )
        )
    ] );

    Kirki::add_field( 'bizberg', [
        'type'        => 'typography',
        'settings'    => 'featured_post_post_title_font_family',
        'label'       => esc_html__( 'Title Font', 'school-of-education' ),
        'section'     => 'school_of_education_featured_posts_section',
        'default'     => [
            'font-family'    => 'Poppins',
            'variant'        => '500',
            'font-size'      => '20px',
            'line-height'    => '1.2',
            'letter-spacing' => '0',
            'text-transform' => 'none'
        ],
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body .featured-post .featured-post-content h4.title',
            ],
        ],
        'active_callback'    => array(
            array(
                'setting'  => 'featured_post_status',
                'operator' => '==',
                'value'    => true
            )
        )
    ] );

}