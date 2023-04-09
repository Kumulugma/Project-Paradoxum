<div class="wrap" id="K3eGrowlist">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('BBCode', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <div class="section">
                        <form method="post" action="admin.php?page=growlist_pdf&save=form">
                            <div>
                                <div id="header">
                                    <h2><?= __('Po skopiowaniu wklej na forum', 'k3e') ?></h2>
                                </div>
                                <div class="box">
                                    <textarea rows="500" cols="270">
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
                    'value' => '1',
                    'compare' => '='
                )
            )
        );
        ?>
[b]<?= $group->name ?>[/b]
<?php $i = 1; ?>
<?php
$species = new WP_Query($args);
if ($species->have_posts()) :
    while ($species->have_posts()) : $species->the_post();
$name = get_post_meta(get_the_ID(), "species_name", true);
        ?>
<?=$i?>. <?= get_the_title() ?> <?= strlen($name)>0 ? '[i]'.$name.'[/i]':''  ?>
<?php $photos = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true))) ?>
<?php if (count($photos) > 0 && $photos[0] != "") { ?>
 [url=<?= get_permalink(get_the_ID()) ?>][b](Zdjęcia)[/b][/url]<?php } ?>

<?php
        $i++;
    endwhile;
endif;
?>
_________________________________________


<?php } ?>
Wygenerowano: <?= date('d-m-Y H:i') ?>

[color=#b5b5b5]Wersja online: [url=<?=get_site_url()?>/lista-roslin/]<?=get_site_url()?>/lista-roslin/[/url][/color]</textarea>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






