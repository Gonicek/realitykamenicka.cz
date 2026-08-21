<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Real Estate Property
 */

get_header(); ?>

<section id="wrapper-404">
	<div class="container">
		<div class="inner-content py-5">
			<h1><?php echo esc_html(get_theme_mod('real_estate_property_404_page_heading',__('404','real-estate-property')));?></h1>
            <p><?php echo esc_html(get_theme_mod('real_estate_property_404_page_content',__('Oops! Something happened...','real-estate-property')));?></p>
            <?php if( get_theme_mod('real_estate_property_404_page_button','Home') != ''){ ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="boxed-btn reload"><?php echo esc_html(get_theme_mod('real_estate_property_404_page_button',__('Home','real-estate-property')));?></a>
			<?php } ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>