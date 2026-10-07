<?php get_header(); ?>
<?php echo do_shortcode('[block id="breadcrumb-block"]'); ?>
<div class="container single-post-custom">

  <div class="row align-center">

    <div class="col large-9">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) : the_post();
            get_template_part('template-parts/posts/content', 'single');
          endwhile;
        endif;
        ?>
    </div>
<div class ="col large-3">
      <?php echo do_shortcode('[related_posts_vertical]'); ?>
</div>
  </div>

</div>

<?php get_footer(); ?>