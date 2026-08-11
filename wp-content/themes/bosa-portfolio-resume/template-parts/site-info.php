<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Portfolio Resume 1.0.0
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-portfolio-resume' ) ) );
		echo esc_html( date( 'Y' ) . ' ' . get_bloginfo( 'name' ) );
		echo esc_html__( '. Powered by', 'bosa-portfolio-resume' );
	?>
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bosa-portfolio-resume' ) ); ?>" target="_blank">
		<?php
			printf( esc_html__( 'WordPress', 'bosa-portfolio-resume' ) );
		?>
	</a>
</div><!-- .site-info -->