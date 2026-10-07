<?php

function custom_sooner_breadcrumb() {
    if (is_front_page()) return;

    echo '<nav class="custom-breadcrumb" aria-label="Breadcrumb">
    <ol itemscope itemtype="https://schema.org/BreadcrumbList">';

    // Trang chủ
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="s-bread-item">
            <a itemprop="item" href="' . get_home_url() . '">
                <span itemprop="name">Trang chủ</span>
            </a>
            <meta itemprop="position" content="1" />
          </li>';

    $position = 2;

    // ================= CATEGORY =================
    if (is_category()) {
        echo '<li class="separator"> / </li>';

        $category = get_queried_object();

        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="s-bread-item current-item">
                <span itemprop="name">' . $category->name . '</span>
                <meta itemprop="position" content="'.$position.'" />
              </li>';
    }

    // ================= SINGLE =================
    elseif (is_single()) {
        $post_type = get_post_type();

        // ===== POST THƯỜNG =====
        if ($post_type === 'post') {
            $categories = get_the_category();

            if ($categories) {
                echo '<li class="separator"> / </li>';
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="s-bread-item">
                        <a itemprop="item" href="' . get_category_link($categories[0]->term_id) . '">
                            <span itemprop="name">' . $categories[0]->name . '</span>
                        </a>
                        <meta itemprop="position" content="'.$position.'" />
                      </li>';
                $position++;
            }
        }

        // ===== CUSTOM POST TYPE =====
        else {
            $post_type_obj = get_post_type_object($post_type);

            if ($post_type_obj && $post_type_obj->has_archive) {
                echo '<li class="separator"> / </li>';
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="s-bread-item">
                        <a itemprop="item" href="' . get_post_type_archive_link($post_type) . '">
                            <span itemprop="name">' . $post_type_obj->labels->name . '</span>
                        </a>
                        <meta itemprop="position" content="'.$position.'" />
                      </li>';
                $position++;
            }
        }

        // Title
        echo '<li class="separator"> / </li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="s-bread-item current-item">
                <span itemprop="name">' . get_the_title() . '</span>
                <meta itemprop="position" content="'.$position.'" />
              </li>';
    }

    // ================= PAGE =================
    elseif (is_page()) {
        global $post;

        if ($post->post_parent) {
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            $count = count($ancestors);

            foreach ($ancestors as $index => $ancestor) {
                echo '<li class="separator"> / </li>';

                // Rút gọn ...
                if ($count >= 2 && $index > 0 && $index < ($count - 1)) {
                    if ($index == 1) {
                        echo '<li class="s-bread-item dots">...</li>';
                    }
                    continue;
                }

                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="s-bread-item">
                        <a itemprop="item" href="' . get_permalink($ancestor) . '">
                            <span itemprop="name">' . get_the_title($ancestor) . '</span>
                        </a>
                        <meta itemprop="position" content="' . $position . '" />
                      </li>';
                $position++;
            }
        }

        // Current page
        echo '<li class="separator"> / </li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="s-bread-item current-item">
                <span itemprop="name">' . get_the_title() . '</span>
                <meta itemprop="position" content="' . $position . '" />
              </li>';
    }

    // ================= CPT ARCHIVE =================
    elseif (is_post_type_archive()) {
        $post_type = get_query_var('post_type');
        $post_type_obj = get_post_type_object($post_type);

        if ($post_type_obj) {
            echo '<li class="separator"> / </li>';
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="s-bread-item current-item">
                    <span itemprop="name">' . $post_type_obj->labels->name . '</span>
                    <meta itemprop="position" content="'.$position.'" />
                  </li>';
        }
    }

    echo '</ol></nav>';
}

add_shortcode('sooner_breadcrumb', 'custom_sooner_breadcrumb');