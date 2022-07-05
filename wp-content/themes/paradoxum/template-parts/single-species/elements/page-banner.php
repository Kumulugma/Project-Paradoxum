<!-- Page Banner Start -->
<?php if (has_post_thumbnail(get_the_ID())): ?>
    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'page-banner'); ?>
    <?php $banner = $image[0]; ?>
<?php else: ?>
    <?php $banner = get_template_directory_uri() . "/assets/images/_hero.JPG"; ?>
<?php endif; ?>

<section class="page-banner lazyload" 
         data-style="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
         data-src="<?= $banner ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <div class="bread-crumbs">
                        <?= get_breadcrumb(); ?>
                    </div>
                    <h2><?= get_the_title() ?></h2>
                    <h4><?= get_post_meta(get_the_ID(), 'species_name', true) ?></h4>
                </div>
            </div>
        </div>
    </div>
</section>  
<!-- Page Banner End -->