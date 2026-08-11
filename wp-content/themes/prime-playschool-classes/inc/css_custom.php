<?php

$prime_playschool_classes_custom_css = "";

$prime_playschool_classes_primary_color = get_theme_mod('prime_playschool_classes_primary_color');
$prime_playschool_classes_secondary_color = get_theme_mod('prime_playschool_classes_secondary_color');

/*------------------ Primary Global Color -----------*/

if ($prime_playschool_classes_primary_color) {
  $prime_playschool_classes_custom_css .= ':root {';
  $prime_playschool_classes_custom_css .= '--primary-color: ' . esc_attr($prime_playschool_classes_primary_color) . ' !important;';
  $prime_playschool_classes_custom_css .= '} ';
}

/*------------------ Secondary Global Color -----------*/

if ($prime_playschool_classes_secondary_color) {
  $prime_playschool_classes_custom_css .= ':root {';
  $prime_playschool_classes_custom_css .= '--secondary-color: ' . esc_attr($prime_playschool_classes_secondary_color) . ' !important;';
  $prime_playschool_classes_custom_css .= '} ';
}

/*-------------------- Single Post Alignment-------------------*/

$prime_playschool_classes_single_post_align = get_theme_mod( 'prime_playschool_classes_single_post_align','left-align');

if($prime_playschool_classes_single_post_align == 'left-align'){
$prime_playschool_classes_custom_css .='body:not(.hide-post-meta) .post{';
	$prime_playschool_classes_custom_css .='text-align: left';
$prime_playschool_classes_custom_css .='}';
}else if($prime_playschool_classes_single_post_align == 'right-align'){
$prime_playschool_classes_custom_css .='body:not(.hide-post-meta) .post{';
	$prime_playschool_classes_custom_css .='text-align: right';
$prime_playschool_classes_custom_css .='}';
}else if($prime_playschool_classes_single_post_align == 'center-align'){
$prime_playschool_classes_custom_css .='body:not(.hide-post-meta) .post{';
	$prime_playschool_classes_custom_css .='text-align: center';
$prime_playschool_classes_custom_css .='}';
}

/*-------------------- Scroll Top Alignment-------------------*/

$prime_playschool_classes_scroll_top_alignment = get_theme_mod( 'prime_playschool_classes_scroll_top_alignment','right-align');

if($prime_playschool_classes_scroll_top_alignment == 'right-align'){
$prime_playschool_classes_custom_css .='#button{';
	$prime_playschool_classes_custom_css .='right: 5%;';
$prime_playschool_classes_custom_css .='}';
}else if($prime_playschool_classes_scroll_top_alignment == 'center-align'){
$prime_playschool_classes_custom_css .='#button{';
	$prime_playschool_classes_custom_css .='right:0; left:0; margin: 0 auto;';
$prime_playschool_classes_custom_css .='}';
}else if($prime_playschool_classes_scroll_top_alignment == 'left-align'){
$prime_playschool_classes_custom_css .='#button{';
	$prime_playschool_classes_custom_css .='left: 5%;';
$prime_playschool_classes_custom_css .='}';
}

/*-------------------- Archive Page Pagination Alignment-------------------*/

$prime_playschool_classes_archive_pagination_alignment = get_theme_mod( 'prime_playschool_classes_archive_pagination_alignment','left-align');

if($prime_playschool_classes_archive_pagination_alignment == 'right-align'){
$prime_playschool_classes_custom_css .='.pagination{';
	$prime_playschool_classes_custom_css .='justify-content: end;';
$prime_playschool_classes_custom_css .='}';
}else if($prime_playschool_classes_archive_pagination_alignment == 'center-align'){
$prime_playschool_classes_custom_css .='.pagination{';
	$prime_playschool_classes_custom_css .='justify-content: center;';
$prime_playschool_classes_custom_css .='}';
}else if($prime_playschool_classes_archive_pagination_alignment == 'left-align'){
$prime_playschool_classes_custom_css .='.pagination{';
	$prime_playschool_classes_custom_css .='justify-content: start;';
$prime_playschool_classes_custom_css .='}';
}

// Scroll to top button shape 

$prime_playschool_classes_scroll_border_radius = get_theme_mod( 'prime_playschool_classes_scroll_to_top_radius','curved-box');
if($prime_playschool_classes_scroll_border_radius == 'box'){
	$prime_playschool_classes_custom_css .='#button{';
		$prime_playschool_classes_custom_css .='border-radius: 0px;';
	$prime_playschool_classes_custom_css .='}';
}else if($prime_playschool_classes_scroll_border_radius == 'curved-box'){
	$prime_playschool_classes_custom_css .='#button{';
		$prime_playschool_classes_custom_css .='border-radius: 4px;';
	$prime_playschool_classes_custom_css .='}';
}
else if($prime_playschool_classes_scroll_border_radius == 'circle'){
	$prime_playschool_classes_custom_css .='#button{';
		$prime_playschool_classes_custom_css .='border-radius: 50%;';
	$prime_playschool_classes_custom_css .='}';
}

// Footer Background Image Attatchment 

$prime_playschool_classes_footer_attatchment = get_theme_mod( 'prime_playschool_classes_background_attatchment','scroll');
if($prime_playschool_classes_footer_attatchment == 'fixed'){
	$prime_playschool_classes_custom_css .='.site-footer{';
		$prime_playschool_classes_custom_css .='background-attachment: fixed;';
	$prime_playschool_classes_custom_css .='}';
}elseif ($prime_playschool_classes_footer_attatchment == 'scroll'){
	$prime_playschool_classes_custom_css .='.site-footer{';
		$prime_playschool_classes_custom_css .='background-attachment: scroll;';
	$prime_playschool_classes_custom_css .='}';
}

// Menu Hover Style	

$prime_playschool_classes_menus_item = get_theme_mod( 'prime_playschool_classes_menus_style','None');
if($prime_playschool_classes_menus_item == 'None'){
	$prime_playschool_classes_custom_css .='#site-navigation .menu ul li a:hover, .main-navigation .menu li a:hover{';
		$prime_playschool_classes_custom_css .='';
	$prime_playschool_classes_custom_css .='}';
}else if($prime_playschool_classes_menus_item == 'Zoom In'){
	$prime_playschool_classes_custom_css .='#site-navigation .menu ul li a:hover, .main-navigation .menu li a:hover{';
		$prime_playschool_classes_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important;';
	$prime_playschool_classes_custom_css .='}';
}	
