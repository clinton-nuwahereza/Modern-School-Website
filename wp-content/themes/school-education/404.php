<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package school_education
 */

get_header(); ?>

<?php $school_education_404_page_title = school_education_get_option( 'school_education_404_page_title' ); ?>
<?php $school_education_404_page_text = school_education_get_option( 'school_education_404_page_text' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php echo esc_html($school_education_404_page_title);?></h1>
				</header>
				<div class="page-content">
					<p ><?php echo esc_html($school_education_404_page_text);?></p>
					<?php get_search_form(); ?>
				</div>
			</section>
		</main>
	</div>

<?php get_footer(); ?>