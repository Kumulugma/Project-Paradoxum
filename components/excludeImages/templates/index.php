<div class="wrap">
    <h1><?= __('Wyklucz obrazki z losowania', 'k3e') ?></h1>
    <?php
    $post_images = (get_option("excludeImages"));

    if ($post_images) {
        $post_images = unserialize($post_images);
        $post_images_input = $post_images;
        $post_images = explode(",", $post_images);
    } else {
        $post_images = [];
        $post_images_input = "";
    }
    ?>
    <div id="exclude-box" data-default='<?= get_template_directory_uri() . '/images/default.png' ?>' style="padding-left: 5px;">
        <?php if (count($post_images) > 0 && $post_images[0] != "") { ?>
            <?php foreach ($post_images as $image) { ?>
                <img src="<?= wp_get_attachment_image_url($image, 'big-icons') ?>" style="width: 80px; margin-right: 5px;" class="preview-images">
            <?php } ?>
        <?php } else { ?>
            <img src="<?= get_template_directory_uri() . '/images/default.png' ?>" style="width: 80px;" class="preview-images"/>
        <?php } ?>
    </div>
    <div style="display: block">
        <input type='button' class="button-primary" value="<?php esc_attr_e('Wybierz obrazki', 'k3e'); ?>" id="post_media_manager" style="margin-left: 5px;"/>
        <input type='button' class="button-secondary" value="<?php esc_attr_e('Usuń obrazki', 'k3e'); ?>" id="post_media_remover"/>
    </div>
    <div style="display: block;  margin-top: 5px; margin-left: 5px;">
        <form method="post" action="options-general.php?page=exclude_images">
            <input type="hidden" name="exclude_images" value="<?php echo esc_attr($post_images_input); ?>" id="exclude-images" class="regular-text" />
            <input type='submit' class="button-primary" value="<?php esc_attr_e('Zapisz', 'k3e'); ?>" id="form-save"/>
        </form>
    </div>
</div>