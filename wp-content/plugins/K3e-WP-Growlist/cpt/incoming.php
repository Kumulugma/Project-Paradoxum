<?php

// Register Custom Post Type
function incoming() {

    $labels = array(
        'name' => _x('P.Z.', 'Post Type General Name', 'k3e'),
        'singular_name' => _x('P.Z.', 'Post Type Singular Name', 'k3e'),
        'menu_name' => __('P.Z.', 'k3e'),
        'name_admin_bar' => __('P.Z.', 'k3e'),
        'archives' => __('Archiwum P.Z.', 'k3e'),
        'attributes' => __('Atrybuty P.Z.', 'k3e'),
        'parent_item_colon' => __('Nadrzędne P.Z.', 'k3e'),
        'all_items' => __('Wszystkie P.Z.', 'k3e'),
        'add_new_item' => __('Dodaj nowe P.Z.', 'k3e'),
        'add_new' => __('Dodaj nowe', 'k3e'),
        'new_item' => __('Nowy wpis', 'k3e'),
        'edit_item' => __('Edytuj wpis', 'k3e'),
        'update_item' => __('Aktualizuj wpis', 'k3e'),
        'view_item' => __('Zobacz wpis', 'k3e'),
        'view_items' => __('Zobacz wpisy', 'k3e'),
        'search_items' => __('Szukaj wpisu', 'k3e'),
        'not_found' => __('Brak P.Z.', 'k3e'),
        'not_found_in_trash' => __('W koszu nic nie ma.', 'k3e'),
        'featured_image' => __('Obrazek wyróżniający', 'k3e'),
        'set_featured_image' => __('Ustaw obrazek wyróżniający', 'k3e'),
        'remove_featured_image' => __('Usuń obrazek wyróżniający', 'k3e'),
        'use_featured_image' => __('Użyj jako obrazka wyróżniającego', 'k3e'),
        'insert_into_item' => __('Wstaw do wpisu', 'k3e'),
        'uploaded_to_this_item' => __('Wgrano do wpisu', 'k3e'),
        'items_list' => __('Lista P.Z.', 'k3e'),
        'items_list_navigation' => __('Nawigacja P.Z.', 'k3e'),
        'filter_items_list' => __('Filtruj listę wpisów', 'k3e'),
    );
    $args = array(
        'label' => __('P.Z.', 'k3e'),
        'description' => __('Materiały przyjęte zewnętrznie', 'k3e'),
        'labels' => $labels,
        'supports' => false,
        'taxonomies' => array('incoming_type'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 10,
        'menu_icon' => 'dashicons-arrow-right-alt',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'rewrite' => false,
        'capability_type' => 'page',
        'show_in_rest' => false,
    );
    register_post_type('incoming', $args);
}

add_action('init', 'incoming', 0);
