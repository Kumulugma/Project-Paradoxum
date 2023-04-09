<div class="postbox-container" style="width:100%;">
    <div class="card" style="max-width: none; margin:2px">
        <?php $wishlist = unserialize(get_option('wishlist')); ?>

        <div class="k3e_box">
            <style scoped>
                .k3e_box{
                    display: grid;
                    grid-template-columns: max-content 1fr;
                    grid-row-gap: 10px;
                    grid-column-gap: 20px;
                }
                .k3e_field{
                    display: contents;
                }
            </style>
            <form method="post" action="edit.php?post_type=species&page=growlist_utilities&save=form">
                <div class="meta-options k3e_field" style="display: block;">
                    <?php
                    $args = [
                        'media_buttons' => false, // This setting removes the media button.
                        'textarea_name' => 'Growlist[wishlist]', // Set custom name.
                        'quicktags' => false, // Remove view as HTML button.
                    ];
                    wp_editor($wishlist, 'k3e_wishlist', $args);
                    ?>
                </div>
                <div  style="display: block; margin-top: 5px;">
                    <?php
                    wp_nonce_field("k3e-growlist-utilities-wishlist", 'nonce');
                    ?>
                    <button class="button button-primary" type="submit">Zapisz</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="clear: both"></div>
