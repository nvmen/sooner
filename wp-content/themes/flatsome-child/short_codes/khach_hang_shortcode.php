<?php
function sooner_khach_hang_shortcode($atts) {
    ob_start();

    $atts = shortcode_atts([
        'posts_per_page' => 12,
        'columns' => 6,
        'slug' => '' // thêm slug khach hang theo danh muc
    ], $atts);

    $args = [
        'post_type' => 'khach-hang',
        'posts_per_page' => $atts['posts_per_page'],
        'post_status' => 'publish'
    ];

    // 👉 Nếu có slug → filter theo danh mục
    if (!empty($atts['slug'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'khach-hang-category',
                'field'    => 'slug',
                'terms'    => $atts['slug'],
            ]
        ];
    } 
    // 👉 Nếu KHÔNG có slug → lấy bài chưa có danh mục
    else {
        $args['tax_query'] = [
            [
                'taxonomy' => 'khach-hang-category',
                'operator' => 'NOT EXISTS'
            ]
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="sooner-khach-hang-grid columns-' . esc_attr($atts['columns']) . '">';

        while ($query->have_posts()) {
            $query->the_post();

            $link = get_field('link_khach_hang');
            $img = get_the_post_thumbnail_url(get_the_ID(), 'medium');

            echo '<div class="kh-item">';

            if ($link) echo '<a href="'. esc_url($link) .'" target="_blank">';

            echo '<div class="kh-card">';
            echo '<img src="'. esc_url($img) .'" alt="'. esc_attr(get_the_title()) .'">';
            echo '</div>';

            if ($link) echo '</a>';

            echo '</div>';
        }

        echo '</div>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('sooner_khach_hang', 'sooner_khach_hang_shortcode');