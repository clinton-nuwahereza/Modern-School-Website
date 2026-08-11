<?php
/**
 * Subscribe Form Area
 */
$subscribe_form_args = array(
	'title'	=>	get_theme_mod('subscribe_form_title'),
	'form'	=>	get_theme_mod('form_shortcode'),
	'image'	=>	get_theme_mod('subscribe_form_book_image'),
);
$show_subscribe_form = get_theme_mod('show_subscribe_form_section', false);
if (true == $show_subscribe_form) :
?>
<section id="subscribe-form-area" class="subscribe-form-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-7 text-lg-left text-center order-1 order-md-0 order-lg-0">
                <div class="subscribe-form-wrapper">
                    <div class="subscribe-form-title">
                        <h2><?php echo wp_kses_post($subscribe_form_args['title']); ?></h2>
                    </div>
                    <div class="subscribe-form">
                        <?php echo do_shortcode(wp_kses_post($subscribe_form_args['form'])); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 text-center mb-4 mb-lg-0 text-lg-right order-md-1 order-0 order-lg-1">
            	 <?php
                if (!empty($subscribe_form_args['image'])) :
                ?>
                <div class="book-preview-image">
                    <img src="<?php echo esc_url($subscribe_form_args['image']['url']);?>" class="subscribe-form-book-image" alt="">
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>