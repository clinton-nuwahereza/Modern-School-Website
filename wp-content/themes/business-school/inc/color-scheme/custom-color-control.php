<?php

$business_school_first_color = get_theme_mod('business_school_first_color');
$business_school_second_color = get_theme_mod('business_school_second_color');
$business_school_color_scheme_css = '';

/*------------------ Global First Color -----------*/

if ($business_school_first_color) {
  $business_school_color_scheme_css .= ':root {';
  $business_school_color_scheme_css .= '--first-theme-color: ' . esc_attr($business_school_first_color) . ' !important;';
  $business_school_color_scheme_css .= '} ';
}

/*------------------ Global Second Color -----------*/

if ($business_school_second_color) {
  $business_school_color_scheme_css .= ':root {';
  $business_school_color_scheme_css .= '--second-theme-color: ' . esc_attr($business_school_second_color) . ' !important;';
  $business_school_color_scheme_css .= '} ';
}

//---------------------------------Logo-Max-height--------- 
$business_school_logo_width = get_theme_mod('business_school_logo_width');

if($business_school_logo_width != false){

  $business_school_color_scheme_css .='.logo img{';

    $business_school_color_scheme_css .='width: '.esc_html($business_school_logo_width).'px;';

  $business_school_color_scheme_css .='}';
}

  // slider hide css
$business_school_slider = get_theme_mod( 'business_school_slider', false);
$business_school_catData = get_theme_mod('business_school_slider_cat');
if($business_school_slider != true || $business_school_catData != true){
  $business_school_color_scheme_css .='.page-template-template-home-page .mainhead{';
    $business_school_color_scheme_css .='position:static; background-color: var(--first-theme-color);';
  $business_school_color_scheme_css .='}';
  $business_school_color_scheme_css .='.page-template-template-home-page .logo:after{';
  $business_school_color_scheme_css .='content:none !important;';
  $business_school_color_scheme_css .='}';
  $business_school_color_scheme_css .='.page-template-template-home-page .menubox, .page-template-template-home-page .logo-col{';
    $business_school_color_scheme_css .='align-self:center;';
  $business_school_color_scheme_css .='}';
}

/*--------------------------- Footer Background Color -------------------*/

  $business_school_footer_bg_color = get_theme_mod('business_school_footer_bg_color');
  if($business_school_footer_bg_color != false){
      $business_school_color_scheme_css .='.footer-widget{';
          $business_school_color_scheme_css .='background-color: '.esc_attr($business_school_footer_bg_color).' !important;';
      $business_school_color_scheme_css .='}';
  }

/*--------------------------- Scroll to top positions -------------------*/

 $business_school_scroll_position = get_theme_mod( 'business_school_scroll_position','Right');
 if($business_school_scroll_position == 'Right'){
     $business_school_color_scheme_css .='#button{';
         $business_school_color_scheme_css .='right: 20px;';
     $business_school_color_scheme_css .='}';
 }else if($business_school_scroll_position == 'Left'){
     $business_school_color_scheme_css .='#button{';
         $business_school_color_scheme_css .='left: 20px;';
     $business_school_color_scheme_css .='}';
 }else if($business_school_scroll_position == 'Center'){
     $business_school_color_scheme_css .='#button{';
         $business_school_color_scheme_css .='right: 50%;left: 50%;';
     $business_school_color_scheme_css .='}';
 }  

/*--------------------------- Woocommerce Product Sale Position -------------------*/    

$business_school_product_sale_position = get_theme_mod( 'business_school_product_sale_position','Left');
if($business_school_product_sale_position == 'Right'){
    $business_school_color_scheme_css .='.woocommerce ul.products li.product .onsale{';
        $business_school_color_scheme_css .='left:auto !important; right:.5em !important;';
    $business_school_color_scheme_css .='}';
}else if($business_school_product_sale_position == 'Left'){
    $business_school_color_scheme_css .='.woocommerce ul.products li.product .onsale {';
        $business_school_color_scheme_css .='right:auto !important; left:.5em !important;';
    $business_school_color_scheme_css .='}';
}   

/*--------------------------- Woocommerce Shop page pagination -------------------*/

$business_school_wooproducts_nav = get_theme_mod('business_school_wooproducts_nav', 'Yes');
if($business_school_wooproducts_nav == 'No'){
  $business_school_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
    $business_school_color_scheme_css .='display: none;';
  $business_school_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Related Product -------------------*/

$business_school_related_product_enable = get_theme_mod('business_school_related_product_enable',true);
if($business_school_related_product_enable == false){
  $business_school_color_scheme_css .='.related.products{';
    $business_school_color_scheme_css .='display: none;';
  $business_school_color_scheme_css .='}';
}     

/*--------------------------- Woocommerce Product Image Border Radius -------------------*/

$business_school_woo_product_img_border_radius = get_theme_mod('business_school_woo_product_img_border_radius');
if($business_school_woo_product_img_border_radius != false){
    $business_school_color_scheme_css .='.woocommerce ul.products li.product a img{';
        $business_school_color_scheme_css .='border-radius: '.esc_attr($business_school_woo_product_img_border_radius).'px;';
    $business_school_color_scheme_css .='}';
}

/*--------------------------- Footer background image -------------------*/

$business_school_footer_bg_image = get_theme_mod('business_school_footer_bg_image');
if($business_school_footer_bg_image != false){
    $business_school_color_scheme_css .='#footer{';
        $business_school_color_scheme_css .='background: url('.esc_attr($business_school_footer_bg_image).');';
        $business_school_color_scheme_css .= 'background-size: cover;';  
    $business_school_color_scheme_css .='}';
}

/*--------------------------- Footer image position -------------------*/

$business_school_footer_img_position = get_theme_mod('business_school_footer_img_position','center center');
if($business_school_footer_img_position != false){
    $business_school_color_scheme_css .='#footer{';
        $business_school_color_scheme_css .='background-position: '.esc_attr($business_school_footer_img_position).';';
    $business_school_color_scheme_css .='}';
}	

/*--------------------------- Scroll to Top Button Shape -------------------*/

$business_school_scroll_top_shape = get_theme_mod('business_school_scroll_top_shape', 'circle');
if($business_school_scroll_top_shape == 'box' ){
    $business_school_color_scheme_css .='#button{';
        $business_school_color_scheme_css .=' border-radius: 0%';
    $business_school_color_scheme_css .='}';
}elseif($business_school_scroll_top_shape == 'curved' ){
    $business_school_color_scheme_css .='#button{';
        $business_school_color_scheme_css .=' border-radius: 20%';
    $business_school_color_scheme_css .='}';
}elseif($business_school_scroll_top_shape == 'circle' ){
    $business_school_color_scheme_css .='#button{';
        $business_school_color_scheme_css .=' border-radius: 50%;';
    $business_school_color_scheme_css .='}';
}

/*--------------------------- Menu Typography -------------------*/

$business_school_theme_lay = get_theme_mod( 'business_school_menu_text_transform','Capitalize');
if($business_school_theme_lay == 'Uppercase'){
    $business_school_color_scheme_css .='.main-nav a{';
        $business_school_color_scheme_css .='text-transform: uppercase;';
    $business_school_color_scheme_css .='}';
}else if($business_school_theme_lay == 'Lowercase'){
    $business_school_color_scheme_css .='.main-nav a{';
        $business_school_color_scheme_css .='text-transform: lowercase;';
    $business_school_color_scheme_css .='}';
}
else if($business_school_theme_lay == 'Capitalize'){
    $business_school_color_scheme_css .='.main-nav a{';
        $business_school_color_scheme_css .='text-transform: capitalize;';
    $business_school_color_scheme_css .='}';
}