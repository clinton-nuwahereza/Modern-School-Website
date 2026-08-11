jQuery(document).ready(function(){
	
	wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {

		var counter_arr = [
		    'school_of_education_counter_section_homepage'
		];

		if( jQuery.inArray( placement.partial.id , counter_arr ) !== -1 ){

			/*-----------------------------------------------------------------------------------*/
		    /*  COUNTER UP
		    /*-----------------------------------------------------------------------------------*/
		    jQuery('.school-value').counterUp({
		        delay: 50,
		        time: 1000
		    });
			
		}

		var course_arr = [
		    'school_of_education_course_category_content_repeater'
		];

		if( jQuery.inArray( placement.partial.id , course_arr ) !== -1 ){
		
			jQuery('.partner-slider').slick({
	         	infinite: true,
	         	slidesToShow: 6,
	         	slidesToScroll: 1,
	         	swipeToSlide: true,
	         	arrows: false,
	         	dots: false,
	         	autoplay: true,
	         	speed: 2000,
	         	loop:true,
	         	responsive: [{
	             	breakpoint: 1000,
	             	settings: {
	                 	slidesToShow: 3
	             	}
	         	}, {
	             	breakpoint: 800,
	             	settings: {
	                 	slidesToShow: 3
	             	}
	         	}, {
	             	breakpoint: 500,
	             	settings: {
	                 	slidesToShow: 1
	             	}
	         	}]
	     	});

		}

		var teams = [
		    'school_of_education_teams_status_1',
		    'school_of_education_teams_status_2',
		    'school_of_education_teams_status_3',
		    'school_of_education_teams_status_4',
		    'school_of_education_teams_status_5',
		    'school_of_education_teams_status_6',
		    'school_of_education_teams_status_7',
		    'school_of_education_teams_status_8',
		    'school_of_education_teams_status_9',
		    'school_of_education_teams_status_10',
		    'school_of_education_teams_image_1',
		    'school_of_education_teams_image_2',
		    'school_of_education_teams_image_3',
		    'school_of_education_teams_image_4',
		    'school_of_education_teams_image_5',
		    'school_of_education_teams_image_6',
		    'school_of_education_teams_image_7',
		    'school_of_education_teams_image_8',
		    'school_of_education_teams_image_9',
		    'school_of_education_teams_image_10',
		    'school_of_education_teams_content_title_1',
		    'school_of_education_teams_content_title_2',
		    'school_of_education_teams_content_title_3',
		    'school_of_education_teams_content_title_4',
		    'school_of_education_teams_content_title_5',
		    'school_of_education_teams_content_title_6',
		    'school_of_education_teams_content_title_7',
		    'school_of_education_teams_content_title_8',
		    'school_of_education_teams_content_title_9',
		    'school_of_education_teams_content_title_10',
		    'school_of_education_teams_content_subtitle_1',
		    'school_of_education_teams_content_subtitle_2',
		    'school_of_education_teams_content_subtitle_3',
		    'school_of_education_teams_content_subtitle_4',
		    'school_of_education_teams_content_subtitle_5',
		    'school_of_education_teams_content_subtitle_6',
		    'school_of_education_teams_content_subtitle_7',
		    'school_of_education_teams_content_subtitle_8',
		    'school_of_education_teams_content_subtitle_9',
		    'school_of_education_teams_content_subtitle_10',
		];

		if( jQuery.inArray( placement.partial.id , teams ) !== -1 ){

			jQuery('.review-slider').slick({
		         infinite: true,
		         slidesToShow: 3,
		         slidesToScroll: 1,
		         swipeToSlide: true,
		         arrows: false,
		         dots: false,
		         rows:0,
		         autoplay: true,
		         speed: 2000,
		         loop:true,
		         responsive: [{
		             breakpoint: 800,
		             settings: {
		                 slidesToShow: 2
		             }
		         }, {
		             breakpoint: 700,
		             settings: {
		                 slidesToShow: 1
		             }
		         }]
		    });

		}

		var tesimonials = [
		    'school_of_education_testimonials_content_status_1',
		    'school_of_education_testimonials_content_status_2',
		    'school_of_education_testimonials_content_status_3',
		    'school_of_education_testimonials_content_status_4',
		    'school_of_education_testimonials_content_status_5',
		    'school_of_education_testimonials_content_status_6',
		    'school_of_education_testimonials_content_status_7',
		    'school_of_education_testimonials_content_status_8',
		    'school_of_education_testimonials_content_status_9',
		    'school_of_education_testimonials_content_status_10',
		    'school_of_education_testimonials_name_1',
		    'school_of_education_testimonials_name_2',
		    'school_of_education_testimonials_name_3',
		    'school_of_education_testimonials_name_4',
		    'school_of_education_testimonials_name_5',
		    'school_of_education_testimonials_name_6',
		    'school_of_education_testimonials_name_7',
		    'school_of_education_testimonials_name_8',
		    'school_of_education_testimonials_name_9',
		    'school_of_education_testimonials_name_10',
		    'school_of_education_testimonials_designation_1',
		    'school_of_education_testimonials_designation_2',
		    'school_of_education_testimonials_designation_3',
		    'school_of_education_testimonials_designation_4',
		    'school_of_education_testimonials_designation_5',
		    'school_of_education_testimonials_designation_6',
		    'school_of_education_testimonials_designation_7',
		    'school_of_education_testimonials_designation_8',
		    'school_of_education_testimonials_designation_9',
		    'school_of_education_testimonials_designation_10',
		    'school_of_education_testimonials_description_1',
		    'school_of_education_testimonials_description_2',
		    'school_of_education_testimonials_description_3',
		    'school_of_education_testimonials_description_4',
		    'school_of_education_testimonials_description_5',
		    'school_of_education_testimonials_description_6',
		    'school_of_education_testimonials_description_7',
		    'school_of_education_testimonials_description_8',
		    'school_of_education_testimonials_description_9',
		    'school_of_education_testimonials_description_10',
		    'school_of_education_testimonials_image_1',
		    'school_of_education_testimonials_image_2',
		    'school_of_education_testimonials_image_3',
		    'school_of_education_testimonials_image_4',
		    'school_of_education_testimonials_image_5',
		    'school_of_education_testimonials_image_6',
		    'school_of_education_testimonials_image_7',
		    'school_of_education_testimonials_image_8',
		    'school_of_education_testimonials_image_9',
		    'school_of_education_testimonials_image_10'
		];

		if( jQuery.inArray( placement.partial.id , tesimonials ) !== -1 ){

			jQuery('.testimonial-slider').slick({
		         infinite: true,
		         slidesToShow: 3,
		         slidesToScroll: 1,
		         swipeToSlide: true,
		         arrows: false,
		         dots: false,
		         rows:0,
		         autoplay: true,
		         speed: 2000,
		         loop:true,
		         responsive: [{
		             breakpoint: 800,
		             settings: {
		                 slidesToShow: 2
		             }
		         }, {
		             breakpoint: 700,
		             settings: {
		                 slidesToShow: 1
		             }
		         }]
		    });

		}

	});

});