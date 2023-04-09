
<div>
    <?php
    $args = array(
        'post_type' => 'species',
        'order' => 'ASC',
        'orderby' => 'title',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'species_state',
                'value' => '2',
                'compare' => '='
            )
        ),
    );

    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        ?>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: left;"><?= __("Gatunek", 'k3e') ?> </th>
                    <th rowspan="2">
                        <button data-id="sown" class="button button-primary btn-toggle"><i class="fa fa-low-vision" aria-hidden="true"></i></button>     
                    </th>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <small><?= __("Znaleziono: ", 'k3e') ?><?=$loop->found_posts?></small> 
                        <span class="badge badge-<?=$loop->found_posts!=0?'warning':'success'?>"></span> 
                    </td>
                </tr>
            </thead>
            <tbody class="k3e-toggle" id="sown">
                <?php
                while ($loop->have_posts()) : $loop->the_post();
                    echo "<tr>";
                    echo '<td colspan="2">';
                    echo '<a href="/wp-admin/post.php?action=edit&post=' . get_the_ID() . '" style="text-decoration: none;"> ' . get_the_title() . ' <small>' . get_post_meta(get_the_ID(), "species_name", true) . '</small></a>';
                    echo '</td>';
                    echo "</tr>";
                endwhile;

                wp_reset_postdata();
                ?>
            </tbody>
        </table>
    <?php } else { ?>
        <h3><?= __('Lista jest pusta', 'k3e') ?></h3>
    <?php } ?>
</div>