<main class="content">
    <div class="container-fluid-limited">
        <div class="row">
            <div class="col col-xl-9">
                <section id="section-01" class="section section-sub-header animation interaction-in">
                    <div class="section-body">
                        <div class="jumbotron jumbotron-fluid pt-6 pt-lg-8 pb-0 mb-0">
                            <img src="<?= get_template_directory_uri() ?>/assets/img/icon.svg" class="jumbotron-img animation-translate animation-item-1" alt="<?= get_bloginfo('name') ?>">
                            <h1 class="display-1 display-animated display-animated-in animation-translate animation-item-2">K3e</h1>
                            <p class="lead animation-translate animation-item-3">WEBDEVELOPER</p>
                        </div>
                    </div>
                    <div class="section-footer animation-translate animation-item-4">
                        <a class="section-next goto-section" href="#section-02">
                            <span class="section-next-counter">1/6</span>
                            <span class="section-next-label">Następny rozdział</span>
                            <span class="section-next-icon"></span>
                        </a>
                    </div>
                </section>
                <section id="section-02" class="section animation">
                    <div class="section-body">
                        <div class="row">
                            <div class="col col-xl-10">
                                <h2 class="section-title animation-translate-overline animation-item-1"><?= get_field('about_header', 10) ?></h2>
                                <article class="article animation-translate animation-item-2">
                                    <?= get_field('about_content', 10) ?>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="section-footer animation-translate animation-item-3">
                        <a class="section-next goto-section" href="#section-03">
                            <span class="section-next-counter">2/6</span>
                            <span class="section-next-label">Następny rozdział</span>
                            <span class="section-next-icon"></span>
                        </a>
                    </div>
                </section>
                <section id="section-03" class="section animation">
                    <div class="section-body">
                        <h2 class="section-title animation-translate-overline animation-item-1"><?= get_field('services_header', 10) ?></h2>
                        <div class="row animation-translate animation-item-2">
                            <div class="col-12 col-md-4">
                                <div class="card card">
                                    <div class="card-body">
                                        <strong class="card-counter">1</strong>
                                        <h3 class="card-title"><?= get_field('services_tile_1_title', 10) ?></h3>
                                        <p class="card-text">
                                            <?= get_field('services_tile_1_content', 10) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card card">
                                    <div class="card-body">
                                        <strong class="card-counter">2</strong>
                                        <h3 class="card-title"><?= get_field('services_tile_2_title', 10) ?></h3>
                                        <p class="card-text">
                                            <?= get_field('services_tile_2_content', 10) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card card">
                                    <div class="card-body">
                                        <strong class="card-counter">3</strong>
                                        <h3 class="card-title"><?= get_field('services_tile_3_title', 10) ?></h3>
                                        <p class="card-text">
                                            <?= get_field('services_tile_3_content', 10) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-footer animation-translate animation-item-3">
                        <a class="section-next goto-section" href="#section-04">
                            <span class="section-next-counter">3/6</span>
                            <span class="section-next-label">Następny rozdział</span>
                            <span class="section-next-icon"></span>
                        </a>
                    </div>
                </section>
                <section id="section-04" class="section animation">
                    <div class="section-body">
                        <h2 class="section-title animation-translate-overline animation-item-1"><?= get_field('history_header', 10) ?></h2>
                        <?= get_field('history_content', 10) ?>
                    </div>
                    <div class="section-footer animation-translate animation-item-3">
                        <a class="section-next goto-section" href="#section-05">
                            <span class="section-next-counter">4/6</span>
                            <span class="section-next-label">Następny rozdział</span>
                            <span class="section-next-icon"></span>
                        </a>
                    </div>
                </section>
                <section id="section-05" class="section animation">
                    <div class="section-body">
                        <?php
                        $args = array(
                            'post_type' => 'projects',
                            'post_status' => 'publish',
                            'orderby' => 'ID',
                        );

                        $the_query = new WP_Query($args);
                        ?>
                        <h2 class="section-title animation-translate-overline animation-item-1"><?= get_field('projects_header', 10) ?></h2>
                        <div class="row animation-translate animation-item-2">
                            <?php
                            $i = 0;
                            if ($the_query->have_posts()) {
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();
                                    $i++;
                                    ?>
                                    <div class="col-12 col-md-4">
                                        <a class="card" href="#modal-project-<?= $i ?>" data-toggle="modal">
                                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                                                <?php $image_ID = get_post_thumbnail_id(get_the_ID()); ?>
                                                <?php $image = wp_get_attachment_image_src($image_ID, 'single-post-thumbnail'); ?>
                                                <?php $image_alt = get_post_meta($image_ID, '_wp_attachment_image_alt', TRUE); ?>
                                                <img class="card-img-top" src="<?php echo $image[0]; ?>" alt="<?= get_the_title() ?>">
                                            <?php endif; ?>

                                            <div class="card-body">
                                                <h3 class="card-title"><?= get_the_title() ?></h3>
                                                <h4 class="card-subtitle"><?= get_field('projects_subtitle') ?></h4>
                                                <p class="card-tags"><?= get_field('projects_label') ?></p>
                                            </div>
                                        </a>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="section-footer animation-translate animation-item-3">
                        <a class="section-next goto-section" href="#section-07">
                            <span class="section-next-counter">5/6</span>
                            <span class="section-next-label">Następny rozdział</span>
                            <span class="section-next-icon"></span>
                        </a>
                    </div>
                </section>
                <?php /*
                <section id="section-06" class="section animation">
                    <div class="section-body">
                        <h2 class="section-title animation-translate-overline animation-item-1"><?= get_field('testimonials_header', 10) ?></h2>
                        <div id="carousel" class="carousel slide animation-translate animation-item-2" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $args = array(
                                    'post_type' => 'testimonials',
                                    'post_status' => 'publish',
                                    'posts_per_page' => 9,
                                    'orderby' => 'rand',
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
                                        <div class="carousel-item <?= ($i == 1 ? "active" : "") ?>">
                                            <div class="testimonial">
                                                <?php if (has_post_thumbnail(get_the_ID())): ?>
                                                    <?php $image_ID = get_post_thumbnail_id(get_the_ID()); ?>
                                                    <?php $image = wp_get_attachment_image_src($image_ID, 'single-post-thumbnail'); ?>
                                                    <?php $image_alt = get_post_meta($image_ID, '_wp_attachment_image_alt', TRUE); ?>
                                                    <img class="testimonial-img" src="<?php echo $image[0]; ?>" alt="<?= get_the_title() ?>">
                                                <?php endif; ?>
                                                <div class="testimonial-body">
                                                    <h3 class="testimonial-title"><?= get_the_title() ?></h3>
                                                    <h4 class="testimonial-subtitle"><a href="<?= get_field('testimonials_url') ?>"><?= get_field('testimonials_url') ?></a></h4>
                                                    <p class="testimonial-text">
                                                        <?= get_the_content() ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <ol class="carousel-indicators">

                                <?php
                                $i = 0;
                                if ($the_query->have_posts()) {
                                    while ($the_query->have_posts()) {
                                        $the_query->the_post();
                                        $i++;
                                        ?>
                                        <li data-target="#carousel" data-slide-to="<?= $i ?>"<?= ($i == 1 ? ' class="active"' : "") ?>></li>

                                    <?php } ?>
                                <?php } ?>
                            </ol>

                            <?php wp_reset_postdata(); ?>

                            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Poprzedni</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Następny</span>
                            </a>
                        </div>
                    </div>
                    <div class="section-footer animation-translate animation-item-3">
                        <a class="section-next goto-section" href="#section-07">
                            <span class="section-next-counter">6/6</span>
                            <span class="section-next-label">Następny rozdział</span>
                            <span class="section-next-icon"></span>
                        </a>
                    </div>
                </section> */?>
                <section id="section-07" class="section animation">
                    <div class="section-body">
                        <h2 class="section-title animation-translate-overline animation-item-1"><?= get_field('contact_header', 10) ?></h2>
                        <div class="row mb-10 animation-translate animation-item-2">
                            <div class="col-12 col-md-4">
                                <div class="contact">
                                    <strong class="contact-label"><?= get_field('contact_section_1_header', 10) ?></strong>
                                    <a href="mailto:<?= get_field('contact_email', 10) ?>"><?= get_field('contact_email', 10) ?></a><br>
                                    <a href="tel:<?= get_field('contact_phone', 10) ?>"><?= get_field('contact_phone', 10) ?></a>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="contact">
                                    <strong class="contact-label"><?= get_field('contact_section_2_header', 10) ?></strong>
                                    <?php if (get_field('contact_facebook', 10)) { ?>
                                        <a href="<?= get_field('contact_facebook', 10) ?>">Facebook</a><br>
                                    <?php } ?>
                                    <?php if (get_field('contact_linkedin', 10)) { ?>
                                        <a href="<?= get_field('contact_linkedin', 10) ?>">LinekdIn</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="contact">
                                    <strong class="contact-label"><?= get_field('contact_section_3_header', 10) ?></strong>
                                    <?= get_field('contact_address', 10) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-9">
                                <?php if (get_field('contact_form', 10)) { ?>
                                    <?= do_shortcode(get_field('contact_form', 10)) ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="section-footer animation-translate animation-item-5">
                        <span class="section-next goto-section">
                            <span class="section-next-counter">6/6</span>
                        </span>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
