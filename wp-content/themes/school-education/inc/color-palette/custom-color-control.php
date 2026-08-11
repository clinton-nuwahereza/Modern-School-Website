<?php

  $school_education_color_palette_css = '';

	// Global Color

	$school_education_first_color = school_education_get_option('school_education_first_color', '#6621ba' );

	if($school_education_first_color != false){
		$school_education_color_palette_css .=':root {';
			$school_education_color_palette_css .='--primary-color: '.esc_attr($school_education_first_color).'!important;';
		$school_education_color_palette_css .='}';
	}

	$school_education_color_palette_css .='}';

  /*-------------- Copyright Text Align-------------------*/

	$school_education_copyright_text_align = school_education_get_option('school_education_copyright_text_align');
	$school_education_color_palette_css .='.site-footer{';
	$school_education_color_palette_css .='text-align: '.esc_attr($school_education_copyright_text_align).' !important;';
	$school_education_color_palette_css .='}';
	$school_education_color_palette_css .='
	@media screen and (max-width:575px) {
	.site-footer{';
	$school_education_color_palette_css .='text-align: center !important;';
	$school_education_color_palette_css .='} }';

  // copyright font size
	$school_education_copyright_text_font_size = school_education_get_option('school_education_copyright_text_font_size');
	$school_education_color_palette_css .='#colophon p, #colophon a , #colophon{';
	$school_education_color_palette_css .='font-size: '.esc_attr($school_education_copyright_text_font_size).'px;';
	$school_education_color_palette_css .='}';

	// Copyright Background Color
	$school_education_copyright_background_color = school_education_get_option('school_education_copyright_background_color');
	$school_education_color_palette_css .='#colophon {';
	$school_education_color_palette_css .='background: '.esc_attr($school_education_copyright_background_color);
	$school_education_color_palette_css .='}';

	// Copyright Text Color
	$school_education_copyright_text_color = school_education_get_option('school_education_copyright_text_color');
	$school_education_color_palette_css .='#colophon a , #colophon{';
	$school_education_color_palette_css .='color: '.esc_attr($school_education_copyright_text_color);
	$school_education_color_palette_css .='}';	

	// Site title And tagline Option
	$school_education_site_title_font_size = school_education_get_option('school_education_site_title_font_size');
	$school_education_site_title_color = school_education_get_option('school_education_site_title_color');
	$school_education_color_palette_css .='.site-title>a , .site-title {';
		$school_education_color_palette_css .='font-size: '.esc_attr($school_education_site_title_font_size).'px;';
		$school_education_color_palette_css .='color: '.esc_attr($school_education_site_title_color).';';
	$school_education_color_palette_css .='}';
	
	$school_education_site_tagline_font_size = school_education_get_option('school_education_site_tagline_font_size');
	if($school_education_site_tagline_font_size != false){
		$school_education_color_palette_css .='.site-description {';
			$school_education_color_palette_css .='font-size: '.esc_attr($school_education_site_tagline_font_size).'px;';
		$school_education_color_palette_css .='}';
	}

	//First Cap
	$school_education_show_first_caps = school_education_get_option('school_education_show_first_caps', false);
	if($school_education_show_first_caps == 'true' ){
	$school_education_color_palette_css .='.blog-content .text-content p:nth-of-type(1)::first-letter{';
	$school_education_color_palette_css .=' font-size: 50px; font-weight: 600;';
	$school_education_color_palette_css .=' margin-right: 5px;';
	$school_education_color_palette_css .=' line-height: 1;';
	$school_education_color_palette_css .='}';
	}elseif($school_education_show_first_caps == 'false' ){
	$school_education_color_palette_css .='.blog-content .text-content p:nth-of-type(1)::first-letter {';
	$school_education_color_palette_css .='display: none;';
	$school_education_color_palette_css .='}';
	}

	// preloader background image
	$school_education_show_preloader_background_image = school_education_get_option('school_education_show_preloader_background_image');
	if($school_education_show_preloader_background_image != false){
		$school_education_color_palette_css .='#preloader {';
			$school_education_color_palette_css .='background: url('.esc_attr($school_education_show_preloader_background_image).');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
		$school_education_color_palette_css .='}';
	}