<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Real Estate Property
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function real_estate_property_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'real_estate_property_body_classes' );

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backward compatibility for wp_body_open hook.
	 *
	 * @since 1.0.0
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if (!function_exists('real_estate_property_str_replace_assoc')) {
    /**
     * real_estate_property_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function real_estate_property_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

function real_estate_property_sanitize_select( $input, $setting ) {
	// Ensure input is a slug
	$input = sanitize_key( $input );

	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it;
	// otherwise, return the default
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

