<?php
/**
 * 
 *
 * Template Name: Full width template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eyepress
 */
$eyepress_sidebar_page = get_theme_mod( 'eyepress_sidebar_page','no-sidebar');

get_header();
?>
<?php if(!is_front_page()): ?>
<!-- Header Space Start -->
	<div class="header-space eyepress-overlay dark-5">
		<img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/bg/header.jpg'); ?>" alt="<?php esc_attr_e( 'blog banner', 'eyepress') ?>">
	</div>
<!-- Header Space End -->
<?php endif; ?>
	<div id="primary" class="content-area blog-details template-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<main id="main" class="site-main">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div> <!-- #primary -->
							
			</div>
		</div>
	</div>
<?php
get_footer();