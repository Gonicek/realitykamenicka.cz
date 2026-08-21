<?php 
/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/

add_action( 'wp_ajax_real_estate_property_dismissed_notice_handler', 'real_estate_property_ajax_notice_handler' );

/** * AJAX handler to record dismissible notice status. */
function real_estate_property_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function real_estate_property_admin_notice_deprecated_hook() {
        $current_screen = get_current_screen();
        if ($current_screen->id !== 'toplevel_page_real-estate-property-guide-page') {
        if ( ! get_option('dismissed-get_started', FALSE ) ) { ?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="real-estate-property-getting-started-notice clearfix">
                    <div class="real-estate-property-theme-notice-content">
                        <h2 class="real-estate-property-notice-h2">
                            <?php
                            echo esc_html__( 'Let\'s Create Your website With', 'real-estate-property' ) . ' <strong>' . esc_html( wp_get_theme()->get('Name') ) . '</strong>';
                            ?>
                        </h2>
                        <span class="st-notification-wrapper">
                            <span class="st-notification-column-wrapper">
                                <span class="st-notification-column">
                                    <h2><?php echo esc_html('Features Rich Theme','real-estate-property'); ?></h2>
                                    <ul class="st-notification-column-list">
                                        <li><?php echo esc_html('Live Customize','real-estate-property'); ?></li>
                                        <li><?php echo esc_html('Detailed theme Options','real-estate-property'); ?></li>
                                        <li><?php echo esc_html('Cleanly Coded','real-estate-property'); ?></li>
                                        <li><?php echo esc_html('Search Engine Friendly','real-estate-property'); ?></li>
                                    </ul>
                                </span>
                                <span class="st-notification-column">
                                    <h2><?php echo esc_html('Customize Your Site','real-estate-property'); ?></h2>
                                    <ul>
                                        <li><a href="<?php echo esc_url( admin_url( 'customize.php' ) ) ?>" target="_blank" class="button button-primary"><?php echo esc_html('Customize','real-estate-property'); ?></a></li>
                                        <li><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ) ?>" class="button button-primary"><?php echo esc_html('Add Widgets','real-estate-property'); ?></a></li>
                                        <li><a href="<?php echo esc_url( REAL_ESTATE_PROPERTY_SUPPORT_FREE ); ?>" target="_blank" class="button button-primary"><?php echo esc_html('Get Support','real-estate-property'); ?></a> </li>
                                        <li><a href="<?php echo esc_url( admin_url( 'themes.php?page=real-estate-property-guide-page' ) ); ?>" class="button-primary button get-start"><?php echo esc_html('Getting Started','real-estate-property'); ?></a></li>
                                    </ul>
                                </span>
                                <span class="st-notification-column">
                                    <h2><?php echo esc_html('Get More Options','real-estate-property'); ?></h2>
                                    <ul>
                                        <li><a href="<?php echo esc_url( REAL_ESTATE_PROPERTY_DEMO_PRO ); ?>" target="_blank" class="button button-primary"><?php echo esc_html('View Live Demo','real-estate-property'); ?></a></li>
                                        <li><a href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" target="_blank" class="button button-primary premium"><?php echo esc_html('Purchase Now','real-estate-property'); ?></a></li>
                                        <li><a href="<?php echo esc_url( REAL_ESTATE_PROPERTY_DOCS_FREE ); ?>" target="_blank" class="button button-primary"><?php echo esc_html('Free Documentation','real-estate-property'); ?></a> </li>
                                        <li><a href="<?php echo esc_url( admin_url( 'themes.php?page=realestateproperty-wizard' ) ); ?>" class="button button-primary demo-import"><?php echo esc_html('Demo Importer','real-estate-property'); ?></a> </li>
                                    </ul>
                                </span>
                            </span>
                            <span class="notice-img">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/notice.png' ); ?>">                                
                            </span>
                        </span>
                        <style>
                        </style>
                    </div>
                </div>
            </div>
        <?php }
    }
}

add_action( 'admin_notices', 'real_estate_property_admin_notice_deprecated_hook' );

function real_estate_property_switch_theme_function () {
    delete_option('dismissed-get_started', FALSE );
}

add_action('after_switch_theme', 'real_estate_property_switch_theme_function');