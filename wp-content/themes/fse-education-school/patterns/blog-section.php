<?php
 /**
  * Title: Blog Section
  * Slug: fse-education-school/blog-section
  */
?>

<!-- wp:group {"align":"full","className":"blog-sec","layout":{"type":"constrained","contentSize":"90%"}} -->
<div class="wp-block-group alignfull blog-sec"><!-- wp:paragraph {"align":"center","textColor":"primary","fontSize":"upper-heading"} -->
<p class="has-text-align-center has-primary-color has-text-color has-upper-heading-font-size wow bounceInDown"><strong><?php esc_html_e('Blog','fse-education-school'); ?></strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} -->
<h3 class="wp-block-heading has-text-align-center wow bounceInDown" style="font-style:normal;font-weight:600"><?php esc_html_e('Our Latest News Feed','fse-education-school'); ?></h3>
<!-- /wp:heading -->

<!-- wp:query {"queryId":2,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":4}} -->
<!-- wp:group {"className":"home-blog-box wow zoomIn","style":{"border":{"radius":"10px"},"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group home-blog-box wow zoomIn" style="border-radius:10px;padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:post-featured-image {"style":{"border":{"radius":{"topLeft":"10px","topRight":"10px"}}}} /-->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"700"},"elements":{"link":{"color":{"text":"var:preset|color|heading"}}},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|40","bottom":"0","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"textColor":"heading"} /-->

<!-- wp:group {"className":"homeblog-meta","style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|30","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group homeblog-meta" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:post-author-name {"style":{"elements":{"link":{"color":{"text":"var:preset|color|heading"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"}},"textColor":"heading"} /-->

<!-- wp:post-date {"format":"M j, Y","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"elements":{"link":{"color":{"text":"var:preset|color|heading"}}}},"textColor":"heading"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:spacer {"height":"70px"} -->
<div style="height:70px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->