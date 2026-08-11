<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Business School
 */
?>
<div id="footer">
  <?php 
    $business_school_footer_widget_enabled = get_theme_mod('business_school_footer_widget', true);
    
    if ($business_school_footer_widget_enabled !== false && $business_school_footer_widget_enabled !== '') { ?>

    <?php 
        $business_school_widget_areas = get_theme_mod('business_school_footer_widget_areas', '4');
        if ($business_school_widget_areas == '3') {
            $business_school_cols = 'col-lg-4 col-md-6';
        } elseif ($business_school_widget_areas == '4') {
            $business_school_cols = 'col-lg-3 col-md-6';
        } elseif ($business_school_widget_areas == '2') {
            $business_school_cols = 'col-lg-6 col-md-6';
        } else {
            $business_school_cols = 'col-lg-12 col-md-12';
        }
    ?>

    <div class="footer-widget">
        <div class="container">
          <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($business_school_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'business-school'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'business-school'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($business_school_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'business-school'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Archives', 'business-school'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($business_school_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'business-school'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Meta', 'business-school'); ?></h3>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($business_school_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="search-widget" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'business-school'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Search', 'business-school'); ?></h3>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
          </div>
        </div>
    </div>

  <?php } ?>
  <div class="clear"></div> 
  
  <div class="copywrap text-center">
    <?php $business_school_social_links_present = get_theme_mod('business_school_footer_facebook_link') || get_theme_mod('business_school_footer_instagram_link') || get_theme_mod('business_school_footer_pinterest_link') || get_theme_mod('business_school_footer_twitter_link') || get_theme_mod('business_school_footer_dribbble_link') || get_theme_mod('business_school_footer_youtube_link'); ?>
    <div class="container copywrap-info <?php echo $business_school_social_links_present ? '' : 'center-content'; ?>">
        <p>
        <a href="<?php 
            $business_school_copyright_link = get_theme_mod('business_school_copyright_link', '');
            if (empty($business_school_copyright_link)) {
                echo esc_url('https://www.theclassictemplates.com/products/free-business-school-wordpress-theme');
            } else {
                echo esc_url($business_school_copyright_link);
            } ?>" target="_blank">
            <?php echo esc_html(get_theme_mod('business_school_copyright_line', __('Business School WordPress Theme', 'business-school'))); ?>
        </a> 
        <?php echo esc_html('By Classic Templates', 'business-school'); ?>
        </p>
        <?php if ( $business_school_social_links_present ) { ?>
            <div class="footer-social d-flex gap-3">
                <?php if ( get_theme_mod('business_school_footer_facebook_link') ) { ?>
                    <a title="<?php echo esc_attr('facebook', 'business-school'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('business_school_footer_facebook_link')); ?>"><i class="fab fa-facebook-f"></i></a> 
                <?php } ?>
                <?php if ( get_theme_mod('business_school_footer_instagram_link') ) { ?> 
                    <a title="<?php echo esc_attr('instagram', 'business-school'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('business_school_footer_instagram_link')); ?>"><i class="fab fa-instagram"></i></a>
                <?php } ?>
                <?php if ( get_theme_mod('business_school_footer_googleplus_link') ) { ?>
                    <a title="<?php echo esc_attr('googleplus', 'business-school'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('business_school_footer_googleplus_link')); ?>"><i class="fab fa-google-plus-g"></i></a>
                <?php } ?>
                <?php if ( get_theme_mod('business_school_footer_youtube_link') ) { ?>
                    <a title="<?php echo esc_attr('youtube', 'business-school'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('business_school_footer_youtube_link')); ?>"><i class="fab fa-youtube"></i></a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
  </div>
</div>

<?php if(get_theme_mod('business_school_scroll_hide',true)){ ?>
    <a id="button"><?php echo esc_html( get_theme_mod('business_school_scroll_text',__('TOP', 'business-school' )) ); ?></a>
<?php } ?>
  
<?php wp_footer(); ?>
</body>
</html>
