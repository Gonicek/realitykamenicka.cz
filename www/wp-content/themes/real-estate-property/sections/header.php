<!-- Start: Header
============================= -->
<?php

$real_estate_property_top_twitter_link = get_theme_mod('real_estate_property_top_twitter_link');
$real_estate_property_top_linkdin_link = get_theme_mod('real_estate_property_top_linkdin_link');
$real_estate_property_top_youtube_link = get_theme_mod('real_estate_property_top_youtube_link');
$real_estate_property_top_facebook_link = get_theme_mod('real_estate_property_top_facebook_link');
$real_estate_property_top_instagram_link = get_theme_mod('real_estate_property_top_instagram_link');

$real_estate_property_header_register_link = get_theme_mod('real_estate_property_header_register_link');
$real_estate_property_header_register_text = get_theme_mod('real_estate_property_header_register_text');

$real_estate_property_header_phone_number = get_theme_mod('real_estate_property_header_phone_number');
$real_estate_property_header_email_address = get_theme_mod('real_estate_property_header_email_address');

?>

<div class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 align-self-center">
				<div class="logo main text-center text-md-start">
					<?php if ( function_exists( 'real_estate_property_logo_title_description' ) ) :	real_estate_property_logo_title_description(); endif; ?>
				</div>
			</div>
			<div class="col-lg-7 col-md-7 align-self-center text-center text-md-end">
				<?php if ( ! empty( $real_estate_property_header_phone_number ) ): ?>
					<span class="me-4"><i class="fa fa-phone me-3" aria-hidden="true"></i><?php echo esc_html( $real_estate_property_header_phone_number ); ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $real_estate_property_header_email_address ) ): ?>
					<span><i class="fa fa-envelope me-3" aria-hidden="true"></i><?php echo esc_html( $real_estate_property_header_email_address ); ?></span>
				<?php endif; ?>
			</div>
			<div class="col-lg-2 col-md-2 align-self-center text-center text-md-end">
				<div class="icons-media">
					<?php if ( ! empty( $real_estate_property_top_twitter_link ) ): ?>
						<a href="<?php echo esc_url( $real_estate_property_top_twitter_link ); ?>"><i class="fa fa-twitter me-2" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					<?php if ( ! empty( $real_estate_property_top_linkdin_link ) ): ?>
						<a href="<?php echo esc_url( $real_estate_property_top_linkdin_link ); ?>"><i class="fa fa-linkedin me-2" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					<?php if ( ! empty( $real_estate_property_top_youtube_link ) ): ?>
						<a href="<?php echo esc_url( $real_estate_property_top_youtube_link ); ?>"><i class="fa fa-youtube-play me-2" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					<?php if ( ! empty( $real_estate_property_top_facebook_link ) ): ?>
						<a href="<?php echo esc_url( $real_estate_property_top_facebook_link ); ?>"><i class="fa fa-facebook me-2" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					<?php if ( ! empty( $real_estate_property_top_instagram_link ) ): ?>
						<a href="<?php echo esc_url( $real_estate_property_top_instagram_link ); ?>"><i class="fa fa-instagram me-2" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<header id="header" role="banner" class="navbar-area container <?php echo esc_attr(real_estate_property_sticky_header()); ?>" <?php if ( get_header_image() ) { ?> style="background-image: url( <?php header_image(); ?> ); background-size: 100%;" <?php } ?> >
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-7 col-4 align-self-center">
				<div class="toggle-menu gb_menu mb-2 mb-md-0 text-left">
					<button onclick="real_estate_property_navigation_open()" class="gb_toggle"><p class="mb-0"><?php esc_html_e('Menu','real-estate-property'); ?></p></button>
				</div>
				<div id="gb_responsive" class="nav side_gb_nav">
					<nav id="top_gb_menu" class="gb_nav_menu" role="navigation" aria-label="<?php esc_attr_e( 'Menu', 'real-estate-property' ); ?>">
						<?php 
						    wp_nav_menu( array( 
								'theme_location' => 'primary_menu',
								'container_class' => 'gb_navigation clearfix' ,
								'menu_class' => 'clearfix',
								'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav mb-0 px-0">%3$s</ul>',
								'fallback_cb' => 'wp_page_menu',
						    ) ); 
						?>
						<a href="javascript:void(0)" class="closebtn gb_menu" onclick="real_estate_property_navigation_close()">x<span class="screen-reader-text"><?php esc_html_e('Close Menu','real-estate-property'); ?></span></a>
					</nav>
				</div>
			</div>
			<div class="col-lg-3 col-md-5 col-8 align-self-center text-center text-md-end">
				<?php if ( ! empty( $real_estate_property_header_register_link ) || ! empty( $real_estate_property_header_register_text ) ): ?>
					<a class="register_button" href="<?php echo esc_url( $real_estate_property_header_register_link ); ?>">
						<?php echo esc_html( $real_estate_property_header_register_text ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>