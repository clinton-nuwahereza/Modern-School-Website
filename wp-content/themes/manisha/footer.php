<?php
/**
 * The template for displaying the footer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
            </div><!-- #content -->
		</div><!-- #page -->
        
        <?php
        // manisha_before_footer hook.
        do_action( 'manisha_before_footer' );
        ?>

        <div <?php do_action( 'manisha_footer_class_init' ); ?>>
            <?php
            // manisha_before_footer_content hook.
            do_action( 'manisha_before_footer_content' );
        
			do_action( 'manisha_footer_widgets' );
		
			// manisha_after_footer_widgets hook.
			do_action( 'manisha_after_footer_widgets' );
			
			// manisha_footer hook.
            do_action( 'manisha_footer' );
        
            // manisha_after_footer_content hook.
            do_action( 'manisha_after_footer_content' );
            ?>
        </div><!-- .site-footer -->
        
        <?php
        // manisha_after_footer hook.
        do_action( 'manisha_after_footer' );
        ?>
	</div><!-- .manisha-body-padding-content -->
	<?php wp_footer(); ?>
</body>
</html>
