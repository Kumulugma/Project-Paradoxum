<?php
$popularpost = new WP_Query(
        array(
    'posts_per_page' => 8,
    'meta_key' => 'k3e_post_views_count',
    'orderby' => 'meta_value_num',
    'order' => 'DESC')
);
?>

<div class="col-lg-4 col-md-12">
    <div class="news-sidebar">
        <aside class="widget widget-search">
            <h3 class="widget-title"><span><?= __('Wyszukaj', 'k3e') ?></span></h3>
            <form class="search-form" action="#" method="get">
                <input type="search" name="s" placeholder="<?= __('Wpisz poszukiwane hasło...', 'k3e') ?>">
                <button type="submit"><i class="far fa-search"></i></button>
            </form>
        </aside>
        <aside class="widget widget-trend-post">
            <h3 class="widget-title"><span><?= __('Popularne wpisy', 'k3e') ?></span></h3>
            <?php if ($popularpost->have_posts()) { ?>
                <?php while ($popularpost->have_posts()) : $popularpost->the_post(); ?>
                    <div class="tr-post">
                        <a href="#">
                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'big-icons'); ?>
                                <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
                            <?php endif; ?>
                        </a>
                        <h5><a href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
                        </h5>
                        <span><i class="fal fa-calendar-alt"></i><?= get_the_date() ?></span>
                    </div>
                <?php endwhile; ?>
            <?php } else { ?>
                <p class="text-center"><?= __('Czekamy na odwiedziny', 'k3e') ?></p>
            <?php } ?>
        </aside>
        <?php wp_reset_postdata(); ?>
        <aside class="widget widget-categories">
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC'
            ));
            ?>
            <h3 class="widget-title"><span><?= __('Kategorie', 'k3e') ?></span></h3>
            <ul>
                <?php foreach ($categories as $category) { ?>
                    <li>
                        <div class="blog-post blog-overlay blog-post-05">
                            <div class="blog-image">

                            </div>
                            <div class="blog-name">
                                <a href="<?= get_category_link($category->term_id) ?>"><?= $category->name ?>&nbsp;<span class="ms-auto">(<?= $category->count ?>)</span></a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </aside>
        <aside class="widget widget-tags">
            <?php
            $tags = get_terms(array(
                'taxonomy' => 'post_tag',
                'orderby' => 'count',
                'order' => 'DESC',
            ));
            ?>
            <h3 class="widget-title"><span><?= __('Popularne Tagi', 'k3e') ?></span></h3>
            <div class="tags">
                <?php if (count($tags)) { ?>
                    <?php foreach ($tags as $tag) { ?>
                        <a href="<?= get_tag_link($tag) ?>"><?= $tag->name ?></a>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-center"><?= __('Brak przypisanych tagów', 'k3e') ?></p>
                <?php } ?>
            </div>
        </aside>
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
            'post__not_in' => ['575', '574']
//            'tax_query' => array(
//                array(
//                    'taxonomy' => 'media_category',
//                    'field' => 'slug',
//                    'terms' => 'imgfront',
//                ),
//            ),
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
