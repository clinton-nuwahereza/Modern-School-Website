<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Business School
 */

get_header(); ?>

<div class="container">
    <div id="content" class="contentsecwrap">
        <section class="site-main page-not-found">
            <header class="page-header">
                <h1 class="entry-title">
                    <?php echo esc_html(get_theme_mod('business_school_page_not_found_heading',__('404 Not Found','business-school')));?>
                </h1>
            </header>
            <div class="page-content">
                <p>
                    <?php echo esc_html(get_theme_mod('business_school_page_not_found_content',__( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'business-school' ))); ?>
                </p>
                <?php if( get_theme_mod('business_school_page_not_found_btn','Homepage') != ''){ ?>
                    <div class="not-found-btn mt-3 mb-4 mx-0">
                        <a href="<?php echo esc_url( home_url() ); ?>" class="button py-2 px-3"><?php echo esc_html(get_theme_mod('business_school_page_not_found_btn',__('Homepage','business-school')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('business_school_page_not_found_btn',__('Homepage','business-school')));?></span></a>
                    </div>
                <?php } ?>
            </div>
        </section>
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>