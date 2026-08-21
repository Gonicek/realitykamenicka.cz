<?php
function real_estate_property_premium_setting( $wp_customize ) {
	
	/*=========================================
	Page Layout Settings Section
	=========================================*/
	$wp_customize->add_section(
        'real_estate_property_upgrade_premium',
        array(
            'title' 		=> __('Upgrade to Pro','real-estate-property'),
			'priority'      => 1,
		)
    );
	
	/*=========================================
	Add Buttons
	=========================================*/
	
	class Real_Estate_Property_WP_Button_Customize_Control extends WP_Customize_Control {
	public $type = 'real_estate_property_upgrade_premium';

	   function render_content() {
		?>
			<div class="premium_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Upgrade to Pro','real-estate-property' ); ?> </a></li>
				</ul>
			</div>
			<div class="premium_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo','real-estate-property' ); ?> </a></li>
				</ul>
			</div>
			<div class="premium_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_DOCS_FREE ); ?>" target="_blank"><?php esc_html_e( 'Free Documentation','real-estate-property' ); ?> </a></li>
				</ul>
			</div>
			<div class="premium_info discount-box">
				<ul>
					<li class="discount-text"><?php esc_html_e( 'Special Discount of 35% Use Code “winter35”','real-estate-property' ); ?></li>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( REAL_ESTATE_PROPERTY_BUNDLE ); ?>" target="_blank"><?php esc_html_e( 'WordPress Theme Bundle','real-estate-property' ); ?> </a></li>
				</ul>
			</div>
		<?php
	   }
	}
	
	$wp_customize->add_setting('real_estate_property_premium_info_buttons', array(
	   'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'real_estate_property_sanitize_text',
	));
		
	$wp_customize->add_control( new Real_Estate_Property_WP_Button_Customize_Control( $wp_customize, 'real_estate_property_premium_info_buttons', array(
		'section' => 'real_estate_property_upgrade_premium',
    ))
);
}
add_action( 'customize_register', 'real_estate_property_premium_setting' );