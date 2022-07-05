<?php

//Breadcrumbs
function get_breadcrumb() {
    echo '<a href="' . home_url() . '" rel="nofollow">Strona główna</a>';
    if ((is_category() || is_single()) && !is_singular('species')) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
        if (is_single()) {
            echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
            the_title();
        }
    } elseif ((is_category() || is_single()) && is_singular('species')) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";

        global $post;
        $category = get_the_terms($post->ID, 'groups');
        $name = reset($category)->name;
        $slug = reset($category)->slug;
        echo '<a href="/?groups=' . $slug . '">' . $name;
        echo "</a>";
        if (is_single()) {
            echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
            the_title();
        }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search() || $_GET['s']) {
        if (is_home()) {
            echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
            echo __('Aktualności', 'k3e');
        }
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Wynik wyszukiwania dla... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    } elseif (is_home()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo __('Aktualności', 'k3e');
    }
}
