<?php

add_theme_support( 'post-thumbnails' );

function remove_menus() {
    remove_menu_page('edit.php');                   //Wpisy
    remove_menu_page('edit-comments.php');          //Komentarze
    remove_menu_page('users.php');                  //Użytkownicy
}

add_action('admin_menu', 'remove_menus');

//Register headerAsset
include("components/headerAsset.php");
//Register Projects
include("post-types/projects.php");
//Register Testimonials
include("post-types/testimonials.php");