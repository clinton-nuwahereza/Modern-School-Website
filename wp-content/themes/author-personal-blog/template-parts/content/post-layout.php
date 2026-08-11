<?php
$settings = author_personal_blog_get_theme_settings();
$get_post_column_layout = '3';
if (is_home()) {
    $get_post_column_layout = $settings['blog_page_post_column'];
} elseif (is_search()) {
    $get_post_column_layout = $settings['search_page_post_column'];
} elseif (is_archive()) {
    $get_post_column_layout = $settings['archive_page_post_column'];
}
$post_column_layout = 'col-sm-12 col-md-6 col-lg-4';
if ($get_post_column_layout == '2') {
    $post_column_layout = 'col-lg-6 col-md-12';
} elseif ($get_post_column_layout == '4') {
    $post_column_layout = 'col-sm-12 col-md-6 col-lg-3';
}
$post_classes = 'author-personal-blog-standard-post' . (!has_post_thumbnail() ? ' no-post-thumbnail' : '');
$post_el_is_on = [
    'show_post_category' => $settings['show_post_category'],
    'show_post_thumbnail' => $settings['show_post_thumbnail'],
    'show_post_date' => $settings['show_post_date'],
    'show_post_author' => $settings['show_post_author'],
    'show_post_title' => $settings['show_post_title'],
    'show_post_excerpt' => $settings['show_post_excerpt'],
];
if (!is_single()) :
?>
<div class="<?php echo esc_attr($post_column_layout); ?> blog-grid-layout">
<?php endif; ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
        <div class="author-personal-blog-standard-post__entry-content text-left">
            <div class="author-personal-blog-standard-post__overlay-layout">
                <?php if ($post_el_is_on['show_post_thumbnail'] && has_post_thumbnail()) : ?>
                    <div class="post-thumbnail has-post-thumbnail" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'author-personal-blog-overlay-thumbnail')); ?>);"></div>
                <?php endif; ?>
                <div class="author-personal-blog-standard-post__overlay-content<?php echo has_post_thumbnail() ? ' has-post-thumbnail' : ' no-post-thumbnail'; ?>">
                    <div class="content-container">
                        <?php if ($post_el_is_on['show_post_category']) : ?>
                            <div class="author-personal-blog-standard-post__post-meta mb-3">
                                <?php author_personal_blog_categories(); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_el_is_on['show_post_title']) : ?>
                            <div class="author-personal-blog-standard-post__post-title">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </div>
                        <?php endif; ?>
                        <div class="author-personal-blog-standard-post__blog-meta">
                            <?php
                            if ($post_el_is_on['show_post_author']) {
                                author_personal_blog_posted_by(false);
                            }
                            if ($post_el_is_on['show_post_date']) {
                                author_personal_blog_posted_on(false, 'publish');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php if (!is_single()) : ?>
</div>
<?php endif; ?>