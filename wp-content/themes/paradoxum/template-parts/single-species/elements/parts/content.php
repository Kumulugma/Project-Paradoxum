<div class="col-lg-8 col-md-12">
    <?= get_the_content() ?>

    <?php
    $post_images = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true)));

    if (count($post_images) > 0 && $post_images[0] != "") {
        ?>
        <div class="news-item-3">
            <div class="news-thumb">
                <div id="gallery-image" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $i = 0; ?>
                        <?php foreach ($post_images as $item) { ?>
                            <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                                <?= wp_get_attachment_image($item, 'blog', false) ?>
                            </div>
                            <?php $i++ ?>
                        <?php } ?>
                    </div>
                    <a class="carousel-control-prev" href="#gallery-image" role="button" data-slide="prev"><i class="fal fa-arrow-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#gallery-image" role="button" data-slide="next"><i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php } else {
        ?>
        <h3>
            <?= __('Niestety ale ten gatunek nie ma jeszcze zdjęć', 'k3e'); ?>
        </h3>
        <?php
    }
    ?>

    <?php echo do_shortcode("[growlist-gallery id='".get_the_ID()."']"); ?>
</div>
<?php wp_reset_postdata(); ?>
