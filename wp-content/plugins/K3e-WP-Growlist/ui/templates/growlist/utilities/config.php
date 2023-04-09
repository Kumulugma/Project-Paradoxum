<div class="postbox-container" style="width:100%;">
    <div class="card" style="max-width: none; margin:2px">
        <?php $prefix = get_option('code_prefix'); ?>

        <div class="k3e_box">
            <form method="post" action="edit.php?post_type=species&page=growlist_utilities&save=form">
                <div class="section">
                    <div class="box">
                        <div class="input">
                            <label for="k3e_growlist_config_code_prefix"><?= __('Prefix kodów roślinnych', 'k3e') ?></label>
                            <input id="k3e_growlist_config_code_prefix" type="text" name="GrowlistConfig[code_prefix]" value='<?= $prefix ?>'>
                        </div>
                        <div class="save">
                            <?php
                            wp_nonce_field("k3e-growlist-utilities-config", 'nonce');
                            ?>
                            <button class="button button-primary" type="submit">Zapisz</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="clear: both"></div>
