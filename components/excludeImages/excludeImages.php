<?php

class excludeImages {

    public static function run() {

        add_action('admin_menu', 'exclude_images_menu');

        function exclude_images_menu() {


            add_submenu_page(
                    'options-general.php',
                    __('Wyklucz obrazki', 'k3e'),
                    __('Wyklucz obrazki', 'k3e'),
                    'manage_options',
                    'exclude_images',
                    'exclude_images_content'
            );
        }

        excludeImages::saveExcluded();

        function exclude_images_content() {

            wp_enqueue_media();
            wp_enqueue_script('ExcludeImages', get_template_directory_uri() . '/assets/js/excludeImages.js', array('jquery'), '0.1');
            include plugin_dir_path(__FILE__) . 'templates/index.php';
        }

    }

    public static function getExcluded() {
        $excludeImages = unserialize(get_option('excludeImages'));
        if (is_array($excludeImages)) {
            $exclude = (explode(",", $excludeImages));
        } else {
            $exclude = [];
        }
        return $exclude;
    }

    public static function saveExcluded() {

        if (isset($_POST['exclude_images'])) {
            $wishlist = htmlentities($_POST['exclude_images']);
            update_option('excludeImages', serialize($wishlist));
            wp_redirect('admin.php?page=' . $_GET['page']);
        }

        add_action('wp_ajax_exclude_images', 'exclude_images');

        function exclude_images() {
            if (isset($_GET['id'])) {

                $ids = explode(",", $_GET['id']);
                $images = [];

                foreach ($ids as $id) {
                    $images[] = wp_get_attachment_image($id, 'big-icons', false, array('id' => 'preview-images', 'style' => 'margin-left: 5px;'));
                }
                $data = array(
                    'images' => $images
                );
                wp_send_json_success($data);
            } else {
                wp_send_json_error();
            }
        }

    }

}
