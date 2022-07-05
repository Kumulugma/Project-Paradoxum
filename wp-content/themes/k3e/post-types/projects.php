<?php

// Register Custom Post Type
function projects() {

    $labels = array(
        'name' => _x('Projekty', 'Post Type General Name', 'k3e'),
        'singular_name' => _x('Projekt', 'Post Type Singular Name', 'k3e'),
        'menu_name' => __('Projekty', 'k3e'),
        'name_admin_bar' => __('Projekty', 'k3e'),
        'archives' => __('Archiwum projektów', 'k3e'),
        'attributes' => __('Atrybuty projektu', 'k3e'),
        'parent_item_colon' => __('Projekt nadrzędny:', 'k3e'),
        'all_items' => __('Wszystkie projekty', 'k3e'),
        'add_new_item' => __('Dodaj nowy projekt', 'k3e'),
        'add_new' => __('Dodaj nowy', 'k3e'),
        'new_item' => __('Nowy projekt', 'k3e'),
        'edit_item' => __('Edytuj projekt', 'k3e'),
        'update_item' => __('Aktualizuj projekt', 'k3e'),
        'view_item' => __('Zobacz projekt', 'k3e'),
        'view_items' => __('Zobacz projekty', 'k3e'),
        'search_items' => __('Szukaj projektu', 'k3e'),
        'not_found' => __('Brak projektów', 'k3e'),
        'not_found_in_trash' => __('Brak wyników w koszu', 'k3e'),
        'featured_image' => __('Obrazek wyróżniający', 'k3e'),
        'set_featured_image' => __('Ustaw obrazek wyróżniający', 'k3e'),
        'remove_featured_image' => __('Usuń obrazek wyróżniający', 'k3e'),
        'use_featured_image' => __('Użyj jako obrazek wyróżniający', 'k3e'),
        'insert_into_item' => __('Wstaw do projektu', 'k3e'),
        'uploaded_to_this_item' => __('Wgrano do tego projektu', 'k3e'),
        'items_list' => __('Lista projektów', 'k3e'),
        'items_list_navigation' => __('Lista projektów', 'k3e'),
        'filter_items_list' => __('Filtruj wpisy na liście', 'k3e'),
    );
    $args = array(
        'label' => __('Projekt', 'k3e'),
        'description' => __('Wykonane dotychczas projekty', 'k3e'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-view-site',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('projects', $args);
}

add_action('init', 'projects', 0);
