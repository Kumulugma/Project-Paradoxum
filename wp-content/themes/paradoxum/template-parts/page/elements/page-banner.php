<!-- Page Banner Start -->
<section class="page-banner lazyload" 
         data-style="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
         data-src="<?=reset(wp_get_attachment_image_src(get_field('homepage_hero', 7), 'hero'))?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <div class="bread-crumbs">
                        <?= get_breadcrumb(); ?>
                    </div>
                    <h2><?= get_the_title() ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>  
<!-- Page Banner End -->