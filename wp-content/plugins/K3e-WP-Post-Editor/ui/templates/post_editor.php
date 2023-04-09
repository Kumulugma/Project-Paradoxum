<div class="wrap" id="k3e-page">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Edytor wpisów', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <div class="section">
                        <form method="post" action="admin.php?page=post_editor&save=form">
                            <div>
                                <div id="header">
                                    <h2><?= __('Konfiguracja', 'k3e') ?></h2>
                                </div>
                                <div class="box">
                                    <div class="select">
                                        <label for="k3e_post_editor_post"><?= __('Pole wpisu', 'k3e') ?></label>
                                        <?php $post_types = get_post_types('', 'objects'); ?>
                                        <select id="k3e_post_editor_post" name="PostEditor[post]">
                                            <?php
                                            foreach ($post_types as $post_type) {
                                                echo '<option value="' . $post_type->name . '">' . $post_type->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input">
                                        <label for="k3e_post_editor_name"><?= __('Nazwa pola meta', 'k3e') ?></label>
                                        <input id="k3e_post_editor_name" type="text" name="PostEditor[name]" placeholder='<?= __('Nazwa pola ', 'k3e') ?>'>
                                    </div>
                                    <div class="input">
                                        <label for="k3e_post_editor_value"><?= __('Wartość pola meta', 'k3e') ?></label>
                                        <input id="k3e_post_editor_value" type="text" name="PostEditor[value]" placeholder="<?= __('Wartość', 'k3e') ?>">
                                    </div>

                                    <div class="save">
                                        <button class="button button-primary"  type="submit">Wykonaj</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <h2 class="h5"><?= __('Modyfikacje', 'k3e') ?></h2>
                    <div class="posts">

                        <?php $editions = get_option('post_editions') ?>

                        <table id="post_meta" class="table" style="width:100%" data-counter="<?= $species->found_posts ?>">
                            <thead>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Typ wpisu', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Nazwa meta', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Wartość', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Zmieniono', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Data', 'k3e') ?></th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                <?php foreach ($editions as $edition) { ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $edition['post'] ?? '' ?></td>
                                        <td><?= $edition['name'] ?? '' ?></td>
                                        <td><?= $edition['value'] ?? '' ?></td>
                                        <td><?= $edition['done'] ?? '' ?></td>
                                        <td><?= $edition['date'] ?? '' ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

