<?php
get_header();
$settings = author_personal_blog_get_theme_settings();
$s_post_el_is_on = [
    'show_post_category' => $settings['show_single_post_category'],
    'show_post_thumbnail' => $settings['show_single_post_thumbnail'],
    'show_post_date' => $settings['show_single_post_date'],
    'show_post_comments' => $settings['show_single_post_comments'],
    'show_post_author' => $settings['show_single_post_author'],
    'show_post_title' => $settings['show_single_post_title'],
    'show_recommend_posts' => $settings['show_recommend_posts'],
    'show_post_navigation' => $settings['show_post_navigation'],
    'show_post_tags' => $settings['show_single_post_tags'],
    'post_layout' => $settings['post_page_layout'],
    'show_post_author_box' => $settings['show_post_author_box'],
];
?>
<div class="single-post-header-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="single-post-header-content text-left">
                    <?php if ($s_post_el_is_on['show_post_category']) : ?>
                        <div class="author-personal-blog-standard-post__post-meta">
                            <?php author_personal_blog_categories(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="author-personal-blog-standard-post__post-title pl-0">
                        <?php if ($s_post_el_is_on['show_post_title']) : ?>
                            <h1 class="single-post-title"><?php the_title(); ?></h1>
                        <?php endif; ?>
                    </div>
                    <div class="author-personal-blog-standard-post__post-meta-wrapper">
                        <div class="author-personal-blog-standard-post__post-meta-single pl-0">
                            <?php
                            if ($s_post_el_is_on['show_post_author']) {
                                author_personal_blog_posted_by(false);
                            }
                            if ($s_post_el_is_on['show_post_date']) {
                                author_personal_blog_posted_on(false, 'publish');
                            }
                            if ($s_post_el_is_on['show_post_comments']) {
                                author_personal_blog_comment_popuplink();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <?php if (has_post_thumbnail() && $s_post_el_is_on['show_post_thumbnail']) : ?>
                    <div class="author-personal-blog-standard-post__thumbnail post-header p-0">
                        <?php author_personal_blog_post_thumbnail(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php do_action('author_personal_blog_before_default_page'); ?>
        <div class="post-details-page">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content', 'single');
            endwhile;
            if ($s_post_el_is_on['show_post_navigation']) {
                author_personal_blog_post_page_navigation();
            }
            if ($s_post_el_is_on['show_post_author_box']) {
                author_personal_blog_postedby();
            }
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            if ($s_post_el_is_on['show_recommend_posts']) {
                echo '<div class="related-post-wrapper">';
                author_personal_blog_cats_related_post();
                echo '</div>';
            }
            ?>
        </div>
        <?php do_action('author_personal_blog_after_default_page'); ?>
    </main>
</div>
<?php
get_footer();