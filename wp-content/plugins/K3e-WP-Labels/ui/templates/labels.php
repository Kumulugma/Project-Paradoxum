<?php
//
$csv_file = get_option('labels_csv_file');

if ($csv_file) {
    $csv_file = unserialize($csv_file);
    $csv_file_input = $csv_file;
} else {
    $csv_file = "";
    $csv_file_input = "";
}
?>

<div class="wrap" id="configuration-page">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Etykiety', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <div class="k3e_box">
                        <style scoped>
                            .k3e_box{
                                display: grid;
                                grid-template-columns: max-content 1fr;
                                grid-row-gap: 10px;
                                grid-column-gap: 20px;
                            }
                            .k3e_field{
                                display: contents;
                            }
                        </style>
                        <form method="post" action="admin.php?page=labels_pdf&save=form"> 
                            <div>
                                <p class="meta-options k3e_field">
                                    <label for="k3e_document_pdf_name"><?= __('Nazwa dokumentu', 'k3e') ?></label>
                                    <input id="k3e_document_pdf_name" type="text" name="Labels[document_pdf_name]" value='<?= __('Etykiety ', 'k3e') . date('Y-m-d H:i:s') ?>'>
                                </p>
                            </div>
                            <div>
                                <h2><?= __('Rozmiar etykiet', 'k3e') ?></h2>
                                <p class="meta-options k3e_field">
                                    <input type="radio" id="k3e_labels_small" name="Labels[labels_size]" value="1" checked>
                                    <label for="k3e_labels_small"><?= __('Małe', 'k3e') ?></label>
                                    <br>
                                    <input type="radio" id="k3e_labels_medium" name="Labels[labels_size]" value="2">
                                    <label for="k3e_labels_medium"><?= __('Średnie', 'k3e') ?></label>

                                </p>
                            </div>
                            <div id="csv-box" data-default='fa fa-upload'' style="padding-left: 5px; padding-top: 10px;">
                                <?php if (!empty($csv_file)) { ?>
                                    <?php
                                    switch (get_post_mime_type($csv_file)) {
                                        default:
                                            echo '<a href="post.php?post=' . $csv_file . '&action=edit"><i class="fa fa-file" aria-hidden="true" style="font-size: 4em;"></i></a>';
                                            break;
                                    }
                                    ?>
                                <?php } else { ?>
                                    <i class="fa fa-upload" aria-hidden="true" style="font-size: 4em"></i>
                                <?php } ?></p>
                            </div>
                            <div style="display: block; margin-top: 4px; margin-bottom: 10px">
                                <input type='button' class="button-secondary" value="<?php esc_attr_e('Wybierz pliki', 'k3e'); ?>" id="csv_media_manager" style="margin-left: 5px;"/>
                                <input type='button' class="button-secondary" value="<?php esc_attr_e('Usuń pliki', 'k3e'); ?>" id="csv_media_remover"/>
                            </div>
                            <div style="display: block; padding-left: 5px;">
                                <input type="hidden" name="Labels[csv_file]" value="<?php echo esc_attr($csv_file_input); ?>" id="csv-file" class="regular-text" />
                                <input type='hidden' name="Labels[PDF]" value="<?= md5(rand(0, 255)) ?>"/>
                                <button class="button button-primary"  type="submit">Wygeneruj</button>
                            </div>
                        </form>
                        <div>
                            <h5><?= __('Wzór dokumentu', 'k3e') ?></h5>
                            <a href="<?= plugin_dir_url(__FILE__) . '../../assets/etykiety.csv'; ?>" download><?= __('Wzór', 'k3e') ?></a>
                        </div>
                    </div>
                    <hr>
                    <h2><?= __('Wygenerowane dokumenty', 'k3e') ?></h2>
                    <div class="k3e_box">
                        <?php
                        $args = array(
                            'post_type' => 'attachment',
                            'order' => 'DESC',
                            'post_status' => 'inherit',
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                array(
                                    'key' => '_labels_document',
                                    'compare' => 'EXISTS'
                                )
                            ),
                        );

                        $files = new WP_Query($args);
                        ?>
                        <table id="labels" class="display" style="width:100%" data-counter="<?= $files->found_posts ?>">
                            <thead>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Dokument', 'k3e') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($files->have_posts()) { ?>
                                    <?php $i = 1; ?>
                                    <?php while ($files->have_posts()) : $files->the_post(); ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><a href="<?= wp_get_attachment_url(get_the_ID()) ?>" style="text-decoration: none;"><?= get_the_title() ?></a></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endwhile; ?>
                                <?php } else { ?>
                                <td colspan="2" style="text-align: center;"><?= __('Brak wspisów', 'k3e') ?></td>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Dokument', 'k3e') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






