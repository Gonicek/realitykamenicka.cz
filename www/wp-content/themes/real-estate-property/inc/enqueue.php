<?php
 /**
 * Enqueue scripts and styles.
 */
function real_estate_property_scripts() {
	
	// Styles

	wp_enqueue_style('dashicons' );

	wp_enqueue_style('bootstrap-min',get_template_directory_uri().'/css/bootstrap.css');

	wp_enqueue_style('owl-carousel',get_template_directory_uri().'/css/owl.carousel.css');
	
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/fonts/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_style('real-estate-property-widget',get_template_directory_uri().'/css/widget.css');
	
	wp_enqueue_style('real-estate-property-color-default',get_template_directory_uri().'/css/colors/default.css');
	
	wp_enqueue_style('real-estate-property-wp-test',get_template_directory_uri().'/css/wp-test.css');
	
	wp_enqueue_style('real-estate-property-menu',get_template_directory_uri().'/css/menu.css');
	
	wp_enqueue_style('real-estate-property-style', get_stylesheet_uri() );

	wp_style_add_data('real-estate-property-style', 'rtl', 'replace');
	
	wp_enqueue_style('real-estate-property-gutenberg',get_template_directory_uri().'/css/gutenberg.css');
	
	wp_enqueue_style('real-estate-property-responsive',get_template_directory_uri().'/css/responsive.css');
	
	// Scripts
	wp_enqueue_script('jquery-ui-core');
	
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.3.1', true); 

	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), true); 
	
	wp_register_script('real-estate-property-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), false, true);

	wp_localize_script('real-estate-property-custom-js', 'real_estate_property_script_args',
		array( 
			'scroll_top_type' => get_theme_mod( 'real_estate_property_scroll_to_top_type' ) == 'simple-scroll' ? 'simple-scroll' : 'advanced-scroll'
		)
	);
	wp_enqueue_script('real-estate-property-custom-js');

	wp_enqueue_script('real-estate-property-navigation-focus', get_template_directory_uri() . '/js/navigation-focus.js', array(), true );

	wp_enqueue_script('skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	require get_template_directory(). '/inc/common-inline.php';

	wp_add_inline_style( 'real-estate-property-style',$real_estate_property_common_inline_css );
}
add_action( 'wp_enqueue_scripts', 'real_estate_property_scripts' );

//Admin Enqueue for Admin
function real_estate_property_admin_enqueue_scripts(){	
	wp_enqueue_style('real-estate-property-style-customizer',get_template_directory_uri(). '/css/style-customizer.css');

	wp_enqueue_style( 'real-estate-property-admin-style', get_template_directory_uri().'/inc/started/main.css' );

	wp_enqueue_script( 'real-estate-property-admin-script', get_template_directory_uri() . '/inc/admin-notice/admin.js', array( 'jquery' ), '', true );
}
add_action( 'admin_enqueue_scripts', 'real_estate_property_admin_enqueue_scripts' );

// Fix for Customizer querySelector error with numeric menu IDs and invalid pseudo-selectors
function real_estate_property_customize_controls_fix() {
	$fix_script = "
	(function() {
		var selectorErrors = {};
		
		// Override document.querySelector to fix invalid selectors
		var originalQuerySelector = document.querySelector;
		document.querySelector = function(selector) {
			if (typeof selector === 'string') {
				var originalSelector = selector;
				
				// Fix selectors with numeric IDs in brackets: #accordion-section-nav_menu[180]
				if (selector.match(/\\[\\d+\\]$/)) {
					selector = selector.replace(/\\[(\\d+)\\]$/, '-\$1');
				}
				
				// Fix invalid pseudo-selectors: :last should be :last-child
				if (selector.indexOf(':last') !== -1 && selector.indexOf(':last-child') === -1 && selector.indexOf(':last-of-type') === -1) {
					selector = selector.replace(/:last(\\s|,|$)/g, ':last-child\$1');
				}
			}
			try {
				return originalQuerySelector.call(this, selector);
			} catch(e) {
				// Only log if this is the first time seeing this error
				if (!selectorErrors[selector]) {
					selectorErrors[selector] = true;
					console.warn('Real Estate Property - querySelector fixed selector issue:', selector);
				}
				return null;
			}
		};
		
		// Also override querySelectorAll
		var originalQuerySelectorAll = document.querySelectorAll;
		document.querySelectorAll = function(selector) {
			if (typeof selector === 'string') {
				var originalSelector = selector;
				
				// Fix selectors with numeric IDs in brackets
				if (selector.match(/\\[\\d+\\]$/)) {
					selector = selector.replace(/\\[(\\d+)\\]$/, '-\$1');
				}
				
				// Fix invalid pseudo-selectors: :last should be :last-child
				if (selector.indexOf(':last') !== -1 && selector.indexOf(':last-child') === -1 && selector.indexOf(':last-of-type') === -1) {
					selector = selector.replace(/:last(\\s|,|$)/g, ':last-child\$1');
				}
			}
			try {
				return originalQuerySelectorAll.call(this, selector);
			} catch(e) {
				// Only log if this is the first time seeing this error
				if (!selectorErrors[selector]) {
					selectorErrors[selector] = true;
					console.warn('Real Estate Property - querySelectorAll fixed selector issue:', selector);
				}
				return [];
			}
		};
	})();
	";
	wp_add_inline_script( 'customize-base', $fix_script, 'before' );
}
add_action( 'customize_controls_enqueue_scripts', 'real_estate_property_customize_controls_fix', 0 );

?>