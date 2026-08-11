<?php
/**
 * The template for displaying posts within the loop.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="inside-article">
    	<div class="article-holder">
		<?php
		// manisha_before_content hook.
		do_action( 'manisha_before_content' );
		?>

		<header class="entry-header">
			<?php
			// manisha_before_entry_title hook.
			do_action( 'manisha_before_entry_title' );

			the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			// manisha_after_entry_title hook.
			do_action( 'manisha_after_entry_title' );
			?>
		</header><!-- .entry-header -->

		<?php
		// manisha_after_entry_header hook.
		do_action( 'manisha_after_entry_header' ); ?>

			<div class="entry-content" itemprop="text">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'manisha' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->

		<?php 

		// manisha_after_entry_content hook.
		do_action( 'manisha_after_entry_content' );

		// manisha_after_content hook.
		do_action( 'manisha_after_content' );
		?>
        </div>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
