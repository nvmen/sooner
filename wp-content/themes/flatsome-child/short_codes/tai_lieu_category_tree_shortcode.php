<?php
function sooner_tai_lieu_category_tree() {
    ob_start();

    $taxonomy = 'tai-lieu-category';

    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'parent' => 0,
        'hide_empty' => false
    ]);

    if (!empty($terms)) {
        echo '<ul class="sooner-cat-tree">';
        foreach ($terms as $term) {
            sooner_render_term_tree($term, $taxonomy);
        }
        echo '</ul>';
    }

    return ob_get_clean();
}

function sooner_render_term_tree($term, $taxonomy) {
    $children = get_terms([
        'taxonomy' => $taxonomy,
        'parent' => $term->term_id,
        'hide_empty' => false
    ]);

    $current = get_queried_object();

    $active = '';
    if (isset($current->term_id) && $current->term_id == $term->term_id) {
        $active = 'active';
    }

    echo '<li class="open  '.$active.'">';
    echo '<a href="#" class="sooner-cat-link" data-id="'.$term->term_id.'">'.$term->name.'</a>';

    if (!empty($children)) {
        echo '<ul>';
        foreach ($children as $child) {
            sooner_render_term_tree($child, $taxonomy);
        }
        echo '</ul>';
    }

    echo '</li>';
}

add_shortcode('tai_lieu_tree', 'sooner_tai_lieu_category_tree');