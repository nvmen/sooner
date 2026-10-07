<?php
function sooner_related_tai_lieu_shortcode($atts) {
    global $post;

    $atts = shortcode_atts(array(
        'posts_per_page' => 4,
    ), $atts);

    // Lấy category của bài hiện tại
    $terms = wp_get_post_terms($post->ID, 'category', ['fields' => 'ids']);

    $args = array(
        'post_type'      => 'tai-lieu',
        'posts_per_page' => $atts['posts_per_page'],
        'post__not_in'   => array($post->ID),
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => array(
            array(
                'key'     => 'is_article', // Tên field bạn đặt trong ACF
                'value'   => '1',          // ACF lưu true là '1' (dạng string) hoặc 1 (boolean)
                'compare' => '=='
            ),
        ),
    );

    // Nếu có category thì lọc theo category
    if (!empty($terms)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => $terms,
            ),
        );
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) : ?>
        <div class="related-tai-lieu">
            <h4 class="mb-15">Tài liệu liên quan</h4>

            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="related-item mb-15">
                    <a href="<?php the_permalink(); ?>" class="plain">
                        <div class="d-flex gap-10">
                            
                            <div class="thumb" style="width:80px;">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail('thumbnail');
                                } else {
                                    echo '<img src="https://via.placeholder.com/150">';
                                } ?>
                            </div>

                            <div class="info flex-1">
                                <h5 class="title mb-5">
                                    <?php the_title(); ?>
                                </h5>

                                <span class="is-xsmall op-7">
                                    <?php echo get_the_date(); ?>
                                </span>
                            </div>

                        </div>
                    </a>
                </div>
            <?php endwhile; ?>

        </div>
    <?php endif;

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('tai_lieu_lien_quan', 'sooner_related_tai_lieu_shortcode');