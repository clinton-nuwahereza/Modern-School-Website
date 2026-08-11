<?php
get_header();
$settings = author_personal_blog_get_theme_settings();
if ($settings['show_archive_page_header']) {
    get_template_part('template-parts/page-header/page', 'header');
}
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        do_action('author_personal_blog_before_default_page');
        if (have_posts()) :
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
<?php
get_footer();