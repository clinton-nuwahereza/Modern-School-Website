<?php
/**
 * Block Styles
 *
 * @package fse_education_school
 * @since 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	function fse_education_school_register_block_styles() {

		//Wp Block Padding Zero
		register_block_style(
			'core/group',
			array(
				'name'  => 'fse-education-school-padding-0',
				'label' => esc_html__( 'No Padding', 'fse-education-school' ),
			)
		);

		//Wp Block Post Author Style
		register_block_style(
			'core/post-author',
			array(
				'name'  => 'fse-education-school-post-author-card',
				'label' => esc_html__( 'Theme Style', 'fse-education-school' ),
			)
		);

		//Wp Block Button Style
		register_block_style(
			'core/button',
			array(
				'name'         => 'fse-education-school-button',
				'label'        => esc_html__( 'Plain', 'fse-education-school' ),
			)
		);

		//Post Comments Style
		register_block_style(
			'core/post-comments',
			array(
				'name'         => 'fse-education-school-post-comments',
				'label'        => esc_html__( 'Theme Style', 'fse-education-school' ),
			)
		);

		//Latest Comments Style
		register_block_style(
			'core/latest-comments',
			array(
				'name'         => 'fse-education-school-latest-comments',
				'label'        => esc_html__( 'Theme Style', 'fse-education-school' ),
			)
		);


		//Wp Block Table Style
		register_block_style(
			'core/table',
			array(
				'name'         => 'fse-education-school-wp-table',
				'label'        => esc_html__( 'Theme Style', 'fse-education-school' ),
			)
		);


		//Wp Block Pre Style
		register_block_style(
			'core/preformatted',
			array(
				'name'         => 'fse-education-school-wp-preformatted',
				'label'        => esc_html__( 'Theme Style', 'fse-education-school' ),
			)
		);

		//Wp Block Verse Style
		register_block_style(
			'core/verse',
			array(
				'name'         => 'fse-education-school-wp-verse',
				'label'        => esc_html__( 'Theme Style', 'fse-education-school' ),
			)
		);
	}
	add_action( 'init', 'fse_education_school_register_block_styles' );
}
