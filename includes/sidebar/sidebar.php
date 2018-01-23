<?php

if(!function_exists('chandelier_elated_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function chandelier_elated_register_sidebars() {

        register_sidebar(array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'description' => 'Default Sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6 class="eltd-widget-title">',
            'after_title' => '</h6>'
        ));

    }

    add_action('widgets_init', 'chandelier_elated_register_sidebars');
}

if(!function_exists('chandelier_elated_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates ChandelierSidebar object
     */
    function chandelier_elated_add_support_custom_sidebar() {
        add_theme_support('ChandelierSidebar');
        if (get_theme_support('ChandelierSidebar')) new ChandelierSidebar();
    }

    add_action('after_setup_theme', 'chandelier_elated_add_support_custom_sidebar');
}
