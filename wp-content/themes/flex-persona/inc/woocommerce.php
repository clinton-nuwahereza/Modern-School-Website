<?php
/**
 * functions and hooks for woocommerce
 *
 * @package wpopus_fse
 */

// remove woocommerce core breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );