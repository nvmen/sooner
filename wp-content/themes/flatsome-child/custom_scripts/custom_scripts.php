<?php
function sooner_custom_scripts() {
    wp_enqueue_script(
        'sooner-custom-js',
        get_stylesheet_directory_uri() . '/assets/js/custom.js',
        [],
        null,
        true // load footer
    );
}
add_action('wp_enqueue_scripts', 'sooner_custom_scripts');