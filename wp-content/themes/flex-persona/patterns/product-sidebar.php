<?php
 /**
  * Title: Product Sidebar
  * Slug: flex-persona/product-sidebar
  * Categories: flex-persona
  */
?>

<!-- wp:group {"style":{"spacing":{"padding":{"right":"30px","left":"30px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:30px;padding-left:30px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"},"blockGap":"var:preset|spacing|40"},"border":{"width":"1px"}},"borderColor":"border","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-border-border-color" style="border-width:1px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Active Filters', 'flex-persona' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/filter-wrapper {"filterType":"active-filters"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:woocommerce/active-filters {"heading":"","lock":{"remove":true},"textColor":"body-text"} -->
<div class="wp-block-woocommerce-active-filters is-loading has-body-text-color has-text-color"><span aria-hidden="true" class="wc-block-active-filters__placeholder"></span></div>
<!-- /wp:woocommerce/active-filters --></div>
<!-- /wp:woocommerce/filter-wrapper --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"}},"border":{"width":"1px"}},"borderColor":"border","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-border-border-color" style="border-width:1px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:woocommerce/filter-wrapper {"filterType":"price-filter"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Filter by Price', 'flex-persona' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/price-filter {"heading":"","lock":{"remove":true},"textColor":"body-text"} -->
<div class="wp-block-woocommerce-price-filter is-loading has-body-text-color has-text-color"><span aria-hidden="true" class="wc-block-product-categories__placeholder"></span></div>
<!-- /wp:woocommerce/price-filter --></div>
<!-- /wp:woocommerce/filter-wrapper --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"}},"border":{"width":"1px"}},"borderColor":"border","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-border-border-color" style="border-width:1px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:woocommerce/filter-wrapper {"filterType":"stock-filter"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Filter by Stock Status', 'flex-persona' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/stock-filter {"showCounts":true,"heading":"","lock":{"remove":true},"textColor":"body-text"} -->
<div class="wp-block-woocommerce-stock-filter is-loading has-body-text-color has-text-color"></div>
<!-- /wp:woocommerce/stock-filter --></div>
<!-- /wp:woocommerce/filter-wrapper --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"}},"border":{"width":"1px"}},"borderColor":"border","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-border-border-color" style="border-width:1px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:woocommerce/filter-wrapper {"filterType":"attribute-filter"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Filter by Attribute', 'flex-persona' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/attribute-filter {"attributeId":1,"showCounts":true,"heading":"","lock":{"remove":true},"textColor":"body-text"} -->
<div class="wp-block-woocommerce-attribute-filter is-loading has-body-text-color has-text-color"></div>
<!-- /wp:woocommerce/attribute-filter --></div>
<!-- /wp:woocommerce/filter-wrapper --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"}},"border":{"width":"1px"}},"borderColor":"border","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-border-border-color" style="border-width:1px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:woocommerce/filter-wrapper {"filterType":"rating-filter"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Filter by Rating', 'flex-persona' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/rating-filter {"showCounts":true,"lock":{"remove":true},"textColor":"body-text"} -->
<div class="wp-block-woocommerce-rating-filter is-loading has-body-text-color has-text-color"></div>
<!-- /wp:woocommerce/rating-filter --></div>
<!-- /wp:woocommerce/filter-wrapper --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"40px","bottom":"40px","left":"40px","right":"40px"},"blockGap":"var:preset|spacing|30"},"border":{"width":"1px"}},"borderColor":"border","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-border-border-color" style="border-width:1px;padding-top:40px;padding-right:40px;padding-bottom:40px;padding-left:40px"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Product Categories', 'flex-persona' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-categories {"hasCount":false,"isHierarchical":false,"style":{"typography":{"lineHeight":"2"}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->