<?php if ( true == get_theme_mod( 'real_estate_property_slide_on_off', 'off' ) ) : ?>

<?php $real_estate_property_slide_count = get_theme_mod('real_estate_property_slide_count'); ?>

<section id="home_slider">
	<div class="owl-carousel">
		<?php for ($i=1; $i <= $real_estate_property_slide_count; $i++) {
			
			$real_estate_property_slider_image = get_theme_mod('real_estate_property_slider_image'.$i);
	
			$real_estate_property_slider_heading = get_theme_mod('real_estate_property_slider_heading'.$i);
			 
			$real_estate_property_slider_content = get_theme_mod('real_estate_property_slider_content'.$i);

			$real_estate_property_slider_button_link = get_theme_mod('real_estate_property_slider_button_link'.$i);
			$real_estate_property_slider_button_text = get_theme_mod('real_estate_property_slider_button_text'.$i);
			 ?>

			<div class="slider_main_box">
				<?php if ( ! empty( $real_estate_property_slider_image ) ) : ?>
					<img src="<?php echo esc_url( $real_estate_property_slider_image ); ?>">
					<div class="slider_content_box">
						<?php if ( ! empty( $real_estate_property_slider_heading ) ): ?>
							<h3><?php echo esc_html( $real_estate_property_slider_heading ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $real_estate_property_slider_content ) ) : ?>
							<p><?php echo esc_html( $real_estate_property_slider_content ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $real_estate_property_slider_button_link ) || ! empty( $real_estate_property_slider_button_text ) ): ?>
							<a href="<?php echo esc_url( $real_estate_property_slider_button_link ); ?>"><?php echo esc_html( $real_estate_property_slider_button_text ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php } ?>
	</div>
</section>

<?php endif; ?>