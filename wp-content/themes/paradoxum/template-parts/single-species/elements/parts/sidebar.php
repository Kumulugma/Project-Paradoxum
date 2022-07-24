<?php
$args = array(
    'posts_per_page' => 8,
    'post_type' => 'species',
    'order' => 'rand'
);
$terms = get_the_terms(get_the_ID(), 'groups');
if (!empty($terms)) {
    // get the first term
    $term = array_shift($terms);
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'groups',
            'field' => 'slug',
            'terms' => $term->slug
        )
    );
}

$other_species = new WP_Query($args);
?>

<div class="col-lg-4 col-md-12">
    <div class="news-sidebar">
        <aside class="widget widget-trend-post">
            <h3 class="widget-title"><span><?= __('Inne z tej kategorii', 'k3e') ?></span></h3>
            <?php if ($other_species->have_posts()) { ?>
                <?php while ($other_species->have_posts()) : $other_species->the_post(); ?>
                    <div class="tr-post">
                        <a href="<?= get_permalink() ?>">
                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'big-icons'); ?>
                                <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
                            <?php endif; ?>
                        </a>
                        <h5><a href="<?= get_permalink() ?>"><?= get_the_title() ?> <small style="display:block;"><?= get_post_meta(get_the_ID(), 'species_name', true) ?></small></a>
                        </h5>
                        <span><i class="fal fa-calendar-alt"></i><?= get_the_date() ?></span>
                    </div>
                <?php endwhile; ?>
            <?php } else { ?>
                <p class="text-center"><?= __('Brak podobnych', 'k3e') ?></p>
            <?php } ?>
        </aside>
        <?php wp_reset_postdata(); ?>
        <?php

        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'closed',
            'orderby' => 'rand',
            'posts_per_page' => '1',
            'post_mime_type' => array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif' => 'image/gif',
                'png' => 'image/png',
            ),
            'post__not_in' => excludeImages::getExcluded()
        );
        $random_image = new WP_Query($args);
        ?>    <?php if ($random_image->have_posts()) { ?>
            <?php
            while ($random_image->have_posts()) {
                $random_image->the_post();
                ?>
                <aside class="widget widget-image">
                    <h3 class="widget-title"><span><?= __('Losowy obrazek', 'k3e') ?></span></h3>

                    <?php $image = wp_get_attachment_image_src((get_the_ID()), 'sidebar-image'); ?>
                    <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
                </aside>
            <?php } ?>
        <?php } ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>
