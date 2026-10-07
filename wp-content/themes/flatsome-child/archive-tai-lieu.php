<?php get_header(); ?>

<main id="main" class="site-main">
 <?php echo do_shortcode('[block id="tai-lieu"]'); ?>	
  <div class="section-content relative">
    <div class="row">
      <div class="col small-12 large-12">
        <div class="col-inner">
          <div style="text-align: center; padding-top: 60px;">
            <h4 class="uppercase green-text ft-36 tf-relatve tf-under-line">Tài liệu của Sooner</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="job-list container"  style="padding-bottom:30px">
      <?php echo do_shortcode('[danh_sach_tai_lieu]'); ?>
    </div>
  </div>

</main>

<?php get_footer(); ?>