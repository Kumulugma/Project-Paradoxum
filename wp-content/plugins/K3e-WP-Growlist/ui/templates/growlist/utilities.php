<div class="wrap" id="K3eGrowlist">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Użytkowe', 'k3e'); ?>
    </h1>

    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <?php
                    $default_tab = null;
                    $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
                    ?>  
                    <div class="tabs">
                        <nav class="nav-tab-wrapper">  
                            <a href="edit.php?post_type=species&page=growlist_utilities" class="nav-tab <?php if ($tab === null): ?>nav-tab-active<?php endif; ?>"><?= __('Konfiguracja', 'k3e') ?></a>  
                            <a href="edit.php?post_type=species&page=growlist_utilities&tab=export" class="nav-tab <?php if ($tab === 'export'): ?>nav-tab-active<?php endif; ?>"><?= __('Eksport', 'k3e') ?></a>  
                            <a href="edit.php?post_type=species&page=growlist_utilities&tab=pdf" class="nav-tab <?php if ($tab === 'pdf'): ?>nav-tab-active<?php endif; ?>"><?= __('PDF', 'k3e') ?></a>  
                            <a href="edit.php?post_type=species&page=growlist_utilities&tab=photos" class="nav-tab <?php if ($tab === 'photos'): ?>nav-tab-active<?php endif; ?>"><?= __('Albumy', 'k3e') ?></a>  
                            <a href="edit.php?post_type=species&page=growlist_utilities&tab=bbcode" class="nav-tab <?php if ($tab === 'bbcode'): ?>nav-tab-active<?php endif; ?>"><?= __('BBcode', 'k3e') ?></a>  
                            <a href="edit.php?post_type=species&page=growlist_utilities&tab=growlist" class="nav-tab <?php if ($tab === 'growlist'): ?>nav-tab-active<?php endif; ?>"><?= __('Lista roślin', 'k3e') ?></a>  
                            <a href="edit.php?post_type=species&page=growlist_utilities&tab=wishlist" class="nav-tab <?php if ($tab === 'wishlist'): ?>nav-tab-active<?php endif; ?>"><?= __('Poszukiwane', 'k3e') ?></a>  
                        </nav>  
                    </div>
                    <div class="tab-content">  
                        <?php
                        switch ($tab) :
                            case 'export':
                                include plugin_dir_path(__FILE__) . 'utilities/export.php';
                                break;
                            case 'pdf':
                                include plugin_dir_path(__FILE__) . 'utilities/pdf.php';
                                break;
                            case 'photos':
                                include plugin_dir_path(__FILE__) . 'utilities/photos.php';
                                break;
                            case 'bbcode':
                                include plugin_dir_path(__FILE__) . 'utilities/bbcode.php';
                                break;
                            case 'growlist':
                                include plugin_dir_path(__FILE__) . 'utilities/growlist.php';
                                break;
                            case 'wishlist':
                                include plugin_dir_path(__FILE__) . 'utilities/wishlist.php';
                                break;
                            default:
                                include plugin_dir_path(__FILE__) . 'utilities/config.php';
                                break;
                        endswitch;
                        ?>  
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>






