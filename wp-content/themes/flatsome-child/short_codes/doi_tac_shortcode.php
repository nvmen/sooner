<?php
function sooner_doi_tac_shortcode($atts) {
    ob_start();
    $atts = shortcode_atts([
        'posts_per_page' => 12,
        'columns' => 6,
        'slug' => '' // thêm slug
    ], $atts);

    $args = [
        'post_type' => 'doi-tac',
        'posts_per_page' => $atts['posts_per_page'],
        'post_status' => 'publish'
    ];

    // 👉 Nếu có slug → lọc theo danh mục
    if (!empty($atts['slug'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'doi-tac-category',
                'field'    => 'slug',
                'terms'    => explode(',', $atts['slug']), // hỗ trợ nhiều slug
            ]
        ];
    } 
    // 👉 Nếu không có slug → lấy item chưa có danh mục
    else {
        $args['tax_query'] = [
            [
                'taxonomy' => 'doi-tac-category',
                'operator' => 'NOT EXISTS'
            ]
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="sooner-khach-hang-grid columns-' . esc_attr($atts['columns']) . '">';

        while ($query->have_posts()) {
            $query->the_post();

            $link = get_field('link_doi_tac');
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

add_shortcode('sooner_doi_tac', 'sooner_doi_tac_shortcode');