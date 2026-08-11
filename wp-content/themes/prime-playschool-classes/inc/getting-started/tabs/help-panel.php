<?php
/**
 * Help Panel.
 *
 * @package Prime_Playschool_Classes
 */

    if (wp_get_theme()->get('Name') === PRIME_PLAYSCHOOL_CLASSES_THEME_TITLE ) {
        
        $demo_importer_url = esc_url(admin_url('themes.php?page=primeplayschoolclasses-wizard'));
    } else {
        $demo_importer_url = esc_url(admin_url('themes.php?page=primekindergarten-wizard'));
    }
?>

<div id="help-panel" class="panel-left visible">
    <div class="panel-aside active">
        <h4><?php printf( esc_html__( ' DEMO CONTENT IMPORTER', 'prime-playschool-classes' )); ?></h4>
        <p><?php esc_html_e( 'Your journey to a powerful and stylish website begins here. Let’s get everything set up in just a few clicks!', 'prime-playschool-classes' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url($demo_importer_url); ?>" title="<?php esc_attr_e( 'Demo Importer', 'prime-playschool-classes' ); ?>" target="_blank">
            <?php esc_html_e( 'DEMO IMPORTER', 'prime-playschool-classes' ); ?>
        </a>
    </div>
    <div class="panel-aside">
        <h4><?php printf( esc_html__( ' VISIT FREE DOCUMENTATION', 'prime-playschool-classes' )); ?></h4>
        <p><?php esc_html_e( 'Are you a newcomer to the WordPress universe? Our comprehensive and user-friendly documentation guide is designed to assist you in effortlessly building a captivating and interactive website, even if you lack any coding expertise or prior experience. Follow our step-by-step instructions to create a visually appealing and engaging online presence.', 'prime-playschool-classes' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( PRIME_PLAYSCHOOL_CLASSES_FREE_DOC_URL ); ?>" title="<?php esc_attr_e( 'Visit the Documentation', 'prime-playschool-classes' ); ?>" target="_blank">
            <?php esc_html_e( 'FREE DOCUMENTATION', 'prime-playschool-classes' ); ?>
        </a>
    </div>

    <div class="panel-aside">
        <h4><?php esc_html_e( 'REVIEW', 'prime-playschool-classes' ); ?></h4>
        <p><?php esc_html_e( 'If you are passionate about the Prime Playschool Classes theme, we would love to hear your thoughts and feedback regarding our theme. Your review will be highly valuable to us as we strive to enhance and improve our theme based on the needs and preferences of our users. Your opinion matters, and we sincerely appreciate your time and effort in sharing your experience with the Prime Playschool Classes theme.', 'prime-playschool-classes' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( PRIME_PLAYSCHOOL_CLASSES_REVIEW_URL ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'prime-playschool-classes' ); ?>" target="_blank">
            <?php esc_html_e( 'REVIEW', 'prime-playschool-classes' ); ?>
        </a>
    </div>
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'CONTACT SUPPORT', 'prime-playschool-classes' ); ?></h4>
        <p>
            <?php esc_html_e( 'Thank you for choosing Prime Playschool Classes! We appreciate your interest in our theme and are here to assist you with any support you may need.', 'prime-playschool-classes' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( PRIME_PLAYSCHOOL_CLASSES_SUPPORT_URL ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'prime-playschool-classes' ); ?>" target="_blank">
            <?php esc_html_e( 'CONTACT SUPPORT', 'prime-playschool-classes' ); ?>
        </a>
    </div>
</div>