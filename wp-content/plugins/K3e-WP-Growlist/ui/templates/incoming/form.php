<?php $incoming_provider = get_post_meta($object->ID, "incoming_provider", true); ?>
<?php $incoming_form = get_post_meta($object->ID, "incoming_form", true); ?>
<?php $incoming_number = get_post_meta($object->ID, "incoming_number", true); ?>
<?php $incoming_date = get_post_meta($object->ID, "incoming_date", true); ?>
<?php $incoming_shipment = get_post_meta($object->ID, "incoming_shipment", true); ?>
<?php $incoming_confirmation = get_post_meta($object->ID, "incoming_confirmation", true); ?>
<?php $incoming_lp = get_post_meta($object->ID, "lp", true); ?>

<?php
if ($incoming_number == "") {
    $incoming_number = (get_option('incoming_number') != "" ? get_option('incoming_number') : "S" . date('y') . '/01');
}
?>

<div id="K3eGrowlist">
    <div class="k3e_box">
        <table id="incoming" class="table" data-nonce='<?= wp_create_nonce('k3e-incoming-nonce') ?>'>
            <tbody>
                <tr>
                    <td><?= __('Dostawca: ', 'k3e') ?></td>
                    <td>

                        <select name="incoming_provider" class="input select2">
                            <option value="">Brak dostawcy</option>
                            <?php foreach (get_terms('provider') as $term) { ?>
                                <option value="<?= $term->term_id ?>" <?= $incoming_provider == $term->term_id ? 'selected' : '' ?>><?= $term->name ?></option>
                            <?php } ?>
                        </select>

                    </td>
                    <td>
                        <?php
                        if ($incoming_provider == "") {
                            echo "<span>" . __('Brak wartości', 'k3e') . "</span>";
                        }
                        ?>
                    </td>
                    <td class="actions">
                        <a href="/wp-admin/edit-tags.php?taxonomy=provider&post_type=species"  class="button button-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> <?= __('Utwórz nowego dostawcę', 'k3e') ?>    
                        </a>  
                    </td>
                </tr>
                <tr>
                    <td><?= __('Forma: ', 'k3e') ?></td>
                    <td>

                        <select name="incoming_form" class="input">
                            <option value="">Brak formy</option>
                            <option value="1" <?= $incoming_form == 1 ? 'selected' : '' ?> style="color:green" ><?= __('Zakup', 'k3e') ?></option>
                            <option value="2" <?= $incoming_form == 2 ? 'selected' : '' ?> style="color:orange" ><?= __('Wymiana', 'k3e') ?></option>
                        </select>

                    </td>
                    <td>
                        <?php
                        if ($incoming_form == "") {
                            echo "<span>" . __('Brak wartości', 'k3e') . "</span>";
                        }
                        ?>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td><?= __('Numer: ', 'k3e') ?></td>
                    <td>
                        <input type="text" name="incoming_number" class="input" value="<?= $incoming_number ?>"/> 
                    </td>
                    <td>
                        <?php
                        if ($incoming_number == "") {
                            echo "<span>" . __('Brak wartości', 'k3e') . "</span>";
                        }
                        ?>
                            <?php
                        if ($incoming_lp != "") {
                            echo "<span>" . __('Aktualny wektor: ', 'k3e') . $incoming_lp . "</span>";
                        }
                        ?>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td><?= __('Data: ', 'k3e') ?></td>
                    <td>
                        <input type="date" name="incoming_date" class="input" value="<?= $incoming_date ?>"/> 
                    </td>
                    <td>
                        <?php
                        if ($incoming_date == "") {
                            echo "<span>" . __('Brak wartości', 'k3e') . "</span>";
                        }
                        ?>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td><?= __('Status przesyłki: ', 'k3e') ?></td>
                    <td>

                        <select name="incoming_shipment" class="input">
                            <option value="">Brak wysyłki</option>
                            <option value="1" <?= $incoming_shipment == 1 ? 'selected' : '' ?> style="color:blue" ><?= __('Wysłane', 'k3e') ?></option>
                            <option value="2" <?= $incoming_shipment == 2 ? 'selected' : '' ?> style="color:green" ><?= __('Dotarło', 'k3e') ?></option>
                            <option value="3" <?= $incoming_shipment == 3 ? 'selected' : '' ?> style="color:orange" ><?= __('Ponowna wysyłka', 'k3e') ?></option>
                        </select>

                    </td>
                    <td>
                        <?php
                        if ($incoming_shipment == "") {
                            echo "<span>" . __('Brak wartości', 'k3e') . "</span>";
                        }
                        ?>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td><?= __('Wysłano potwierdzenie: ', 'k3e') ?></td>
                    <td>

                        <select name="incoming_confirmation" class="input">
                            <option value="">Brak formy</option>
                            <option value="1" <?= $incoming_confirmation == 1 ? 'selected' : '' ?> style="color:green" ><?= __('Tak', 'k3e') ?></option>
                            <option value="2" <?= $incoming_confirmation == 2 ? 'selected' : '' ?> style="color:red" ><?= __('Nie', 'k3e') ?></option>
                        </select>

                    </td>
                    <td>
                        <?php
                        if ($incoming_confirmation == "") {
                            echo "<span>" . __('Brak wartości', 'k3e') . "</span>";
                        }
                        ?>
                    </td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>  

        <?php if (get_post_status() == 'publish') { ?>
            <h2 class="h5"><?= __('Gatunki', 'k3e') ?></h2>
            <?php $linked_species = get_post_meta(get_the_ID(), "incoming_species", true) ? get_post_meta(get_the_ID(), "incoming_species", true) : []; ?>

            <table id="species" class="table" data-counter='<?= count($linked_species) ?>' data-nonce='<?= wp_create_nonce('k3e-incoming-nonce') ?>'>
                <?php $i = 1; ?>
                <thead>
                    <tr>
                        <th><?= __('Lp. ', 'k3e') ?></th>
                        <th><?= __('Kod', 'k3e') ?></th>
                        <th><?= __('Odmiana', 'k3e') ?></th>
                        <th colspan="2"><?= __('Stan', 'k3e') ?></th>
                        <th><?= __('Paszport', 'k3e') ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($linked_species as $species) { ?>
                        <tr id="row_<?= $species ?>" data-form="0">
                            <td><?= $i ?></td>
                            <td id="code_<?= $species ?>"><?= get_post_meta($species, 'species_code', true) ?: '' ?></td>
                            <td><?= get_the_title($species) ?> <?= get_post_meta($species, 'species_name', true) ?></td>
                            <?php $status = get_post_meta($species, 'species_state', true); ?>
                            <td id="status_<?= $species ?>" data-status="<?= $status ?>">
                                <?= speciesStatus($status) ?>
                            </td>
                            <td id="badge_<?=$species?>">
                                <span class="badge badge-<?= speciesBadge($status) ?>">
                                </span>
                            </td>
                            <td id="passport_<?=$species?>"><?= get_post_meta($species, 'species_passport', true) ?></td>
                            <td class="actions">
                                <?php if(get_post_meta($species, 'species_code', true) == '') { ?>
                                <button id="generate_<?= $species ?>" data-species="<?= $species ?>" data-id="<?= get_the_ID() ?>" data-incoming="<?=$object->ID?>" class="button button-secondary btn-code"><i class="fa fa-barcode" aria-hidden="true"></i></button>     
                                <?php } ?>                                
                                <button data-species="<?= $species ?>" data-id="<?= get_the_ID() ?>"  class="button button-secondary btn-edit"><i class="fa fa-edit" aria-hidden="true"></i></button>     
                                <button data-species="<?= $species ?>" data-id="<?= get_the_ID() ?>"  class="button button-danger btn-remove"><i class="fa fa-trash" aria-hidden="true"></i></button>       
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr id="species-add" class="panel" data-provider='<?=$incoming_provider?>' data-form='0'>
                        <td colspan="6">
                            <select name="incoming_add_species" id="incoming_species" class="input select2">
                                <?php
                                $args = array(
                                    'numberposts' => -1,
                                    'post_type' => 'species',
                                    'orderby' => 'post_title',
                                    'order' => 'ASC',
                                );

                                $species = get_posts($args);

                                if (is_array($species)) {
                                    foreach ($species as $post) {
                                        ?>
                                        <option value="<?= $post->ID ?>"><?= $post->post_title ?> <?= get_post_meta($post->ID, 'species_name', true) ?></option>
                                        <?php
                                    }
                                }
                                ?>


                            </select>
                            <button data-id="<?= get_the_ID() ?>" class="button button-primary btn-add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </td>
                        <td class="actions">
                            <a href="/wp-admin/post-new.php?post_type=species">
                                <button class="button button-info"><i class="fa fa-cogs" aria-hidden="true"></i></button>     
                            </a> 
                        </td>
                    </tr>
                </tfoot>
            </table>

        <?php } else { ?>
            <div><p><?= __('Aby dodać gatunki, musisz opublikować P.Z.', 'k3e') ?></p></div>
        <?php } ?>
    </div>		
</div>

