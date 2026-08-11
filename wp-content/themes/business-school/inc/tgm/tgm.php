<?php
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function business_school_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Classic Blog Grid', 'business-school' ),
			'slug'             => 'classic-blog-grid',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'business_school_register_recommended_plugins' );