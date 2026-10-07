/**
 * SOONER DOCUMENT SYSTEM
 * Tree + AJAX + Pagination + Mobile + Popup
 */

jQuery(document).ready(function($){

    /* =========================
     * LOAD AJAX TÀI LIỆU
     * ========================= */
    function loadTaiLieu(term_id, page = 1) {
        $('#sooner-document-list').html('<div class="loading-spinner"></div>');

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'load_tai_lieu',
                term_id: term_id,
                page: page
            },
            success: function(res){
                $('#sooner-document-list').html(res);

                // scroll lên top (UX tốt hơn)
                $('html, body').animate({
                    scrollTop: $("#sooner-document-list").offset().top - 80
                }, 300);
            },
            error: function(){
                $('#sooner-document-list').html('<p>Đã có lỗi xảy ra</p>');
            }
        });
    }


    /* =========================
     * CLICK CATEGORY (TREE + AJAX)
     * ========================= */
    $(document).on('click', '.sooner-cat-link', function(e){
        e.preventDefault();

        let parent = $(this).parent();
        let sub = parent.children('ul');

        // mở / đóng tree
        if (sub.length) {
            parent.toggleClass('open');
        }

        // active state
        $('.sooner-cat-link').removeClass('active');
        $(this).addClass('active');

        let term_id = $(this).data('id');

        // load ajax
        loadTaiLieu(term_id);

        // mobile: auto đóng tree
        if (window.innerWidth < 850) {
            $('.sooner-cat-tree').removeClass('show');
        }
    });


    /* =========================
     * PAGINATION AJAX
     * ========================= */
    $(document).on('click', '.sooner-pagination a', function(e){
        e.preventDefault();

        let page = $(this).text();
        let term_id = $('.sooner-cat-link.active').data('id');

        loadTaiLieu(term_id, page);
    });


    /* =========================
     * MOBILE TOGGLE TREE
     * ========================= */
    $(document).on('click', '.sooner-cat-toggle', function(){
        $('.sooner-cat-tree').toggleClass('show');
    });


});


/* =========================
 * FLUENT FORM SUCCESS POPUP
 * ========================= */
document.addEventListener('fluentform_submission_success', function () {
    const popup = document.getElementById('ff-success-popup');
    if (popup) {
        popup.classList.add('active');
    }
});

// đóng popup
document.addEventListener('click', function(e){
    const popup = document.getElementById('ff-success-popup');

    if (!popup) return;

    if (e.target.classList.contains('ff-close') || e.target.id === 'ff-success-popup') {
        popup.classList.remove('active');
    }
});

function request_download(title, url, id) {

   document.querySelectorAll('.wpcf7-form').forEach(form => form.reset());

// 1. Set nội dung hiển thị cho thẻ label (người dùng sẽ nhìn thấy tiêu đề này)
    jQuery('#request-title-document').text(title);
    
    // 2. Set giá trị ẩn cho trường tiêu đề (để gửi kèm trong Email CF7)
    jQuery('#doc-title').val(title);
    jQuery('#doc_id').val(id);
    
    // 3. Set giá trị ẩn cho trường URL (để biết khách tải file nào)
    jQuery('#doc-url').val(url);
    
    // 4. Mở popup (nếu bạn dùng Lightbox của Flatsome)
   jQuery.loadMagnificPopup().then(function() {
    jQuery.magnificPopup.open({
      midClick: true,
      removalDelay: 300,
      // closeBtnInside: flatsomeVars.lightbox.close_btn_inside,
      // closeMarkup: flatsomeVars.lightbox.close_markup,
      items: {
        src: '#popup-download',
        type: 'inline'
      }
    })
  })
}


document.addEventListener('wpcf7beforesubmit', function (event) {
  const btn = event.target.querySelector('.wpcf7-submit');
  if (!btn) return;

  btn.classList.add('loading');
  btn.dataset.text = btn.value;
  btn.value = 'Đang gửi...';
  btn.disabled = true;
});

document.addEventListener('wpcf7submit', function (event) {
  const btn = event.target.querySelector('.wpcf7-submit');
  if (!btn) return;

  btn.classList.remove('loading');
  btn.value = btn.dataset.text || 'Gửi';
  btn.disabled = false;
});
