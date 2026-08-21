<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Real Estate Property
 */

get_header();
$real_estate_property_sidebar_position = get_theme_mod('real_estate_property_single_page_sidebar_option', 'right');
 ?>

<section id="blog-content" class="search-result <?php echo $real_estate_property_sidebar_position == 'none' ? 'no-sidebar' : 'has-sidebar'; ?>">
    <div class="featured-img">
        <div class="post-thumbnail">
            <?php
            if ( has_post_thumbnail() ) :
                the_post_thumbnail();
            else :
                // Get custom fallback image set from the Customizer
                $real_estate_property_custom_fallback_img = get_theme_mod( 'real_estate_property_custom_fallback_img' );

                if ( ! empty( $real_estate_property_custom_fallback_img ) ) :
                    ?>
                    <img src="<?php echo esc_url( $real_estate_property_custom_fallback_img ); ?>">
                <?php else : ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/exist_img.jpg' ); ?>">
                <?php endif;
            endif;
            ?>
        </div>
        <div class="single-meta-box">
            <h2 class="my-3"><?php the_title(); ?></h2>
            <?php if ( get_theme_mod('real_estate_property_breadcrumb_setting',true) ) : ?>
                  <div class="bread_crumb text-center">
                    <?php real_estate_property_breadcrumb();  ?>
                  </div>
                <?php endif; ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php if ($real_estate_property_sidebar_position == 'left') : ?>
                <div class="col-lg-3 col-md-4 sidebar">
                    <?php get_sidebar(); ?>
                </div>
            <?php endif; ?>
                <div class="<?php echo $real_estate_property_sidebar_position == 'none' ? 'col-lg-12' : 'col-lg-9'; ?> col-md-8">
                    <div class="site-content">
                        <?php if ( have_posts() ) : ?>
                            <div class="row">
                                <?php
                                $count = 0;
                                while ( have_posts() ) : the_post();
                                    ?>
                                    <div class="col-md-6 col-sm-6 mb-4">
                                        <?php
                                        get_template_part( 'template-parts/content', 'search' );
                                        ?>
                                    </div>
                                    <?php
                                    $count++;
                                    if ( $count % 2 == 0 ) {
                                        echo '</div><div class="row">'; // start new row after 2 posts
                                    }
                                endwhile;
                                ?>
                            </div>

                            <div class="paginations">
                                <?php
                                the_post_navigation(
                                    array(
                                        'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                                        'next_text' => '<i class="fa fa-angle-double-right"></i>',
                                    )
                                );
                                ?>
                            </div>

                        <?php else : ?>
                            <?php get_template_part( 'template-parts/content', 'none' ); ?>
                        <?php endif; ?>
                    </div>
                </div>

            <?php if ($real_estate_property_sidebar_position == 'right') : ?>
                <div class="col-lg-3 col-md-4 sidebar">
                    <?php get_sidebar(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();