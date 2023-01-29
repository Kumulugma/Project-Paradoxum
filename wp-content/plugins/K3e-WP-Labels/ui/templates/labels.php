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

<div class="wrap" id="K3eLabel">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Etykiety', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <div class="section">
                        <form method="post" action="admin.php?page=labels_pdf&save=form"> 
                            <div>
                                <div id="header">
                                    <h2><?= __('Konfiguracja etykiety', 'k3e') ?></h2>
                                    <div class="info">
                                        <p><?= __('Wzór dokumentu: ', 'k3e') ?> <a href="<?= plugin_dir_url(__FILE__) . '../../assets/etykiety.csv'; ?>" download><?= __('Wzór', 'k3e') ?></a></p>
                                    </div>
                                </div>
                                <div class="box">
                                    <label>
                                        <img src="<?= plugin_dir_url(__FILE__) . '../../assets/etykiety_4.png'; ?>" width="67px" alt="<?= __("Małe ikony", "k3e") ?>" for="k3e_labels_small"/>
                                        <input type="radio" id="k3e_labels_small" name="Labels[labels_size]" value="1" checked>
                                        <?= __('Małe', 'k3e') ?>
                                    </label>
                                </div>
                                <div class="box">
                                    <label for="k3e_labels_medium">
                                        <img src="<?= plugin_dir_url(__FILE__) . '../../assets/etykiety_2.png'; ?>" width="67px" alt="<?= __("Średnie ikony", "k3e") ?>" for="k3e_labels_medium"/>
                                        <input type="radio" id="k3e_labels_medium" name="Labels[labels_size]" value="2">
                                        <?= __('Średnie', 'k3e') ?>
                                    </label>
                                </div>
                            </div>
                            <div class="box">
                                <div id="upload" data-default='fa fa-upload'>
                                    <?php if (!empty($csv_file)) { ?>
                                        <?php
                                        switch (get_post_mime_type($csv_file)) {
                                            default:
                                                echo '<a href="post.php?post=' . $csv_file . '&action=edit"><i class="fa fa-file" aria-hidden="true" style="font-size: 4em;"></i></a>';
                                                break;
                                        }
                                        ?>
                                    <?php } else { ?>
                                        <i class="fa fa-upload" aria-hidden="true" style="font-size: 2.2em"></i>
                                    <?php } ?>
                                </div>
                                <input type='button' class="button-secondary" value="<?php esc_attr_e('Wybierz pliki', 'k3e'); ?>" id="csv_media_manager" style="margin-left: 5px;"/>
                                <input type='button' class="button-secondary" value="<?php esc_attr_e('Usuń pliki', 'k3e'); ?>" id="csv_media_remover"/>
                                <input type="hidden" name="Labels[csv_file]" value="<?php echo esc_attr($csv_file_input); ?>" id="csv-file" class="regular-text" />
                                <input type='hidden' name="Labels[PDF]" value="<?= md5(rand(0, 255)) ?>"/>
                                <input id="document_name" type="text" name="Labels[document_pdf_name]" value='<?= __('Etykiety ', 'k3e') . date('Y-m-d H:i:s') ?>'>
                                <input id="document_comment" type="text" name="Labels[document_pdf_comment]" placeholder="<?= __('Komentarz', 'k3e') ?>">
                                <button class="button button-primary" id="save" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Wygeneruj</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <h2><?= __('Wygenerowane dokumenty', 'k3e') ?></h2>
                    <div class="documents">
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
                        <table id="files" class="table display" style="width:100%" data-counter="<?= $files->found_posts ?>">
                            <thead>
                                <tr>
                                    <th style="text-align: left;  width:23px">Lp.</th>
                                    <th style="text-align: left; width: 30%">Dokument</th>
                                    <th style="text-align: left;">Komentarz</th>
                                    <th style="text-align: left; width: 150px">Opcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($files->have_posts()) { ?>
                                    <?php $i = 1; ?>
                                    <?php while ($files->have_posts()) : $files->the_post(); ?>
                                        <tr id="row_<?= get_the_ID() ?>" data-form="0" data-nonce='<?= wp_create_nonce('k3e-label-nonce') ?>'>
                                            <td><?= $i ?></td>
                                            <td><a href="<?= wp_get_attachment_url(get_the_ID()) ?>" style="text-decoration: none;"><?= get_the_title() ?></a></td>
                                            <td id="comment_<?= get_the_ID() ?>"><?= (get_post_meta(get_the_ID(), '_document_comment', true)) ?></td>
                                            <td>
                                                <button data-id="<?= get_the_ID() ?>" class="button button-primary btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>       
                                                <button data-id="<?= get_the_ID() ?>" class="button button-danger btn-remove"><i class="fa fa-trash" aria-hidden="true"></i></button>       
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endwhile; ?>
                                <?php } else { ?>
                                <td colspan="4" style="text-align: center;"><?= __('Brak wspisów', 'k3e') ?></td>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Dokument', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Komentarz', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Opcje', 'k3e') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






