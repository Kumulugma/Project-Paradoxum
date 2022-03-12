<?php /* Template Name: Opinia */ ?>
<?php wp_redirect(get_home_url(), 301); exit; ?>
<?php get_header(); ?>
<?= get_the_content();  ?>   
<?php get_footer();
