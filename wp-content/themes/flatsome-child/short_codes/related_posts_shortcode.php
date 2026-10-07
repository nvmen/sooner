<?php
function related_posts_vertical_shortcode($atts){

    global $post;

    if(!$post) return '';

    $atts = shortcode_atts(array(
        'posts' => 3
    ), $atts);

    $categories = wp_get_post_categories($post->ID);

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $atts['posts'],
        'post__not_in' => array($post->ID),
        'category__in' => $categories,
        'ignore_sticky_posts' => 1
    );

    $query = new WP_Query($args);

    if(!$query->have_posts()) return '';

    ob_start();
?>

<div class="related-posts-card">

<h4 class="related-title">Bài viết liên quan</h4>

<?php while($query->have_posts()) : $query->the_post(); ?>

<a href="<?php the_permalink(); ?>" class="related-card">

    <div class="related-card-image">
        <?php if(has_post_thumbnail()) :
            the_post_thumbnail('medium_large');
        endif; ?>
    </div>

    <div class="related-card-content">

        <h5 class="related-card-title">
            <?php the_title(); ?>
        </h5>

        <span class="related-card-date">
            <?php echo get_the_date(); ?>
        </span>

    </div>

</a>

<?php endwhile; ?>

</div>

<?php

wp_reset_postdata();

return ob_get_clean();
}

add_shortcode('related_posts_vertical','related_posts_vertical_shortcode');