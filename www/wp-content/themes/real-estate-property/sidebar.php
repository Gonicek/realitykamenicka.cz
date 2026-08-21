<?php
/**
 * Sidebar File
 *
 * This file contains the sidebar structure for the theme.
 * The sidebar includes the Archives, Recent Posts, and Tags widgets.
 *
 * @package Real Estate Property
 */
?>
<div id="sidebar">    
    <?php if ( ! dynamic_sidebar( 'sidebar-primary' ) ) : ?>

    	<!-- Search Widget -->
		<aside id="search" class="widget widget_search" role="complementary" aria-label="firstsidebar">
		    <h5 class="widget-title"><?php esc_html_e('Search', 'real-estate-property'); ?></h5>
		    <span class="animate-border border-black"></span>
		    <?php get_search_form(); ?>
		</aside>

        <!-- Archives Widget -->
        <aside id="archives" class="widget widget_archive" role="complementary" aria-label="firstsidebar">
            <h5 class="widget-title"><?php esc_html_e( 'Archives List', 'real-estate-property' ); ?></h5>
            <span class="animate-border border-black"></span>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>

        <!-- Recent Posts Widget -->
        <aside id="recent-posts-widget" class="widget widget_recent_posts" role="complementary" aria-label="firstsidebar">
		    <h5 class="widget-title"><?php esc_html_e('Recent Posts', 'real-estate-property'); ?></h5>
		    <span class="animate-border border-black"></span>
		    <ul class="wp-block-latest-posts__list">
		        <?php
		        // Query recent posts
		        $real_estate_property_recent_posts = wp_get_recent_posts(array(
		            'numberposts' => 5, // Adjust the number of posts to display
		            'post_status' => 'publish',
		        ));

		        // Loop through recent posts
		        foreach ($real_estate_property_recent_posts as $post) :
		            ?>
		            <li>
		                <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
		                    <?php echo esc_html($post['post_title']); ?>
		                </a>
		            </li>
		        <?php endforeach; ?>
		    </ul>
		</aside>

		<!-- Meta Widget -->
		<aside id="meta" class="widget widget_meta" role="complementary" aria-label="firstsidebar">
		    <h5 class="widget-title"><?php esc_html_e('Meta', 'real-estate-property'); ?></h5>
		    <span class="animate-border border-black"></span>
		    <ul>
		        <?php wp_register(); ?>
		        <li><?php wp_loginout(); ?></li>
		        <?php wp_meta(); ?>
		    </ul>
		</aside>

		<!-- Categories Widget -->
		<aside id="categories" class="widget widget_categories" role="complementary" aria-label="firstsidebar">
		    <h5 class="widget-title"><?php esc_html_e('Categories', 'real-estate-property'); ?></h5>
		    <span class="animate-border border-black"></span>
		    <ul>
		        <?php
		        wp_list_categories(array(
		            'title_li' => '',
		        ));
		        ?>
		    </ul>
		</aside>

		<!-- Tags Widget -->
		<aside id="tags-widget" class="widget widget_tag_cloud" role="complementary" aria-label="firstsidebar">
		    <h5 class="widget-title"><?php esc_html_e('Tag Cloud', 'real-estate-property'); ?></h5>
		    <span class="animate-border border-black"></span>
		    <?php wp_tag_cloud(array(
		        'smallest' => 10,   // Minimum font size
		        'largest' => 22,    // Maximum font size
		        'unit' => 'px',     // Font size unit (pixels)
		        'number' => 20,      // Maximum number of tags to display
		        'format' => 'array' // Display as an array for more control
		    )); ?>
		    <div class="tagcloud">
		        <?php
		        $tags = get_tags(); // Get all tags
		        foreach ($tags as $tag) :
		        ?>
		            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="custom-tag-link">
		                <?php echo esc_html($tag->name); ?>
		            </a>
		        <?php endforeach; ?>
		    </div>
		</aside>
    <?php endif; ?>
</div>
