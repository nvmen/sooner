<?php
/**
 * The template for displaying the footer.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

global $flatsome_opt;
?>

</main>



<div id="ff-success-popup" class="ff-popup">
    <div class="ff-popup-content">
        <div class="ff-icon">✔</div>
        <h3>Gửi thành công!</h3>
        <p>Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ sớm.</p>
        <button class="ff-close">Đóng</button>
    </div>
</div>
<footer id="footer" class="footer-wrapper">

	<?php do_action('flatsome_footer'); ?>

</footer>

</div>

<?php wp_footer(); ?>

<?php 
   // Thay 'form-yeu-cau-download-tai-lieu' bằng slug chính xác của block
  // echo do_shortcode('[block id="form-yeu-cau-download-tai-lieu"]'); 
?>

<?php 
echo do_shortcode('[lightbox id="popup-download" width="500px" padding="30px"]
<h3 style="text-align: center;">Đăng ký thông tin download</h3>
[contact-form-7 id="89acc39" title="Request download document"]
[/lightbox]');
?>
</body>
</html>
