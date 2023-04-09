<?php

class UIClassPostEditorAdmin {

    public static function run() {

        add_action('admin_menu', 'post_editor_menu');

        function post_editor_menu() {

            add_menu_page(
                    __('Edytor wpisów', 'k3e'), //Title
                    __('Edytor wpisów', 'k3e'), //Name
                    'manage_options',
                    'post_editor',
                    'post_editor_content',
                    'dashicons-editor-kitchensink',
                    8
            );

            /* Dostępne pozycje
              2 – Dashboard
              4 – Separator
              5 – Posts
              10 – Media
              15 – Links
              20 – Pages
              25 – Comments
              59 – Separator
              60 – Appearance
              65 – Plugins
              70 – Users
              75 – Tools
              80 – Settings
              99 – Separator
             */
        }

        UIClassPostEditorAdmin::PostEditor();
        UIClassPostEditorAdmin::ajaxFunctions();

        add_action('admin_enqueue_scripts', 'k3e_post_editor_admin_enqueue');

        function k3e_post_editor_admin_enqueue() {

            $screen = get_current_screen();

            if ('toplevel_page_post_editor' === $screen->base && $_GET['page'] === 'post_editor') {
                wp_enqueue_style('K3e-Post-Editor', plugin_dir_url(__FILE__) . '../assets/k3e-post-editor.css');
                wp_enqueue_style('K3e-Buttons', plugin_dir_url(__FILE__) . '../assets/k3e-buttons.css');
                wp_enqueue_style('K3e-Table', plugin_dir_url(__FILE__) . '../assets/k3e-table.css');
            }
        }

        function post_editor_content() {

            include plugin_dir_path(__FILE__) . 'templates/post_editor.php';
        }

    }

    public static function PostEditor() {
        if (isset($_POST['PostEditor'])) {
            $post = ($_POST['PostEditor']['post']);
            $name = ($_POST['PostEditor']['name']);
            $value = ($_POST['PostEditor']['value']);

            $editions = get_option('post_editions');

            if ($editions == false) {
                $editions = [];
            }

            $done = 0;

            if (post_type_exists($post)) {
                $posts = get_posts([
                    'post_type' => $post,
                    'post_status' => 'publish',
                    'posts_per_page' => -1
                ]);

                foreach ($posts as $item) {
                    if (get_post_meta($item->ID, $name, true) != false && !is_null(get_post_meta($item->ID, $name, true))) {
                        update_post_meta($item->ID, $name, $value);
                        $done++;
                    }
                }
            }

            $editions[] = ['post' => $post, 'name' => $name, 'value' => $value, 'done' => $done, 'date' => date('Y-m-d H:i:s')];

            update_option('post_editions', $editions);
            
            wp_redirect('admin.php?page=' . $_GET['page']);
        }
    }

    public static function ajaxFunctions() {
        
    }

}
