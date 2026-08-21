<?php
/**
 * real-estate-property Theme Customizer.
 *
 * @package real-estate-property
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function real_estate_property_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting('custom_logo')->transport = 'refresh';	
}
add_action( 'customize_register', 'real_estate_property_customize_register' );

if ( ! defined( 'REAL_ESTATE_PROPERTY_BUY_NOW_1' ) ) {
define('REAL_ESTATE_PROPERTY_BUY_NOW_1',__('https://www.mishkatwp.com/themes/property-wordpress-theme/','real-estate-property'));
}

if ( ! defined( 'REAL_ESTATE_PROPERTY_BUNDLE_1' ) ) {
define('REAL_ESTATE_PROPERTY_BUNDLE_1',__('https://www.mishkatwp.com/themes/wordpress-theme-bundle/','real-estate-property'));
}


if ( class_exists("Kirki")){

	/* Logo */

	/* Logo Size limit Option End */
	new \Kirki\Field\Slider(
		[
			'settings'    => 'real_estate_property_logo_resizer_setting',
			'label'       => esc_html__( 'Logo Size Limit', 'real-estate-property' ),
			'section'     => 'title_tagline',
			'default'     => 70,
			'choices'     => [
				'min'  => 10,
				'max'  => 300,
				'step' => 10,
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_site_title_setting',
			'label'       => esc_html__( 'Site Title On / Off', 'real-estate-property' ),
			'section'     => 'title_tagline',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_tagline_setting',
			'label'       => esc_html__( 'Tagline On / Off', 'real-estate-property' ),
			'section'     => 'title_tagline',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'title_tagline',
    ] );

	/* Logo End */

	/* Typography Section */

	new \Kirki\Section(
		'real_estate_property_theme_typography_section',
		[
			'title'       => esc_html__( 'Theme Typography', 'real-estate-property' ),
			'description' => esc_html__( 'Here you can customize Heading or other body text font settings', 'real-estate-property' ),
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'real_estate_property_all_headings_typography',
		'section'     => 'real_estate_property_theme_typography_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading Of All Sections',  'real-estate-property' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'real_estate_property_all_headings_typography',
		'label'       => esc_html__( 'Heading Typography',  'real-estate-property' ),
		'description' => esc_html__( 'Select the typography options for your heading.',  'real-estate-property' ),
		'section'     => 'real_estate_property_theme_typography_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'h1','h2','h3','h4','h5','h6', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'real_estate_property_body_content_typography',
		'section'     => 'real_estate_property_theme_typography_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Body Content',  'real-estate-property' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'real_estate_property_body_content_typography',
		'label'       => esc_html__( 'Content Typography',  'real-estate-property' ),
		'description' => esc_html__( 'Select the typography options for your content.',  'real-estate-property' ),
		'section'     => 'real_estate_property_theme_typography_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'body', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_theme_typography_section',
    ] );

    /* End Typography */

        /* Woocommerce Section */

	new \Kirki\Section(
		'real_estate_property_theme_product_sidebar',
		[
			'title'       => esc_html__( 'Woocommerce Sidebars', 'real-estate-property' ),
			'description' => esc_html__( 'Here you can change woocommerce sidebar', 'real-estate-property' ),
			'panel' =>'woocommerce',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Select(
		[
			'settings'    => 'real_estate_property_product_sidebar_position',
			'label'       => esc_html__( 'Sidebar Option', 'real-estate-property' ),
			'section'     => 'real_estate_property_theme_product_sidebar',
			'default'     => 'right',
			'choices'     => [
				'left' => esc_html__( 'Left Sidebar', 'real-estate-property' ),
				'right' => esc_html__( 'Right Sidebar', 'real-estate-property' ),
				'none' => esc_html__( 'No Sidebar', 'real-estate-property' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_theme_product_sidebar',
    ] );

    /* Woocommerce Section End */

    /* Global Color Section */

	new \Kirki\Section(
		'real_estate_property_theme_color_section',
		[
			'title'       => esc_html__( 'Theme Colors Option', 'real-estate-property' ),
			'description' => esc_html__( 'Here you can change your theme color', 'real-estate-property' ),
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'real_estate_property_theme_color_1',
		'label'       => __( 'Select Your First Color', 'real-estate-property' ),
		'section'     => 'real_estate_property_theme_color_section',
		'default'     => '#353d46',
	] );

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_theme_color_section',
    ] );


       /* Global Color End */


    /* Breadcrumb Section */

	new \Kirki\Section(
		'real_estate_property_breadcrumb_section',
		[
			'title'       => esc_html__( 'Theme Breadcrumb Option', 'real-estate-property' ),
			'description' => esc_html__( 'The breadcrumbs for your theme can be included here.', 'real-estate-property' ),
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_breadcrumb_setting',
			'label'       => esc_html__( 'Enable Breadcrumbs Option', 'real-estate-property' ),
			'section'     => 'real_estate_property_breadcrumb_section',
			'default'     => true,
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
	    'type'        => 'text',
	    'settings'    => 'real_estate_property_breadcrumb_separator',
	    'label'       => esc_html__( 'Breadcrumb Separator Setting', 'real-estate-property' ),
	    'section'     => 'real_estate_property_breadcrumb_section',
	    'default'     => ' → ',
	    'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_breadcrumb_section',
    ] );

    /* Breadcrumb section End */

	/* Social Icon */

	new \Kirki\Section(
		'real_estate_property_top_header_section',
		[
			'title'       => esc_html__( 'Header Social Icon', 'real-estate-property' ),
			'description' => esc_html__( 'Here you can add social links.', 'real-estate-property' ),
			'priority'    => 30,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'real_estate_property_top_twitter_link',
			'label'    => esc_html__( 'Add Twitter Link', 'real-estate-property' ),
			'section'  => 'real_estate_property_top_header_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'real_estate_property_top_linkdin_link',
			'label'    => esc_html__( 'Add Linkdin Link', 'real-estate-property' ),
			'section'  => 'real_estate_property_top_header_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'real_estate_property_top_youtube_link',
			'label'    => esc_html__( 'Add Youtube Link', 'real-estate-property' ),
			'section'  => 'real_estate_property_top_header_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'real_estate_property_top_facebook_link',
			'label'    => esc_html__( 'Add Facebook Link', 'real-estate-property' ),
			'section'  => 'real_estate_property_top_header_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'real_estate_property_top_instagram_link',
			'label'    => esc_html__( 'Add Instagram Link', 'real-estate-property' ),
			'section'  => 'real_estate_property_top_header_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_top_header_section',
    ] );

    //Home page Setting Panel
	new \Kirki\Panel(
		'real_estate_property_home_page_section',
		[
			'priority'    => 10,
			'title'       => esc_html__( 'Home Page Sections', 'real-estate-property' ),
			'priority'    => 20,
		]
	);

	/* Header */

	new \Kirki\Section(
		'real_estate_property_header_button_section',
		[
			'title'       => esc_html__( 'Header', 'real-estate-property' ),
			'description' => esc_html__( 'Here you can add header button text and link.', 'real-estate-property' ),
			'panel'		  => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'real_estate_property_header_phone_number',
			'label'    => esc_html__( 'Add Phone Number', 'real-estate-property' ),
			'section'  => 'real_estate_property_header_button_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'real_estate_property_header_email_address',
			'label'    => esc_html__( 'Add Email Address', 'real-estate-property' ),
			'section'  => 'real_estate_property_header_button_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'real_estate_property_header_register_text',
			'label'    => esc_html__( 'Add Register Text', 'real-estate-property' ),
			'section'  => 'real_estate_property_header_button_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	new \Kirki\Field\URL(
		[
			'settings' => 'real_estate_property_header_register_link',
			'label'    => esc_html__( 'Add Register Link', 'real-estate-property' ),
			'section'  => 'real_estate_property_header_button_section',
			'default'  => '',
			'priority' => 10,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_header_button_section',
    ] );

	/* Home Slider */

	new \Kirki\Section(
		'real_estate_property_home_slider_section',
		[
			'title'       => esc_html__( 'Home Slider', 'real-estate-property' ),
			'description' => esc_html__( 'Here you can add slider image, title and text.', 'real-estate-property' ),
			'panel'		  => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_slide_on_off',
			'label'       => esc_html__( 'Slider On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_home_slider_section',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Number(
		[
			'settings' => 'real_estate_property_slide_count',
			'label'    => esc_html__( 'Slider Number Control', 'real-estate-property' ),
			'section'  => 'real_estate_property_home_slider_section',
			'default'  => '',
			'choices'  => [
				'min'  => 0,
				'max'  => 3,
				'step' => 1,
			],
		]
	);

	$real_estate_property_slide_count = get_theme_mod('real_estate_property_slide_count');

	for ($i=1; $i <= $real_estate_property_slide_count; $i++) { 
		
		new \Kirki\Field\Image(
			[
				'settings'    => 'real_estate_property_slider_image'.$i,
				'label'       => esc_html__( 'Slider Image 0', 'real-estate-property' ).$i,
				'section'     => 'real_estate_property_home_slider_section',
				'default'     => '',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'real_estate_property_slider_heading'.$i,
				'label'    => esc_html__( 'Main Heading 0', 'real-estate-property' ).$i,
				'section'  => 'real_estate_property_home_slider_section',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'real_estate_property_slider_content'.$i,
				'label'    => esc_html__( 'Content Text 0', 'real-estate-property' ).$i,
				'section'  => 'real_estate_property_home_slider_section',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'real_estate_property_slider_button_text'.$i,
				'label'    => esc_html__( 'Button Text 0', 'real-estate-property' ).$i,
				'section'  => 'real_estate_property_home_slider_section',
			]
		);

		new \Kirki\Field\URL(
			[
				'settings' => 'real_estate_property_slider_button_link'.$i,
				'label'    => esc_html__( 'Button Url 0', 'real-estate-property' ).$i,
				'section'  => 'real_estate_property_home_slider_section',
				'default'  => '',
			]
		);
	}

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_home_slider_section',
    ] );

	/* Home Projects */

	new \Kirki\Section(
		'real_estate_property_home_project_section',
		[
			'title'       => esc_html__( 'Home Projects', 'real-estate-property' ),
			'description' => esc_html__( 'Here you can add project name and project designation to display project.', 'real-estate-property' ),
			'panel'		  => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_project_on_off',
			'label'       => esc_html__( 'Projects On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_home_project_section',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'real_estate_property_project_main_heading',
			'label'    => esc_html__( 'Main Heading', 'real-estate-property' ),
			'section'  => 'real_estate_property_home_project_section',
		]
	);

	new \Kirki\Field\Number(
		[
			'settings' => 'real_estate_property_project_count',
			'label'    => esc_html__( 'Projects Number Control', 'real-estate-property' ),
			'section'  => 'real_estate_property_home_project_section',
			'default'  => '',
			'choices'  => [
				'min'  => 0,
				'max'  => 6,
				'step' => 1,
			],
		]
	);

	$real_estate_property_project_count = get_theme_mod('real_estate_property_project_count');

	for ($i=1; $i <= $real_estate_property_project_count; $i++) { 
		
		new \Kirki\Field\Image(
			[
				'settings'    => 'real_estate_property_project_image'.$i,
				'label'       => esc_html__( 'Projects Image 0', 'real-estate-property' ).$i,
				'section'     => 'real_estate_property_home_project_section',
				'default'     => '',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'real_estate_property_project_category'.$i,
				'label'    => esc_html__( 'Projects Category 0', 'real-estate-property' ).$i,
				'section'  => 'real_estate_property_home_project_section',
			]
		);
		
		new \Kirki\Field\Text(
			[
				'settings' => 'real_estate_property_project_heading'.$i,
				'label'    => esc_html__( 'Projects Heading 0', 'real-estate-property' ).$i,
				'section'  => 'real_estate_property_home_project_section',
			]
		);		

		new \Kirki\Field\Text(
			[
				'settings' => 'real_estate_property_project_content'.$i,
				'label'    => esc_html__( 'Projects Content 0', 'real-estate-property' ).$i,
				'section'  => 'real_estate_property_home_project_section',
			]
		);

		new \Kirki\Field\Text(
			[
				'settings' => 'real_estate_property_project_date'.$i,
				'label'    => esc_html__( 'Projects Date 0', 'real-estate-property' ).$i,
				'section'  => 'real_estate_property_home_project_section',
			]
		);

	}

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_home_project_section',
    ] );

	/* Pro Search */

    new \Kirki\Section(
		'real_estate_property_search_section',
		[
			'title'       => esc_html__( 'Search Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_search_section',
        'description' => __( '<p>a. Add more Search Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For Search Section</p>', 'real-estate-property' ),
    ] );

	/* Pro Search End */

	/* Pro Our Properties */

    new \Kirki\Section(
		'real_estate_property_our_properties_section',
		[
			'title'       => esc_html__( 'Our Properties Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_our_properties_section',
        'description' => __( '<p>a. Add more Our Properties Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For Our Properties Section</p>', 'real-estate-property' ),
    ] );

	/* Pro Our Properties End */

	/* Pro How It Work */

    new \Kirki\Section(
		'real_estate_property_how_work_section',
		[
			'title'       => esc_html__( 'How It Work Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_how_work_section',
        'description' => __( '<p>a. Add more How It Work Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For How It Work Section</p>', 'real-estate-property' ),
    ] );

	/* Pro How It Work End */

	/* Pro Facilities */

    new \Kirki\Section(
		'real_estate_property_facilities_section',
		[
			'title'       => esc_html__( 'Facilities Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_facilities_section',
        'description' => __( '<p>a. Add more Facilities Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For Facilities Section</p>', 'real-estate-property' ),
    ] );

	/* Pro Facilities End */

	/* Pro Properties */

    new \Kirki\Section(
		'real_estate_property_properties_section',
		[
			'title'       => esc_html__( 'Properties Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_properties_section',
        'description' => __( '<p>a. Add more Properties Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For Properties Section</p>', 'real-estate-property' ),
    ] );

	/* Pro Properties End */

	/* Pro Latest News */

    new \Kirki\Section(
		'real_estate_property_latest_news_section',
		[
			'title'       => esc_html__( 'Latest News Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_latest_news_section',
        'description' => __( '<p>a. Add more Latest News Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For Latest News Section</p>', 'real-estate-property' ),
    ] );

	/* Pro Latest News End */

	/* Pro About Us */

    new \Kirki\Section(
		'real_estate_property_about_us_section',
		[
			'title'       => esc_html__( 'About Us Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_about_us_section',
        'description' => __( '<p>a. Add more About Us Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For About Us Section</p>', 'real-estate-property' ),
    ] );

	/* Pro About Us End */

	/* Pro Our Professionals */

    new \Kirki\Section(
		'real_estate_property_our_professionals_section',
		[
			'title'       => esc_html__( 'Our Professionals Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_our_professionals_section',
        'description' => __( '<p>a. Add more Our Professionals Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For Our Professionals Section</p>', 'real-estate-property' ),
    ] );

	/* Pro Our Professionals End */

	/* Pro Agent */

    new \Kirki\Section(
		'real_estate_property_agent_section',
		[
			'title'       => esc_html__( 'Agent Section', 'real-estate-property' ),
			'panel'       => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Details for the Premium Theme', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_agent_section',
        'description' => __( '<p>a. Add more Agent Effortlessly </p><p>b. Easily change the color of specific text elements </p><p>c. Buy Our Premium Theme For Agent Section</p>', 'real-estate-property' ),
    ] );

	/* Pro Agent End */

	/* Footer */

	new \Kirki\Section(
		'real_estate_property_footer_section',
		[
			'title'       => esc_html__( 'Footer', 'real-estate-property' ),
			'panel'		  => 'real_estate_property_home_page_section',
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_footer_widgets_on_off',
			'label'       => esc_html__( 'Footer Widgets On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_footer_section',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_copyright_on_off',
			'label'       => esc_html__( 'Footer Copyright On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_footer_section',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'real_estate_property_copyright_content_text',
			'label'    => esc_html__( 'Copyright Text', 'real-estate-property' ),
			'section'  => 'real_estate_property_footer_section',
		]
	);

	new \Kirki\Field\Image(
	[
		'settings'    => 'real_estate_property_footer_background_image',
		'label'       => esc_html__( 'Select Your Appropriate Image for footer background', 'real-estate-property' ),
		'section'     => 'real_estate_property_footer_section',
		'default'     => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'real_estate_property_footer_background_color',
		'label'       => __( 'Select Your Appropriate Color for footer background', 'real-estate-property' ),
		'section'     => 'real_estate_property_footer_section',
		'default'     => '#242424',
	] );

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_home_project_section',
    ] );

    //Post & Pages Setting Panel
	new \Kirki\Panel(
		'real_estate_property_post_pages_section',
		[
			'priority'    => 11,
			'title'       => esc_html__( 'Post & Pages Settings', 'real-estate-property' ),
		]
	);

	/* Banner Options */

	new \Kirki\Section(
		'real_estate_property_banner_options',
		[
			'title'       => esc_html__( 'Banner Image Settings', 'real-estate-property' ),
			'priority'    => 30,
			'panel'		  => 'real_estate_property_post_pages_section',
		]
	);

	new \Kirki\Field\Image(
		[
			'settings'    => 'real_estate_property_custom_fallback_img',
			'label'       => esc_html__( 'Featured Header Image Banner Background', 'real-estate-property' ),
			'section'     => 'real_estate_property_banner_options',
			'default'     => '',
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_banner_options',
    ] );


	/* Single Post Options */

	new \Kirki\Section(
		'real_estate_property_single_post_options',
		[
			'title'       => esc_html__( 'Single Post Options', 'real-estate-property' ),
			'priority'    => 30,
			'section'     => 'real_estate_property_banner_options',
		]
	);

	/* Single Post Content Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_single_post_content_on_off',
			'label'       => esc_html__( 'Single Post Content On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Single Post Meta Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_single_meta_on_off',
			'label'       => esc_html__( 'Single Post Meta On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Single Post Feature Image Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_single_post_image_on_off',
			'label'       => esc_html__( 'Single Post Feature Image On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Single Post Pagination Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_single_post_pagination_on_off',
			'label'       => esc_html__( 'Single Post Pagination On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_single_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_single_post_options',
    ] );

	/* Page Options */
	new \Kirki\Section(
		'real_estate_property_single_page_options',
		[
			'title'       => esc_html__( 'Page Sidebar Options', 'real-estate-property' ),
			'priority'    => 30,
			'section'     => 'real_estate_property_banner_options',
		]
	);

	new \Kirki\Field\Radio(
	[
		'settings'    => 'real_estate_property_single_page_sidebar_option',
		'label'       => esc_html__( 'Page Sidebar Settings', 'real-estate-property' ),
		'section'     => 'real_estate_property_single_page_options',
		'default'     => 'right',
		'priority'    => 10,
		'choices'     => [
			'right'   => esc_html__( 'Page With Right Sidebar', 'real-estate-property' ),
			'left' => esc_html__( 'Page With Left Sidebar', 'real-estate-property' ),
			'none'  => esc_html__( 'Page With No Sidebar', 'real-estate-property' ),

		],
	]
	);
	/* Page Options End*/
	/* Post Options */

	new \Kirki\Section(
		'real_estate_property_post_options',
		[
			'title'       => esc_html__( 'Post Options', 'real-estate-property' ),
			'priority'    => 30,
			'section'     => 'real_estate_property_banner_options',
		]
	);
    
    /* Post Image Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_post_image_on_off',
			'label'       => esc_html__( 'Post Image On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Post Heading Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_post_heading_on_off',
			'label'       => esc_html__( 'Post Heading On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Post Content Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_post_content_on_off',
			'label'       => esc_html__( 'Post Content On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Post Date Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_post_date_on_off',
			'label'       => esc_html__( 'Post Date On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Post Comments Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_post_comment_on_off',
			'label'       => esc_html__( 'Post Comments On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Post Author Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_post_author_on_off',
			'label'       => esc_html__( 'Post Author On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	/* Post Categories Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_post_categories_on_off',
			'label'       => esc_html__( 'Post Categories On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_post_options',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_single_post_options',
    ] );

	/* Post Options End */

	/* Post Options */

	new \Kirki\Section(
		'real_estate_property_post_layouts_section',
		[
			'title'       => esc_html__( 'Post Layout Options', 'real-estate-property' ),
			'priority'    => 30,
			'section'     => 'real_estate_property_banner_options',
		]
	);

	new \Kirki\Field\Radio_Image(
		[
			'settings'    => 'real_estate_property_post_layout',
			'label'       => esc_html__( 'Blog Layout', 'real-estate-property' ),
			'section'     => 'real_estate_property_post_layouts_section',
			'default'     => 'two_column_right',
			'priority'    => 10,
			'choices'     => [
				'one_column'   => get_template_directory_uri().'/images/1column.png',
				'two_column_right' => get_template_directory_uri().'/images/right-sidebar.png',
				'two_column_left'  => get_template_directory_uri().'/images/left-sidebar.png',
				'three_column'  => get_template_directory_uri().'/images/3column.png',
				'four_column'  => get_template_directory_uri().'/images/4column.png',
				'grid_post'  => get_template_directory_uri().'/images/grid.png',
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_post_layouts_section',
    ] );

	/* Post Options End */

	/* Related Post Options */

	new \Kirki\Section(
		'real_estate_property_related_post_section',
		[
			'title'       => esc_html__( 'Related Post Options', 'real-estate-property' ),
			'priority'    => 30,
			'panel'		  => 'real_estate_property_post_pages_section',
		]
	);

    /* Post Image Option End */
	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_enable_related_post_thumbnail',
			'label'       => esc_html__( 'Related Post Image On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_related_post_section',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_related_post_section',
    ] );

	/* Related Post Options End */

	/* 404 Page */

	new \Kirki\Section(
		'real_estate_property_404_page_section',
		[
			'title'       => esc_html__( '404 Page', 'real-estate-property' ),
			'description' => esc_html__( 'Here you can add 404 Page information.', 'real-estate-property' ),
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'real_estate_property_404_page_heading',
			'label'    => esc_html__( 'Add Heading', 'real-estate-property' ),
			'section'  => 'real_estate_property_404_page_section',
			'default'  => esc_html__( '404', 'real-estate-property' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'real_estate_property_404_page_content',
			'label'    => esc_html__( 'Add Content', 'real-estate-property' ),
			'section'  => 'real_estate_property_404_page_section',
			'default'  => esc_html__( 'Ops! Something happened...', 'real-estate-property' ),
			'priority' => 10,
		]
	);

	new \Kirki\Field\Text(
		[
			'settings' => 'real_estate_property_404_page_button',
			'label'    => esc_html__( 'Add Button', 'real-estate-property' ),
			'section'  => 'real_estate_property_404_page_section',
			'default'  => esc_html__( 'Home', 'real-estate-property' ),
			'priority' => 10,
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_404_page_section',
    ] );

	/* 404 Page End */

	/* Responsive Options */

	new \Kirki\Section(
		'real_estate_property_responsive_options_section',
		[
			'title'       => esc_html__( 'Responsive Options', 'real-estate-property' ),
			'priority'    => 30,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_responsive_preloader_setting',
			'label'       => esc_html__( 'Preloader On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_responsive_options_section',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Select(
	[
		'settings'    => 'real_estate_property_preloader_type',
		'label'       => esc_html__( 'Preloader Type', 'real-estate-property' ),
		'section'     => 'real_estate_property_general_options_section',
		'default'     => 'load',
		'placeholder' => esc_html__( 'Choose an option', 'real-estate-property' ),
		'choices'     => [
			'load' => esc_html__( 'Load', 'real-estate-property' ),
			'time' => esc_html__( 'Time', 'real-estate-property' ),
		],
	] );

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_responsive_scroll_to_top_setting',
			'label'       => esc_html__( 'Scroll To Top On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_responsive_options_section',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'section'     => 'real_estate_property_responsive_options_section',
    ] );


	/* Responsive End */

	/* General Options */

	new \Kirki\Section(
		'real_estate_property_general_options_section',
		[
			'title'       => esc_html__( 'General Options', 'real-estate-property' ),
			'priority'    => 10,
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_sticky_header_setting',
			'label'       => esc_html__( 'Show Hide Sticky Header', 'real-estate-property' ),
			'section'     => 'real_estate_property_general_options_section',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_preloader_setting',
			'label'       => esc_html__( 'Preloader On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_general_options_section',
			'default'     => 'off',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Checkbox_Switch(
		[
			'settings'    => 'real_estate_property_scroll_to_top_setting',
			'label'       => esc_html__( 'Scroll To Top On / Off', 'real-estate-property' ),
			'section'     => 'real_estate_property_general_options_section',
			'default'     => 'on',
			'choices'     => [
				'on'  => esc_html__( 'Enable', 'real-estate-property' ),
				'off' => esc_html__( 'Disable', 'real-estate-property' ),
			],
		]
	);

	new \Kirki\Field\Select(
	[
		'settings'    => 'real_estate_property_scroll_to_top_type',
		'label'       => esc_html__( 'Scroll To Top Type', 'real-estate-property' ),
		'section'     => 'real_estate_property_general_options_section',
		'default' => 'advance-scroll',
		'placeholder' => esc_html__( 'Choose an option', 'real-estate-property' ),
		'choices'     => [
			'advance-scroll' => __('Type 1','real-estate-property'),
            'simple-scroll' => __('Type 2','real-estate-property'),
		],
	] );

	new \Kirki\Field\Select(
		[
			'settings'    => 'real_estate_property_scroll_top_alignment',
			'label'       => esc_html__( 'Scroll Top Alignment', 'real-estate-property' ),
			'section'     => 'real_estate_property_general_options_section',
			'default'     => 'Right',
			'choices'     => [
				'Left' => esc_html__( 'Left Align', 'real-estate-property' ),
				'Center' => esc_html__( 'Center Align', 'real-estate-property' ),
				'Right' => esc_html__( 'Right Align', 'real-estate-property' ),
			],
		]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'real_estate_property_container_width',
		'label'       => esc_html__( 'Theme Container Width', 'real-estate-property' ),
		'section'     => 'real_estate_property_general_options_section',
		'default'     => 100,
		'choices'     => [
			'min'  => 50,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'label'    => esc_html__( 'Buy Our Premium Theme For More Feature', 'real-estate-property' ),
		'default'  => 
	        '<a class="premium_info_btn" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUY_NOW_1 ) . '">' . __( 'Buy Pro', 'real-estate-property' ) . '</a>' .
	        '<a class="premium_info_btn bundle" target="_blank" href="' . esc_url( REAL_ESTATE_PROPERTY_BUNDLE_1 ) . '">' . __( 'Buy All Themes In Single Package', 'real-estate-property' ) . '</a>',
        'type'        => 'custom',
        'priority'    => 100,
        'section'     => 'real_estate_property_general_options_section',
    ] );

	/* General Options End */

}