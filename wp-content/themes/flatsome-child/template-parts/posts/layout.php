<?php
/**
 * Posts layout.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

do_action('flatsome_before_blog');
?>

<?php if(!is_single() && get_theme_mod('blog_featured', '') == 'top'){ 
	get_template_part('template-parts/posts/featured-posts');
 } ?>
<?php
$rx_col= 12;

?>


<div class="row align-center">

	<div class="large-<?php echo $rx_col;?> col">
		
	<?php if(!is_single() && get_theme_mod('blog_featured', '') == 'content'){ get_template_part('template-parts/posts/featured-posts'); } ?>
	
	<?php
		if(is_single()){
			get_template_part( 'template-parts/posts/partials/entry', 'titlecustom');
			get_template_part( 'template-parts/posts/single');
			// comments_template();
		} elseif(get_theme_mod('blog_style_archive', '') && (is_archive() || is_search())){
			get_template_part( 'template-parts/posts/archive', get_theme_mod('blog_style_archive', '') );
		} else{
			get_template_part( 'template-parts/posts/archive', get_theme_mod('blog_style', 'normal') );
		}
	?>
	</div>


</div>
<?php if(is_single() && get_post_type()=='post'):?>
	<section class="section has-block" id="rx-sec-related-news">
    <div class="bg section-bg fill bg-fill bg-loaded"> </div>
    <div class="large-12 col">
        <div class="section-content relative">
            <div class="row">
                <div class="rx-post-related">
                    <h1 class="entry-title text-center uppercase green-text ft-36 tf-title tf-under-line"> <?php  echo(__( 'Tin tức liên quan')); ?></h1>
                </div>
            </div>
            <div class="row">
            <?php  echo (do_shortcode('[related_post_shortcode]'));?>
            </div>
        </div>

    </div>
</section>
		
<?php endif;?>
<?php do_action('flatsome_after_blog');
