<?php
/**
 * Books Slider
 *
 * Displays a slider of books with optimized performance and security.
 *
 * @package Author Personal Blog
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// Retrieve cached theme settings
$settings = author_personal_blog_get_theme_settings();
$books_per_page = (int) $settings['books_per_page'] ?? 5;
$slide_to_show = (int) $settings['slide_to_show'] ?? 4;
$book_section_title_on_off = $settings['book_section_title_on_off'] ?? false;
$show_title_border = $settings['show_section_title_border'];
$book_section_title = $settings['book_section_title'] ?? __('Read My Books', 'author-personal-blog');

// Query arguments for books
$books_args = [
    'post_type' => 'book',
    'posts_per_page' => max(1, $books_per_page), // Ensure at least 1 post
    'order' => 'DESC',
    'orderby' => 'date',
    'no_found_rows' => true, // Skip pagination count for performance
];

// Cache the query results
$cache_key = 'books_slider_' . md5(serialize($books_args));
$books_slider_query = wp_cache_get($cache_key);
if (false === $books_slider_query) {
    $books_slider_query = new WP_Query($books_args);
    wp_cache_set($cache_key, $books_slider_query, '', 3600); // Cache for 1 hour
}

// Title classes
$title_classes = $show_title_border ? 'border-on' : 'border-off';
?>

<section id="blog-page-header-sidebar" class="blog-page-header-area">
    <?php if ($book_section_title_on_off && !empty(trim($book_section_title))) : ?>
        <div class="book-section-title <?php echo esc_attr($title_classes); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title-wrapper">
                            <div class="section-title-inner">
                                <h2><?php echo esc_html($book_section_title); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="books-slider-widget-area">
            <div class="books-slider-wrapper">
                <div class="books-slider-inner books-slider-active" data-slide-to-show="<?php echo esc_attr($slide_to_show); ?>">
                    <?php while ($books_slider_query->have_posts()) : $books_slider_query->the_post(); ?>
                        <article class="book-slider-layout books-content books-loop-item">
                            <?php if (function_exists('rswpbs_get_book_image') && ($book_image = rswpbs_get_book_image(get_the_ID())) !== '') : ?>
                                <div class="loop-book-image-wrapper">
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>">
						            	<?php echo rswpbs_get_book_image(get_the_ID()); ?>
						        	</a>
						        	<a href="<?php echo esc_url(get_the_permalink());?>" class="view-book-details"><?php esc_html_e('View Book', 'author-personal-blog'); ?></a>
                                </div>
                            <?php endif; ?>
                            <div class="loop-book-content-wrapper">
                                <?php if (function_exists('rswpbs_get_book_name') && ($book_name = rswpbs_get_book_name(get_the_ID())) !== '') : ?>
                                    <div class="content-item">
                                        <h2 class="book-name">
                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo wp_kses_post($book_name); ?></a>
                                        </h2>
                                    </div>
                                <?php endif; ?>
                                <?php if (function_exists('rswpbs_get_book_author') && ($book_author = rswpbs_get_book_author(get_the_ID())) !== '') : ?>
                                    <div class="content-item">
                                        <h4 class="book-author">
                                            <strong><?php echo esc_html__('By:', 'author-personal-blog'); ?></strong>
                                            <?php echo wp_kses_post($book_author); ?>
                                        </h4>
                                    </div>
                                <?php endif; ?>
                                <?php if (function_exists('rswpbs_get_book_price') && ($book_price = rswpbs_get_book_price(get_the_ID())) !== '') : ?>
                                    <div class="content-item">
                                        <h2 class="book-price d-flex justify-content-center">
                                            <?php echo wp_kses_post($book_price); ?>
                                        </h2>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>