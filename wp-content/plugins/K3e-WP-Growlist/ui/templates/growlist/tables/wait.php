<?php $labels = get_option('new_labels')?get_option('new_labels'):[]; ?>
<table id="species" class="table" >
    <tbody>
        <?php $j = 1; ?>
        <?php foreach (get_terms('groups', array('hide_empty' => false)) as $group) { ?>
            <?php
            $args = array(
                'post_type' => 'species',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'title',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'groups',
                        'field' => 'slug',
                        'terms' => $group->slug
                    )
                ),
                'meta_query' => array(
                    array(
                        'key' => 'species_state',
                        'value' => '4',
                        'compare' => '='
                    )
                )
            );
            ?>
            <tr>
                <th colspan="4"><?= $group->name ?></th>
            </tr> 
            <?php $i = 1; ?>
            <?php
            $species = new WP_Query($args);
            if ($species->have_posts()) {
                while ($species->have_posts()) : $species->the_post();
                    ?>
                    <tr>
                        <td><?= $i ?>.</td>
                        <td><?= get_post_meta(get_the_ID(), "species_code", true) ?></td>
                        <td><a href="post.php?post=<?= (get_the_ID()) ?>&action=edit" style="text-decoration: none;"><?= get_the_title() ?> <?= get_post_meta(get_the_ID(), "species_name", true) ?></a></td>
                        <td class="actions">
                            <button data-id="<?= get_the_ID() ?>" data-nonce='<?= wp_create_nonce('k3e-tables-nonce') ?>'  class="button button-<?= (in_array(get_the_ID(), $labels) ? 'primary' : 'secondary') ?> btn-label"><i class="fa fa-tag" aria-hidden="true"></i></button>       
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
        }
        ?>
    </tbody>
</table>