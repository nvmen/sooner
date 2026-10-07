<?php get_header(); ?>
<?php echo do_shortcode('[block id="tuyen-dung"]'); ?>	

<div class="page-wrapper" style="padding-top: 60px">
   <div class="container">
      <?php if (have_posts()):
         while (have_posts()):
             the_post(); 
             
             // --- LOGIC KIỂM TRA HẾT HẠN ---
             $deadline = get_field('deadline');
             $is_expired = false;
             $today = new DateTime('today'); // Lấy ngày hiện tại (00:00:00)
          

             if ($deadline) {
                 // Chuyển đổi chuỗi 31/03/2026 thành đối tượng ngày tháng để so sánh
                 $deadline_date = DateTime::createFromFormat('d/m/Y', $deadline);
                 
                 // Nếu ngày hiện tại LỚN HƠN ngày deadline => Đã hết hạn
                 if ($deadline_date && $deadline_date < $today) {
                     $is_expired = true;
                 }
             }

             // ------------------------------
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('single-job'); ?>>
         <header class="job-header">
            <h1><?php the_title(); ?></h1>
            <?php if (function_exists('get_field')): ?>
            <div class="job-meta">
               <span class="job-location"><strong>Địa điểm:</strong> <?php the_field('location'); ?></span><br>
               <span class="job-deadline"><strong>Bắt đầu nhận hồ sơ:</strong> <?php the_field('from_date'); ?></span><br/>
               <span class="job-deadline">
                  <strong>Hạn nộp hồ sơ:</strong> 
                  <?php echo $deadline; ?>
                  <?php if($is_expired): ?> 
                     <span style="color: red; font-weight: bold;">(Đã hết hạn)</span> 
                  <?php endif; ?>
               </span>
            </div>
            <?php endif; ?>
         </header>

         <div class="job-content entry-content">
            <?php the_content(); ?>
         </div>

         <div id="apply-form" class="job-apply mt-40">
            <div class="row row-collapse" id="row-1293721900">
               <div id="col-1686309052" class="col hide-for-small medium-2 small-12 large-2" style="display:none">
                  <div class="col-inner"></div>
               </div>
               
               <div id="col-76698977" class="col medium-8 small-12 large-8">
                  <div class="col-inner">
                     <?php if ($is_expired) : ?>
                        <div class="expired-notice" style="text-align: center; padding: 30px; border: 2px dashed #e67e22; background: #fff9f4; border-radius: 8px; margin-bottom:30px">
                           <h3 style="color: #d35400; text-transform: uppercase;">Thông báo</h3>
                           <p>Xin lỗi, vị trí tuyển dụng này đã <strong>ngừng nhận hồ sơ</strong> do quá hạn ngày <?php echo $deadline; ?>.</p>
                           <p>Vui lòng tham khảo các vị trí khác bên dưới.</p>
                        </div>
                     <?php else : ?>
                        <h3 class="uppercase">Gửi hồ sơ ứng tuyển</h3>
                        <?php echo do_shortcode('[contact-form-7 id="2a8b1a9" title="Form tuyển dụng"]'); ?>
                     <?php endif; ?>
                  </div>
               </div>

               <div id="col-430893677" class="col hide-for-small medium-2 small-12 large-2">
                  <div class="col-inner"></div>
               </div>
            </div>
         </div>

         <div class="job-footer text-center" style ="display:none;">
            <a href="/tuyen-dung/" class="button secondary">← Quay lại danh sách</a>
         </div>
      </article>
      <?php
         endwhile;
         endif; ?>
   </div>
</div>

<?php get_footer(); ?>