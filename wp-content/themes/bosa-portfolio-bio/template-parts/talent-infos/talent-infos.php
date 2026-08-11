<?php
$bosa_portfolio_bio_page_one 	= get_theme_mod( 'bosa_portfolio_bio_talent_info_page_one', '' );
$bosa_portfolio_bio_page_two 	= get_theme_mod( 'bosa_portfolio_bio_talent_info_page_two', '' );
$bosa_portfolio_bio_page_three	= get_theme_mod( 'bosa_portfolio_bio_talent_info_page_three', '' );
$bosa_portfolio_bio_page_four  	= get_theme_mod( 'bosa_portfolio_bio_talent_info_page_four', '' );
$bosa_portfolio_bio_page_five  	= get_theme_mod( 'bosa_portfolio_bio_talent_info_page_five', '' );

$bosa_portfolio_bio_page_array = array();
$bosa_portfolio_bio_has_page = false;
if( !empty( $bosa_portfolio_bio_page_one ) ){
	$bosa_portfolio_bio_has_page = true;
	$bosa_portfolio_bio_page_array['page_one'] = array(
		'ID' => $bosa_portfolio_bio_page_one,
	);
}
if( !empty( $bosa_portfolio_bio_page_two ) ){
	$bosa_portfolio_bio_has_page = true;
	$bosa_portfolio_bio_page_array['page_two'] = array(
		'ID' => $bosa_portfolio_bio_page_two,
	);
}
if( !empty( $bosa_portfolio_bio_page_three ) ){
	$bosa_portfolio_bio_has_page = true;
	$bosa_portfolio_bio_page_array['page_three'] = array(
		'ID' => $bosa_portfolio_bio_page_three,
	);
}
if( !empty( $bosa_portfolio_bio_page_four ) ){
	$bosa_portfolio_bio_has_page = true;
	$bosa_portfolio_bio_page_array['page_four'] = array(
		'ID' => $bosa_portfolio_bio_page_four,
	);
}
if( !empty( $bosa_portfolio_bio_page_five ) ){
	$bosa_portfolio_bio_has_page = true;
	$bosa_portfolio_bio_page_array['page_five'] = array(
		'ID' => $bosa_portfolio_bio_page_five,
	);
}

if( !get_theme_mod( 'bosa_portfolio_bio_disable_talent_info_section', true ) && $bosa_portfolio_bio_has_page ){ ?>
	<section class="section-talent_infos-area">
		<div class="content-wrap">
			<?php foreach( $bosa_portfolio_bio_page_array as $bosa_portfolio_bio_each_page ){ ?>
				<article class="talent_infos-content-wrap">
					<figure class="featured-image">
						<?php echo get_the_post_thumbnail( $bosa_portfolio_bio_each_page[ 'ID' ], 'bosa-portfolio-bio-1370-550' ); ?>
					</figure>					
					<div class="entry-content">
						<h3 class="entry-title">
							<a href="<?php echo esc_url( get_permalink( $bosa_portfolio_bio_each_page[ 'ID' ] ) ); ?>">
								<?php echo esc_html( get_the_title( $bosa_portfolio_bio_each_page[ 'ID' ] ) ); ?>
							</a>
						</h3>
						<div class="entry-text">
							<?php 
							$bosa_portfolio_bio_excerpt = get_the_excerpt( $bosa_portfolio_bio_each_page[ 'ID' ] );
							$bosa_portfolio_bio_result  = wp_trim_words( $bosa_portfolio_bio_excerpt, 18, '' );
							echo esc_html( $bosa_portfolio_bio_result );
							?>
						</div>
						<a href="<?php echo esc_url( get_permalink( $bosa_portfolio_bio_each_page[ 'ID' ] ) ); ?>" class="entry-button-text">
							<?php echo esc_html__( 'Continue reading', 'bosa-portfolio-bio' ); ?>
							<i class="fas fa-arrow-right"></i>
						</a>
					</div>
				</article>
			<?php } ?>
		</div>
	</section>
<?php }