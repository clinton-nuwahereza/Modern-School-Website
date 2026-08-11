<?php require get_template_directory() . '/theme-wizard/tgm/class-tgm-plugin-activation.php';

function prime_playschool_classes_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Classic Widgets', 'prime-playschool-classes' ),
			'slug'             => 'classic-widgets',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'prime_playschool_classes_register_recommended_plugins' );