<?php

class UIClassGrowlistAdmin {

    public static function run() {

        add_action('admin_menu', 'growlist_menu');

        function growlist_menu() {

            add_submenu_page(
                    'edit.php?post_type=species',
                    __('Tablice', 'k3e'),
                    __('Tablice', 'k3e'),
                    'manage_options',
                    'growlist_tables',
                    'growlist_tables_content'
            );

            add_submenu_page(
                    'edit.php?post_type=species',
                    __('Użytkowe', 'k3e'),
                    __('Użytkowe', 'k3e'),
                    'manage_options',
                    'growlist_utilities',
                    'growlist_utilities_content'
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

        UIClassGrowlistAdmin::GrowlistBox();
        UIClassGrowlistAdmin::GrowlistPhotos();

        UIClassGrowlistAdmin::GrowlistUtilities();
        UIClassGrowlistAdmin::GrowlistTables();

        UIClassGrowlistAdmin::IconInTaxonomy();
        UIClassGrowlistAdmin::IncomingBox();

        UIClassGrowlistAdmin::AlterSpeciesList();
        UIClassGrowlistAdmin::AlterIncomingList();

        UIClassGrowlistAdmin::ajaxFunctionsPhotos();
        UIClassGrowlistAdmin::ajaxFunctionsPdf();
        UIClassGrowlistAdmin::ajaxFunctionsIncoming();
        UIClassGrowlistAdmin::ajaxFunctionsGenerateCode();
        UIClassGrowlistAdmin::ajaxFunctionsExport();
        UIClassGrowlistAdmin::ajaxFunctionsNewLabels();

        add_action('admin_enqueue_scripts', 'k3e_growlist_admin_enqueue');

        function k3e_growlist_admin_enqueue() {
            wp_enqueue_style('k3e', plugin_dir_url(__FILE__) . '../assets/k3e.css');
            wp_enqueue_style('K3e-Badges', plugin_dir_url(__FILE__) . '../assets/k3e-badges.css');
            wp_enqueue_style('K3e-Buttons', plugin_dir_url(__FILE__) . '../assets/k3e-buttons.css');
            wp_enqueue_style('Font-Awesome', plugin_dir_url(__FILE__) . "../node_modules/font-awesome/css/font-awesome.min.css");
            wp_enqueue_script('K3e-Growlist', plugin_dir_url(__FILE__) . '../assets/k3e-growlist.js', array('jquery'), '0.1');

            $screen = get_current_screen();

            if ($screen->post_type === 'incoming') {
                wp_enqueue_style('K3e-Growlist-Incoming', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-incoming.css');
                wp_enqueue_style('K3e-Table', plugin_dir_url(__FILE__) . '../assets/k3e-table.css');
                wp_enqueue_style('K3e-Input', plugin_dir_url(__FILE__) . '../assets/k3e-input.css');
                wp_register_script('K3e-Growlist-Incoming', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-incoming.js', array('jquery'), '0.1');
                wp_localize_script('K3e-Growlist-Incoming', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
                wp_enqueue_script('K3e-Growlist-Incoming');
                wp_enqueue_style('K3e-Select2', plugin_dir_url(__FILE__) . "../node_modules/select2/dist/css/select2.min.css");
                wp_enqueue_script('K3e-Select2', plugin_dir_url(__FILE__) . "../node_modules/select2/dist/js/select2.min.js", ['jquery']);
                wp_enqueue_script('K3e-Select2-Config', plugin_dir_url(__FILE__) . '../assets/select2.js', array('K3e-Select2'), '0.1');
            }

            if ('species_page_growlist_tables' === $screen->base && $_GET['page'] === 'growlist_tables') {
                wp_enqueue_style('K3e-Table', plugin_dir_url(__FILE__) . '../assets/k3e-table.css');
                wp_enqueue_style('K3e-Input', plugin_dir_url(__FILE__) . '../assets/k3e-input.css');
                wp_enqueue_style('K3e-Growlist-Tables', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-tables.css');

                wp_register_script('K3e-Growlist-Tables', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-tables.js', array('jquery'), '0.1');
                wp_localize_script('K3e-Growlist-Tables', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
                wp_enqueue_script('K3e-Growlist-Tables');
            }

            if ('species_page_growlist_utilities' === $screen->base && $_GET['page'] === 'growlist_utilities') {
                wp_enqueue_style('K3e-Table', plugin_dir_url(__FILE__) . '../assets/k3e-table.css');
                wp_enqueue_style('K3e-Input', plugin_dir_url(__FILE__) . '../assets/k3e-input.css');
                wp_enqueue_style('K3e-Growlist-Pdf', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-pdf.css');
                wp_enqueue_style('K3e-Growlist-Export', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-export.css');
                wp_enqueue_style('K3e-Growlist-Photos', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-photos.css');

                wp_register_script('K3e-Growlist-Pdf', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-pdf.js', array('jquery'), '0.1');
                wp_localize_script('K3e-Growlist-Pdf', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
                wp_enqueue_script('K3e-Growlist-Pdf');

                wp_register_script('K3e-Growlist-Export', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-export.js', array('jquery'), '0.1');
                wp_localize_script('K3e-Growlist-Export', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
                wp_enqueue_script('K3e-Growlist-Export');

                wp_register_script('K3e-Growlist-Photos', plugin_dir_url(__FILE__) . '../assets/k3e-growlist-photos.js', array('jquery'), '0.1');
                wp_localize_script('K3e-Growlist-Photos', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce')));
                wp_enqueue_script('K3e-Growlist-Photos');

                wp_enqueue_script('dataTable', plugin_dir_url(__FILE__) . "../node_modules/datatables.net/js/jquery.dataTables.min.js", ['jquery']);
                wp_enqueue_style('dataTable-css', "https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css");
                wp_enqueue_script('dataTable-config', plugin_dir_url(__FILE__) . "../assets/dataTable.js");
            }
        }

        function growlist_tables_content() {

            include plugin_dir_path(__FILE__) . 'templates/growlist/tables.php';
        }

        function growlist_utilities_content() {

            include plugin_dir_path(__FILE__) . 'templates/growlist/utilities.php';
        }

    }

    public static function GrowlistBox() {

        function growlist_meta_box() {
            add_meta_box("growlist-data-meta-box", "Dodatkowe parametry", "growlist_box_markup", "species", "normal", "high", null);
        }

        add_action("add_meta_boxes", "growlist_meta_box");

        function growlist_box_markup($object) {
            wp_enqueue_style('K3e-Badges', plugin_dir_url(__FILE__) . '../assets/k3e-badges.css');

            include plugin_dir_path(__FILE__) . 'templates/meta/form.php';
        }

        function k3e_growlist_save_meta_box($post_id) {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;
            if ($parent_id = wp_is_post_revision($post_id)) {
                $post_id = $parent_id;
            }
            $fields = [
                'species_code',
                'species_name',
                'species_state',
                'species_comment',
                'species_own',
                'species_passport',
            ];
            foreach ($fields as $field) {
                if (array_key_exists($field, $_POST)) {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
            if (!isset($_POST['species_own'])) {
                update_post_meta($post_id, 'species_own', 0);
            }
        }

        add_action('save_post', 'k3e_growlist_save_meta_box');
    }

    public static function GrowlistPhotos() {

        add_action("add_meta_boxes", "growlist_photos_meta_box");

        function growlist_photos_meta_box() {
            add_meta_box("growlist-photos-meta-box", "Zdjęcia gatunku", "growlist_photos_box_markup", "species", "normal", "high", null);
        }

        function growlist_photos_box_markup($object) {
            wp_enqueue_media();
            wp_enqueue_script('K3e-Media', plugin_dir_url(__FILE__) . '../assets/k3e-media.js', array('jquery'), '0.1');

            include plugin_dir_path(__FILE__) . 'templates/photos/form.php';
        }

        function k3e_growlist_photos_save_meta_box($post_id) {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;
            if ($parent_id = wp_is_post_revision($post_id)) {
                $post_id = $parent_id;
            }

            $fields = [
                'species_photos',
            ];
            foreach ($fields as $field) {
                if (array_key_exists($field, $_POST)) {
                    update_post_meta($post_id, $field, serialize(sanitize_text_field($_POST[$field])));
                }
            }
        }

        add_action('save_post', 'k3e_growlist_photos_save_meta_box');

        add_action('wp_ajax_postimage_get_files', 'postimage_get_files');

        function postimage_get_files() {
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

    public static function GrowlistUtilities() {

        //Config
        if (isset($_POST['GrowlistConfig'])) {
            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-growlist-utilities-config")) {
                exit("Brak dostępu");
            }

            if (!current_user_can('manage_options')) {
                exit("Brak dostępu");
            }

            $code_prefix = ($_POST['GrowlistConfig']['code_prefix']);
            update_option('code_prefix', ($code_prefix));
            wp_redirect('admin.php?page=' . $_GET['page']);
        }

        //Export
        if (isset($_POST['Growlist']['CSV'])) {
            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-growlist-utilities-export")) {
                exit("Brak dostępu");
            }

            if (!current_user_can('manage_options')) {
                exit("Brak dostępu");
            }

            $growlist = [];

            $i = 1;
            foreach (get_terms('groups', array('hide_empty' => false,)) as $group) {

                $args = array(
                    'post_type' => 'species',
                    'order' => 'ASC',
                    'orderby' => 'title',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'groups',
                            'field' => 'slug',
                            'terms' => $group->slug
                        )
                    )
                );

                $species = new WP_Query($args);
                if ($species->have_posts()) {
                    while ($species->have_posts()) : $species->the_post();
                        $growlist[$i]['i'] = $i;
                        $growlist[$i]['code'] = get_post_meta(get_the_ID(), 'species_code', true) ?: '';
                        $growlist[$i]['name'] = get_the_title();
                        $growlist[$i]['mininame'] = get_post_meta(get_the_ID(), 'species_name', true);
                        $groups = "";
                        foreach (get_the_terms(get_the_ID(), 'groups') as $group) {
                            $groups .= $group->name . " ";
                        }
                        $growlist[$i]['group'] = $groups;

                        $growlist[$i]['state'] = speciesStatus(get_post_meta(get_the_ID(), 'species_state', true));

                        $growlist[$i]['comment'] = get_post_meta(get_the_ID(), 'species_comment', true) ?: '';

                        $post_images = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true)));
                        $growlist[$i]['images'] = count($post_images) - 1;
                        $growlist[$i]['thumbnail'] = has_post_thumbnail(get_the_ID());
                        $i++;
                    endwhile;
                }
            }
            update_option('_csv_growlist', json_encode($growlist));

            include plugin_dir_path(__FILE__) . 'templates/growlist/document_csv.php';

            wp_redirect('admin.php?page=' . $_GET['page'] . '&tab=export');
        }


        //PDF
        if (isset($_POST['Growlist']['PDF'])) {
            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-growlist-utilities-pdf")) {
                exit("Brak dostępu");
            }

            if (!current_user_can('manage_options')) {
                exit("Brak dostępu");
            }

            $growlist = [];

            if ($_POST['Growlist']['species_status'] != -1) {
                $post_status = $_POST['Growlist']['species_status'];
            } else {
                $post_status = NULL;
            }

            $i = 1;
            foreach (get_terms('groups', array('hide_empty' => false,)) as $group) {

                if ($post_status) {
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'groups',
                                'field' => 'slug',
                                'terms' => $group->slug
                            ),
                        ),
                        'meta_query' => array(
                            array(
                                'key' => 'species_state',
                                'value' => $post_status,
                                'compare' => '='
                            )
                        )
                    );
                } else {
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'groups',
                                'field' => 'slug',
                                'terms' => $group->slug
                            )
                        )
                    );
                }

                $species = new WP_Query($args);
                if ($species->have_posts()) {
                    while ($species->have_posts()) : $species->the_post();
                        $growlist[$i]['i'] = $i;
                        $growlist[$i]['code'] = get_post_meta(get_the_ID(), 'species_code', true) ?: '';
                        $growlist[$i]['name'] = get_the_title();
                        $growlist[$i]['mininame'] = get_post_meta(get_the_ID(), 'species_name', true);
                        $groups = "";
                        foreach (get_the_terms(get_the_ID(), 'groups') as $group) {
                            $groups .= $group->name . " ";
                        }
                        $growlist[$i]['group'] = $groups;
                        $growlist[$i]['state'] = speciesStatus(get_post_meta(get_the_ID(), 'species_state', true));
                        $growlist[$i]['comment'] = get_post_meta(get_the_ID(), 'species_comment', true) ?: '';

                        $post_images = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true)));
                        $growlist[$i]['images'] = count($post_images) - 1;
                        $growlist[$i]['thumbnail'] = has_post_thumbnail(get_the_ID());
                        $i++;
                    endwhile;
                }
            }
            update_option('_pdf_growlist', json_encode($growlist));

            include plugin_dir_path(__FILE__) . 'templates/growlist/document_pdf.php';

            wp_redirect('admin.php?page=' . $_GET['page'] . '&tab=pdf');
        }


        //Wishlist
        if (isset($_POST['Growlist'])) {
            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-growlist-utilities-wishlist")) {
                exit("Brak dostępu");
            }

            if (!current_user_can('manage_options')) {
                exit("Brak dostępu");
            }

            $wishlist = ($_POST['Growlist']['wishlist']);
            update_option('wishlist', serialize($wishlist));
            wp_redirect('admin.php?page=' . $_GET['page'] . '&tab=wishlist');
        }


        //Photos
        if (isset($_POST['PhotoAlbum']['checksum'])) {
            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-growlist-utilities-photos")) {
                exit("Brak dostępu");
            }

            if (!empty($_POST['PhotoAlbum']['start_date'])) {
                $start_date = $_POST['PhotoAlbum']['start_date'];
                $comment = $_POST['PhotoAlbum']['comment'];

                $query_images_args = array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'post_status' => 'inherit',
                    'posts_per_page' => - 1,
                    'date_query' => array(
                        array(
                            'after' => $start_date,
                            'before' => date('Y-m-d H:i:s'),
                            'inclusive' => true,
                        ),
                    ),
                );

                $query_images = new WP_Query($query_images_args);

                $post_id = wp_insert_post(array(
                    'post_type' => 'photo_album',
                    'post_title' => 'Album zdjęć od ' . $start_date . ' do ' . date('Y-m-d'),
                    'post_status' => 'publish',
                    'comment_status' => 'closed', // if you prefer
                    'ping_status' => 'closed', // if you prefer
                ));

                if ($post_id) {
                    // insert post meta
                    add_post_meta($post_id, 'ready_photos', 0);
                    add_post_meta($post_id, 'package_photos', $query_images->found_posts);
                    add_post_meta($post_id, 'start_date', $start_date);
                    add_post_meta($post_id, 'document_comment', $comment);
                }
            }



            if (isset($_POST['PhotoAlbum']['pack'])) {
                manuallyPackPhotos();
            }

            wp_redirect('admin.php?page=' . $_GET['page'] . '&tab=photos');
        }
    }

    public static function GrowlistTables() {

        //Config
        if (isset($_POST['NewLabels'])) {
            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-growlist-tables-list")) {
                exit("Brak dostępu");
            }

            if (!current_user_can('manage_options')) {
                exit("Brak dostępu");
            }

            if ($_POST['NewLabels']['clear'] == '1') {
                update_option('new_labels', []);
            }


            if ($_POST['NewLabels']['document_list_name']) {
                $labelList = [];

                $labels = get_option('new_labels') ? get_option('new_labels') : [];

                if (count($labels) > 0) {
                    $args = array(
                        'post_type' => 'species',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'post__in' => array_keys($labels)
                    );
                } else {
                    $args = [];
                }

                $labelList = [];

                $species = new WP_Query($args);
                if ($species->have_posts()) {
                    while ($species->have_posts()) : $species->the_post();
                        $labelList[] = [
                            'line1' => iconv("UTF-8", "Windows-1250", get_post_meta(get_the_ID(), 'species_code', true)),
                            'line2' => iconv("UTF-8", "Windows-1250", get_the_title()),
                            'line3' => iconv("UTF-8", "Windows-1250", get_post_meta(get_the_ID(), 'species_name', true)),
                            'amount' => $labels[get_the_ID()]
                        ];

                    endwhile;
                }
                update_option('_csv_labelList', json_encode($labelList));

                include plugin_dir_path(__FILE__) . 'templates/growlist/document_labels.php';
            }
            wp_redirect('admin.php?page=' . $_GET['page'] . '&tab=labels');
        }
    }

    public static function AlterSpeciesList() {
        add_filter('manage_species_posts_columns', 'rename_first_column');

        function rename_first_column($columns) {
            wp_enqueue_style('K3e-Badges', plugin_dir_url(__FILE__) . '../assets/k3e-badges.css');

            foreach ($columns as $k => $column) {
                if ($column == 'Tytuł') {
                    $columns[$k] = __('Nazwa', 'k3e');
                }
            }
            return $columns;
        }

        add_filter('manage_species_posts_columns', 'add_new_columns');

        function add_new_columns($columns) {
            $column_meta = array('species_state' => __('Status okazu', 'k3e'));
            $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, NULL, true);
            $column_meta = array('species_name' => __('Szczegóły', 'k3e'));
            $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, NULL, true);
            return $columns;
        }

        add_action('manage_species_posts_custom_column', 'custom_species_columns');

        function custom_species_columns($column) {
            global $post;
            switch ($column) {
                case 'species_name':
                    $metaData = get_post_meta($post->ID, 'species_name', true);
                    echo "<small>" . $metaData . "</small>";
                    break;
                case 'species_state':
                    $metaData = get_post_meta($post->ID, 'species_state', true);
                    echo '<span class="badge badge-' . speciesBadge($metaData) . '"></span>  ';
                    echo speciesStatus($metaData);
                    break;
            }
        }

        add_filter('manage_species_posts_columns', function ($columns) {
            unset($columns['date']);
            return $columns;
        });

        add_filter('posts_join', 'species_search_join');

        function species_search_join($join) {
            global $pagenow, $wpdb;

            if (is_admin() && 'edit.php' === $pagenow && 'species' === $_GET['post_type'] && !empty($_GET['s'])) {
                $join .= 'LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
            }
            return $join;
        }

        add_filter('posts_where', 'species_search_where');

        function species_search_where($where) {
            global $pagenow, $wpdb;

            if (is_admin() && 'edit.php' === $pagenow && 'species' === $_GET['post_type'] && !empty($_GET['s'])) {
                $where = preg_replace(
                        "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                        "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where);
                $where .= " GROUP BY {$wpdb->posts}.id";
            }
            return $where;
        }

    }

    public static function AlterIncomingList() {

        add_filter('manage_incoming_posts_columns', 'add_new_incoming_columns');

        function add_new_incoming_columns($columns) {
            $column_meta = array('incoming_content' => __('Zawartość', 'k3e'));
            $columns = array_slice($columns, 0, 2, true) + $column_meta + array_slice($columns, 2, NULL, true);
            return $columns;
        }

        add_action('manage_incoming_posts_custom_column', 'custom_incoming_columns');

        function custom_incoming_columns($column) {
            global $post;
            switch ($column) {
                case 'incoming_content':
                    $linked_species = get_post_meta($post->ID, 'incoming_species', true);
                    echo "<ul>";
                    foreach ($linked_species as $species) {
                        echo "<li><small>" . get_the_title($species) . " " . get_post_meta($species, 'species_name', true) . '</small></li>';
                    }
                    echo "</ul>";

                    break;
            }
        }

        add_filter('manage_incoming_posts_columns', function ($columns) {
            unset($columns['taxonomy-incoming_type']);
            return $columns;
        });
    }

    public static function IconInTaxonomy() {

        add_action('groups_add_form_fields', 'groups_add_term_fields');

        function groups_add_term_fields($taxonomy) {
            include plugin_dir_path(__FILE__) . 'templates/taxonomy/add.php';
        }

        add_action('admin_enqueue_scripts', 'k3e_groups_js');

        function k3e_groups_js() {

            if (!did_action('wp_enqueue_media')) {
                wp_enqueue_media();
            }
            wp_enqueue_script(
                    'K3e-Groups',
                    plugin_dir_url(__FILE__) . '../assets/k3e-groups.js',
                    array('jquery')
            );
        }

        add_action('groups_edit_form_fields', 'groups_edit_term_fields', 10, 2);

        function groups_edit_term_fields($term, $taxonomy) {
            include plugin_dir_path(__FILE__) . 'templates/taxonomy/edit.php';
        }

        add_action('created_groups', 'k3e_groups_save_term_fields');
        add_action('edited_groups', 'k3e_groups_save_term_fields');

        function k3e_groups_save_term_fields($term_id) {

            update_term_meta(
                    $term_id,
                    'k3e_groups_img',
                    absint($_POST['k3e_groups_img'])
            );
        }

    }

    public static function ajaxFunctionsNewLabels() {

        function k3e_tables_new_label_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_tables_add_label", "k3e_tables_add_label");
        add_action("wp_ajax_nopriv_k3e_tables_add_label", "k3e_tables_new_label_no_logged");

        function k3e_tables_add_label() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-tables-nonce")) {
                exit("Brak dostępu");
            }

            $labels = get_option('new_labels') ? get_option('new_labels') : [];
            $labels[$_REQUEST["id"]] = 1;

            if (!update_option('new_labels', $labels)) {
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

        add_action("wp_ajax_k3e_tables_remove_label", "k3e_tables_remove_label");
        add_action("wp_ajax_nopriv_k3e_tables_remove_label", "k3e_tables_new_label_no_logged");

        function k3e_tables_remove_label() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-tables-nonce")) {
                exit("Brak dostępu");
            }

            $labels = get_option('new_labels') ? get_option('new_labels') : [];
            unset($labels[$_REQUEST["id"]]);

            if (!update_option('new_labels', $labels)) {
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

        add_action("wp_ajax_k3e_tables_save_label", "k3e_tables_save_label");
        add_action("wp_ajax_nopriv_k3e_tables_save_label", "k3e_tables_new_label_no_logged");

        function k3e_tables_save_label() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-tables-nonce")) {
                exit("Brak dostępu");
            }

            $labels = get_option('new_labels') ? get_option('new_labels') : [];
            $labels[$_REQUEST["id"]] = $_REQUEST["value"];

            if (!update_option('new_labels', $labels)) {
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

        add_action("wp_ajax_k3e_tables_new_label_comment", "k3e_tables_new_label_comment");
        add_action("wp_ajax_nopriv_k3e_tables_new_label_comment", "k3e_tables_new_label_no_logged");

        function k3e_tables_new_label_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-tables-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);
            $newComment = update_post_meta($_REQUEST["id"], "document_comment", $_REQUEST["comment"]);

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

        add_action("wp_ajax_k3e_tables_new_label_old_comment", "k3e_tables_new_label_old_comment");
        add_action("wp_ajax_nopriv_k3e_tables_new_label_old_comment", "k3e_tables_new_label_no_logged");

        function k3e_tables_new_label_old_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-tables-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);

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

        add_action("wp_ajax_k3e_tables_new_label_remove", "k3e_tables_new_label_remove");
        add_action("wp_ajax_nopriv_tables_new_label_remove", "k3e_tables_new_label_no_logged");

        function k3e_tables_new_label_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-tables-nonce")) {
                exit("Brak dostępu");
            }

            $comment = wp_delete_post($_REQUEST["id"], "attachment");

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

    public static function ajaxFunctionsGenerateCode() {

        function k3e_incoming_species_generate_code_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_incoming_species_generate_code", "k3e_incoming_species_generate_code");
        add_action("wp_ajax_nopriv_k3e_incoming_species_generate_code", "k3e_incoming_species_generate_code_no_logged");

        function k3e_incoming_species_generate_code() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-incoming-nonce")) {
                exit("Brak dostępu");
            }

            $lp = get_post_meta($_REQUEST["id"], "lp", true);
            $lp = intval($lp);
            if ($lp == 0) {
                $lp = 1;
            }
            $prefix = get_option('code_prefix');
            $prefix = $prefix != null ? $prefix . "-" : '';
            $incoming_number = get_post_meta($_REQUEST["id"], "incoming_number", true);
            $code = $prefix . $incoming_number . '/' . $lp;
            $lp++;
            update_post_meta($_REQUEST["id"], "lp", $lp);

            if ($code) {
                $edit = update_post_meta($_REQUEST["species"], "species_code", $code);
            }

            if ($edit === false) {
                $result['type'] = "error";
                $result['code'] = "error";
                $result['status'] = "error";
            } else {
                $result['type'] = "success";
                $result['species_code'] = $code;
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

    public static function ajaxFunctionsIncoming() {

        function k3e_incoming_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_incoming_species", "k3e_incoming_species");
        add_action("wp_ajax_nopriv_k3e_incoming_species", "k3e_incoming_no_logged");

        function k3e_incoming_species() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-incoming-nonce")) {
                exit("Brak dostępu");
            }

            $incoming = get_post($_REQUEST["id"]);
            $species = get_post($_REQUEST["species"]);
            $linked_species = get_post_meta($_REQUEST["id"], "incoming_species", true);

            if (is_array($linked_species)) {
                if (!in_array($species->ID, $linked_species)) {
                    array_push($linked_species, $species->ID);
                }
            } else {
                $linked_species = [];
                $linked_species[0] = $species->ID;
            }

            $linkSpecies = update_post_meta($_REQUEST["id"], "incoming_species", $linked_species);

            $species_status = get_post_meta($_REQUEST["species"], "species_state", true);
            $species_code = get_post_meta($_REQUEST["species"], "species_code", true);
            $species_passport = get_post_meta($_REQUEST["species"], "species_passport", true);

            if ($linkSpecies === false) {
                $result['type'] = "error";
            } else {
                $result['type'] = "success";
                $result['species'] = $_REQUEST["species"];
                $result['id'] = $_REQUEST["id"];
                $result['code'] = $species_code;
                $result['passport'] = $species_passport;
                $result['name'] = get_the_title($_REQUEST["species"]) . " " . get_post_meta($_REQUEST["species"], 'species_name', true);
                $result['status_id'] = $species_status;
                $result['status'] = speciesStatus($species_status);
                $result['badge'] = speciesBadge($species_status);
            }

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $result = json_encode($result);
                echo $result;
            } else {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

            die();
        }

        add_action("wp_ajax_k3e_incoming_species_remove", "k3e_incoming_species_remove");
        add_action("wp_ajax_nopriv_k3e_incoming_species_remove", "k3e_incoming_no_logged");

        function k3e_incoming_species_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-incoming-nonce")) {
                exit("Brak dostępu");
            }

            $linked_species = get_post_meta($_REQUEST["id"], "incoming_species", true);

            foreach ($linked_species as $k => $species) {
                if ($species == $_REQUEST["species"]) {
                    unset($linked_species[$k]);
                }
            }

            $remove = update_post_meta($_REQUEST["id"], "incoming_species", $linked_species);

            if ($remove === false) {
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

        add_action("wp_ajax_k3e_incoming_species_save", "k3e_incoming_species_save");
        add_action("wp_ajax_nopriv_k3e_incoming_species_save", "k3e_incoming_no_logged");

        function k3e_incoming_species_save() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-incoming-nonce")) {
                exit("Brak dostępu");
            }

            $code = $_REQUEST["code"];
            $status = $_REQUEST["status"];
            $passport = $_REQUEST["passport"];
            $old_status = get_post_meta($_REQUEST["species"], "species_state", true);
//            $old_code = get_post_meta($_REQUEST["species"], "species_code", true);


            if (isset($_REQUEST["code"])) {
                $edit = update_post_meta($_REQUEST["species"], "species_code", $code);
            }

            if (isset($_REQUEST["status"])) {
                $edit = update_post_meta($_REQUEST["species"], "species_state", $status);
            }

            if (isset($_REQUEST["passport"])) {
                $edit = update_post_meta($_REQUEST["species"], "species_passport", $passport);
            }


            if ($old_status == $status) {
                $edit = true;
            }


            if ($edit === false) {
                $result['type'] = "error";
                $result['code'] = "error";
                $result['status'] = "error";
            } else {
                $result['type'] = "success";
                $result['code'] = $code;
                $result['passport'] = $passport;
                $result['status'] = speciesStatus($status);
                $result['removeClass'] = 'badge-' . speciesBadge($old_status);
                $result['addClass'] = 'badge-' . speciesBadge($status);
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

    public static function ajaxFunctionsPdf() {

        function k3e_list_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_list_comment", "k3e_list_comment");
        add_action("wp_ajax_nopriv_k3e_list_comment", "k3e_list_no_logged");

        function k3e_list_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-list-nonce")) {
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

        add_action("wp_ajax_k3e_list_old_comment", "k3e_list_old_comment");
        add_action("wp_ajax_nopriv_k3e_list_old_comment", "k3e_list_no_logged");

        function k3e_list_old_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-list-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);

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

        add_action("wp_ajax_k3e_list_remove", "k3e_list_remove");
        add_action("wp_ajax_nopriv_list_remove", "k3e_list_no_logged");

        function k3e_list_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-list-nonce")) {
                exit("Brak dostępu");
            }

            $comment = wp_delete_post($_REQUEST["id"], "photo_album");

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

    public static function ajaxFunctionsPhotos() {

        function k3e_photos_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_photos_comment", "k3e_photos_comment");
        add_action("wp_ajax_nopriv_k3e_photos_comment", "k3e_photos_no_logged");

        function k3e_photos_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-photos-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);
            $newComment = update_post_meta($_REQUEST["id"], "document_comment", $_REQUEST["comment"]);

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

        add_action("wp_ajax_k3e_photos_old_comment", "k3e_photos_old_comment");
        add_action("wp_ajax_nopriv_k3e_photos_old_comment", "k3e_photos_no_logged");

        function k3e_photos_old_comment() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-photos-nonce")) {
                exit("Brak dostępu");
            }

            $comment = get_post_meta($_REQUEST["id"], "document_comment", true);

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

        add_action("wp_ajax_k3e_photos_remove", "k3e_photos_remove");
        add_action("wp_ajax_nopriv_photos_remove", "k3e_photos_no_logged");

        function k3e_photos_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-photos-nonce")) {
                exit("Brak dostępu");
            }

            $comment = wp_delete_post($_REQUEST["id"], "photo_album");

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

    public static function ajaxFunctionsExport() {

        function k3e_export_no_logged() {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        add_action("wp_ajax_k3e_export_remove", "k3e_export_remove");
        add_action("wp_ajax_nopriv_k3e_export_remove", "k3e_export_no_logged");

        function k3e_export_remove() {

            if (!wp_verify_nonce($_REQUEST['nonce'], "k3e-export-nonce")) {
                exit("Brak dostępu");
            }

            $comment = delete_post_meta($_REQUEST["id"], "_growlist_export");

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

    public static function IncomingBox() {

        function incoming_meta_box() {
            add_meta_box("incoming-data-meta-box", "Szczegóły", "incoming_box_markup", "incoming", "normal", "high", null);
        }

        add_action("add_meta_boxes", "incoming_meta_box");
        add_action("edit_meta_boxes", "incoming_meta_box");

        function incoming_box_markup($object) {
            include plugin_dir_path(__FILE__) . 'templates/incoming/form.php';
        }

        function k3e_incoming_save_meta_box($post_id) {
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;
            if ($parent_id = wp_is_post_revision($post_id)) {
                $post_id = $parent_id;
            }

            if (get_post_type($post_id) == 'incoming') {
                $fields = [
                    'incoming_provider',
                    'incoming_form',
                    'incoming_number',
                    'incoming_date',
                    'incoming_shipment',
                    'incoming_confirmation'
                ];

                foreach ($fields as $field) {
                    if (array_key_exists($field, $_POST)) {
                        update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                    }
                }

                $title = get_the_title($post_id);
                $provider = get_term_by('id', $_POST['incoming_provider'], 'provider');

                $new_title = ($_POST['incoming_form'] == 1 ? __('Zakup', 'k3e') : __('Wymiana', 'k3e')) . " (" . ucfirst($provider->name) . ")";
                if ($title != $new_title) {


                    wp_update_post([
                        "ID" => $post_id,
                        "post_title" => $new_title,
                    ]);
                }
            }
        }

        add_action('save_post', 'k3e_incoming_save_meta_box');

        add_action('admin_menu', function () {
            remove_meta_box('litespeed_meta_boxes', 'incoming', 'side');
        });
    }

}
