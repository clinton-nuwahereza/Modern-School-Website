<?php
/**
 * Header elements.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'manisha_construct_header' ) ) {
	add_action( 'manisha_header', 'manisha_construct_header' );
	// Build the header.
	function manisha_construct_header() {
		
		do_action( 'manisha_before_header_content' );

		do_action( 'manisha_default_header' );
		
		do_action( 'manisha_header_content' );

		do_action( 'manisha_after_header_content' );
		
	}
}

// Add Footer template part
add_action( 'manisha_footer_widgets', 'manisha_add_footer_widgets' );
if ( ! function_exists( 'manisha_add_footer_widgets' ) ) {
	// Add the template part
	function manisha_add_footer_widgets() {
		block_template_part( 'footer' );
	}
}

// Build before header content
add_action( 'manisha_default_header', 'manisha_build_default_header' );
if ( ! function_exists( 'manisha_build_default_header' ) ) {
	// Build the header.
	function manisha_build_default_header() {
		?>
        <div class="site-header-holder site-default-header nav-float-right">
			<header class="site-header has-inline-mobile-toggle" id="masthead">
				<div class="inside-header">
					<div class="site-branding-container">
						<div class="site-branding">
							<h1 class="main-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
							</h1>
						</div>
					</div>
					<nav id="site-navigation" class="main-navigation sub-menu-right">
						<div class="inside-navigation grid-parent">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'container' => 'div',
									'container_class' => 'main-nav',
									'container_id' => 'primary-menu',
									'menu_class' => '',
									'fallback_cb' => 'manisha_menu_fallback',
									'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								)
							);
							?>
						</div>
					</nav>
				</div>
			</header>
        </div>
        <?php
	}
}

// Menu fallback.
if ( ! function_exists( 'manisha_menu_fallback' ) ) {
	function manisha_menu_fallback( $args ) {
		?>
		<div id="primary-menu" class="main-nav">
			<ul>
				<?php
				$args = array(
					'sort_column' => 'menu_order',
					'title_li' => '',
				);

				wp_list_pages( $args );
				?>
			</ul>
		</div>
		<?php
	}
}