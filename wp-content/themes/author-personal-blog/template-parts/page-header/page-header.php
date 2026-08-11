<?php
/**
 * Renders the page header section for the Author Personal Blog theme.
 *
 * @since 3.2.45
 * @hook author_personal_blog_before_page_title
 * @hook author_personal_blog_after_page_title
 */
?>
<section class="page-header-area" role="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left">
                <?php
                do_action('author_personal_blog_before_page_title');

                // Render page title based on context
                $title_class = apply_filters('author_personal_blog_page_title_class', 'page-title text-left');

                switch (true) {
                    case is_page():
                        echo '<h1 class="' . esc_attr($title_class) . '">' . esc_html(get_the_title()) . '</h1>';
                        break;
                    case is_category() || is_tag() || is_tax():
                        the_archive_title('<h1 class="' . esc_attr($title_class) . '">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        break;
                    case is_author():
                        get_template_part('template-parts/author', 'vcard');
                        break;
                    case is_search():
                        printf(
                            '<h1 class="' . esc_attr($title_class) . '">' . esc_html__('Search Results for: %s', 'author-personal-blog') . '</h1>',
                            '<span>' . esc_html(get_search_query()) . '</span>'
                        );
                        break;
                    case is_post_type_archive():
                        echo '<h1 class="' . esc_attr($title_class) . '">' . esc_html(post_type_archive_title('', false)) . '</h1>';
                        the_archive_description('<div class="archive-description">', '</div>');
                        break;
                    default:
                        echo '<h1 class="' . esc_attr($title_class) . '">' . esc_html__('Page Not Found', 'author-personal-blog') . '</h1>';
                        break;
                }

                do_action('author_personal_blog_after_page_title');
                ?>
            </div>
        </div>
    </div>
</section>