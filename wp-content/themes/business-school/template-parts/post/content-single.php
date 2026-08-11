<?php
/**
 * @package Business School
 */
?>

<?php
    $business_school_post_date = get_the_date();
    
    $business_school_author_name = get_the_author();

    $business_school_single_post_show_date     = get_theme_mod('business_school_single_post_date', true);
    $business_school_single_post_show_comments = get_theme_mod('business_school_single_post_comment', true);
    $business_school_single_post_show_author   = get_theme_mod('business_school_single_post_author', true);
    $business_school_single_post_show_time     = get_theme_mod('business_school_single_post_time', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    <?php if (has_post_thumbnail() ){ ?>
        <div class="post-thumb">
           <?php the_post_thumbnail(); ?>
        </div>
    <?php } ?>

    <?php if ('post' == get_post_type()) : ?>
        <?php if ( $business_school_single_post_show_date || $business_school_single_post_show_comments || $business_school_single_post_show_author || $business_school_single_post_show_time ) : ?>
            <div class="postmeta">
                <?php if ($business_school_single_post_show_date) : ?>
                <div class="post-date">
                    <i class="fas fa-calendar-alt"></i> &nbsp;<?php echo esc_html($business_school_post_date); ?>
                </div>
                <?php endif; ?>
                <?php if ($business_school_single_post_show_comments) : ?>
                <div class="post-comment">&nbsp; &nbsp;
                    <span><?php echo esc_html(get_theme_mod('business_school_single_post_metabox_seperator', '|'));?></span>
                    <i class="fa fa-comment"></i> &nbsp; <?php comments_number(); ?>
                </div>
                <?php endif; ?>
                <?php if ($business_school_single_post_show_author) : ?>
                    <div class="post-author">&nbsp; &nbsp;
                        <span><?php echo esc_html(get_theme_mod('business_school_single_post_metabox_seperator', '|'));?></span>
                        <i class="fas fa-user"></i> &nbsp; <?php echo esc_html($business_school_author_name); ?>
                    </div>
                <?php endif; ?>
                <?php if ($business_school_single_post_show_time) : ?>
                    <div class="post-time">&nbsp; &nbsp;
                        <span><?php echo esc_html(get_theme_mod('business_school_single_post_metabox_seperator', '|'));?></span>
                        <i class="fas fa-clock"></i> &nbsp; <?php echo get_the_time(); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'business-school' ),
                'after'  => '</div>',
            ) );
        ?>
        <div class="tags"><?php the_tags(); ?></div>
    </div>
    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'business-school' ), '<span class="edit-link">', '</span>' ); ?>
    </footer>
</article>