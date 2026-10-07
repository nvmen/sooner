<?php get_header(); ?>

<main id="main" class="site-main">
 <?php echo do_shortcode('[block id="tuyen-dung"]'); ?>	
  <div class="section-content relative">
    <div class="row">
      <div class="col small-12 large-12">
        <div class="col-inner">
          <div style="text-align: center; padding-top: 60px;">
            <h4 class="uppercase green-text ft-36 tf-relatve tf-under-line">Các vị trí tuyển dụng</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="job-list container" style="max-width:900px; margin:10px auto;">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="job-item blog-post-inner" style="padding:24px 0; border-bottom:1px solid #e5e5e5;">
            <h3 class="job-title" style="font-weight:700; color:#111; margin:0 0 8px;">
              <a href="<?php the_permalink(); ?>" style="color:inherit; text-decoration:none;">
                <?php the_title(); ?>
              </a>
            </h3>
            <div class="job-excerpt" style="color:#555; font-size:15px; line-height:1.6; margin-bottom:10px;">
             <?php the_field('mo_ta'); ?>

 <?php if (function_exists('get_field')): ?>
            <div class="job-meta">
              <span class="job-location"><strong>Địa điểm:</strong> <?php the_field('location'); ?></span><br>
             <span class="job-deadline"><strong>Bắt đầu nhận hồ sơ:</strong> <?php the_field('from_date'); ?></span><br/>
              <span class="job-deadline"><strong>Hạn nộp hồ sơ:</strong> <?php the_field('deadline'); ?></span>
            </div>
          <?php
        endif; ?>

            </div>
            <a href="<?php the_permalink(); ?>" class="button is-shade button primary is-link is-small mb-0">CHI TIẾT
<i class="icon-angle-right" aria-hidden="true"></i>
</a>
          </div>
        <?php endwhile; ?>

        <!-- ✅ Pagination -->
        <div class="pagination-wrap" style="text-align:center; margin-top:40px;">
          <?php
            the_posts_pagination([
              'mid_size'  => 2,
              'prev_text' => __('«'),
              'next_text' => __('»'),
            ]);
          ?>
        </div>

      <?php else : ?>
        <p>Hiện chưa có tin tuyển dụng.</p>
      <?php endif; ?>
    </div>
  </div>

</main>

<?php get_footer(); ?>
