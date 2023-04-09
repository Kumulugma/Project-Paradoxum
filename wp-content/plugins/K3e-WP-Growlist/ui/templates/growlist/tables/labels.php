<div class="section">
    <form method="post" action="edit.php?post_type=species&page=growlist_tables&save=form">
        <div>
            <div id="header">
                <h2><?= __('Konfiguracja dokumentu', 'k3e') ?></h2>
            </div>
            <div class="box">
                <div class="input">
                    <label for="k3e_document_list_name"><?= __('Nazwa dokumentu', 'k3e') ?></label>
                    <input id="k3e_document_list_name" type="text" name="NewLabels[document_list_name]" value='<?= __('Spis etykiet ', 'k3e') . date('Y-m-d H:i:s') ?>'>
                </div>

                <div class="input">
                    <label for="k3e_list_comment"><?= __('Komentarz', 'k3e') ?></label>
                    <input id="k3e_list_comment" type="text" name="NewLabels[document_list_comment]" placeholder="<?= __('Komentarz', 'k3e') ?>">
                </div>
                <div class="save">
                    <?php
                    wp_nonce_field("k3e-growlist-tables-list", 'nonce');
                    ?>
                    <button class="button button-primary"  type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Wygeneruj</button>
                </div>
            </div>
        </div>
    </form>
    <form method="post" action="edit.php?post_type=species&page=growlist_tables&save=form">
        <div>
            <div class="box">
                <div class="clear">
                    <?php
                    wp_nonce_field("k3e-growlist-tables-list", 'nonce');
                    ?>
                    <input type="hidden" name="NewLabels[clear]" value="1">
                    <button class="button button-danger"  type="submit"><i class="fa fa-remove" aria-hidden="true"></i> Wyczyść</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php $labels = get_option('new_labels') ? get_option('new_labels') : []; ?>

<table id="labels" class="table" >
    <tbody>
        <?php
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
        ?>
        <tr>
            <th colspan="5"><?= $group->name ?></th>
        </tr> 
        <?php $i = 1; ?>
        <?php
        $species = new WP_Query($args);
        if ($species->have_posts()) {
            while ($species->have_posts()) : $species->the_post();
                ?>
                <tr id="row_<?= get_the_ID() ?>">
                    <td><?= $i ?>.</td>
                    <td><?= get_post_meta(get_the_ID(), "species_code", true) ?></td>
                    <td><a href="post.php?post=<?= (get_the_ID()) ?>&action=edit" style="text-decoration: none;"><?= get_the_title() ?> <?= get_post_meta(get_the_ID(), "species_name", true) ?></a></td>
                    <td><input type="text" id='amount_<?= get_the_ID() ?>' name="value" value='<?= isset($labels[get_the_ID()]) ? $labels[get_the_ID()] : 0 ?>' autocomplete="off"/></td>
                    <td class="actions">
                        <button data-id="<?= get_the_ID() ?>" data-nonce='<?= wp_create_nonce('k3e-tables-nonce') ?>' class="button button-primary btn-save"><i class="fa fa-save" aria-hidden="true"></i></button>       
                        <button data-id="<?= get_the_ID() ?>" data-nonce='<?= wp_create_nonce('k3e-tables-nonce') ?>' class="button button-danger btn-remove"><i class="fa fa-trash" aria-hidden="true"></i></button>       
                    </td>
                </tr>                                                        
                <?php
                $i++;
            endwhile;
        } else {
            ?>
            <tr>
                <td colspan="4"><?= __('Brak wspisów', 'k3e') ?></td>
            </tr> 
            <?php
        }
        ?>
    </tbody>
</table>

<hr>
<h2 class="h5"><?= __('Wygenerowane listy etykiet', 'k3e') ?></h2>
<div class="documents">
    <?php
    $args = array(
        'post_type' => 'attachment',
        'order' => 'DESC',
        'post_status' => 'inherit',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_document_list',
                'compare' => 'EXISTS'
            )
        ),
    );

    $files = new WP_Query($args);
    ?>
    <table id="files" class="table" data-counter="<?= $files->found_posts ?>">
        <thead>
            <tr>
                <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                <th style="text-align: left;"><?= __('Paczka', 'k3e') ?></th>
                <th style="text-align: left;"><?= __('Komentarz', 'k3e') ?></th>
                <th style="text-align: right;"><?= __('Akcje', 'k3e') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($files->have_posts()) { ?>
                <?php $i = 1; ?>
                <?php while ($files->have_posts()) : $files->the_post(); ?>
                    <tr id="row_<?= get_the_ID() ?>" data-form="0" data-nonce='<?= wp_create_nonce('k3e-tables-nonce') ?>'>
                        <td><?= $i ?></td>
                        <td>
                            <a href="<?=wp_get_attachment_url(get_the_ID())?>" style="text-decoration: none;" download><?= get_the_title() ?></a>
                        </td>
                        <td id="comment_<?= get_the_ID() ?>"><?= get_post_meta(get_the_ID(), 'document_comment', true) ?></td>
                        <td class="actions">
                            <button data-id="<?= get_the_ID() ?>" class="button button-primary btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>       
                            <button data-id="<?= get_the_ID() ?>" class="button button-danger btn-remove"><i class="fa fa-trash" aria-hidden="true"></i></button>       
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endwhile; ?>
            <?php } else { ?>
            <td colspan="4" style="text-align: center;"><?= __('Brak paczek', 'k3e') ?></td>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                <th style="text-align: left;"><?= __('Paczka', 'k3e') ?></th>
                <th style="text-align: left;"><?= __('Komentarz', 'k3e') ?></th>
                <th style="text-align: right;"><?= __('Akcje', 'k3e') ?></th>
            </tr>
        </tfoot>
    </table>
</div>