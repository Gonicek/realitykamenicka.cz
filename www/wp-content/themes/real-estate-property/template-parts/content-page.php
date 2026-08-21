<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package real-estate-property
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-style-1'); ?>>
	<?php if ( true == get_theme_mod( 'real_estate_property_single_post_content_on_off', 'on' ) ) :	?>	
	<div class="post-content">
		<div class="post-content-inner read-more-wrapper">
		<?php 
		if ( is_single() ) :
				the_content( 
					sprintf( 
						__( 'Read More', 'real-estate-property' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					) 
				);
			
			else:
					the_content( 
					sprintf( 
						__( 'Read More', 'real-estate-property' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					) 
				);
			endif;
		?>
		</div>
	</div>
<?php endif; ?>
</article>