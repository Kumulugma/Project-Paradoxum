<?php

/*
  Plugin name: K3e - Edytor wpisów
  Plugin URI:
  Description: Masowy edytor wartości meta.
  Author: K3e
  Author URI: https://www.k3e.pl/
  Text Domain:
  Domain Path:
  Version: 0.0.1
 */

add_action('init', 'k3e_post_editor_plugin_init');

function k3e_post_editor_plugin_init() {
    do_action('k3e_post_editor_plugin_init');

    require_once 'ui/UIClassPostEditor.php';
    require_once 'ui/UIClassPostEditorAdmin.php';
    require_once 'ui/UIFunctions.php';

    UIClassPostEditor::init();

    if (is_admin()) {
        UIClassPostEditorAdmin::run();
    } 
}

function k3e_post_editor_plugin_activate() {
    
}

register_activation_hook(__FILE__, 'k3e_post_editor_plugin_activate');

function k3e_post_editor_plugin_deactivate() {
    
}

register_deactivation_hook(__FILE__, 'k3e_post_editor_plugin_deactivate');
