<?php
/**
 * Displays related posts based on categories.
 *
 * Optimized for performance with caching and secure output.
 *
 * @package Author Personal Blog
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

function author_personal_blog_cats_related_post() {
    // Get current post ID and type
    $post_id = get_the_ID();
    if (!$post_id) {
        return; // Exit if no valid post ID
    }
    $current_post_type = get_post_type($post_id);
    if ($current_post_type !== 'post') {
        return; // Only proceed for standard posts
    }
    $sidebar_layout = $settings['post_sidebar'] ?? 'no';

    // Determine column classes
    $post_columns_class = 'col-md-6 col-lg-4 blog-grid-layout';
    if (in_array($sidebar_layout, ['right', 'left'], true)) {
        $post_columns_class = 'col-md-12 col-lg-6 col-xl-6 blog-grid-layout';
    }

    // Get category IDs
    $cat_ids = wp_cache_get('related_cat_ids_' . $post_id);
    if (false === $cat_ids) {
        $categories = get_the_category($post_id);
        $cat_ids = [];
        if (!empty($categories) && is_array($categories)) {
            $cat_ids = array_column($categories, 'term_id');
        }
        wp_cache_set('related_cat_ids_' . $post_id, $cat_ids, '', 3600); // Cache for 1 hour
    }

    // Exit if no categories
    if (empty($cat_ids)) {
        return;
    }

    // Query arguments
    $query_args = [
        'category__in'   => array_map('absint', $cat_ids), // Sanitize IDs
        'post_type'      => $current_post_type,
        'post__not_in'   => [$post_id],
        'posts_per_page' => 3,
        'no_found_rows'  => true, // Skip pagination count
        'ignore_sticky_posts' => true, // Ignore sticky posts
    ];

    // Cache query results
    $cache_key = 'related_posts_' . md5(serialize($query_args));
    $related_cats_post = wp_cache_get($cache_key);
    if (false === $related_cats_post) {
        $related_cats_post = new WP_Query($query_args);
        wp_cache_set($cache_key, $related_cats_post, '', 3600); // Cache for 1 hour
    }

    // Output related posts
    if ($related_cats_post->have_posts()) : ?>
        <div class="recommended-post-section mt-5 mb-5">
            <h4 class="related-post-title text-left"><?php echo esc_html__('Related Posts', 'author-personal-blog'); ?></h4>
            <div class="related-post-slider masonry-active row justify-content-md-center">
                <?php while ($related_cats_post->have_posts()) : $related_cats_post->the_post(); ?>
                    <div class="<?php echo esc_attr($post_columns_class); ?>">
                        <?php
                        get_template_part('template-parts/content/post', 'layout');
                        ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php
        wp_reset_postdata();
    endif;
}