<?php

/*
  Plugin name: K3e - Generator etykiet
  Plugin URI:
  Description: Wtyczka pozwalająca na wygenerowanie arkusza etykiet.
  Author: K3e
  Author URI: https://www.k3e.pl/
  Text Domain:
  Domain Path:
  Version: 0.0.1
 */

add_action('init', 'k3e_labels_plugin_init');

function k3e_labels_plugin_init() {
    do_action('k3e_labels_plugin_init');

    require_once 'ui/UIClassLabels.php';
    require_once 'ui/UIClassLabelsAdmin.php';
    require_once 'ui/UIClassLabelsFront.php';
    require_once 'ui/UIFunctions.php';

    UIClassLabels::init();

    if (is_admin()) {
        require_once(plugin_dir_path(__FILE__) . '/vendor/autoload.php');
        
        UIClassLabelsAdmin::run();
    } else {
        UIClassLabelsFront::run();
    }
}

function k3e_labels_plugin_activate() {
    
}

register_activation_hook(__FILE__, 'k3e_labels_plugin_activate');

function k3e_labels_plugin_deactivate() {
    
}

register_deactivation_hook(__FILE__, 'k3e_labels_plugin_deactivate');
