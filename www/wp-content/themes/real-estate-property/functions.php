<?php
if ( ! function_exists( 'real_estate_property_setup' ) ) :
function real_estate_property_setup() {

	add_theme_support( "woocommerce" );	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( "responsive-embeds" );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );
	
	
	add_theme_support( 'custom-header' );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'real-estate-property' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Enable support for custom logo.
	 */
	add_theme_support('custom-logo');
	
	remove_theme_support( 'widgets-block-editor' );

	// -- Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );
		
	// Gutenberg wide images.
	add_theme_support( 'align-wide' );

	load_theme_textdomain( 'real-estate-property', get_stylesheet_directory() . '/languages' );
		
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'real_estate_property_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'real_estate_property_setup' );

/*
 * Enable support for Post Formats.
 *
 * See: https://codex.wordpress.org/Post_Formats
*/
add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function real_estate_property_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'real_estate_property_content_width', 1170 );
}
add_action( 'after_setup_theme', 'real_estate_property_content_width', 0 );

function real_estate_property_customize_remove_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );
    
}
add_action( 'customize_register', 'real_estate_property_customize_remove_register', 11 );

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';


function real_estate_property_text_domain_setup() {

/**
 * All Styles & Scripts.
 */
require_once get_template_directory() . '/inc/enqueue.php';

/**
 * Sidebar.
 */
require_once get_template_directory() . '/inc/sidebar/sidebar.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
 require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/inc/jetpack.php';

/**
 * Load Web Font
 */
require_once get_template_directory() . '/inc/wptt-webfont-loader.php';

/**
 * Load demo importer
 */
require_once get_template_directory() . '/inc/importer/config.php';

/**
 * Called all the Customize file.
 */
require( get_template_directory() . '/inc/customize/premium.php');

/**
 * Get Started.
 */
require( get_template_directory() . '/inc/started/main.php');

/**
 * Admin notice function.
 */
require_once get_template_directory() . '/inc/admin-notice/admin.php';

}
add_action('after_setup_theme', 'real_estate_property_text_domain_setup');

/* 
* Logo Resizer
*/
function real_estate_property_logo_resizer_setting() {

    $real_estate_property_theme_logo_size_css = '';
    $real_estate_property_logo_resizer_setting = get_theme_mod('real_estate_property_logo_resizer_setting');

	$real_estate_property_theme_logo_size_css = '
		.custom-logo{
			height: '.esc_attr($real_estate_property_logo_resizer_setting).'px !important;
			width: '.esc_attr($real_estate_property_logo_resizer_setting).'px !important;
		}
	';
    wp_add_inline_style( 'real-estate-property-style',$real_estate_property_theme_logo_size_css );

}
add_action( 'wp_enqueue_scripts', 'real_estate_property_logo_resizer_setting' );

/**
 * Function that returns if the menu is sticky
 */
if (!function_exists('real_estate_property_sticky_header')):
    function real_estate_property_sticky_header()
    {
        $is_sticky = get_theme_mod('real_estate_property_sticky_header_setting', false);

        if ($is_sticky == false):
            return 'not-sticky';
        else:
            return 'is-sticky-on';
        endif;
    }
endif;

function real_estate_property_breadcrumb() {
    $separator = get_theme_mod( 'real_estate_property_breadcrumb_separator', ' → ' );
    $home_text = __('Home', 'real-estate-property');
    
    // Build breadcrumb array
    $breadcrumbs = array();
    
    // Home link
    $breadcrumbs[] = '<a href="' . esc_url(home_url('/')) . '">' . esc_html($home_text) . '</a>';
    
    // Check page type
    if (is_home() && !is_front_page()) {
        $breadcrumbs[] = esc_html(get_the_title(get_option('page_for_posts')));
    } elseif (is_front_page()) {
        // Don't add anything for front page
    } elseif (is_category()) {
        $category = get_queried_object();
        if ($category) {
            // Get parent categories if any
            $category_parents = get_ancestors($category->term_id, 'category');
            if (!empty($category_parents)) {
                $category_parents = array_reverse($category_parents);
                foreach ($category_parents as $parent_cat_id) {
                    $parent_cat = get_category($parent_cat_id);
                    if ($parent_cat) {
                        $breadcrumbs[] = '<a href="' . esc_url(get_category_link($parent_cat->term_id)) . '">' . esc_html($parent_cat->name) . '</a>';
                    }
                }
            }
            // Current category
            $breadcrumbs[] = esc_html($category->name);
        }
    } elseif (is_tag()) {
        $tag = get_queried_object();
        if ($tag) {
            $breadcrumbs[] = esc_html($tag->name);
        }
    } elseif (is_date()) {
        if (is_year()) {
            $breadcrumbs[] = esc_html(get_the_time('Y'));
        } elseif (is_month()) {
            $breadcrumbs[] = '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>';
            $breadcrumbs[] = esc_html(get_the_time('F'));
        } elseif (is_day()) {
            $breadcrumbs[] = '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>';
            $breadcrumbs[] = '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a>';
            $breadcrumbs[] = esc_html(get_the_time('d'));
        }
    } elseif (is_author()) {
        $breadcrumbs[] = esc_html(sprintf(__('Author: %s', 'real-estate-property'), get_the_author()));
    } elseif (is_search()) {
        $breadcrumbs[] = esc_html(sprintf(__('Search Results for: %s', 'real-estate-property'), get_search_query()));
    } elseif (is_404()) {
        $breadcrumbs[] = esc_html(__('404 - Page Not Found', 'real-estate-property'));
    } elseif (is_singular('post')) {
        // Get post categories
        $categories = get_the_category();
        if (!empty($categories)) {
            $breadcrumbs[] = '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
        }
        $breadcrumbs[] = esc_html(get_the_title());
    } elseif (is_singular('page')) {
        // Get parent pages
        $parent_id = wp_get_post_parent_id(get_the_ID());
        if ($parent_id) {
            $breadcrumbs[] = '<a href="' . esc_url(get_permalink($parent_id)) . '">' . esc_html(get_the_title($parent_id)) . '</a>';
        }
        $breadcrumbs[] = esc_html(get_the_title());
    } elseif (is_singular('product')) {
        // WooCommerce product
        $breadcrumbs[] = '<a href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '">' . esc_html(__('Shop', 'real-estate-property')) . '</a>';
        $breadcrumbs[] = esc_html(get_the_title());
    } elseif (is_archive()) {
        $breadcrumbs[] = esc_html(post_type_archive_title('', false));
    } else {
        $breadcrumbs[] = esc_html(get_the_title());
    }
    
    // Output breadcrumbs
    if (!empty($breadcrumbs)) {
        echo implode(' ' . esc_html($separator) . ' ', $breadcrumbs);
    }
}

function get_page_id_by_title($pagename){

    $args = array(
        'post_type' => 'page',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'title' => $pagename
    );
    $query = new WP_Query( $args );

    $page_id = '1';
    if (isset($query->post->ID)) {
        $page_id = $query->post->ID;
    }

    return $page_id;
}

if ( ! function_exists( 'real_estate_property_top_scroller' ) ) {
    function real_estate_property_top_scroller() { ?>      
        <button type="button" id="scroll_2" class="scroll_2">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" 
                      style="transition: stroke-dashoffset 10ms linear 0s; 
                             stroke-dasharray: 307.919, 307.919; 
                             stroke-dashoffset: -0.0171453;">
                </path>
            </svg>
        </button>
    <?php }
}
add_action( 'real_estate_property_top_scroller', 'real_estate_property_top_scroller' );