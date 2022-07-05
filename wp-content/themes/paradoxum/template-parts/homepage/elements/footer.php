<!-- Footer Start -->
<footer class="footer-01">
    <div class="container">
        <div class="row"><div class="col-lg-12"><div class="footer-border"></div></div></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <!-- Navigation Menu Start -->
                <aside class="widget">
                    <h3 class="widget-title"><?= __('Podręczne', 'k3e') ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'handy',
                        'menu_class' => 'navbar-nav',
                            )
                    );
                    ?>
                </aside>
                <!-- Navigation Menu End -->
            </div>
            <div class="col-lg-3 col-md-6">
                <!-- Navigation Menu Start -->
                <aside class="widget">
                    <h3 class="widget-title"><?= __('Ostatnie wpisy', 'k3e') ?></h3>
                    <ul>
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 8, // Number of recent posts thumbnails to display
                            'post_status' => 'publish' // Show only the published posts
                        ));
                        foreach ($recent_posts as $post_item) :
                            ?>
                            <li>
                                <a href="<?php echo get_permalink($post_item['ID']) ?>">
                                    <?php echo get_the_title($post_item['ID']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </aside>
                <!-- Navigation Menu End -->
            </div>
            <div class="col-lg-6 col-md-12">
                <!-- Navigation Menu Start -->
                <aside class="widget">
                    <h3 class="widget-title"><?= __('Najnowsze nabytki', 'k3e') ?></h3>
                    <ul>
                        <?php
                        $recent_specied = wp_get_recent_posts(array(
                            'post_type' => 'species', // Post type
                            'numberposts' => 8, // Number of recent posts thumbnails to display
                            'post_status' => 'publish' // Show only the published posts
                        ));
                        foreach ($recent_specied as $species_item) :
                            ?>
                            <li>
                                <a href="<?php echo get_permalink($species_item['ID']) ?>">
                                    <?php echo get_the_title($species_item['ID']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
                <!-- Navigation Menu End -->
            </div>
        </div>
        <!-- Copyright -->
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright clearfix">
                    <p><?= __('Wspierane przez: ', 'k3e') ?><a href="//k3e.pl">K3E.pl</a></p>
                </div>
            </div>
        </div>
        <!-- Copryright -->
    </div>
</footer>
<!-- Footer End -->
