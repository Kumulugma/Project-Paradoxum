<?php
$args = array(
    'post_type' => 'projects',
    'post_status' => 'publish',
    'orderby' => 'ID',
);

$the_query = new WP_Query($args);
?>
<?php
$i = 0;
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();
        $i++;
        ?>
        <div id="modal-project-<?= $i ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog modal-fluid">
                <div class="modal-content">
                    <div class="modal-header">
                        &nbsp;
                        <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                            <span class="d-none">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <article class="article">
                            <div class="article-header">
                                <h2 class="article-title"><?= get_the_title() ?></h2>
                                <h3 class="article-subtitle"><?= get_field('projects_subtitle') ?></h3>
                                <p class="article-tags"><?= get_field('projects_label') ?></p>
                            </div>
                            <div class="row flex-column-reverse flex-lg-row">
                                <div class="col-12 col-lg-6">
                                    <p><?= get_the_content() ?></p>
                                    <?php if(get_field('projects_url')) { ?>
                                    <p><a href="<?=get_field('projects_url')?>"><button type="submit" class="btn btn-primary">Odwiedź</button></a></p>
                                    <?php } ?>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <?php if (has_post_thumbnail(get_the_ID())): ?>
                                        <?php $image_ID = get_post_thumbnail_id(get_the_ID()); ?>
                                        <?php $image = wp_get_attachment_image_src($image_ID, 'single-post-thumbnail'); ?>
                                        <?php $image_alt = get_post_meta($image_ID, '_wp_attachment_image_alt', TRUE); ?>
                                        <img class="img-fluid mb-10" src="<?php echo $image[0]; ?>" alt="<?= get_the_title() ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
<?php } ?>
<?php wp_reset_postdata(); ?>