<div class="wrap" id="K3eGrowlist">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Tablice', 'k3e'); ?>
    </h1>

    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <div class="section">
                        <?php
                        $default_tab = null;
                        $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
                        ?>  
                            <nav class="nav-tab-wrapper">  
                                <a href="edit.php?post_type=species&page=growlist_tables" class="nav-tab <?php if ($tab === null): ?>nav-tab-active<?php endif; ?>"><?= __('Statystyki', 'k3e') ?></a>  
                                <a href="edit.php?post_type=species&page=growlist_tables&tab=transit" class="nav-tab <?php if ($tab === 'transit'): ?>nav-tab-active<?php endif; ?>"><?= __('Transport', 'k3e') ?></a>  
                                <a href="edit.php?post_type=species&page=growlist_tables&tab=sow" class="nav-tab <?php if ($tab === 'sow'): ?>nav-tab-active<?php endif; ?>"><?= __('Wysiane', 'k3e') ?></a>  
                                <a href="edit.php?post_type=species&page=growlist_tables&tab=grow" class="nav-tab <?php if ($tab === 'grow'): ?>nav-tab-active<?php endif; ?>"><?= __('Rośnie', 'k3e') ?></a>  
                                <a href="edit.php?post_type=species&page=growlist_tables&tab=wait" class="nav-tab <?php if ($tab === 'wait'): ?>nav-tab-active<?php endif; ?>"><?= __('Oczekuje', 'k3e') ?></a>  
                                <a href="edit.php?post_type=species&page=growlist_tables&tab=sleep" class="nav-tab <?php if ($tab === 'sleep'): ?>nav-tab-active<?php endif; ?>"><?= __('Zimuje', 'k3e') ?></a>  
                                <a href="edit.php?post_type=species&page=growlist_tables&tab=lost" class="nav-tab <?php if ($tab === 'lost'): ?>nav-tab-active<?php endif; ?>"><?= __('Stracone', 'k3e') ?></a>  
                                <a href="edit.php?post_type=species&page=growlist_tables&tab=uncomplete" class="nav-tab <?php if ($tab === 'uncomplete'): ?>nav-tab-active<?php endif; ?>"><?= __('Niekompletne', 'k3e') ?></a>  
                                <a href="edit.php?post_type=species&page=growlist_tables&tab=labels" class="nav-tab <?php if ($tab === 'labels'): ?>nav-tab-active<?php endif; ?>"><?= __('Brakujące etykiety', 'k3e') ?></a>  
                            </nav>  

                            <div class="tab-content">  
                                <?php
                                switch ($tab) :
                                    case 'transit':
                                        include plugin_dir_path(__FILE__) . 'tables/transit.php';
                                        break;
                                    case 'sow':
                                        include plugin_dir_path(__FILE__) . 'tables/sow.php';
                                        break;
                                    case 'grow':
                                        include plugin_dir_path(__FILE__) . 'tables/grow.php';
                                        break;
                                    case 'wait':
                                        include plugin_dir_path(__FILE__) . 'tables/wait.php';
                                        break;
                                    case 'sleep':
                                        include plugin_dir_path(__FILE__) . 'tables/sleep.php';
                                        break;
                                    case 'lost':
                                        include plugin_dir_path(__FILE__) . 'tables/lost.php';
                                        break;
                                    case 'uncomplete':
                                        include plugin_dir_path(__FILE__) . 'tables/uncomplete.php';
                                        break;
                                    case 'labels':
                                        include plugin_dir_path(__FILE__) . 'tables/labels.php';
                                        break;
                                    default:
                                        include plugin_dir_path(__FILE__) . 'tables/stats.php';
                                        break;
                                endswitch;
                                ?>  
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






