<?php

add_action('get_header', function () {
    if (!is_admin()) {
        wp_enqueue_style('Bootstrap', get_template_directory_uri() . "/assets/css/bootstrap.css", false, '1.1', 'all');
        wp_enqueue_style('Font-Awesome', get_template_directory_uri() . "/assets/css/font-awesome.min.css", false, '1.1', 'all');
        wp_enqueue_style('Animate', get_template_directory_uri() . "/assets/css/animate.css", false, '1.1', 'all');
        wp_enqueue_style('Owl-carousel', get_template_directory_uri() . "/assets/css/owl.carousel.min.css", false, '1.1', 'all');
        wp_enqueue_style('Owl-theme', get_template_directory_uri() . "/assets/css/owl.theme.default.min.css", false, '1.1', 'all');
        wp_enqueue_style('Slick', get_template_directory_uri() . "/assets/css/slick.css", false, '1.1', 'all');
        wp_enqueue_style('Lightcase', get_template_directory_uri() . "/assets/css/lightcase.css", false, '1.1', 'all');
        wp_enqueue_style('Preset', get_template_directory_uri() . "/assets/css/preset.css", false, '1.1', 'all');
        wp_enqueue_style('Theme', get_template_directory_uri() . "/assets/css/theme.css", false, '1.1', 'all');
        wp_enqueue_style('Responsive', get_template_directory_uri() . "/assets/css/responsive.css", false, '1.1', 'all');
        wp_enqueue_style('Template', get_template_directory_uri() . "/assets/css/template.css", false, '1.1', 'all');

        wp_enqueue_script('jQuery', get_template_directory_uri() . "/assets/js/jquery.js", false, '1.0', 'all');
        wp_enqueue_script('Bootstrap', get_template_directory_uri() . "/assets/js/bootstrap.min.js", false, '1.0', 'all');
        wp_enqueue_script('jQuery-appear', get_template_directory_uri() . "/assets/js/jquery.appear.js", false, '1.0', 'all');
        wp_enqueue_script('Owl-carousel', get_template_directory_uri() . "/assets/js/owl.carousel.min.js", false, '1.0', 'all');
        wp_enqueue_script('Slick', get_template_directory_uri() . "/assets/js/slick.js", false, '1.0', 'all');
        wp_enqueue_script('Lightcase', get_template_directory_uri() . "/assets/js/lightcase.js", false, '1.0', 'all');
        wp_enqueue_script('jQuery-easing', get_template_directory_uri() . "/assets/js/jquery.easing.1.3.js", false, '1.0', 'all');
        wp_enqueue_script('Theme', get_template_directory_uri() . "/assets/js/theme.js", false, '1.0', 'all');
    }

    if (is_single()) {
        
    }

    if (is_search()) {
        
    }

    if (is_tag()) {
        
    }

    if (is_tag()) {
        
    }

    if (is_404()) {
        
    }

    if (is_front_page()) {
        
    }

    if (is_category()) {
        
    }

    if (is_page(242)) {
        
    }
});
