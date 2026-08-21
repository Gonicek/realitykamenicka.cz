<?php

add_action( 'admin_menu', 'real_estate_property_getting_started' );
function real_estate_property_getting_started() {
    add_theme_page( 
		esc_html__('Getting Started', 'real-estate-property'), 
		esc_html__('Getting Started', 'real-estate-property'), 
		'manage_options', 
		'real-estate-property-guide-page', 
		'real_estate_property_test_guide'
	);
}

if ( ! defined( 'REAL_ESTATE_PROPERTY_DOCS_FREE' ) ) {
define('REAL_ESTATE_PROPERTY_DOCS_FREE',__('https://www.mishkatwp.com/instruction/real-estate-property-free-docs/','real-estate-property'));
}
if ( ! defined( 'REAL_ESTATE_PROPERTY_DOCS_PRO' ) ) {
define('REAL_ESTATE_PROPERTY_DOCS_PRO',__('https://www.mishkatwp.com/instruction/real-estate-property-pro-docs/','real-estate-property'));
}
if ( ! defined( 'REAL_ESTATE_PROPERTY_BUY_NOW' ) ) {
define('REAL_ESTATE_PROPERTY_BUY_NOW',__('https://www.mishkatwp.com/themes/property-wordpress-theme/','real-estate-property'));
}
if ( ! defined( 'REAL_ESTATE_PROPERTY_SUPPORT_FREE' ) ) {
define('REAL_ESTATE_PROPERTY_SUPPORT_FREE',__('https://wordpress.org/support/theme/real-estate-property/','real-estate-property'));
}
if ( ! defined( 'REAL_ESTATE_PROPERTY_REVIEW_FREE' ) ) {
define('REAL_ESTATE_PROPERTY_REVIEW_FREE',__('https://wordpress.org/support/theme/real-estate-property/reviews/#new-post','real-estate-property'));
}
if ( ! defined( 'REAL_ESTATE_PROPERTY_DEMO_PRO' ) ) {
define('REAL_ESTATE_PROPERTY_DEMO_PRO',__('https://www.mishkatwp.com/pro/real-estate-property/','real-estate-property'));
}
if ( ! defined( 'REAL_ESTATE_PROPERTY_BUNDLE' ) ) {
define('REAL_ESTATE_PROPERTY_BUNDLE',__('https://www.mishkatwp.com/themes/wordpress-theme-bundle/','real-estate-property'));
}

function real_estate_property_test_guide() { ?>
	<?php $real_estate_property_theme = wp_get_theme();?>
	<div class="wrap" id="main-page">
		<div id="righty">
			<div class="getstart-postbox donate">
				<h4><?php esc_html_e( 'Discount Upto 25%', 'real-estate-property' ); ?> <span><?php esc_html_e( '"Special25"', 'real-estate-property' ); ?></span></h4>
				<h3 class="hndle"><?php esc_html_e( 'Upgrade to Premium', 'real-estate-property' ); ?></h3>
				<div class="inside">
					<p><?php esc_html_e('Click to upgrade to see the enhanced pro features available in the premium version.','real-estate-property'); ?></p>
					<div id="admin_pro_links">
						<a class="blue-button-2" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'real-estate-property' ); ?></a>
						<a class="blue-button-1" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'real-estate-property' ) ?></a>
						<a class="blue-button-2" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_DOCS_PRO ); ?>" target="_blank"><?php esc_html_e( 'Pro Docs', 'real-estate-property' ) ?></a>
					</div>
				</div>
				<div class="d-table">
				    <ul class="d-column">
				      <li class="feature"><?php esc_html_e('Features','real-estate-property'); ?></li>
				      <li class="free"><?php esc_html_e('Pro','real-estate-property'); ?></li>
				      <li class="plus"><?php esc_html_e('Free','real-estate-property'); ?></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('24hrs Priority Support','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('LearnPress Campatiblity','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Kirki Framework','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Advance Posttype','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('One Click Demo Import','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Section Reordering','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Enable / Disable Option','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Multiple Sections','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Advance Color Pallete','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Advance Widgets','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
				    </ul>
				    <ul class="d-row">
				      <li class="points"><?php esc_html_e('Page Templates','real-estate-property'); ?></li>
				      <li class="right"><span class="dashicons dashicons-yes"></span></li>
				      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
				    </ul>
	  			</div>
			</div>
		</div>
		<div id="lefty">
			<div id="description">
				<h3><?php esc_html_e('Welcome! Thank you for choosing ','real-estate-property'); ?><?php echo esc_html( $real_estate_property_theme ); ?>  <span><?php esc_html_e('Version: ', 'real-estate-property'); ?><?php echo esc_html($real_estate_property_theme['Version']);?></span></h3>
				<div class="demo-import-box">
					<h4><?php echo esc_html('IMPORT HOMEPAGE','real-estate-property'); ?></h4>
					<p><?php echo esc_html('Get started with the wordpress theme installation','real-estate-property'); ?></p>
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=realestateproperty-wizard' ) ); ?>" class="blue-button-1">
					    <?php echo esc_html__( 'Demo Importer', 'real-estate-property' ); ?>
					</a>
				</div>
				<h4 class="feature-head"><?php esc_html_e('Begin with our theme features:-','real-estate-property'); ?></h4>
				<div class="customizer-inside">
					<div class="real-estate-property-theme-setting-item">
                        <div class="real-estate-property-theme-setting-item-header">
                            <?php esc_html_e( 'Add Menus', 'real-estate-property' ); ?>                            
                       	</div>
                        <div class="real-estate-property-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>"><?php esc_html_e('Go to Menu', 'real-estate-property'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to menu >> Select menu which you had created >> Then Publish ', 'real-estate-property' ); ?></p>
                	</div>
                	<div class="real-estate-property-theme-setting-item">
                        <div class="real-estate-property-theme-setting-item-header">
                            <?php esc_html_e( 'Add Logo', 'real-estate-property' ); ?>                            
                       	</div>
                        <div class="real-estate-property-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>"><?php esc_html_e('Go to Site Identity', 'real-estate-property'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Site Identity >> Select Logo Add Title or Tagline >> Then Publish ', 'real-estate-property' ); ?></p>
                	</div>
                	<div class="real-estate-property-theme-setting-item">
                        <div class="real-estate-property-theme-setting-item-header">
                            <?php esc_html_e( 'Home Page Section', 'real-estate-property' ); ?>                            
                       	</div>
                        <div class="real-estate-property-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=real_estate_property_home_page_section') ); ?>"><?php esc_html_e('Go to Home Page Section', 'real-estate-property'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Home Page Sections >> Then go to different section which ever you want >> Then Publish ', 'real-estate-property' ); ?></p>
                	</div>
                	<div class="real-estate-property-theme-setting-item">
                        <div class="real-estate-property-theme-setting-item-header">
                            <?php esc_html_e( 'Post Options', 'real-estate-property' ); ?>                            
                       	</div>
                        <div class="real-estate-property-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=real_estate_property_post_image_on_off') ); ?>"><?php esc_html_e('Go to Post Options', 'real-estate-property'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Post Options >> Then go to different settings which ever you want >> Then Publish ', 'real-estate-property' ); ?></p>
                	</div>
                	<div class="real-estate-property-theme-setting-item">
                        <div class="real-estate-property-theme-setting-item-header">
                            <?php esc_html_e( 'Post Layout Options', 'real-estate-property' ); ?>                            
                       	</div>
                        <div class="real-estate-property-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=real_estate_property_post_layout') ); ?>"><?php esc_html_e('Go to Post Layout Options', 'real-estate-property'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Post Layout Options >> Then go to different settings which ever you want >> Then Publish ', 'real-estate-property' ); ?></p>
                	</div>
                	<div class="real-estate-property-theme-setting-item">
                        <div class="real-estate-property-theme-setting-item-header">
                            <?php esc_html_e( 'General Options Options', 'real-estate-property' ); ?>                            
                       	</div>
                        <div class="real-estate-property-theme-setting-item-content">
                        	<a target="_blank" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=real_estate_property_preloader_setting') ); ?>"><?php esc_html_e('Go to General Options', 'real-estate-property'); ?></a>
                     	</div>
                     	<p><?php esc_html_e( 'After Clicking go to customizer >> Go to Post General Options >> Then go to different settings which ever you want >> Then Publish ', 'real-estate-property' ); ?></p>
                	</div>
                	
                	<a target="_blank" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" class="real-estate-property-theme-setting-item real-estate-property-theme-setting-item-unavailable">
					    <div class="real-estate-property-theme-setting-item-header">
					        <span><?php esc_html_e("Customize All Fonts", "real-estate-property"); ?></span> <span><?php esc_html_e("Premium", "real-estate-property"); ?></span>
					    </div>
					    <div class="real-estate-property-theme-setting-item-content">
					        <span><?php esc_html_e("Go to Customizer", "real-estate-property"); ?></span>
					    </div>
					</a>

					<a target="_blank" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" class="real-estate-property-theme-setting-item real-estate-property-theme-setting-item-unavailable">
					    <div class="real-estate-property-theme-setting-item-header">
					        <span><?php esc_html_e("Customize All Color", "real-estate-property"); ?></span> <span><?php esc_html_e("Premium", "real-estate-property"); ?></span>
					    </div>
					    <div class="real-estate-property-theme-setting-item-content">
					        <span><?php esc_html_e("Go to Customizer", "real-estate-property"); ?></span>
					    </div>
					</a>

					<a target="_blank" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" class="real-estate-property-theme-setting-item real-estate-property-theme-setting-item-unavailable">
					    <div class="real-estate-property-theme-setting-item-header">
					        <span><?php esc_html_e("Section Reorder", "real-estate-property"); ?></span> <span><?php esc_html_e("Premium", "real-estate-property"); ?></span>
					    </div>
					    <div class="real-estate-property-theme-setting-item-content">
					        <span><?php esc_html_e("Go to Customizer", "real-estate-property"); ?></span>
					    </div>
					</a>

					<a target="_blank" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" class="real-estate-property-theme-setting-item real-estate-property-theme-setting-item-unavailable">
					    <div class="real-estate-property-theme-setting-item-header">
					        <span><?php esc_html_e("Typography Options", "real-estate-property"); ?></span> <span><?php esc_html_e("Premium", "real-estate-property"); ?></span>
					    </div>
					    <div class="real-estate-property-theme-setting-item-content">
					        <span><?php esc_html_e("Go to Customizer", "real-estate-property"); ?></span>
					    </div>
					</a>

					<a target="_blank" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" class="real-estate-property-theme-setting-item real-estate-property-theme-setting-item-unavailable">
					    <div class="real-estate-property-theme-setting-item-header">
					        <span><?php esc_html_e("One Click Demo Import", "real-estate-property"); ?></span> <span><?php esc_html_e("Premium", "real-estate-property"); ?></span>
					    </div>
					    <div class="real-estate-property-theme-setting-item-content">
					        <span><?php esc_html_e("Go to Customizer", "real-estate-property"); ?></span>
					    </div>
					</a>
					<a target="_blank" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" class="real-estate-property-theme-setting-item real-estate-property-theme-setting-item-unavailable">
					    <div class="real-estate-property-theme-setting-item-header">
					        <span><?php esc_html_e("Background  Settings", "real-estate-property"); ?></span> <span><?php esc_html_e("Premium", "real-estate-property"); ?></span>
					    </div>
					    <div class="real-estate-property-theme-setting-item-content">
					        <span><?php esc_html_e("Go to Customizer", "real-estate-property"); ?></span>
					    </div>
					</a>
					
				</div>
			</div>
		</div>
		<div id="righty">
			<div class="real-estate-property-theme-setting-sidebar-item">
		        <div class="real-estate-property-theme-setting-sidebar-header"><?php esc_html_e( 'Theme Bundle', 'real-estate-property' ) ?></div>
		        <div class="real-estate-property-theme-setting-sidebar-content">
		            <p class="m-0"><?php esc_html_e( 'Get our all themes in single pack.', 'real-estate-property' ) ?></p>
		            <div id="admin_links">
		            	<a href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUNDLE ); ?>" target="_blank" class="blue-button-2"><?php esc_html_e( 'Theme Bundle', 'real-estate-property' ) ?></a>
		            </div>
		        </div>
		    </div>
			<div class="real-estate-property-theme-setting-sidebar-item">
		        <div class="real-estate-property-theme-setting-sidebar-header"><?php esc_html_e( 'Free Documentation', 'real-estate-property' ) ?></div>
		        <div class="real-estate-property-theme-setting-sidebar-content">
		            <p class="m-0"><?php esc_html_e( 'Our guide is available if you require any help configuring and setting up the theme.', 'real-estate-property' ) ?></p>
		            <div id="admin_links">
		            	<a href="<?php echo esc_url( REAL_ESTATE_PROPERTY_DOCS_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Free Documentation', 'real-estate-property' ) ?></a>
		            </div>
		        </div>
		    </div>
		    <div class="real-estate-property-theme-setting-sidebar-item">
		        <div class="real-estate-property-theme-setting-sidebar-header"><?php esc_html_e( 'Support', 'real-estate-property' ) ?></div>
		        <div class="real-estate-property-theme-setting-sidebar-content">
		            <p class="m-0"><?php esc_html_e( 'Visit our website to contact us if you face any issues with our lite theme!', 'real-estate-property' ) ?></p>
		            <div id="admin_links">
		            	<a class="blue-button-2" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_SUPPORT_FREE ); ?>" target="_blank" class="btn3"><?php esc_html_e( 'Support', 'real-estate-property' ) ?></a>
		            </div>
		        </div>
		    </div>
		    <div class="real-estate-property-theme-setting-sidebar-item">
		        <div class="real-estate-property-theme-setting-sidebar-header"><?php esc_html_e( 'Review', 'real-estate-property' ) ?></div>
		        <div class="real-estate-property-theme-setting-sidebar-content">
		            <p class="m-0"><?php esc_html_e( 'Are you having fun with Real Estate Property? Review us on WordPress.org to show your support!', 'real-estate-property' ) ?></p>
		            <div id="admin_links">
		            	<a href="<?php echo esc_url( REAL_ESTATE_PROPERTY_REVIEW_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Review', 'real-estate-property' ) ?></a>
		            </div>
		        </div>
		    </div>
		</div>
	</div>

<?php } ?>