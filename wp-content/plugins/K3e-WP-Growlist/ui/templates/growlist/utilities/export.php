<div id="K3e-Export" class="postbox-container" style="width:100%;">
    <div class="card" style="max-width: none; margin:2px">
        <div class="section">
            <form method="post" action="edit.php?post_type=species&page=growlist_utilities&save=form">
                <div>
                    <div id="header">
                        <h2><?= __('Konfiguracja dokumentu', 'k3e') ?></h2>
                    </div>
                    <div class="box">
                        <div class="input">
                            <label for="k3e_document_export_name"><?= __('Nazwa dokumentu', 'k3e') ?></label>
                            <input id="k3e_document_export_name" type="text" name="Growlist[document_export_name]" value='<?= __('Lista roślin ', 'k3e') . date('Y-m-d H:i:s') ?>'>
                        </div>
                        <div class="save">
                            <?php
                            wp_nonce_field("k3e-growlist-utilities-export", 'nonce');
                            ?>
                            <input type='hidden' name="Growlist[CSV]" value="<?= md5(rand(0, 255)) ?>"/>
                            <button class="button button-primary"  type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Wygeneruj</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <h2 class="h5"><?= __('Wygenerowane dokumenty', 'k3e') ?></h2>
        <div class="documents">
            <?php
            $args = array(
                'post_type' => 'attachment',
                'order' => 'DESC',
                'post_status' => 'inherit',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => '_growlist_export',
                        'compare' => 'EXISTS'
                    )
                ),
            );

            $files = new WP_Query($args);
            ?>
            <table id="files" class="table" data-counter="<?= $files->found_posts ?>">
                <thead>
                    <tr>
                        <th style="text-align: left; width: 20px;" scope="col"><?= __('Lp.', 'k3e') ?></th>
                        <th style="text-align: left;" scope="col"><?= __('Dokument', 'k3e') ?></th>
                        <th style="text-align: right;" scope="col"><?= __('Akcje', 'k3e') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($files->have_posts()) { ?>
                        <?php $i = 1; ?>
                        <?php while ($files->have_posts()) : $files->the_post(); ?>
                            <tr id="row_<?= get_the_ID() ?>" data-nonce='<?= wp_create_nonce('k3e-export-nonce') ?>'>
                                <td scope="row"><?= $i ?></td>
                                <td><a href="<?= wp_get_attachment_url(get_the_ID()) ?>" style="text-decoration: none;" download><?= get_the_title() ?></a></td>
                                <td class="actions"><button data-id="<?= get_the_ID() ?>" class="button button-danger btn-remove"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endwhile; ?>
                    <?php } else { ?>
                    <td colspan="3" style="text-align: center;"><?= __('Brak wspisów', 'k3e') ?></td>
                <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                        <th style="text-align: left;"><?= __('Dokument', 'k3e') ?></th>
                        <th style="text-align: right;" scope="col"><?= __('Akcje', 'k3e') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div style="clear: both"></div>
<?php wp_reset_query(); ?>