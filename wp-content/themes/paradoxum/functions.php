<?php

//Register headerAsset
include("components/headerAsset.php");
//Okruszki
include("includes/breadcrumbs.php");
//Include GalleryCount
include("includes/galleryCount.php");
//Post Views
include("includes/postViews.php");

function k3e_custom_new_menu() {
    register_nav_menus(array(
        'main-menu' => __('Menu Główne'),
        'handy' => __('Podręczne')
    ));
}

add_action('init', 'k3e_custom_new_menu');

add_filter('nav_menu_css_class', 'k3e_menu_item_class', 10, 4);

function k3e_menu_item_class($classes, $item, $args, $depth) {
    $classes[] = 'nav-item';
    return $classes;
}

function k3e_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/', '/ class="dropdown-menu" /', $menu);
    return $menu;
}

add_filter('wp_nav_menu', 'k3e_submenu_class');


//  Functions to display a list of all the shortcodes
function diwp_get_list_of_shortcodes(){
 
    // Get the array of all the shortcodes
    global $shortcode_tags;
     
    $shortcodes = $shortcode_tags;
     
    // sort the shortcodes with alphabetical order
    ksort($shortcodes);
     
    $shortcode_output = "<ul>";
     
    foreach ($shortcodes as $shortcode => $value) {
        $shortcode_output = $shortcode_output.'<li>['.$shortcode.']</li>';
    }
     
    $shortcode_output = $shortcode_output. "</ul>";
     
    return $shortcode_output;
 
}
add_shortcode('get-shortcode-list', 'diwp_get_list_of_shortcodes');