<?php get_header(); ?>

<div class="container doi-tac-container">
    <h1>Khách hàng</h1>

    <?php
    // Lấy taxonomy để filter (nếu cần)
    $terms = get_terms([
        'taxonomy' => 'khach-hang-category',
        'hide_empty' => false
    ]);

    if (!empty($terms)) {
        echo '<ul class="doi-tac-filter">';
        echo '<li><a href="' . get_post_type_archive_link('khach-hang') . '">Tất cả</a></li>';

        foreach ($terms as $term) {
            echo '<li><a href="?cat=' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</a></li>';
        }

        echo '</ul>';
    }

    // Query chính (có filter slug)
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $slug  = isset($_GET['cat']) ? sanitize_text_field($_GET['cat']) : '';

    $args = [
        'post_type' => 'khach-hang',
        'posts_per_page' => 12,
        'paged' => $paged
    ];

    if (!empty($slug)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'khach-hang-category',
                'field' => 'slug',
                'terms' => $slug
            ]
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="sooner-khach-hang-grid columns-6">';

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

        // Pagination
        echo paginate_links([
            'total' => $query->max_num_pages
        ]);
    } else {
        echo '<p>Chưa có khách hàng nào.</p>';
    }

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>