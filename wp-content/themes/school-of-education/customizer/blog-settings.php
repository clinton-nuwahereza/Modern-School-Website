<?php

add_action( 'init' , 'school_of_education_blog_settings' );
function school_of_education_blog_settings(){

	Kirki::add_field( 'bizberg', array(
	    'type'        => 'custom',
	    'settings'    => 'school_of_education_background_animation',
	    'section'     => 'homepage',
	    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Background Animation', 'school-of-education' ) . '</div>',
	) );

	Kirki::add_field( 'bizberg', [
		'type'        => 'checkbox',
		'settings'    => 'school_of_education_background_animation_status',
		'label'       => esc_html__( 'Enable Animation', 'school-of-education' ),
		'section'     => 'homepage',
		'default'     => false,
	] );

	Kirki::add_field( 'bizberg', array(
	    'type'        => 'advanced-repeater',
	    'label'       => esc_html__( 'Circle Colors', 'school-of-education' ),
	    'section'     => 'homepage',
	    'settings'    => 'school_of_education_background_animation_colors',
	    'default'      => json_encode([
	        [
	            'circle_color' => '#3CC157',
	        ],
	        [
	            'circle_color' => '#2AA7FF',
	        ],
	        [
	            'circle_color' => '#2a58ff',
	        ],
	        [
	            'circle_color' => '#FCBC0F',
	        ],
	        [
	            'circle_color' => '#F85F36',
	        ],
	    ]),
	    'choices' => [
	        'row_label' => [
	            'value' => esc_html__( 'Color', 'school-of-education' ),
	        ],
	        'fields' => [
	        	'circle_color'  => [
	                'type'        => 'color',
	                'label'       => esc_html__( 'Circle Color', 'school-of-education' ),
	                'default'     => '#dd3333'
	            ],
	        ]
	    ],
	    'active_callback'    => array(
            array(
                'setting'  => 'school_of_education_background_animation_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
	) );

	Kirki::add_field( 'bizberg', array(
	    'type'        => 'custom',
	    'settings'    => 'school_of_education_other_blog_settings',
	    'section'     => 'homepage',
	    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Other Blog Settings', 'school-of-education' ) . '</div>',
	) );

}