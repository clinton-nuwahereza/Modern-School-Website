<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Author Personal Blog
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!function_exists('author_personal_blog_posted_on')) :
    /**
     * Prints HTML with meta information for the post date.
     *
     * @param bool   $icon      Whether to display an icon.
     * @param string $date_type Which date to display ('publish' or 'modified'). Default 'publish'.
     * @return void
     */
    function author_personal_blog_posted_on($icon = false, $date_type = 'publish') {
        $date_type = in_array($date_type, ['publish', 'modified'], true) ? $date_type : 'publish';
        $cache_key = 'post_date_' . get_the_ID() . '_' . $date_type . '_' . ($icon ? 'icon' : 'noicon');
        $output = wp_cache_get($cache_key);
        if (false === $output) {
            $date = $date_type === 'publish' ? get_the_date() : get_the_modified_date();
            $date_w3c = $date_type === 'publish' ? get_the_date(DATE_W3C) : get_the_modified_date(DATE_W3C);
            $time_string = sprintf(
                '<time class="entry-date %1$s" datetime="%2$s">%3$s</time>',
                esc_attr($date_type),
                esc_attr($date_w3c),
                esc_html($date)
            );
            $line = '<i class="dote"></i> ';
            if (filter_var($icon, FILTER_VALIDATE_BOOLEAN)) {
                $line = '<i class="rswpthemes-icon icon-calendar-days-solid" aria-hidden="true"></i>';
            }
            $posted_on = sprintf(
                '<a href="%1$s" rel="bookmark">%2$s</a>',
                esc_url(get_permalink()),
                $time_string
            );
            $output = '<span class="posted-on">' . wp_kses_post($line . $posted_on) . '</span>';
            wp_cache_set($cache_key, $output, '', 3600);
        }
        echo $output;
    }
endif;

if (!function_exists('author_personal_blog_time')) :
    /**
     * Displays the post date/time.
     *
     * @return void
     */
    function author_personal_blog_time() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        echo '<i class="blog-time">' . wp_kses_post($time_string) . '</i>';
    }
endif;

if (!function_exists('author_personal_blog_reading_time')) :
    /**
     * Estimates reading time for the current post.
     *
     * @return string HTML output with reading time estimate.
     */
    function author_personal_blog_reading_time() {
        global $post;
        if (!isset($post->post_content)) {
            return '';
        }

        $thecontent = wp_strip_all_tags($post->post_content);
        $words = str_word_count($thecontent);
        $m = floor($words / 200);
        $s = floor($words % 200 / (200 / 60));

        $estimate = sprintf(
            '%d minute%s, %d second%s',
            $m,
            $m == 1 ? '' : 's',
            $s,
            $s == 1 ? '' : 's'
        );

        $output = sprintf(
            '<span><i class="rswpthemes-icon icon-clock-regular" aria-hidden="true"></i> %s</span>',
            esc_html($estimate)
        );

        return $output;
    }
endif;

if (!function_exists('author_personal_blog_posted_by')) :
    /**
     * Displays the post author with optional avatar.
     *
     * @param bool $author_image Whether to display the author image.
     * @return void
     */
    function author_personal_blog_posted_by($author_image = true) {
        $post_author_id = get_post_field('post_author', get_queried_object_id());
        if (!$post_author_id) {
            return;
        }
        $cache_key = 'post_author_' . get_the_ID();
        $posted_by = wp_cache_get($cache_key);
        if (false === $posted_by) {
            $get_author_image = filter_var($author_image, FILTER_VALIDATE_BOOLEAN)
                ? '<span class="post-author-image"><i class="rswpthemes-icon icon-user-solid" aria-hidden="true"></i></span> '
                : '';
            $posted_by = sprintf(
                '<a href="%1$s">%2$s<i>%3$s</i></a>',
                esc_url(get_author_posts_url($post_author_id)),
                wp_kses_post($get_author_image),
                esc_html(get_the_author_meta('display_name', $post_author_id))
            );
            wp_cache_set($cache_key, $posted_by, '', 3600);
        }
        echo '<span class="posted_by">' . wp_kses_post($posted_by) . '</span>';
    }
endif;

if (!function_exists('author_personal_blog_comment_popuplink')) :
    /**
     * Displays a comment link if comments are open or there are comments.
     *
     * @return void
     */
    function author_personal_blog_comment_popuplink() {
        if (post_password_required() || (!comments_open() && !get_comments_number())) {
            return;
        }

        echo '<span class="comments-link">';
        $number = (int) get_comments_number(get_the_ID());
        $css_class = $number === 0 ? 'zero-comments' : ($number === 1 ? 'one-comment' : 'multiple-comments');

        comments_popup_link(
            esc_html__('Add Comment', 'author-personal-blog'),
            esc_html__('1 Comment', 'author-personal-blog'),
            esc_html__('% Comments', 'author-personal-blog'),
            esc_attr($css_class),
            esc_html__('Comments are Closed', 'author-personal-blog')
        );

        echo '</span>';
    }
endif;

if (!function_exists('author_personal_blog_categories')) :
    /**
     * Displays post categories.
     *
     * @return void
     */
    function author_personal_blog_categories() {
        if (get_post_type() !== 'post') {
            return;
        }
        $cache_key = 'post_categories_' . get_the_ID();
        $categories_list = wp_cache_get($cache_key);
        if (false === $categories_list) {
            $categories_list = get_the_category_list(' ');
            wp_cache_set($cache_key, $categories_list, '', 3600);
        }
        if ($categories_list) {
            echo '<span class="cat-links">' . wp_kses_post($categories_list) . '</span>';
        }
    }
endif;

if (!function_exists('author_personal_blog_post_tag')) :
    /**
     * Displays post tags.
     *
     * @return void
     */
    function author_personal_blog_post_tag() {
        if (get_post_type() !== 'post') {
            return;
        }

        $tags_list = get_the_tag_list('', ' ');
        if ($tags_list) {
            echo '<span class="tags-links">' . wp_kses_post($tags_list) . '</span>';
        }
    }
endif;

if (!function_exists('author_personal_blog_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * @return void
     */
    function author_personal_blog_post_thumbnail() {
        if (!has_post_thumbnail()) {
            return;
        }
        $cache_key = 'post_thumbnail_' . get_the_ID() . '_' . (is_single() || is_page() ? 'large' : 'grid');
        $output = wp_cache_get($cache_key);
        if (false === $output) {
            if (is_single() || is_page()) {
                $output = get_the_post_thumbnail(null, 'author-personal-blog-thumbnail-large', ['loading' => 'lazy']);
            } else {
                $settings = author_personal_blog_get_theme_settings();
                $sidebar_layouts = 'no';
                $get_post_column_layout = '3';
                if (is_home()) {
                    $sidebar_layouts = get_theme_mod('blog_page_sidebar', 'no');
                    $get_post_column_layout = $settings['blog_page_post_column'];
                } elseif (is_search()) {
                    $sidebar_layouts = get_theme_mod('search_page_sidebar', 'no');
                    $get_post_column_layout = $settings['search_page_post_column'];
                } elseif (is_archive()) {
                    $sidebar_layouts = get_theme_mod('archive_page_sidebar', 'no');
                    $get_post_column_layout = $settings['archive_page_post_column'];
                }
                $thumbnail_size = 'author-personal-blog-grid-thumbnail';
                if ($sidebar_layouts === 'no' && $get_post_column_layout === '2') {
                    $thumbnail_size = 'author-personal-blog-thumbnail-medium';
                } elseif (($sidebar_layouts === 'right' || $sidebar_layouts === 'left') && $get_post_column_layout === '2') {
                    $thumbnail_size = 'author-personal-blog-grid-thumbnail';
                }
                $output = sprintf(
                    '<a href="%1$s">%2$s</a>',
                    esc_url(get_the_permalink()),
                    get_the_post_thumbnail(null, $thumbnail_size, ['loading' => 'lazy'])
                );
            }
            wp_cache_set($cache_key, $output, '', 3600);
        }
        echo $output;
    }
endif;

if (!function_exists('author_personal_blog_navigation')) :
    /**
     * Displays post navigation.
     *
     * @return void
     */
    function author_personal_blog_navigation() {
        $pagination_alignment = get_theme_mod('blog_page_pagination', 'center');

        echo '<div class="pagination-' . esc_attr($pagination_alignment) . '">';
        the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => '<i class="rswpthemes-icon icon-angle-left-solid" aria-hidden="true"></i>',
            'next_text' => '<i class="rswpthemes-icon icon-angle-right-solid" aria-hidden="true"></i>',
        ]);
        echo '</div>';
    }
endif;

if (!function_exists('author_personal_blog_post_page_navigation')) :
    /**
     * Displays single post navigation.
     *
     * @return void
     */
    function author_personal_blog_post_page_navigation() {
        if (!get_next_post_link() && !get_previous_post_link()) {
            return;
        }

        echo '<div class="d-flex single-post-navigation justify-content-between">';
        if (get_previous_post_link()) {
            echo '<div class="previous-post">';
            echo '<div class="postarrow"><i class="rswpthemes-icon icon-angle-left-solid" aria-hidden="true"></i>' . esc_html__('Previous Post', 'author-personal-blog') . '</div>';
            echo wp_kses_post(get_previous_post_link('%link'));
            echo '</div>';
        }
        if (get_next_post_link()) {
            echo '<div class="next-post">';
            echo '<div class="postarrow">' . esc_html__('Next Post', 'author-personal-blog') . '<i class="rswpthemes-icon icon-angle-right-solid" aria-hidden="true"></i></div>';
            echo wp_kses_post(get_next_post_link('%link'));
            echo '</div>';
        }
        echo '</div>';
    }
endif;

if (!function_exists('author_personal_blog_postedby')) :
    /**
     * Displays author information.
     *
     * @return void
     */
    function author_personal_blog_postedby() {
        $author_id = get_the_author_meta('ID');
        if (!$author_id) {
            return;
        }

        echo '<div class="post-author">';
        echo '<div class="d-block d-md-flex">';
        echo '<div class="author-image">';
        echo get_avatar($author_id, 200, '', esc_attr(get_the_author_meta('nickname')), ['class' => 'avatar']);
        echo '</div>';
        echo '<div class="author-about">';
        echo '<h4>' . esc_html(get_the_author_meta('nickname')) . '</h4>';
        echo '<p>' . wp_kses_post(get_the_author_meta('description')) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
endif;

if (!function_exists('author_personal_blog_theme_by')) :
    /**
     * Displays theme credit.
     *
     * @return void
     */
    function author_personal_blog_theme_by() {
        echo '<div class="theme-by-wrapper">';
        echo '<div class="theme-by-inner">';
        echo '<strong>' . esc_html__('Proudly powered by ', 'author-personal-blog') . '</strong>';
        echo '<a href="' . esc_url('https://rswpthemes.com/') . '">' . esc_html__('RS WP THEMES', 'author-personal-blog') . '</a>';
        echo '</div>';
        echo '</div>';
    }
endif;

/**
 * Lazy Load Control
 */
add_filter('wp_lazy_loading_enabled', function () {
    $get_lazy_load = get_theme_mod('wp_lazy_load_control', false);
    return filter_var($get_lazy_load, FILTER_VALIDATE_BOOLEAN);
});