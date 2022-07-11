
<!-- Skills Section Start -->
<section class="skills-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Call To Action start -->
                <div class="skill-content">
                    <div class="sub-title"><span class="border-left"></span><?= __('Rośliny', 'k3e') ?></div>
                    <h3 class="sec-title">
                        <?= __('Ten niewielki kawałek historii', 'k3e') ?>
                    </h3>
                    <p class="sec-desc">
                        <?= __('Dziesięc lat to nie tak dużo, ale każdy kolejny rok to nowe doświadczenie. Pora wiec na trochę liczb, tak w formie ciekawostki...', 'k3e') ?>
                    </p>
                    <div class="skill-wrapper">
                        <?php
                        $count_posts = wp_count_posts('post');
                        $count_species = wp_count_posts('species');
                        $count_photos = gallery_count();
                        $count_categories = get_terms('groups', array('hide_empty' => false));
//                        $count_looking = ;
                        $c_posts = $count_posts->publish;
                        $c_categories = count($count_categories);
                        $c_species = $count_species->publish;
                        ?>
                        <div class="skill-item">
                            <div class="skill-number" style="background-image: url(<?= get_template_directory_uri() ?>/assets/images/home/skill-shape.png);">
                                <h2><span  data-counter="<?=$c_species ?>" class="timer"><?= $c_species ?></span><span class="suffix"></span></h2>
                            </div>
                            <p><?= __('Gatunków roślin', 'k3e') ?></p>
                        </div>
                        <div class="skill-item">
                            <div class="skill-number" style="background-image: url(<?= get_template_directory_uri() ?>/assets/images/home/skill-shape.png);">
                                <h2><span  data-counter="<?=$c_categories?>" class="timer"><?=$c_categories?></span><span class="suffix"></span></h2>
                            </div>
                            <p><?= __('Kategorii na liście', 'k3e') ?></p>
                        </div>
                        <div class="skill-item">
                            <div class="skill-number" style="background-image: url(<?= get_template_directory_uri() ?>/assets/images/home/skill-shape.png);">
                                <h2><span  data-counter="<?=$count_photos?>" class="timer"><?=$count_photos?></span><span class="suffix"></span></h2>
                            </div>
                            <p><?= __('Zdjęć', 'k3e') ?></p>
                        </div>
                        <div class="skill-item">
                            <div class="skill-number" style="background-image: url(<?= get_template_directory_uri() ?>/assets/images/home/skill-shape.png);">
                                <h2><span  data-counter="<?= $c_posts ?>" class="timer"><?= $c_posts ?></span><span class="suffix"></span></h2>
                            </div>
                            <p><?= __('Wpisów', 'k3e') ?></p>
                        </div>
                    </div>
                </div>
                <!-- Call To Action End -->
            </div>
        </div>
    </div>
</section>
<!-- Skills Section End -->
<?php wp_reset_postdata(); ?>
        