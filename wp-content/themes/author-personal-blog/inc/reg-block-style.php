<?php
/**
 * Register Block Style
 */
add_action( 'init', 'author_personal_blog_regiserr_block_style' );
function author_personal_blog_regiserr_block_style(){
    register_block_style( 'core/quote', array(
    	'name'         => 'red-qoute',
        'label'        => __( 'Red Quote', 'author-personal-blog' ),
        'is_default'   => true,
    ));
}
