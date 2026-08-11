<?php
/**
 * Default theme options.
 *
 * @package school_education
 */

if ( ! function_exists( 'school_education_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function school_education_get_default_theme_options() {

		$defaults = array();

		//General Option
        $defaults['school_education_show_scroll_to_top']          = true;
        $defaults['school_education_show_preloader_setting']      = false;
        $defaults['school_education_show_data_sticky_setting']    = false;
		$defaults['school_education_enable_cursor_dot_outline'] = false;

		// Typography
		$defaults['school_education_body_font_family']         = '';
		$defaults['school_education_h1_font_family']          	= '';
		$defaults['school_education_h1_font_size']         	= '';
		$defaults['school_education_h2_font_family']          	= '';
		$defaults['school_education_h2_font_size']         	= '';
		$defaults['school_education_h3_font_family']          	= '';
		$defaults['school_education_h3_font_size']         	= '';
		$defaults['school_education_h4_font_family']          	= '';
		$defaults['school_education_h4_font_size']         	= '';
		$defaults['school_education_h5_font_family']          	= '';
		$defaults['school_education_h5_font_size']         	= '';
		$defaults['school_education_h6_font_family']          	= '';
		$defaults['school_education_h6_font_size']         	= '';

		// Site title And tagline Option

		$defaults['school_education_site_title_font_size']         = '';
		$defaults['school_education_site_tagline_font_size']         = '';
		$defaults['school_education_site_title_color'] = '#6621ba';

		// Global Color
		$defaults['school_education_first_color']          = '#6621ba';

        //Post Option
        $defaults['school_education_show_post_date_setting']         			 = true;
        $defaults['school_education_show_post_heading_setting']      			 = true;
        $defaults['school_education_show_post_content_setting']       			 = true;
        $defaults['school_education_show_post_admin_setting']         		 = true;
        $defaults['school_education_show_post_categories_setting']    		 = true;
        $defaults['school_education_show_post_comments_setting']    	 	 = true;
        $defaults['school_education_show_post_featured_image_setting']   	 = true;
        $defaults['school_education_show_post_tags_setting']    			 = true;
		$defaults['school_education_show_first_caps']      			= false;

		// Related Post
		$defaults['school_education_enable_related_post'] 					= true;
		$defaults['school_education_enable_related_post_image'] 					= true;

		// Header.
		$defaults['school_education_show_title']            = true;
		$defaults['school_education_show_tagline']          = false;
		$defaults['school_education_show_social_in_header'] = false;
		$defaults['school_education_search_in_header']      = true;

		// Layout.
		$defaults['school_education_global_layout']           = 'right-sidebar';
		$defaults['school_education_archive_layout']          = 'excerpt';
		$defaults['school_education_archive_image']           = 'large';
		$defaults['school_education_archive_image_alignment'] = 'center';
		$defaults['school_education_single_image']            = 'large';

		// Home Page.
		$defaults['school_education_home_content_status'] = true;

		// Wow Animation
        $defaults['school_education_animation'] = true;
		
		// 404 page
		$defaults['school_education_404_page_title']  = esc_html__( 'Oops! That page can&rsquo;t be found.', 'school-education' );
		$defaults['school_education_404_page_text']  = esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'school-education' );

		// No Result.
		$defaults['school_education_no_result_title']  = esc_html__( 'Nothing Found', 'school-education' );
		$defaults['school_education_no_result_text']  = esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'school-education' );

		// Footer.
		$defaults['school_education_copyright_text']        = esc_html__( 'Copyright &copy; All rights reserved.', 'school-education' );
		$defaults['school_education_copyright_text_font_size'] = '18';
		$defaults['school_education_copyright_text_align'] = 'center';
		$defaults['school_education_copyright_background_color'] = '#6621ba';
		$defaults['school_education_copyright_text_color'] = '#fff';

		// Pass through filter.
		$defaults = apply_filters( 'school_education_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;