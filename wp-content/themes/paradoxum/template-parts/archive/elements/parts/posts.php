<?php
$args = array(
    'post_type' => 'species',
    'orderby' => 'date',
    'ignore_sticky_posts' => 1,
);

$group = get_category(get_query_var('groups'));
//$terms = get_the_terms(get_the_ID(), 'groups');
if (!empty($terms)) {
    // get the first term
    $term = array_shift($terms);
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'groups',
            'field' => 'slug',
            'terms' => $group
        )
    );
}

$tag = get_query_var('tag');
if (!empty($tag)) {
    $args['tag'] = $tag;
}

$s = get_query_var('s');
if (!empty($s)) {
    $args['s'] = $s;
}

$paged = (get_query_var('page')) ? get_query_var('page') : 1;

$postsPerPage = get_option('posts_per_page');
$postOffset = (($paged - 1) * $postsPerPage);

$args['posts_per_page'] = $postsPerPage;
$args['offset'] = $postOffset;

$blog = new WP_Query($args);
?>

<div class="col-lg-8 col-md-12">
    <?php if ($blog->have_posts()) { ?>
        <?php
        while ($blog->have_posts()) {
            $blog->the_post();
            ?>
            <div class="news-item-3">
                <div class="news-thumb">
                    <?php if (has_post_thumbnail(get_the_ID())): ?>
                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'blog'); ?>
                        <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
                    <?php endif; ?>

                    <?php $post_categories = get_the_category(get_the_ID()); ?>
                    <?php if (is_array($post_categories)) { ?>
                        <?php foreach ($post_categories as $category) { ?>
                            <a class="cate" href="<?= get_category_link($category) ?>"> <?= $category->name ?> </a>                        
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="news-details">
                    <h3>
                        <a href="<?= get_permalink(get_the_ID()) ?>">
                            <?= get_the_title() ?> 
                        </a>
                    </h3>
                    <h4><?= get_post_meta(get_the_ID(), "species_name", true) ?></h4>
                    <p><?= get_the_excerpt(get_the_ID()) ?></p>
                    <div class="news-footer">
                        <a href="<?= get_permalink(get_the_ID()) ?>"><i class="fal fa-calendar-alt"></i><?= get_the_date() ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
    <?=__('Niestety nic nie udało się znaleźć...', 'k3e')?>
    <?php } ?>

    <?php
    $total_pages = $blog->max_num_pages;

    if ($total_pages > 1) {

        $current_page = max(0, $paged);

        $links = paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%',
                    'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => '<i class="fal fa-arrow-left"></i>',
            'next_text' => '<i class="fal fa-arrow-right"></i>',
            'type' => 'array'
        ));
    }
    ?>

    <?php if (isset($links)) { ?>
        <div class="quomodo-pagination text-center">
            <?php foreach ($links as $k => $link) { ?>
                <?php
                if ($k == ($current_page > 1 ? $current_page : ($current_page))) {
                    echo '<span class="current">' . $link . '</span>';
                } else {
                    echo $link;
                }
                ?>


            <?php } ?>
        </div>
    <?php } ?>
</div>
<?php wp_reset_postdata(); ?>