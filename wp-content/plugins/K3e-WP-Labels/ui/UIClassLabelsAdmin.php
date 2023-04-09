<?php

class UIClassLabelsAdmin {

    public static function run() {

        add_action('admin_menu', 'labels_menu');

        function labels_menu() {
            add_menu_page(
                    __('Etykiety', 'k3e'), //Title
                    __('Etykiety', 'k3e'), //Name
                    'manage_options',
                    'labels_pdf',
                    'labels_content',
                    'dashicons-tickets',
                    6
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

        UIClassLabelsAdmin::ajaxFunctions();
        UIClassLabelsAdmin::GenerateLabels();

        function labels_content() {

            wp_enqueue_media();
            wp_register_script('K3e-Labels', plugin_dir_url(__FILE__) . '../assets/k3e-labels.js', array('jquery'), '0.1');
            wp_enqueue_style('K3e-Labels', plugin_dir_url(__FILE__) . '../assets/k3e-labels.css');
            wp_enqueue_style('K3e-Buttons', plugin_dir_url(__FILE__) . '../assets/k3e-buttons.css');
            wp_enqueue_style('K3e-Table', plugin_dir_url(__FILE__) . '../assets/k3e-table.css');
            wp_enqueue_style('Font-Awesome', plugin_dir_url(__FILE__) . "../node_modules/font-awesome/css/font-awesome.min.css");
            wp_localize_script('K3e-Labels', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
            wp_enqueue_script('K3e-Labels');

            include plugin_dir_path(__FILE__) . 'templates/labels.php';
        }

    }

    public static function GenerateLabels() {
        if (isset($_POST['Labels']['PDF'])) {
            $size = $_POST['Labels']['labels_size'];

            //Odczyt z csv
            $labels = [];
            $result = [];
            if (isset($_POST['Labels']['csv_file']) && $_POST['Labels']['csv_file'] != "") {

                $file_path = get_attached_file($_POST['Labels']['csv_file']);

                $file = fopen($file_path, "r");

                $i = 0;
                if ($file !== FALSE) {
                    while (($data = fgetcsv($file, 1000000, ";")) !== FALSE) {
                        if ($i == 0) {
                            $cols = $data;
                        } else {
                            $label = [];
                            foreach ($cols as $k => $item) {
                                $label[$cols[$k]] = iconv("Windows-1250", "UTF-8", $data[$k]);
                            }
                            $labels[] = $label;
                        }
                        $i++;
                    }

                    fclose($file);
                }

                $k = 0;
                $j = 0;

                foreach ($labels as $label) {
                    while ($label['AMOUNT']) {

                        $label = $label + ['SIZE' => $size];
                        $label = $label + ['HEIGHT' => (($size == 3) ? 240 : 120)];
                        $result[$k][] = $label;
                        if ($j % (($size == 1) ? 8 : 4) == (($size == 1) ? 7 : 3)) {
                            $k++;
                        }
                        $j++;
                        $label['AMOUNT']--;
                    }
                }
            }
            update_option('_pdf_labels', json_encode($result));
            include plugin_dir_path(__FILE__) . 'templates/labels/document_pdf.php';

            wp_redirect('admin.php?page=' . $_GET['page']);
        }

        add_action('wp_ajax_labels_get_attachments', 'labels_get_post_attachments');

        function labels_get_post_attachments() {
            if (isset($_GET['id'])) {

                switch (get_post_mime_type($_GET['id'])) {
                    default:
                        $attachments[] = '<a href="post.php?post=' . $_GET['id'] . '&action=edit"><i class="fa fa-file" aria-hidden="true" style="font-size: 4em;"></i></a>';
                        break;
                }
                $data = array(
                    'attachments' => $attachments
                );
                wp_send_json_success($data);
            } else {
                wp_send_json_error();
            }
        }

    }

    public static function ajaxFunctions() {
        add_action("wp_ajax_k3e_label_content", "k3e_label_content");
        add_action("wp_ajax_nopriv_k3e_label_content", "k3e_label_no_logged");

        function k3e_label_content() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-label-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "_document_comment", true);
            $newComment = update_post_meta($_REQUEST["id"], "_document_comment", $_REQUEST["comment"]);

            if ($newComment === false) {
                $result['type'] = "error";
                $result['comment'] = $comment;
            } else {
                $result['type'] = "success";
                $result['comment'] = $_REQUEST["comment"];
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        function k3e_label_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_label_old_content", "k3e_label_old_content");
        add_action("wp_ajax_nopriv_k3e_label_old_content", "k3e_label_no_logged");

        function k3e_label_old_content() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-label-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "_document_comment", true);

            $result['type'] = "success";
            $result['comment'] = $comment;

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        add_action("wp_ajax_k3e_label_remove", "k3e_label_remove");
        add_action("wp_ajax_nopriv_k3e_label_remove", "k3e_label_no_logged");

        function k3e_label_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-label-nonce")) {
                exit("Brak dostępu");
            }

            $comment = delete_post_meta($_REQUEST["id"], "_labels_document");
            
            if ($comment === false) {
                $result['type'] = "error";
            } else {
                $result['type'] = "success";
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }
        
    }

}