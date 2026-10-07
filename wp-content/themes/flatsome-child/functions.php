<?php
// ================== INCLUDE ==================
include_once 'short_codes/lastnews_shortcode.php';
include_once 'short_codes/breadcrumb_shortcode.php';
include_once 'short_codes/related_posts_shortcode.php';
include_once 'short_codes/khach_hang_shortcode.php';
include_once 'short_codes/doi_tac_shortcode.php';
include_once 'short_codes/tai_lieu_category_tree_shortcode.php';
include_once 'short_codes/documents_shortcode.php';
include_once 'short_codes/related_tai_lieu_shortcode.php';
include_once 'short_codes/bai_viet_tai_lieu_shortcode.php';

include_once 'custom_scripts/custom_scripts.php';

// ================== POST TYPES ==================

function create_tuyen_dung_post_type() {
    register_post_type('tuyen-dung', [
        'labels' => [
            'name' => 'Tuyển dụng',
            'singular_name' => 'Tuyển dụng'
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'tuyen-dung'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-businessman'
    ]);
}
add_action('init', 'create_tuyen_dung_post_type');

function create_doi_tac_post_type() {
    register_post_type('doi-tac', [
        'labels' => [
            'name' => 'Đối tác',
            'singular_name' => 'Đối tác'
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'doi-tac'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-businessman'
    ]);
}
add_action('init', 'create_doi_tac_post_type');

function create_khach_hang_post_type() {
    register_post_type('khach-hang', [
        'labels' => [
            'name' => 'Khách hàng',
            'singular_name' => 'Khách hàng'
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'khach-hang'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-businessman'
    ]);
}
add_action('init', 'create_khach_hang_post_type');

function create_tai_lieu_post_type() {
    register_post_type('tai-lieu', [
        'labels' => [
            'name' => 'Tài liệu',
            'singular_name' => 'Tài liệu',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'tai-lieu'],
        'menu_icon' => 'dashicons-media-document',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_tai_lieu_post_type');

// ================== TAXONOMY ==================

function create_doi_tac_taxonomy() {
    register_taxonomy('doi-tac-category', 'doi-tac', [
        'hierarchical' => true,
        'rewrite' => ['slug' => 'danh-muc-doi-tac'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_doi_tac_taxonomy');

function create_khach_hang_taxonomy() {
    register_taxonomy('khach-hang-category', 'khach-hang', [
        'hierarchical' => true,
        'rewrite' => ['slug' => 'danh-muc-khach-hang'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_khach_hang_taxonomy');

function create_tai_lieu_taxonomy() {
    register_taxonomy('tai-lieu-category', 'tai-lieu', [
        'hierarchical' => true,
        'rewrite' => ['slug' => 'danh-muc-tai-lieu'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_tai_lieu_taxonomy');

// ================== SEARCH FILTER ==================

function sooner_exclude_post_types_from_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {

        $post_types = get_post_types(['exclude_from_search' => false]);

        unset($post_types['khach-hang']);
        unset($post_types['doi-tac']);

        $query->set('post_type', $post_types);
    }
}
add_action('pre_get_posts', 'sooner_exclude_post_types_from_search');

// ================== AJAX LOAD ==================

add_action('wp_ajax_load_tai_lieu', 'sooner_load_tai_lieu');
add_action('wp_ajax_nopriv_load_tai_lieu', 'sooner_load_tai_lieu');
function sooner_load_tai_lieu() {
    $term_id = intval($_POST['term_id']);
    $paged   = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = [
        'post_type'      => 'tai-lieu',
        'posts_per_page' => 6,
        'paged'          => $paged,
        'tax_query'      => [
            [
                'taxonomy' => 'tai-lieu-category',
                'field'    => 'term_id',
                'terms'    => $term_id,
            ],
        ],
       'meta_query'     => array(
            array(
                'key'     => 'is_article', // Tên field bạn đặt trong ACF
                'value'   => '0',          // ACF lưu true là '1' (dạng string) hoặc 1 (boolean)
                'compare' => '=='
            ),
        ),
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="sooner-doc-grid">';
        
        while ($query->have_posts()) {
            $query->the_post();
            $permalink = get_permalink();
            $files = get_field('doc_demo_file');
            $link_demo = '#';
            if ($files) {
                $link_demo =  $files['url'];
            }
           
            $post_id = get_the_ID();
            echo '<div class="sooner-doc-item">';
                // Thumbnail
                echo '<div class="doc-thumb">';
                    echo '<a href="' . $permalink . '">';
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('medium');
                    } else {
                        echo '<img src="/wp-content/uploads/default.jpg" alt="' . get_the_title() . '">';
                    }
                    echo '</a>';
                echo '</div>';

                // Content
                echo '<div class="doc-content">';
                    echo '<h3 class="doc-title"><a href="' . $permalink . '">' . get_the_title() . '</a></h3>';
                    echo '<div class="doc-excerpt">' . get_the_excerpt() . '</div>';
                    //echo '<a class="btn doc-btn" href="javascript:void(0)" onClick="request_download(\''.$permalink.'\')">Tải về</a>';
                   $post_title = get_the_title(); // Lấy tiêu đề bài viết/tài liệu
                    echo '<a class="btn doc-btn" href="javascript:void(0)" onClick="request_download(\'' . esc_js($post_title) . '\', \'' . $permalink . '\' , \'' .  $post_id. '\' )">Tải về</a>';
                    if ($link_demo) {
                           // echo '<a class="doc-btn btn-demo" href="' . esc_url($link_demo) . '" target="_blank" rel="nofollow">Xem thử</a>';
                            echo '<a class="doc-btn btn-demo" href="/viewer?file=' . urlencode($link_demo) . '" target="_blank" rel="nofollow">Xem thử</a>';
                    }
                echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';

        // Pagination
        echo '<div class="sooner-pagination">';
        echo paginate_links([
            'total'   => $query->max_num_pages,
            'current' => $paged,
            'type'    => 'plain',
        ]);
        echo '</div>';

        wp_reset_postdata(); // Quan trọng: Reset lại data sau khi dùng WP_Query custom
    } else {
        echo '<p>Không có tài liệu</p>';
    }

    wp_die();
}


// ================== DOWNLOAD SECURE ==================

add_action('wpcf7_mail_sent', 'generate_secure_download_link');

function generate_secure_download_link($contact_form) {

    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    $data = $submission->get_posted_data();

    $email = $data['your-email'];
    $post_id = $data['doc_id'];

    $expires = time() + 3600;
    $secret_key = 'my_secret_key_123';

    $token = hash_hmac('sha256', $post_id . $expires, $secret_key);

    $download_url = site_url("/download?file=$post_id&expires=$expires&token=$token");

    wp_mail($email, 'Download tài liệu', "Link: $download_url");
}

// ================== DOWNLOAD ROUTE ==================

add_action('init', function () {
    add_rewrite_rule('^download$', 'index.php?download_file=1', 'top');
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'download_file';
    return $vars;
});

add_action('template_redirect', function () {

    if (!get_query_var('download_file')) return;

    $post_id = $_GET['file'] ?? '';
    $expires = $_GET['expires'] ?? '';
    $token   = $_GET['token'] ?? '';

    $secret_key = 'my_secret_key_123';

    if (time() > $expires) wp_die('Hết hạn');

    $valid_token = hash_hmac('sha256', $post_id . $expires, $secret_key);

    if (!hash_equals($valid_token, $token)) wp_die('Sai token');

    $file = get_field('doc_file', $post_id);
    if (!$file) wp_die('Không có file');

    $file_path = get_attached_file($file['ID']);
    if (!file_exists($file_path)) wp_die('Không tồn tại');

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');

    readfile($file_path);
    exit;
});




add_action('wp_ajax_load_tai_lieu_ajax', 'sooner_load_tai_lieu_ajax');
add_action('wp_ajax_nopriv_load_tai_lieu_ajax', 'sooner_load_tai_lieu_ajax');

function sooner_load_tai_lieu_ajax() {

    $slug  = $_POST['slug'] ?? '';
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = [
        'post_type'      => 'tai-lieu',
        'posts_per_page' => 12,
        'paged'          => $paged,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => [
            [
                'key'     => 'is_article',
                'value'   => '1',
                'compare' => '='
            ],
        ],
    ];

    if ($slug) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'tai-lieu-category',
                'field'    => 'slug',
                'terms'    => $slug,
            ]
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {

        echo '<div class="row large-columns-3 medium-columns-2 small-columns-1 row-small">';

        while ($query->have_posts()) {
            $query->the_post();

            echo '<div class="col"><div class="col-inner">';
            echo '<a href="'.get_permalink().'" class="plain">';

            echo '<div class="resource-card box has-hover">';

            // IMAGE (FIX STYLE CHUẨN)
            echo '<div class="box-image">';
            echo '<div class="image-cover" style="padding-top:65%;">';

            if (has_post_thumbnail()) {
                the_post_thumbnail('large'); // 🔥 KHÔNG dùng full
            } else {
                echo '<img src="https://via.placeholder.com/600x400">';
            }

            echo '</div></div>';

            echo '<div class="box-text p-top-20">';
            echo '<h4>'.get_the_title().'</h4>';
            echo '<p>'.wp_trim_words(get_the_excerpt(), 15).'</p>';
            echo '<span>Chi tiết →</span>';
            echo '</div>';

            echo '</div></a></div></div>';
        }

        echo '</div>';

        // PAGINATION AJAX
if ($query->max_num_pages > 1) {

    echo '<div class="pagination text-center">';

    // Prev
    if ($paged > 1) {
        echo '<a href="#" class="ajax-page prev" data-page="'.($paged - 1).'">‹</a>';
    }

    // Number
    for ($i = 1; $i <= $query->max_num_pages; $i++) {
        echo '<a href="#" class="ajax-page '.($i == $paged ? 'active' : '').'" data-page="'.$i.'">'.$i.'</a>';
    }

    // Next
    if ($paged < $query->max_num_pages) {
        echo '<a href="#" class="ajax-page next" data-page="'.($paged + 1).'">›</a>';
    }

    echo '</div>';
}

    } else {
        echo '<p>Không có dữ liệu</p>';
    }

    wp_reset_postdata();
    wp_die();
}