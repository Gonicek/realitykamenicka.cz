<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Real Estate Property
 */

get_header();
?>
<section id="blog-content">
    <div class="featured-img">
        <div class="post-thumbnail">
            <?php
            if (is_single()) :
                if (true == get_theme_mod('real_estate_property_single_post_image_on_off', 'on')) :
                    if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                    <?php else : ?>
                        <img src='<?php echo esc_url(get_template_directory_uri()); ?>/images/exist_img.jpg'>
                    <?php endif;
                endif;
            endif;
            ?>
            <div class="single-meta-box">
                <?php if (is_single()) :
                    the_title('<h1 class="entry-title">', '</h1>'); ?>
                    <?php if (true == get_theme_mod('real_estate_property_single_meta_on_off', 'on')) :
                        $post_id = get_the_ID();
                        $author_id = get_post_field('post_author', $post_id);
                    ?>
                        <ul class="meta-info list-inline">
                            <li class="posted-by">
                                <i class="fa fa-user"></i> 
                                <?php esc_html_e('By', 'real-estate-property'); ?> 
                                <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
                                    <?php echo get_the_author_meta('display_name', $author_id); ?>
                                </a>
                            </li>
                            <li class="post-date">
                                <a href="<?php echo esc_url(get_month_link(get_post_time('Y'), get_post_time('m'))); ?>">
                                    <i class="fa fa-calendar"></i> 
                                    <?php echo esc_html(get_the_date('j M, Y')); ?>
                                </a>
                            </li>
                            <li class="post-category">
                                <i class="fa fa-folder-open"></i> 
                                <?php the_category(', '); ?>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php if (get_theme_mod('real_estate_property_breadcrumb_setting', true)) : ?>
                        <div class="bread_crumb text-center">
                            <?php real_estate_property_breadcrumb(); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <?php if (have_posts()) : ?>                    
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/content', 'page'); ?>
                    <?php endwhile; ?>
                    
                    <!-- Pagination -->
                    <?php if (true == get_theme_mod('real_estate_property_single_post_pagination_on_off', 'on')) : ?>
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
                    <?php endif; ?>
                    <!-- Pagination -->
                <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
                <?php endif; ?>
                <?php comments_template('', true); ?>
                
                <!-- Related Posts -->
                <div class="related-posts">
                    <h3 class="py-4"><?php esc_html_e('Related Posts:-', 'real-estate-property'); ?></h3>
                    <div class="row">
                        <?php
                        $real_estate_property_categories = get_the_category();
                        if ($real_estate_property_categories) {
                            $real_estate_property_category_ids = array();
                            foreach ($real_estate_property_categories as $category) {
                                $real_estate_property_category_ids[] = $category->term_id;
                            }
                            
                            $real_estate_property_related_args = array(
                                'category__in' => $real_estate_property_category_ids,
                                'post__not_in' => array(get_the_ID()),
                                'posts_per_page' => 3,
                                'orderby' => 'rand'
                            );
                            
                            $real_estate_property_related_query = new WP_Query($real_estate_property_related_args);
                            
                            if ($real_estate_property_related_query->have_posts()) {
                                while ($real_estate_property_related_query->have_posts()) {
                                    $real_estate_property_related_query->the_post(); ?>
                                    <div class="col-lg-4 col-md-6 related-post-item py-2">
                                        <div class="related-post-thumbnail">
                                            <?php if ( get_theme_mod( 'real_estate_property_enable_related_post_thumbnail', true ) ) : ?>
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('medium'); ?>
                                                <?php else : ?>
                                                    <img src='<?php echo esc_url(get_template_directory_uri()); ?>/images/exist_img.jpg'>
                                                <?php endif; ?>
                                             <?php endif; ?>
                                            <h4 class="mt-2 post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        </div>
                                    </div>
                                <?php }
                                wp_reset_postdata();
                            } else {
                                echo '<p>' . esc_html__('No related posts found.', 'real-estate-property') . '</p>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- End Related Posts -->
            </div>
            <div class="col-lg-3 col-md-4 sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>    
<!-- End of Blog & Sidebar Section -->

<div class="clearfix"></div>

<?php get_footer(); ?>