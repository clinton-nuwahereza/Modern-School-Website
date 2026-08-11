<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bosa Portfolio Bio
 */
?>

<?php
	$bosa_portfolio_bio_stickyClass = "col-12";
	$bosa_portfolio_bio_layout_class = '';
	if( get_theme_mod( 'bosa_portfolio_bio_sidebar_settings', 'right' ) == 'right' ) {
		if ( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' ){
			$bosa_portfolio_bio_stickyClass = "col-sm-6 grid-post";
			if( !is_active_sidebar( 'right-sidebar') ){
				$bosa_portfolio_bio_stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}elseif( get_theme_mod( 'bosa_portfolio_bio_sidebar_settings', 'right' ) == 'left' ) {
		if ( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' ){
			$bosa_portfolio_bio_stickyClass = "col-sm-6 grid-post";
			if( !is_active_sidebar( 'left-sidebar') ){
				$bosa_portfolio_bio_stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}elseif( get_theme_mod( 'bosa_portfolio_bio_sidebar_settings', 'right' ) == 'no-sidebar' ) {
		if ( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' ){
			$bosa_portfolio_bio_stickyClass = "col-sm-6 col-lg-4 grid-post";
		}
	}elseif( get_theme_mod( 'bosa_portfolio_bio_sidebar_settings', 'right' ) == 'right-left' ) {
		if ( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' ){
			$bosa_portfolio_bio_stickyClass = "col-sm-6 col-lg-6 grid-post";
			if( !is_active_sidebar( 'left-sidebar') && !is_active_sidebar( 'right-sidebar') ){
				$bosa_portfolio_bio_stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}
	if( get_theme_mod( 'bosa_portfolio_bio_disable_sidebar_blog_page', false ) && get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' ){
		$bosa_portfolio_bio_stickyClass = "col-sm-6 col-lg-4 grid-post";
	}

	if( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'list' ){
		$bosa_portfolio_bio_layout_class = 'list-post';
	}elseif( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'single' ){
		$bosa_portfolio_bio_layout_class = 'single-post';
	}

	$bosa_portfolio_bio_class = '';
	if(!has_post_thumbnail()){
		$bosa_portfolio_bio_class = 'no-thumbnail';
	}

?>
<div class="<?php echo esc_attr( $bosa_portfolio_bio_stickyClass );?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $bosa_portfolio_bio_class . ' ' . $bosa_portfolio_bio_layout_class ) ?> >
		<?php 
		
		if ( has_post_thumbnail() ) : ?>
	        <figure class="featured-image">
	            <a href="<?php the_permalink(); ?>">
	                <?php
	                $bosa_portfolio_bio_grid_list_size = 'bosa-portfolio-bio-420-300';
	                $bosa_portfolio_bio_single_size 	= 'bosa-portfolio-bio-1370-550';
	                $bosa_portfolio_bio_render_post_image_size = get_theme_mod( 'bosa_portfolio_bio_render_post_image_size', '' );
	                if ( !empty( $bosa_portfolio_bio_render_post_image_size ) ){
	                	$bosa_portfolio_bio_grid_list_size = $bosa_portfolio_bio_render_post_image_size;
	                	$bosa_portfolio_bio_single_size 	= $bosa_portfolio_bio_render_post_image_size;
	                }
	                if( get_theme_mod( 'bosa_portfolio_bio_sidebar_settings', 'right' ) == 'right' ) {
	                	if ( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' || get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'list' ){
	                		bosa_portfolio_bio_image_size( $bosa_portfolio_bio_grid_list_size );
	                	}elseif( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'single' ){
	                		bosa_portfolio_bio_image_size( $bosa_portfolio_bio_single_size );
	                	}
	                }elseif( get_theme_mod( 'bosa_portfolio_bio_sidebar_settings', 'right' ) == 'left' ) {
	                	if ( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' || get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'list' ){
	                		bosa_portfolio_bio_image_size( $bosa_portfolio_bio_grid_list_size );
	                	}elseif( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'single' ){
	                		bosa_portfolio_bio_image_size( $bosa_portfolio_bio_single_size );
	                	}
	                }elseif( get_theme_mod( 'bosa_portfolio_bio_sidebar_settings', 'right' ) == 'no-sidebar' ) {
	                	if ( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' || get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'list' ){
	                		bosa_portfolio_bio_image_size( $bosa_portfolio_bio_grid_list_size );
	                	}elseif( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'single' ){
	                		bosa_portfolio_bio_image_size( $bosa_portfolio_bio_single_size );
	                	}
	                }elseif( get_theme_mod( 'bosa_portfolio_bio_sidebar_settings', 'right' ) == 'right-left' ) {
	                	if ( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'grid' || get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'list' ){
	                		bosa_portfolio_bio_image_size( $bosa_portfolio_bio_grid_list_size );
	                	}elseif( get_theme_mod( 'bosa_portfolio_bio_archive_post_layout', 'list' ) == 'single' ){
	                		bosa_portfolio_bio_image_size( $bosa_portfolio_bio_single_size );
	                	}
	                }
	                ?>
	            </a>
	        </figure><!-- .recent-image -->
		<?php
	    endif;
		?>
	    <div class="entry-content">
	    	<header class="entry-header">
				<?php 
					if( !get_theme_mod( 'bosa_portfolio_bio_hide_category', false ) ){
						bosa_portfolio_bio_entry_header();
					}
					if( !get_theme_mod( 'bosa_portfolio_bio_hide_post_title', false ) ){
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					}
				?>

			</header><!-- .entry-header -->
			<div class="entry-meta">
	           <?php bosa_portfolio_bio_entry_footer(); ?>
	        </div><!-- .entry-meta -->
			
			<?php if ( !get_theme_mod( 'bosa_portfolio_bio_hide_blog_page_excerpt', false ) || !get_theme_mod( 'bosa_portfolio_bio_hide_post_button', true ) ){ ?>
		        <div class="entry-text">
					<?php
						if ( !get_theme_mod( 'bosa_portfolio_bio_hide_blog_page_excerpt', false ) ){
							$bosa_portfolio_bio_excerpt_length = get_theme_mod( 'bosa_portfolio_bio_post_excerpt_length', 15 );
							bosa_portfolio_bio_excerpt( $bosa_portfolio_bio_excerpt_length , true );
						}
					?>
					<?php 
						if( !get_theme_mod( 'bosa_portfolio_bio_hide_post_button', true ) ){
							$bosa_portfolio_bio_post_btn_defaults = array(
								array(
									'blog_btn_type' 		=> 'button-text',
									'blog_btn_bg_color'		=> '#E5FF01',
									'blog_btn_border_color'	=> '#1a1a1a',
									'blog_btn_text_color'	=> '#1a1a1a',
									'blog_btn_hover_color'	=> '#AABC0D',
									'blog_btn_text' 		=> '',
									'blog_btn_radius'		=> 0,
								),		
							);
							$bosa_portfolio_bio_post_button = get_theme_mod( 'bosa_portfolio_bio_blog_page_button_repeater', $bosa_portfolio_bio_post_btn_defaults );
							if( !empty( $bosa_portfolio_bio_post_button ) && is_array( $bosa_portfolio_bio_post_button ) ){ ?>
								<div class="button-container">
									<?php
									  	$bosa_portfolio_bio_count = 0.2;
					            		foreach( $bosa_portfolio_bio_post_button as $bosa_portfolio_bio_value ){
											if( !empty( $bosa_portfolio_bio_value['blog_btn_text'] ) ){ ?>
												<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $bosa_portfolio_bio_value['blog_btn_type'] ); ?>">
													<?php 
														echo esc_html( $bosa_portfolio_bio_value['blog_btn_text'] );
													?>
												</a>
												<?php
								                $bosa_portfolio_bio_count = $bosa_portfolio_bio_count + 0.2;
								            }
							        	}
							        ?>
							    </div>
							    <?php
					        }
						}
					?>	
				</div>
			<?php } ?>
		</div><!-- .entry-content -->
	</article><!-- #post-->
</div>