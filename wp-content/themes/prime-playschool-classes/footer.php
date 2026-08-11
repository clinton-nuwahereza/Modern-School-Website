<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prime_playschool_classes
 */
$prime_playschool_classes_scroll_top  = get_theme_mod( 'prime_playschool_classes_scroll_to_top', true );
$prime_playschool_classes_footer_background = get_theme_mod('footer_background_image');
$prime_playschool_classes_footer_background_url = '';
if(!empty($prime_playschool_classes_footer_background)){
    $prime_playschool_classes_footer_background = absint($prime_playschool_classes_footer_background);
    $prime_playschool_classes_footer_background_url = wp_get_attachment_url($prime_playschool_classes_footer_background);
}

$prime_playschool_classes_footer_background_color = get_theme_mod('footer_background_color', 'var(--secondary-color)'); // New line

$prime_playschool_classes_footer_background_style = '';
if (!empty($prime_playschool_classes_footer_background_url)) {
    $prime_playschool_classes_footer_background_style = ' style="background-image: url(\'' . esc_url($prime_playschool_classes_footer_background_url) . '\'); background-repeat: no-repeat; background-size: cover;"';
} else {
    $prime_playschool_classes_footer_background_style = ' style="background-color: ' . esc_attr($prime_playschool_classes_footer_background_color) . ';"'; // Updated line
}
?>

</div>
</div>
</div>
</div>

<footer class="site-footer"<?php echo($prime_playschool_classes_footer_background_style);  ?>>
    <?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) || is_active_sidebar( 'footer-four' ) ){ ?>
        <div class="footer-t">
            <div class="container">
                <div class="row">
                    <?php 
                    if( is_active_sidebar( 'footer-one') ) {
                        echo '<div class="col">';
                        dynamic_sidebar( 'footer-one' ); 
                        echo '</div>';
                    }
                    
                    if( is_active_sidebar( 'footer-two') ) {
                        echo '<div class="col">';
                        dynamic_sidebar( 'footer-two' );
                        echo '</div>';
                    }
                    
                    if( is_active_sidebar( 'footer-three') ) {
                        echo '<div class="col">';
                        dynamic_sidebar( 'footer-three' );
                        echo '</div>';
                    }
                    
                    if( is_active_sidebar( 'footer-four' ) ) {
                        echo '<div class="col">';
                        dynamic_sidebar( 'footer-four' );
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="footer-t">
            <div class="container">
                <div class="row">
                    <!-- Archive -->
                    <aside id="archive" class="widget widget_archive col" role="complementary" aria-label="<?php esc_attr_e('secondsidebar', 'prime-playschool-classes'); ?>">
                        <h2 class="widget-title"><?php esc_html_e('Archive List', 'prime-playschool-classes'); ?></h2>
                        <ul>
                            <?php wp_get_archives('type=monthly'); ?>
                        </ul>
                    </aside>
                    <!-- Recent Posts -->
                    <aside id="recent-posts" class="widget widget_recent_posts col" role="complementary" aria-label="<?php esc_attr_e('thirdsidebar', 'prime-playschool-classes'); ?>">
                        <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'prime-playschool-classes'); ?></h2>
                        <ul>
                            <?php
                            $args = array(
                                'post_type'      => 'post',
                                'posts_per_page' => 5,
                            );
                            $prime_playschool_classes_recent_posts = new WP_Query($args);

                            while ($prime_playschool_classes_recent_posts->have_posts()) : $prime_playschool_classes_recent_posts->the_post();
                            ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </ul>
                    </aside>
                    <!-- Categories -->
                    <aside id="categories" class="widget widget_categories col" role="complementary" aria-label="<?php esc_attr_e('fourthsidebar', 'prime-playschool-classes'); ?>">
                        <h2 class="widget-title"><?php esc_html_e('Categories', 'prime-playschool-classes'); ?></h2>
                        <ul>
                            <?php
                            $args = array(
                                'title_li' => '',
                            );
                            wp_list_categories($args);
                            ?>
                        </ul>
                    </aside>
                    <!-- Tags Widget -->
                    <aside id="tags" class="widget widget_tags col" role="complementary" aria-label="<?php esc_attr_e('fifthsidebar', 'prime-playschool-classes'); ?>">
                        <h2 class="widget-title"><?php esc_html_e('Tags', 'prime-playschool-classes'); ?></h2>
                        <div class="tag-cloud">
                            <?php wp_tag_cloud(); ?>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    <?php } 
    do_action( 'prime_playschool_classes_footer' );
    ?>
    <?php  
    if ( $prime_playschool_classes_scroll_top ){ ?>
        <a id="button"><i class="fas fa-arrow-up"></i></a>
    <?php } ?>
</footer>
</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
