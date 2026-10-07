<?php
function flatsome_news_carousel_equal_height($atts) {
    extract(shortcode_atts(array(
        'limit' => 8,
        'cat' => '',
    ), $atts));

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'category_name' => $cat,
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);
    if (!$query->have_posts()) return 'Chưa có bài viết nào.';

    ob_start(); ?>

    <div class="custom-news-slider-wrapper">
        <div class="row large-columns-3 medium-columns-2 small-columns-1 row-small slider slider-nav-circle slider-nav-outside" 
             data-flickity-options='{
                "cellAlign": "left",
                "imagesLoaded": true,
                "wrapAround": true,
                "autoPlay": 5000,
                "prevNextButtons": true,
                "pageDots": false,
                "contain": true,
                "percentPosition": true,
                "groupCells": "100%"
             }'>
            
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col">
                    <div class="col-inner mb-0 box-item-wrapper">
                        <div class="post-image mb-0" style="position: relative; overflow: hidden;">
                            <a href="<?php the_permalink(); ?>" class="plain">
                                <?php if(has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large', array('class' => 'skip-lazy is-loaded')); ?>
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/600x400" class="skip-lazy is-loaded" alt="no-thumb">
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="post-info-box">
                            <div class="post-category-tag mb-2">
                                <span class="badge-blue" style="display:none">
                                    <?php 
                                    $categories = get_the_category();
                                    if (!empty($categories)) echo esc_html($categories[0]->name);
                                    ?>
                                </span>
                            </div>
                            <p class="post-date-meta">
                                📅 <?php echo get_the_date('d/m/Y'); ?>
                            </p>
                            <h5 class="post-title-custom">
                                <a href="<?php the_permalink(); ?>" class="plain">
                                    <?php the_title(); ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('news_carousel', 'flatsome_news_carousel_equal_height');
?>