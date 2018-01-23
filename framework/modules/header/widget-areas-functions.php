<?php

if(!function_exists('chandelier_elated_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function chandelier_elated_register_top_header_areas() {
        $top_bar_layout  = chandelier_elated_options()->getOptionValue('top_bar_layout');
        $top_bar_enabled = chandelier_elated_options()->getOptionValue('top_bar');

        if($top_bar_enabled == 'yes') {
            register_sidebar(array(
                'name'          => esc_html__('Top Bar Left', 'chandelier'),
                'id'            => 'eltd-top-bar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-top-bar-widget">',
                'after_widget'  => '</div>'
            ));

            //register this widget area only if top bar layout is three columns
            if($top_bar_layout === 'three-columns') {
                register_sidebar(array(
                    'name'          => esc_html__('Top Bar Center', 'chandelier'),
                    'id'            => 'eltd-top-bar-center',
                    'before_widget' => '<div id="%1$s" class="widget %2$s eltd-top-bar-widget">',
                    'after_widget'  => '</div>'
                ));
            }

            register_sidebar(array(
                'name'          => esc_html__('Top Bar Right', 'chandelier'),
                'id'            => 'eltd-top-bar-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-top-bar-widget">',
                'after_widget'  => '</div>'
            ));
        }
    }

    add_action('widgets_init', 'chandelier_elated_register_top_header_areas');
}

if(!function_exists('chandelier_elated_header_standard_widget_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function chandelier_elated_header_standard_widget_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Right From Main Menu', 'chandelier'),
            'id'            => 'eltd-right-from-main-menu',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'chandelier'),
            'before_widget' => '<div id="%1$s" class="widget %2$s eltd-right-from-main-menu-widget">',
            'after_widget'  => '</div>',
        ));
    }
    add_action('widgets_init', 'chandelier_elated_header_standard_widget_areas');
}


if(!function_exists('chandelier_elated_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function chandelier_elated_register_mobile_header_areas() {
        if(chandelier_elated_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Mobile Logo', 'chandelier'),
                'id'            => 'eltd-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-right-from-mobile-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'chandelier')
            ));
        }
    }

    add_action('widgets_init', 'chandelier_elated_register_mobile_header_areas');
}

if(!function_exists('chandelier_elated_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function chandelier_elated_register_sticky_header_areas() {
        if(in_array(chandelier_elated_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Right', 'chandelier'),
                'id'            => 'eltd-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'chandelier')
            ));
        }
    }

    add_action('widgets_init', 'chandelier_elated_register_sticky_header_areas');
}