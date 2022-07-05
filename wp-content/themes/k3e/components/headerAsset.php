<?php

add_action('get_header', function () {
    wp_enqueue_script('All', get_template_directory_uri() . '/assets/js/all.min.js', false, '1.0', 'all');
    wp_enqueue_script('Form', get_template_directory_uri() . '/assets/js/form.js', ['All'], '1.0', 'all');
    wp_enqueue_style('Font', 'https://fonts.googleapis.com/css?family=Montserrat:400,700,800&display=swap&subset=latin-ext');
    wp_enqueue_style('Main', get_template_directory_uri() . '/assets/css/main.css', false, '1.0');
});
