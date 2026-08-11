<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Author Personal Blog
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'author-personal-blog' ); ?></a>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	?>
<div id="page" class="site">
	<div class="progress-bar-wrapper">
		<div class="progress-bar">
		  <div class="progress-bar-fill"></div>
		  <div class="progress-bar-percentage">0%</div>
		  <div class="progress-bar-text">Still working...</div>
		</div>
	</div>

<?php
get_template_part( 'template-parts/header/header', 'one' );
?>
<div id="content" class="site-content">
