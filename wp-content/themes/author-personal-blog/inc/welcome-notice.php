<?php
/**
 * Display the admin notice for demo setup with popup.
 */
function author_personal_blog_show_demo_setup_notice() {
    // Check if the notice should be dismissed forever
    if (get_option('author_personal_blog_notice_dismissed_forever')) {
        return;
    }
    if (isset($_GET['page']) && $_GET['page'] === 'advanced-import') {
        return; // Exit early to prevent the notice on the Advanced Import page
    }
    // Check if "Remind Me Later" is active (show after 2 days)
    $remind_time = get_option('author_personal_blog_notice_remind_time');
    if ($remind_time && time() < $remind_time) {
        return;
    }

    $demoSetupComplete = get_option('author_personal_blog_demo_setup_completed');
    $noticeClass = $demoSetupComplete ? 'demo-setup-complete' : 'demo-setup-incomplete';
    ?>
    <div class="author-personal-blog notice notice-success notice-info author-personal-blog-notice author-personal-blog-welcome-notice <?php echo esc_attr($noticeClass); ?>">
        <div class="author-personal-blog-notice-wrapper">
            <div class="author-personal-blog-notice-inner">
                <div class="notice-content-col">
                    <?php if (!$demoSetupComplete) : ?>
                        <h3 class="author-personal-blog-notice__title"><?php esc_html_e('Craft Your Author Website with Ease!', 'author-personal-blog'); ?></h3>
                        <p class="author-personal-blog-notice__content notice-desc">
                            <?php
                            printf(
                                esc_html__('Ready to bring your author presence online? Click %s to instantly install a beautifully designed starter website, complete with sample books, blog posts, and author-specific templates—perfectly tailored for writers. This seamless process takes just a few minutes and sets up all the tools you need to showcase your work.', 'author-personal-blog'),
                                '<strong>"Setup Author Website Templates"</strong>'
                            );
                            ?>
                        </p>
                        <p class="author-personal-blog-notice__action">
                            <button id="setup-demo-import" class="button button-primary author-personal-blog-notice__button"><?php esc_html_e('Setup Author Website Templates', 'author-personal-blog'); ?></button>
                        </p>
                        <div id="setup-demo-progress" class="author-personal-blog-notice__progress"></div>
                        <p class="author-personal-blog-notice__content notice-desc">
                            <?php esc_html_e('Once set up, editing your site is as simple as drafting a chapter—update your bio, books, and blog with ease using WordPress’s user-friendly tools.', 'author-personal-blog'); ?>
                        </p>
                    <?php else : ?>
                        <h3 class="author-personal-blog-notice__title"><?php esc_html_e('Your Author Website is Ready!', 'author-personal-blog'); ?></h3>
                        <p class="author-personal-blog-notice__content notice-desc">
                            <?php esc_html_e('Congratulations! Your demo setup is complete. Below are the pages that have been imported for your author website:', 'author-personal-blog'); ?>
                        </p>
                        <p class="author-personal-blog-notice__content notice-desc">
                            <?php esc_html_e('You can now edit these pages to personalize your site.', 'author-personal-blog'); ?>
                        </p>
                        <p class="author-personal-blog-notice__content notice-desc">
                            <?php
                            printf(
                                esc_html__('To set website logo, customize header, footer, colors, typography, %s.', 'author-personal-blog'),
                                '<a href="' . esc_url(admin_url('customize.php')) . '" target="_blank">' . esc_html__('go to Customizer', 'author-personal-blog') . '</a>'
                            );
                            ?>
                        </p>
                        <div class="upgrade-to-pro-part">
                            <h3><?php esc_html_e('Help Us Keep Improving – Upgrade to Pro Today!', 'author-personal-blog'); ?></h3>
                            <p class="author-personal-blog-notice__content notice-desc"><?php esc_html_e('We’re working hard to make this product even better for you, and your support means the world to us. By upgrading to Pro, you’ll unlock amazing features while helping us continue to enhance and grow this platform. We’re dedicated to helping our customers—after upgrading to Pro, you’ll receive our full support until your website is live, including personalized call support with screensharing to ensure your success. Join us on this journey—upgrade now and let’s build something incredible together!', 'author-personal-blog'); ?></p>
                            <a id="upgrade-top-btn-after-demo-setup" href="<?php echo esc_url('https://rswpthemes.com/author-portfolio-pro-wordpress-theme/'); ?>" target="_blank" class="button button-primary author-personal-blog-notice__button"><?php esc_html_e('Upgrade To Pro', 'author-personal-blog'); ?></a>
                        </div>
                    <?php endif; ?>
                    <p class="author-personal-blog-notice__links">
                        <a href="#" class="author-personal-blog-notice__dismiss-forever" data-action="dismiss_forever" data-nonce="<?php echo esc_attr(wp_create_nonce('author_personal_blog_notice_action')); ?>"><?php esc_html_e('Dismiss Forever', 'author-personal-blog'); ?></a> |
                        <a href="#" class="author-personal-blog-notice__remind-later" data-action="remind_later" data-nonce="<?php echo esc_attr(wp_create_nonce('author_personal_blog_notice_action')); ?>"><?php esc_html_e('Remind Me Later', 'author-personal-blog'); ?></a>
                        <?php if ($demoSetupComplete) : ?>
                            | <a href="#" class="author-personal-blog-notice__setup-demo-again" data-action="setup_demo_again" data-nonce="<?php echo esc_attr(wp_create_nonce('author_personal_blog_notice_action')); ?>"><?php esc_html_e('Setup Demo Again', 'author-personal-blog'); ?></a>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="notice-thumbnail-col">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/img/author-portfolio-pro-thumb.png')); ?>" alt="<?php esc_attr_e('Author Portfolio Pro', 'author-personal-blog'); ?>">
                </div>
            </div>
        </div>

        <div id="demo-setup-modal" class="demo-setup-modal" style="display: none;">
            <div class="modal-content">
                <span id="demo-modal-close" class="modal-close"><?php echo esc_html__('×', 'author-personal-blog'); ?></span>
                <h3><?php esc_html_e('Demo Setup Progress', 'author-personal-blog'); ?></h3>
                <div class="warning-notice" style="background: #fff3cd; padding: 10px; margin-bottom: 15px; border: 1px solid #ffeeba; border-radius: 4px;">
                    <strong><?php esc_html_e('⚠️ Please Note:', 'author-personal-blog'); ?></strong> <?php esc_html_e('Keep this tab open during setup. Closing it will interrupt the installation process.', 'author-personal-blog'); ?>
                </div>
                <div id="demo-progress-content"></div>
            </div>
        </div>
    </div>
    <?php
}
add_action('admin_notices', 'author_personal_blog_show_demo_setup_notice');

/**
 * Handle notice dismissal and remind actions via AJAX
 */
function handle_author_personal_blog_notice_actions() {
    // Verify nonce and action type
    if (!isset($_POST['action_type']) || !isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'author_personal_blog_notice_action')) {
        wp_send_json_error(['message' => 'Invalid nonce or action type']);
    }

    $action = sanitize_text_field(wp_unslash($_POST['action_type']));

    switch ($action) {
        case 'dismiss_forever':
            update_option('author_personal_blog_notice_dismissed_forever', true);
            wp_send_json_success(['message' => 'Notice dismissed forever']);
            break;
        case 'remind_later':
            $remind_time = time() + (2 * 24 * 60 * 60); // 2 days
            update_option('author_personal_blog_notice_remind_time', $remind_time);
            wp_send_json_success(['message' => 'Notice set to remind later']);
            break;
        case 'setup_demo_again':
            delete_option('author_personal_blog_demo_setup_completed');
            wp_send_json_success(['message' => 'Demo setup reset']);
            break;
        default:
            wp_send_json_error(['message' => 'Invalid action']);
    }
}
add_action('wp_ajax_author_personal_blog_notice_action', 'handle_author_personal_blog_notice_actions');

/**
 * Enqueue JavaScript for handling notice actions
 */
function author_personal_blog_enqueue_notice_scripts() {
    wp_enqueue_script(
        'author-personal-blog-notice',
        get_theme_file_uri('js/notice-actions.js'),
        ['jquery'],
        '1.0.0',
        true
    );
    wp_localize_script(
        'author-personal-blog-notice',
        'authorPersonalBlogNotice',
        [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'action'  => 'author_personal_blog_notice_action',
        ]
    );
}
add_action('admin_enqueue_scripts', 'author_personal_blog_enqueue_notice_scripts');