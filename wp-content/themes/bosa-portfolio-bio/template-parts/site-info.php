<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Portfolio Bio
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-portfolio-bio' ) ) );
		echo esc_html( date( 'Y' ) . ' ' . get_bloginfo( 'name' ) );
		echo esc_html__( '. Powered by', 'bosa-portfolio-bio' );
	?>
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bosa-portfolio-bio' ) ); ?>" target="_blank">
		<?php
			printf( esc_html__( 'WordPress', 'bosa-portfolio-bio' ) );
		?>
	</a>
</div><!-- .site-info -->