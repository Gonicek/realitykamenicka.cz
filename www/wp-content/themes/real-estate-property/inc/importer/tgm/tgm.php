<?php require get_template_directory() . '/inc/importer/tgm/class-tgm-plugin-activation.php';

function real_estate_property_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'real-estate-property' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'real_estate_property_register_recommended_plugins' );