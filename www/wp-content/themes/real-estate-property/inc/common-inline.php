<?php

/*----------------------------------------------------------------------------------*/

$real_estate_property_common_inline_css = '';

$real_estate_property_scroll_top_alignment = get_theme_mod('real_estate_property_scroll_top_alignment', 'Right');

$real_estate_property_alignment_styles = [
    'Left' => 'left: 20px;',
    'Center' => 'right: 0; left: 0; margin: 0 auto;',
    'Right' => 'right: 20px;'
];

$alignment_style = $real_estate_property_alignment_styles[$real_estate_property_scroll_top_alignment] ?? $real_estate_property_alignment_styles['Right'];

$real_estate_property_common_inline_css .= "a.scrollup,button#scroll_2 { $alignment_style }";

/*----------------------------------------------------------------------------------*/

$real_estate_property_footer_background_color = get_theme_mod('real_estate_property_footer_background_color', '#242424');

if (!empty($real_estate_property_footer_background_color)) {
    $real_estate_property_common_inline_css .= ".footer-widgets { background: " . esc_attr($real_estate_property_footer_background_color) . "}";
}

/*----------------------------------------------------------------------------------*/

$real_estate_property_footer_background_image = get_theme_mod('real_estate_property_footer_background_image', '');

if (!empty($real_estate_property_footer_background_image)) {
    $real_estate_property_common_inline_css .= ".footer-widgets { background-image: url('" . esc_url($real_estate_property_footer_background_image) . "') !important; background-size: cover; background-repeat: no-repeat; }";
}

/*----------------------------------------------------------------------------------*/

$real_estate_property_container_width = get_theme_mod('real_estate_property_container_width');

if (!empty($real_estate_property_container_width)) {
    $real_estate_property_common_inline_css .= "@media (min-width: 1024px) { 
        body, .navbar-area.header-fixed, .admin-bar .header-fixed,.loading,.page-template-template-homepage #header.navbar-area.header-fixed, .navbar-area.header-fixed { 
            width: " . esc_attr($real_estate_property_container_width) . "%; 
            margin: 0 auto; 
        } 
        .admin-bar .header-fixed { 
            margin-top: 32px; 
        } 
    }";
}

/*----------------------------------------------------------------------------------*/   

$real_estate_property_responsive_scroll_to_top_setting = get_theme_mod( 'real_estate_property_responsive_scroll_to_top_setting', true );

if ( $real_estate_property_responsive_scroll_to_top_setting == true && get_theme_mod( 'real_estate_property_scroll_to_top_setting', true ) != true ) {
    $real_estate_property_common_inline_css .= "a.scrollup,button#scroll_2 {
        display: none !important;
    }";
}

if ( $real_estate_property_responsive_scroll_to_top_setting == true ) {
    $real_estate_property_common_inline_css .= "@media screen and (max-width: 768px) {
        a.scrollup,button#scroll_2 {
            display: block !important;
        }
    }";
} elseif ( $real_estate_property_responsive_scroll_to_top_setting == false ) {
    $real_estate_property_common_inline_css .= "@media screen and (max-width: 768px) {
        a.scrollup,button#scroll_2 {
            display: none !important;
        }
    }";
}

/*----------------------------------------------------------------------------------*/ 

$real_estate_property_responsive_preloader_setting = get_theme_mod( 'real_estate_property_responsive_preloader_setting', false );

if ( $real_estate_property_responsive_preloader_setting == true && get_theme_mod( 'real_estate_property_preloader_setting', false ) == false ) {
    $real_estate_property_common_inline_css .= "@media screen and (min-width: 768px) {
        .loading {
            display: none !important;
        }
    }";
}

if ( $real_estate_property_responsive_preloader_setting == false ) {
    $real_estate_property_common_inline_css .= "@media screen and (max-width: 768px) {
        .loading {
            display: none !important;
        }
    }";
}

/*---------------------------Global Color-------------------*/

$real_estate_property_theme_color_1 = get_theme_mod('real_estate_property_theme_color_1');
$real_estate_property_theme_color_2 = get_theme_mod('real_estate_property_theme_color_2');
$real_estate_property_theme_color_3 = get_theme_mod('real_estate_property_theme_color_3');

/*--- First Global Color ---*/

if ($real_estate_property_theme_color_1) {
  $real_estate_property_common_inline_css .= ':root {';
  $real_estate_property_common_inline_css .= '--first-color: ' . esc_attr($real_estate_property_theme_color_1) . ' !important;';
  $real_estate_property_common_inline_css .= '} ';
}

/*--- Second Global Color ---*/

if ($real_estate_property_theme_color_2) {
  $real_estate_property_common_inline_css .= ':root {';
  $real_estate_property_common_inline_css .= '--second-color: ' . esc_attr($real_estate_property_theme_color_2) . ' !important;';
  $real_estate_property_common_inline_css .= '} ';
}
/*--- Third Global Color ---*/

if ($real_estate_property_theme_color_3) {
  $real_estate_property_common_inline_css .= ':root {';
  $real_estate_property_common_inline_css .= '--third-color: ' . esc_attr($real_estate_property_theme_color_3) . ' !important;';
  $real_estate_property_common_inline_css .= '} ';
}