<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="Kumulugma">
        <title><?php wp_title(':', true, 'right'); ?> <?php bloginfo('title'); ?> - <?php bloginfo('description'); ?></title>
        <meta name="descripton" content="<?php wp_title(); ?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>

        <link rel="apple-touch-icon" sizes="57x57" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri() ?>/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?= get_template_directory_uri() ?>/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri() ?>/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= get_template_directory_uri() ?>/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri() ?>/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?= get_template_directory_uri() ?>/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?= get_template_directory_uri() ?>/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

    </head>
    <body class="with-header position-relative" data-spy="scroll" data-target="#sections-nav" data-offset="80">
