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

        UIClassLabelsAdmin::GenerateLabels();

        function labels_content() {

            wp_enqueue_media();
            wp_enqueue_script('K3e-Labels', plugin_dir_url(__FILE__) . '../assets/k3e-labels.js', array('jquery'), '0.1');
            wp_enqueue_style('Font-Awesome', plugin_dir_url(__FILE__) . "../node_modules/font-awesome/css/font-awesome.min.css");

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
                                $label[$cols[$k]] = iconv("Windows-1250", "UTF-8",$data[$k]);
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
                        $result[$k][] = $label;
                        if ($j % (($size == 1) ? 8 : 4) == (($size == 1) ? 7 : 3)) {
                            $k++;
                        }
                        $j++;
                        $label['AMOUNT']--;
                    }
                }
            }
            update_option('_pdf_labels', json_encode($result, JSON_UNESCAPED_UNICODE));
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

}
