<?php
/**
 * Posts archive 3 column.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.18.0
 */

if ( have_posts() ) : ?>
	<div id="post-list" class="rx-blog-container">
		<?php
		$ids = array();
		$cat ='';
		while ( have_posts() ) : the_post();
			array_push( $ids, get_the_ID() );
		endwhile; // end of the loop.
		if (!is_search()) {
			$ids = implode( ',', $ids );
		} else {
			$ids = '';	
		}
		
		//echo $ids;
		?>

		<?php
		// echo flatsome_apply_shortcode( 'blog_posts', array(
		// 	'type'        => get_theme_mod( 'blog_style_type', 'masonry' ),
		// 	'depth'       => get_theme_mod( 'blog_posts_depth', 0 ),
		// 	'depth_hover' => get_theme_mod( 'blog_posts_depth_hover', 0 ),
		// 	'text_align'  => get_theme_mod( 'blog_posts_title_align', 'center' ),
		// 	'columns'     => '1',
		// 	'show_date'   => get_theme_mod( 'blog_badge', 1 ) ? 'true' : 'false',
		// 	'ids'         => $ids,
		// ) );
		?>
		 <?php echo do_shortcode('[all_posts_shortcode ids="'.$ids.'" posts="16" cols="4"]'); ?> 

		<?php flatsome_posts_pagination(); ?>

	</div>
<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content', 'none' ); ?>

<?php endif; ?>
