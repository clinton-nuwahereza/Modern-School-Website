<?php
$bosa_portfolio_bio_blog_follower_one_ID = get_theme_mod( 'bosa_portfolio_bio_blog_follower_one','' );
$bosa_portfolio_bio_blog_follower_two_ID = get_theme_mod( 'bosa_portfolio_bio_blog_follower_two','' );       
$bosa_portfolio_bio_blog_follower_three_ID = get_theme_mod( 'bosa_portfolio_bio_blog_follower_three','' );
$bosa_portfolio_bio_blog_follower_four_ID = get_theme_mod( 'bosa_portfolio_bio_blog_follower_four','' );
$bosa_portfolio_bio_blog_follower_five_ID = get_theme_mod( 'bosa_portfolio_bio_blog_follower_five','' );
$bosa_portfolio_bio_blog_follower_six_ID = get_theme_mod( 'bosa_portfolio_bio_blog_follower_six','' );

$bosa_portfolio_bio_follower_array = array();
$bosa_portfolio_bio_has_follower = false;
$bosa_portfolio_bio_has_follower_text = false;

if ( !empty( get_theme_mod( 'bosa_portfolio_bio_follower_title', '' ) ) ) {
	$bosa_portfolio_bio_has_follower_text = true;
}

if( !empty( $bosa_portfolio_bio_blog_follower_one_ID ) ){
	$bosa_portfolio_bio_blog_follower_one  = wp_get_attachment_image_src( $bosa_portfolio_bio_blog_follower_one_ID,'bosa-portfolio-bio-420-300');
 	if ( is_array(  $bosa_portfolio_bio_blog_follower_one ) ){
 		$bosa_portfolio_bio_has_follower = true;
   	 	$bosa_portfolio_bio_blog_follower_one = $bosa_portfolio_bio_blog_follower_one[0];
   	 	$bosa_portfolio_bio_follower_array['image_one'] = array(
			'ID' => $bosa_portfolio_bio_blog_follower_one,
		);	
  	}
}
if( !empty( $bosa_portfolio_bio_blog_follower_two_ID ) ){
	$bosa_portfolio_bio_blog_follower_two = wp_get_attachment_image_src( $bosa_portfolio_bio_blog_follower_two_ID,'bosa-portfolio-bio-420-300');
	if ( is_array(  $bosa_portfolio_bio_blog_follower_two ) ){
		$bosa_portfolio_bio_has_follower = true;	
        $bosa_portfolio_bio_blog_follower_two = $bosa_portfolio_bio_blog_follower_two[0];
        $bosa_portfolio_bio_follower_array['image_two'] = array(
			'ID' => $bosa_portfolio_bio_blog_follower_two,
		);	
  	}
}
if( !empty( $bosa_portfolio_bio_blog_follower_three_ID ) ){	
	$bosa_portfolio_bio_blog_follower_three = wp_get_attachment_image_src( $bosa_portfolio_bio_blog_follower_three_ID,'bosa-portfolio-bio-420-300');
	if ( is_array(  $bosa_portfolio_bio_blog_follower_three ) ){
		$bosa_portfolio_bio_has_follower = true;
      	$bosa_portfolio_bio_blog_follower_three = $bosa_portfolio_bio_blog_follower_three[0];
      	$bosa_portfolio_bio_follower_array['image_three'] = array(
			'ID' => $bosa_portfolio_bio_blog_follower_three,
		);	
  	}
}
if( !empty( $bosa_portfolio_bio_blog_follower_four_ID ) ){	
	$bosa_portfolio_bio_blog_follower_four = wp_get_attachment_image_src( $bosa_portfolio_bio_blog_follower_four_ID,'bosa-portfolio-bio-420-300');
	if ( is_array(  $bosa_portfolio_bio_blog_follower_four ) ){
		$bosa_portfolio_bio_has_follower = true;
      	$bosa_portfolio_bio_blog_follower_four = $bosa_portfolio_bio_blog_follower_four[0];
      	$bosa_portfolio_bio_follower_array['image_four'] = array(
			'ID' => $bosa_portfolio_bio_blog_follower_four,
		);	
  	}
}
if( !empty( $bosa_portfolio_bio_blog_follower_five_ID ) ){	
	$bosa_portfolio_bio_blog_follower_five = wp_get_attachment_image_src( $bosa_portfolio_bio_blog_follower_five_ID,'bosa-portfolio-bio-420-300');
	if ( is_array(  $bosa_portfolio_bio_blog_follower_five ) ){
		$bosa_portfolio_bio_has_follower = true;
      	$bosa_portfolio_bio_blog_follower_five = $bosa_portfolio_bio_blog_follower_five[0];
      	$bosa_portfolio_bio_follower_array['image_five'] = array(
			'ID' => $bosa_portfolio_bio_blog_follower_five,
		);	
  	}
}
if( !empty( $bosa_portfolio_bio_blog_follower_six_ID ) ){	
	$bosa_portfolio_bio_blog_follower_six = wp_get_attachment_image_src( $bosa_portfolio_bio_blog_follower_six_ID,'bosa-portfolio-bio-420-300');
	if ( is_array(  $bosa_portfolio_bio_blog_follower_six ) ){
		$bosa_portfolio_bio_has_follower = true;
      	$bosa_portfolio_bio_blog_follower_six = $bosa_portfolio_bio_blog_follower_six[0];
      	$bosa_portfolio_bio_follower_array['image_six'] = array(
			'ID' => $bosa_portfolio_bio_blog_follower_six,
		);	
  	}
}

if( !get_theme_mod( 'bosa_portfolio_bio_disable_followers_section', true ) && ($bosa_portfolio_bio_has_follower || $bosa_portfolio_bio_has_follower_text) ) { ?>
	<section class="section-follower-area">
		<?php if($bosa_portfolio_bio_has_follower_text){ ?>
			<div class="follower-section-title-wrap col-lg-6 offset-lg-3 text-center">
				<h2 class="follower-title">
					<?php echo esc_html( get_theme_mod( 'bosa_portfolio_bio_follower_title', '' ) ); ?>
				</h2>
			</div>
		<?php } ?>
		<div class="follower-content-wrap">
			<div class="row justify-content-center follower-row">
				<?php foreach( $bosa_portfolio_bio_follower_array as $bosa_portfolio_bio_each_follower ){ ?>
					<div class="col-sm-4 col-md-3 col-lg-2 follower-column">
						<figure class= "featured-image">
							<img src="<?php echo esc_url( $bosa_portfolio_bio_each_follower['ID'] ); ?>">
						</figure>
					</div>
				<?php } ?>
			</div>	
		</div>	
	</section>
<?php }