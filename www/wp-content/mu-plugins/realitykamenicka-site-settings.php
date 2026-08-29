<?php
/**
 * Site-specific settings for realitykamenicka.cz.
 */

add_filter('gettext', function ($translated, $text, $domain) {
    $map = [
        'Home' => 'Úvod',
        'Search' => 'Hledat',
        'Search...' => 'Hledat…',
        'Recent Posts' => 'Nejnovější nabídky',
        'Recent Comments' => 'Komentáře',
        'Archives List' => 'Archiv',
        'Our Pages' => 'Stránky',
        'Tag Cloud' => 'Štítky',
        'Property WordPress Theme' => 'Šablona pro realitní web',
        'Proudly powered by %s' => 'Běží na %s',
        'Leave a Reply' => 'Komentáře jsou vypnuté',
        'Comment' => 'Komentář',
        'Comments' => 'Komentáře',
        'No comments to show.' => 'Žádné komentáře k zobrazení.',
        'Skip to content' => 'Přejít k obsahu',
    ];
    return $map[$text] ?? $translated;
}, 20, 3);

// Fully disable comments and pingbacks on the public site and in admin.
add_action('init', function () {
    foreach (get_post_types(['public' => true], 'names') as $post_type) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
    }
});

add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 20, 2);

add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    if ($wp_admin_bar) {
        $wp_admin_bar->remove_menu('comments');
    }
});

// Last-resort front-end string cleanup for theme text that is not properly localized.
add_action('template_redirect', function () {
    if (is_admin()) {
        return;
    }
    ob_start(function ($html) {
        return strtr($html, [
            'Home' => 'Úvod',
            'Search' => 'Hledat',
            'Search...' => 'Hledat…',
            'Recent Posts' => 'Nejnovější nabídky',
            'Recent Comments' => 'Komentáře',
            'Archives List' => 'Archiv',
            'Our Pages' => 'Stránky',
            'Tag Cloud' => 'Štítky',
            'Property WordPress Theme' => 'Šablona pro realitní web',
            'No comments to show.' => 'Žádné komentáře k zobrazení.',
            'Related Posts:-' => 'Související nabídky',
            'Related Posts' => 'Související nabídky',
            'Post navigation' => 'Navigace nabídky',
            'Posts' => 'Nabídky',
            'Jun' => 'června',
        ]);
    });
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script(
        'rk-lightbox',
        content_url('mu-plugins/rk-lightbox.js'),
        [],
        filemtime(WP_CONTENT_DIR . '/mu-plugins/rk-lightbox.js'),
        true
    );
});

// New brand look: Playfair Display (nadpisy) + Poppins (text/menu).
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'rk-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap',
        [],
        null
    );
}, 5);

// Two-line bronze/serif logo ("REALITY" / "KAMENICKÁ" + house-key ikona),
// nahrazuje výchozí jednořádkový textový titulek šablony. Definováno dřív,
// než šablona provede vlastní `function_exists()` kontrolu, takže se použije
// tato verze bez zásahu do souborů šablony.
if ( ! function_exists( 'real_estate_property_logo_title_description' ) ) :
function real_estate_property_logo_title_description() {
    $name  = get_bloginfo( 'name' );
    $parts = explode( ' ', $name, 2 );
    $top   = $parts[0] ?? $name;
    $bottom = $parts[1] ?? '';
    ?>
    <a class="rk-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="rk-logo-row">
            <svg width="22" height="20" viewBox="0 0 24 22" fill="none" stroke="#b8873c" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10.5L12 3l9 7.5"/><path d="M5 9.5V19h14V9.5"/><path d="M10 19v-6h4v6"/></svg>
            <span class="rk-logo-top"><?php echo esc_html( $top ); ?></span>
        </span>
        <?php if ( $bottom ) : ?>
            <span class="rk-logo-bottom"><?php echo esc_html( $bottom ); ?></span>
        <?php endif; ?>
    </a>
    <?php
    if ( get_theme_mod( 'real_estate_property_tagline_setting', false ) ) :
        $description = get_bloginfo( 'description' );
        if ( $description ) :
            ?>
            <p class="site-description mb-0"><?php echo esc_html( $description ); ?></p>
            <?php
        endif;
    endif;
}
endif;

add_action('wp_head', function () {
    echo '<style id="rk-lightbox-style">
html.rk-lightbox-open,html.rk-lightbox-open body{overflow:hidden!important}.rk-lightbox-overlay{position:fixed!important;inset:0!important;background:rgba(18,16,17,.92)!important;z-index:2147483647!important;display:none!important;align-items:center!important;justify-content:center!important;padding:42px!important;box-sizing:border-box!important}.rk-lightbox-overlay.is-open{display:flex!important}.rk-lightbox-overlay img{max-width:92vw!important;max-height:86vh!important;width:auto!important;height:auto!important;object-fit:contain!important;box-shadow:0 20px 80px rgba(0,0,0,.45)!important}.rk-lightbox-close,.rk-lightbox-prev,.rk-lightbox-next{position:fixed!important;background:#c49649!important;color:#fff!important;border:0!important;border-radius:999px!important;width:44px!important;height:44px!important;font-size:30px!important;line-height:1!important;cursor:pointer!important;z-index:2147483647!important}.rk-lightbox-close{top:18px!important;right:18px!important}.rk-lightbox-prev{left:18px!important;top:50%!important}.rk-lightbox-next{right:18px!important;top:50%!important}.rk-lightbox-caption{position:fixed!important;left:0!important;right:0!important;bottom:12px!important;text-align:center!important;color:#fff!important;padding:0 24px!important;z-index:2147483647!important}.rk-gallery a{cursor:zoom-in!important}
</style>';
}, 999);

// Replace the temporary homepage hero placeholder with the supplied broker portrait.
add_filter('the_content', function ($content) {
    if (strpos($content, 'rk-hero-photo') === false) {
        return $content;
    }

    $portrait_url = content_url('mu-plugins/assets/maklerka-hero.jpg');
    $portrait = sprintf(
        '<div class="rk-hero-photo"><img src="%s" alt="Angelika Kamenická – realitní makléřka" width="186" height="320" fetchpriority="high" decoding="async"></div>',
        esc_url($portrait_url)
    );

    return preg_replace(
        '~<div class="rk-hero-photo">.*?</div>~s',
        $portrait,
        $content,
        1
    ) ?: $content;
}, 20);
