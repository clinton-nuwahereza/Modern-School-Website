<?php
$bosa_portfolio_bio_blogAdvertoneID = get_theme_mod( 'bosa_portfolio_bio_blog_project_image_one','');
$bosa_portfolio_bio_blogDiscountoneLabel = get_theme_mod( 'bosa_portfolio_bio_project_label_one', '');
$bosa_portfolio_bio_blogAdverttwoID = get_theme_mod( 'bosa_portfolio_bio_blog_project_image_two','');       
$bosa_portfolio_bio_blogDiscounttwoLabel = get_theme_mod( 'bosa_portfolio_bio_project_label_two', '');
$bosa_portfolio_bio_blogAdvertthreeID = get_theme_mod( 'bosa_portfolio_bio_blog_project_image_three','');
$bosa_portfolio_bio_blogDiscountthreeLabel = get_theme_mod( 'bosa_portfolio_bio_project_label_three', '');

$bosa_portfolio_bio_Advert_array = array();
$bosa_portfolio_bio_has_Advert = false;
$bosa_portfolio_bio_has_label = false;
if( !empty( $bosa_portfolio_bio_blogAdvertoneID ) || !empty( $bosa_portfolio_bio_blogDiscountoneLabel ) ){
	$bosa_portfolio_bio_blog_advertisement_one  = wp_get_attachment_image_src( $bosa_portfolio_bio_blogAdvertoneID,'bosa-portfolio-bio-590-310');
 	if ( is_array(  $bosa_portfolio_bio_blog_advertisement_one ) ){
 		$bosa_portfolio_bio_has_Advert = true;
 		$bosa_portfolio_bio_has_label = true;
   	 	$bosa_portfolio_bio_blog_advertisements_one = $bosa_portfolio_bio_blog_advertisement_one[0];
   	 	$bosa_portfolio_bio_Advert_array['image_one'] = array(
			'ID' => $bosa_portfolio_bio_blog_advertisements_one,
			'project_label' => $bosa_portfolio_bio_blogDiscountoneLabel,
		);	
  	}
}
if( !empty( $bosa_portfolio_bio_blogAdverttwoID  ) || !empty( $bosa_portfolio_bio_blogDiscounttwoLabel ) ){
	$bosa_portfolio_bio_blog_advertisement_two = wp_get_attachment_image_src( $bosa_portfolio_bio_blogAdverttwoID,'bosa-portfolio-bio-590-310');
	if ( is_array(  $bosa_portfolio_bio_blog_advertisement_two ) ){
		$bosa_portfolio_bio_has_Advert = true;
		$bosa_portfolio_bio_has_label = true;	
        $bosa_portfolio_bio_blog_advertisements_two = $bosa_portfolio_bio_blog_advertisement_two[0];
        $bosa_portfolio_bio_Advert_array['image_two'] = array(
			'ID' => $bosa_portfolio_bio_blog_advertisements_two,
			'project_label' => $bosa_portfolio_bio_blogDiscounttwoLabel,
		);	
  	}
}
if( !empty( $bosa_portfolio_bio_blogAdvertthreeID ) || !empty( $bosa_portfolio_bio_blogDiscountthreeLabel )){	
	$bosa_portfolio_bio_blog_advertisement_three = wp_get_attachment_image_src( $bosa_portfolio_bio_blogAdvertthreeID,'bosa-portfolio-bio-590-310');
	if ( is_array(  $bosa_portfolio_bio_blog_advertisement_three ) ){
		$bosa_portfolio_bio_has_Advert = true;
		$bosa_portfolio_bio_has_label = true;
      	$bosa_portfolio_bio_blog_advertisements_three = $bosa_portfolio_bio_blog_advertisement_three[0];
      	$bosa_portfolio_bio_Advert_array['image_three'] = array(
			'ID' => $bosa_portfolio_bio_blog_advertisements_three,
			'project_label' => $bosa_portfolio_bio_blogDiscountthreeLabel,
		);	
  	}
}

if( !get_theme_mod( 'bosa_portfolio_bio_disable_project_section', true ) && $bosa_portfolio_bio_has_Advert && $bosa_portfolio_bio_has_label ){ ?>
	<section class="section-project-area">
		<?php foreach( $bosa_portfolio_bio_Advert_array as $bosa_portfolio_bio_each_Advert ){ ?>
			<article class="project-content-wrap">
				<figure class= "featured-image">
					<?php
						if( !empty( $bosa_portfolio_bio_each_Advert['project_label'] ) ) { ?>
							<span class="overlay-txt">
								<?php
									echo esc_html( $bosa_portfolio_bio_each_Advert['project_label'] );
								?>
							</span>
						<?php } ?>
					<img src="<?php echo esc_url( $bosa_portfolio_bio_each_Advert['ID'] ); ?>">
				</figure>
			</article>
		<?php } ?>
	</section>
<?php }