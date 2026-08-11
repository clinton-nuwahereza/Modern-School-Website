<?php
/**
 * Related posts based on categories and tags.
 * 
 */

$school_education_related_posts_taxonomy = school_education_get_option( 'school_education_related_posts_taxonomy', 'category' );
$school_education_archive_layout = school_education_get_option( 'school_education_archive_layout' );

$school_education_post_args = array(
    'posts_per_page'    => 3,
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
);

$school_education_tax_terms = wp_get_post_terms( get_the_ID(), 'category' );
$school_education_terms_ids = array();
foreach( $school_education_tax_terms as $tax_term ) {
	$school_education_terms_ids[] = $tax_term->term_id;
}

$school_education_post_args['category__in'] = $school_education_terms_ids;

$school_education_related_posts = new WP_Query( $school_education_post_args );

if ( $school_education_related_posts->have_posts() ) : ?>
    <div class="related-post">
        <h3><?php echo esc_html__('Related Post' ,'school-education' );?></h3>
        <div class="row">
            <?php while ( $school_education_related_posts->have_posts() ) : $school_education_related_posts->the_post(); ?>
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                  <article id="post-<?php the_ID(); ?>" <?php post_class("zoomInRight wow"); ?>>
                    <?php $school_education_enable_related_post_image = school_education_get_option('school_education_enable_related_post_image');
                    if ($school_education_enable_related_post_image) { ?>
                      <div class="blog-img mb-2">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                        <?php endif; ?>
                      </div>
                    <?php } ?>
                    <div class="entry-content-wrapper">
                      <?php school_education_entry_meta_date(); ?>
                        <header class="entry-header">
                          <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        </header>
                    </div>
                    <div class="text-content">
                      <?php if ( 'full' === $school_education_archive_layout ) : ?>
                        <?php
                        the_content( sprintf(
                          wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'school-education' ), array( 'span' => array( 'class' => array() ) ) ),
                          the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        ) );
                        ?>
                        <?php else : ?>
                        <?php the_excerpt(); ?>
                        <?php endif; ?>
                    </div>
                  </article>
              </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata();