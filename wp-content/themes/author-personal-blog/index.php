<?php
get_header();
$settings = author_personal_blog_get_theme_settings();
global $wp;
$current_url = home_url(add_query_arg([], $wp->request));
$show_blog_extra_sections = strpos($current_url, '/page/') === false;
if ($show_blog_extra_sections) :
    if ($settings['show_about_section']) {
        get_template_part('template-parts/page-header/about', 'section');
    }
    if (class_exists('Rswpbs') && $settings['books_slider_on_off']) {
        get_template_part('template-parts/books-showcase/books', 'slider');
    }
endif;
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        do_action('author_personal_blog_before_default_page');
        if (have_posts()) :
            if ($settings['blog_section_title_on_off'] && !empty($settings['blog_section_title'])) :
                ?>
                <div class="blog-section-title-wrapper">
                    <div class="section-title-wrapper">
                        <div class="section-title-inner">
                            <h2><?php echo esc_html($settings['blog_section_title']); ?></h2>
                        </div>
                    </div>
                </div>
                <?php
            endif;
            echo '<div class="row' . esc_attr(author_personal_blog_masonry_layout_control()) . '">';
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content', get_post_type());
            endwhile;
            echo '</div>';
            author_personal_blog_navigation();
        else :
            get_template_part('template-parts/content/content', 'none');
        endif;
        do_action('author_personal_blog_after_default_page');
        ?>
    </main>
</div>
<?php get_footer();