<!-- Service Section Start -->
<section class="single-service-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="service-area">
                    <div class="service-thumb">
                        <?php if (has_post_thumbnail(get_the_ID())): ?>
                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'blog'); ?>
                            <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
                        <?php endif; ?>
                    </div>
                    <div class="service-content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
<!-- Service Section End -->
