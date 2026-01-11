<!-- Header Start -->
<header class="header-01">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <!-- logo Start-->
                    <a class="navbar-brand" href="/">
                        Paradoxum
                    </a>
                    <!-- logo End-->

                    <!-- Moblie Btn Start -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Moblie Btn End -->

                    <!-- Nav Menu Start -->
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'menu_class' => 'navbar-nav', 
                            )
                                );
                        ?>
                    </div>
                    <!-- Nav Menu End -->

                    <!-- Search Btn -->
                    <div class="search-area">
                        <a href="#" class="search-btn"><i class="far fa-search"></i></a>
                        <form role="search" method="get" class="searchForms" action="#">
                            <input type="search" placeholder="<?=__('Wpisz i naciśnij enter...', 'k3e')?>" name="s">
                            <button type="submit" class="search-submit"><i class="twi-search2"></i></button>
                        </form>
                    </div>
                    <!-- Contact Btn End -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->