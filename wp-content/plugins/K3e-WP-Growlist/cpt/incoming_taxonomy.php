<?php

// Register Custom Taxonomy
function incoming_type() {

    $labels = array(
        'name' => _x('Typy', 'Taxonomy General Name', 'k3e'),
        'singular_name' => _x('Typ', 'Taxonomy Singular Name', 'k3e'),
        'menu_name' => __('Typy', 'k3e'),
        'all_items' => __('Wszystkie typy', 'k3e'),
        'parent_item' => __('Typ nadrzędny', 'k3e'),
        'parent_item_colon' => __('Typ nadrzędny:', 'k3e'),
        'new_item_name' => __('Nazwa nowego typu', 'k3e'),
        'add_new_item' => __('Dodaj nowy typ', 'k3e'),
        'edit_item' => __('Edytuj typ', 'k3e'),
        'update_item' => __('Aktualizuj typ', 'k3e'),
        'view_item' => __('Zobacz typ', 'k3e'),
        'separate_items_with_commas' => __('Oddziel typy przecinkiem', 'k3e'),
        'add_or_remove_items' => __('Dodaj lub usuń typ', 'k3e'),
        'choose_from_most_used' => __('Wybierz z najczęściej używanych', 'k3e'),
        'popular_items' => __('Popularne typy', 'k3e'),
        'search_items' => __('Szukaj typu', 'k3e'),
        'not_found' => __('Nie znaleziono', 'k3e'),
        'no_terms' => __('Brak typów', 'k3e'),
        'items_list' => __('Lista typów', 'k3e'),
        'items_list_navigation' => __('Lista typów', 'k3e'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => false,
        'meta_box_cb' => false,
    );
    register_taxonomy('incoming_type', array('incoming'), $args);
}

add_action('init', 'incoming_type', 0);
