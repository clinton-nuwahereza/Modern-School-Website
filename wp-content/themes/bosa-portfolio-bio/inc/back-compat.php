<?php
/**
 * Bosa Portfolio Bio back compat functionality
 *
 * Prevents Bosa Portfolio Bio from running on WordPress versions prior to 5.0,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 5.0.
 *
 * @since Bosa Portfolio Bio 1.0.0
 */

/**
 * Prevent switching to Bosa Portfolio Bio on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Bosa Portfolio Bio 1.0.0
 */
function bosa_portfolio_bio_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'bosa_portfolio_bio_upgrade_notice' );
}
add_action( 'after_switch_theme', 'bosa_portfolio_bio_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Bosa Portfolio Bio on WordPress versions prior to 5.0.
 *
 * @since Bosa Portfolio Bio 1.0.0
 * @global string $wp_version WordPress version.
 */
function bosa_portfolio_bio_upgrade_notice() {
	/* translators: %s - WordPress version*/
	$message = sprintf( esc_html__( 'Bosa Portfolio Bio requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'bosa-portfolio-bio' ),  $GLOBALS['wp_version'] ) ;
	printf( '<div class="error"><p>%s</p></div>', $message ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 5.0.
 *
 * @since Bosa Portfolio Bio 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function bosa_portfolio_bio_customize() {
	/* translators: %s - WordPress version*/
	wp_die( sprintf( esc_html__( 'Bosa Portfolio Bio requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'bosa-portfolio-bio' ), esc_html($GLOBALS['wp_version'] ) ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'bosa_portfolio_bio_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 5.0.
 *
 * @since Bosa Portfolio Bio 1.0.0
 * @global string $wp_version WordPress version.
 */
function bosa_portfolio_bio_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s - WordPress version*/
		wp_die( sprintf( esc_html__( 'Bosa Portfolio Bio requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'bosa-portfolio-bio' ), esc_html( $GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'bosa_portfolio_bio_preview' );
