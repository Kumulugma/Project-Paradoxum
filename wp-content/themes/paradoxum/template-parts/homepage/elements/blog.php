<?php
$args = array(
    'post_type' => 'post',
    'orderby' => 'date',
    'ignore_sticky_posts' => 1,
);

$category = get_category(get_query_var('cat'));
if (isset($category->cat_ID)) {
    $catID = $category->cat_ID;
    $args['cat'] = $catID;
}

$tag = get_query_var('tag');
if (!empty($tag)) {
    $args['tag'] = $tag;
}

$s = get_query_var('s');
if (!empty($s)) {
    $args['s'] = $s;
}

$paged = (get_query_var('page')) ? (get_query_var('page')) : 1;
//$postsPerPage = get_option('posts_per_page');
$postsPerPage = 3;
$postOffset = (($paged - 1) * $postsPerPage);

$args['posts_per_page'] = $postsPerPage;
$args['offset'] = $postOffset;

$blog = new WP_Query($args);
?>
<!-- Blog Section Start -->
<section class="news-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="sub-title-2"><span><?= __('Aktualności', 'k3e') ?></span></div>
                <h3 class="sec-title">
                    <?= __('Lista wpisów', 'k3e') ?>
                </h3>
            </div>
        </div>
        <div class="row">

            <?php if ($blog->have_posts()) { ?>
                <?php
                while ($blog->have_posts()) {
                    $blog->the_post();
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <!-- Single Post Start -->
                        <div class="news-item">
                            <div class="post-thumb">
                                <?php if (has_post_thumbnail(get_the_ID())): ?>
                                    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'news'); ?>
                                    <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
                                <?php endif; ?>

                                <?php $post_categories = get_the_category(get_the_ID()); ?>
                                <?php if (is_array($post_categories)) { ?>
                                    <?php foreach ($post_categories as $category) { ?>
                                        <a class="cate" href="<?= get_category_link($category) ?>"> <?= $category->name ?> </a>                        
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="post-details">
                                <h4>
                                    <a href="<?= get_permalink(get_the_ID()) ?>">
                                        <?= get_the_title() ?> 
                                    </a>
                                </h4>
                                <div class="post-footer">
                                    <a href="<?= get_permalink(get_the_ID()) ?>"><i class="fal fa-calendar-alt"></i><?= get_the_date() ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Post End -->
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <!-- pagination -->
        <div class="row">


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
                <div class="quomodo-pagination text-center w-100">
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
        <!-- End pagination -->


        <?php wp_reset_postdata(); ?>
    </div>
</section>
<!-- Blog Section End -->