<?php

// Register Custom Post Type
function testimonials() {

    $labels = array(
        'name' => _x('Opinie', 'Post Type General Name', 'k3e'),
        'singular_name' => _x('Opinia', 'Post Type Singular Name', 'k3e'),
        'menu_name' => __('Opinie', 'k3e'),
        'name_admin_bar' => __('Opinie', 'k3e'),
        'archives' => __('Archiwum', 'k3e'),
        'attributes' => __('Atrybuty', 'k3e'),
        'parent_item_colon' => __('Nadrzędny:', 'k3e'),
        'all_items' => __('Wszystkie opinie', 'k3e'),
        'add_new_item' => __('Dodaj nowa opinię', 'k3e'),
        'add_new' => __('Dodaj nową', 'k3e'),
        'new_item' => __('Nowa opinia', 'k3e'),
        'edit_item' => __('Edytuj opinię', 'k3e'),
        'update_item' => __('Aktualizuj opinię', 'k3e'),
        'view_item' => __('Zobacz opinię', 'k3e'),
        'view_items' => __('Zobacz opinie', 'k3e'),
        'search_items' => __('Szukaj', 'k3e'),
        'not_found' => __('Brak opinii', 'k3e'),
        'not_found_in_trash' => __('Brak wyników w koszu', 'k3e'),
        'featured_image' => __('Obrazek wyróżniający', 'k3e'),
        'set_featured_image' => __('Ustaw obrazek wyróżniający', 'k3e'),
        'remove_featured_image' => __('Usuń obrazek wyróżniający', 'k3e'),
        'use_featured_image' => __('Użyj jako obrazek wyróżniający', 'k3e'),
        'insert_into_item' => __('Wstaw do opinii', 'k3e'),
        'uploaded_to_this_item' => __('Wgrano do tego opinii', 'k3e'),
        'items_list' => __('Lista opinii', 'k3e'),
        'items_list_navigation' => __('Lista opinii', 'k3e'),
        'filter_items_list' => __('Filtruj opinie na liście', 'k3e'),
    );
    $args = array(
        'label' => __('Opinia', 'k3e'),
        'description' => __('Opinie klientów', 'k3e'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-comments',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('testimonials', $args);
}

add_action('init', 'testimonials', 0);
