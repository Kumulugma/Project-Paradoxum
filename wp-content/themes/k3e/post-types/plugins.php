<?php

// Register Custom Post Type
function plugins() {

    $labels = array(
        'name' => _x('Pluginy', 'Post Type General Name', 'k3e'),
        'singular_name' => _x('Plugin', 'Post Type Singular Name', 'k3e'),
        'menu_name' => __('Pluginy', 'k3e'),
        'name_admin_bar' => __('Pluginy', 'k3e'),
        'archives' => __('Archiwum pluginów', 'k3e'),
        'attributes' => __('Atrybuty pluginu', 'k3e'),
        'parent_item_colon' => __('Plugin nadrzędny:', 'k3e'),
        'all_items' => __('Wszystkie pluginy', 'k3e'),
        'add_new_item' => __('Dodaj nowy plugin', 'k3e'),
        'add_new' => __('Dodaj nowy', 'k3e'),
        'new_item' => __('Nowy plugin', 'k3e'),
        'edit_item' => __('Edytuj plugin', 'k3e'),
        'update_item' => __('Aktualizuj plugin', 'k3e'),
        'view_item' => __('Zobacz plugin', 'k3e'),
        'view_items' => __('Zobacz pluginy', 'k3e'),
        'search_items' => __('Szukaj pluginu', 'k3e'),
        'not_found' => __('Brak pluginów', 'k3e'),
        'not_found_in_trash' => __('Brak wyników w koszu', 'k3e'),
        'featured_image' => __('Obrazek wyróżniający', 'k3e'),
        'set_featured_image' => __('Ustaw obrazek wyróżniający', 'k3e'),
        'remove_featured_image' => __('Usuń obrazek wyróżniający', 'k3e'),
        'use_featured_image' => __('Użyj jako obrazek wyróżniający', 'k3e'),
        'insert_into_item' => __('Wstaw do pluginu', 'k3e'),
        'uploaded_to_this_item' => __('Wgrano do tego pluginu', 'k3e'),
        'items_list' => __('Lista pluginów', 'k3e'),
        'items_list_navigation' => __('Lista pluginów', 'k3e'),
        'filter_items_list' => __('Filtruj wpisy na liście', 'k3e'),
    );
    $args = array(
        'label' => __('Pluginy', 'k3e'),
        'description' => __('Wykonane dotychczas wtyczki', 'k3e'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-plugins-checked',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('plugins', $args);
}

add_action('init', 'plugins', 0);
