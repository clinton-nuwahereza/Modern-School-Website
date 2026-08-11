<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eyepress
 */
$eyepress_copytext_default = '<a href="' . esc_url('https://wordpress.org/') . '">' . esc_html__('Powered by WordPress', 'eyepress') . '</a> <span class="sep"> | </span><a href="' . esc_url('https://wpthemespace.com/product/eyepress') . '">' . esc_html__('Theme: EyePress ', 'eyepress') . '</a>' . esc_html__(' Developed By', 'eyepress') . ' <a href="' . esc_url('https://wpthemespace.com/') . '">' . esc_html__('wp theme space', 'eyepress') . '</a>';

$eyepress_footer_position = get_theme_mod('eyepress_footer_position', 'center');
if ($eyepress_footer_position == 'default') {
	$eyepress_footer_class1 = 'col-lg-6';
	$eyepress_footer_class2 = 'col-lg-6 text-right';
} else {
	$eyepress_footer_class1 = 'text-center footer-text';
	$eyepress_footer_class2 = 'text-center social-footer';
}


?>

</div><!-- #content -->
<!-- Divider Start -->
<div class="divider theme-bg">
	<hr class="line white" />
</div>
<!-- Divider End -->

<!-- Footer Section Start -->
<footer id="colophon" class="site-footer theme-bg ptb-20 fttext">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr($eyepress_footer_class1); ?>">
				<div class="eye-copyright pt-10">
					<p class="white-color">
						<?php echo wp_kses_post($eyepress_copytext_default); ?>
					</p>
				</div>
			</div>
			<?php
			$eyepress_facebook_url = get_theme_mod('eyepress_facebook_url');
			$eyepress_twitter_url = get_theme_mod('eyepress_twitter_url');
			$eyepress_linkedin_url = get_theme_mod('eyepress_linkedin_url');
			$eyepress_instagram_url = get_theme_mod('eyepress_instagram_url');
			$eyepress_pinterest_url = get_theme_mod('eyepress_pinterest_url');

			if ($eyepress_facebook_url || $eyepress_twitter_url || $eyepress_linkedin_url || $eyepress_instagram_url || $eyepress_pinterest_url) :

			?>

				<div class="<?php echo esc_attr($eyepress_footer_class2); ?>">
					<div class="social-icon style1 white l-height">
						<ul class="clearfix d-inblock">
							<?php
							if ($eyepress_facebook_url) :
							?>
								<li><a href="<?php echo esc_url($eyepress_facebook_url); ?>" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
							<?php
							endif;
							if ($eyepress_twitter_url) :
							?>
								<li><a href="<?php echo esc_url($eyepress_twitter_url); ?>" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
							<?php
							endif;
							if ($eyepress_linkedin_url) :
							?>
								<li><a href="<?php echo esc_url($eyepress_linkedin_url); ?>" target="_blank"><i class="zmdi zmdi-linkedin"></i></a></li>
							<?php
							endif;
							if ($eyepress_instagram_url) :
							?>
								<li><a href="<?php echo esc_url($eyepress_instagram_url); ?>" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
							<?php
							endif;
							if ($eyepress_pinterest_url) :
							?>
								<li><a href="<?php echo esc_url($eyepress_pinterest_url); ?>" target="_blank"><i class="zmdi zmdi-pinterest"></i></a></li>
							<?php
							endif;
							?>
						</ul>
					</div>
					<!-- Change your social media link -->
				</div>

			<?php endif; ?>

		</div>
	</div>
</footer>
<!-- Footer Section End -->


</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>