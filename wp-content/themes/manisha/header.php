<?php
/**
 * The template for displaying the header.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php do_action( 'manisha_body_schema_init' ); ?> <?php body_class(); ?>>
	<?php do_action( 'wp_body_open' ); ?>
    <div class="manisha-body-padding-content">
    	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'manisha' ); ?></a>
			<?php
			do_action( 'manisha_top_bar' );
		
			do_action( 'manisha_before_header' );

			do_action( 'manisha_header' );

			do_action( 'manisha_after_header' );
			?>
		<div id="page">
            <div id="content" class="site-content">
                <?php
                // manisha_inside_container hook.
                do_action( 'manisha_inside_container' );
