<?php

add_action( 'bizberg_before_homepage_blog', 'school_of_education_featured' );
function school_of_education_featured(){

	$status = bizberg_get_theme_mod( 'featured_post_status' );

	if( $status == false ){
		return;
	}

	$featured_post_title    = bizberg_get_theme_mod( 'featured_post_title' );
	$featured_post_subtitle = bizberg_get_theme_mod( 'featured_post_subtitle' ); ?>

    <section class="featured-post">
        <div class="container">

            <div class="section-title">

            	<?php 
            	if( !empty( $featured_post_subtitle ) ){  ?>
                	<p class="subtitle"><?php echo esc_html( $featured_post_subtitle ); ?></p>
                	<?php 
                } 

                if( !empty( $featured_post_title ) ){ ?>
	                <h2 class="featured_title">
	                	<?php 
	                	echo esc_html( $featured_post_title );
	                	?>
	                </h2>
	                <?php 
	            } ?>

            </div>

            <?php 
            $args = array(
            	'post_type'           => 'post',
            	'ignore_sticky_posts' => 1,
            	'posts_per_page'      => 3,
            	'cat'                 => bizberg_get_theme_mod( 'school_of_education_featured_category' )
            );

            $featured_posts_query = new WP_Query( $args );

            if( $featured_posts_query->have_posts() ): ?>

            	<div class="featured-post-inner">

                	<div class="row">
                		
                		<?php 

                		while( $featured_posts_query->have_posts() ): $featured_posts_query->the_post();

                			global $post;
                			$category_detail = get_the_category( $post->ID );
                			$cat_name        = !empty( $category_detail[0]->name ) ? $category_detail[0]->name : ''; ?>

                			<div class="col-md-4">
                				
		                        <div class="featured-post-item">
		                        	<a href="<?php the_permalink(); ?>">
			                            <div 
			                            class="featured-post-image" 
			                            style="background-image: linear-gradient( to right, #00000036, #0000 ) , url( <?php the_post_thumbnail_url( 'medium_large' ); ?> );">
			                            	<?php 
		                            		if( !empty( $cat_name ) ){ ?>
			                                	<div class="featured-cats"><i class="fa fa-tag"></i> <?php echo esc_html( $cat_name ); ?></div>
			                                	<?php 
			                                } ?>
			                            </div>
			                        </a>
		                            <div class="featured-post-content">
		                                <div class="featured-date">
		                                    <i class="far fa-calendar"></i> 
		                                    <?php echo esc_html( get_the_date() ); ?> 
		                                </div>
		                                <h4 class="title">
		                                	<a href="<?php the_permalink(); ?>">
		                                		<?php 
		                                		the_title();
		                                		?>
		                                	</a>
		                                </h4>
		                            </div>
		                        </div>
		                        
		                    </div>

                			<?php

                		endwhile; ?>

                	</div>

                </div>

            	<?php

            endif;

            wp_reset_postdata(); ?>

        </div>

    </section>

    <?php
}