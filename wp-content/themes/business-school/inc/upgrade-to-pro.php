<?php
/**
 * Upgrade to pro options
 */
function business_school_upgrade_pro_options( $wp_customize ) {

	$wp_customize->add_section(
		'upgrade_premium',
		array(
			'title'    => esc_html( BUSINESS_SCHOOL_PRO_NAME ),
			'pro_text' => esc_html__( 'About Business School','business-school'),
			'priority' => 1,
		)
	);

	class Business_School_Pro_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'upgrade_premium';

		function render_content() {
			?>
			<div class="pro_info">
				<ul>

					<li><a class="upgrade-to-pro pro-btn" href="<?php echo esc_url( BUSINESS_SCHOOL_PREMIUM_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-cart"></i><?php esc_html_e( 'Upgrade Pro', 'business-school' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( BUSINESS_SCHOOL_PRO_DEMO ); ?>" target="_blank"><i class="dashicons dashicons-awards"></i><?php esc_html_e( 'Premium Demo', 'business-school' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( BUSINESS_SCHOOL_REVIEW ); ?>" target="_blank"><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Rate Us', 'business-school' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( BUSINESS_SCHOOL_SUPPORT ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php esc_html_e( 'Support Forum', 'business-school' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( BUSINESS_SCHOOL_THEME_PAGE ); ?>" target="_blank"><i class="dashicons dashicons-admin-appearance"></i><?php esc_html_e( 'Theme Page', 'business-school' ); ?> </a></li>

					<li><a class="upgrade-to-pro" href="<?php echo esc_url( BUSINESS_SCHOOL_THEME_DOCUMENTATION ); ?>" target="_blank"><i class="dashicons dashicons-visibility"></i><?php esc_html_e( 'Theme Documentation', 'business-school' ); ?> </a></li>

				</ul>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'pro_info_buttons',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'business_school_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Business_School_Pro_Button_Customize_Control(
			$wp_customize,
			'pro_info_buttons',
			array(
				'section' => 'upgrade_premium',
			)
		)
	);
}
add_action( 'customize_register', 'business_school_upgrade_pro_options' );