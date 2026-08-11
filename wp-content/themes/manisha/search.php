<?php
/**
 * The template for displaying Search Results pages.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php do_action( 'manisha_content_class_init' ); ?>>
		<main id="main" <?php do_action( 'manisha_main_class_init' ); ?>>
			<?php
			// manisha_before_main_content hook.
			do_action( 'manisha_before_main_content' );

			block_template_part( 'search' );

			// manisha_after_main_content hook.
			do_action( 'manisha_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	// manisha_after_primary_content_area hook.
	 do_action( 'manisha_after_primary_content_area' );

get_footer();
