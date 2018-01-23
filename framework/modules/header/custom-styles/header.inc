<?php

if(!function_exists('chandelier_elated_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function chandelier_elated_header_top_bar_styles() {
        global $chandelier_elated_options;

        if($chandelier_elated_options['top_bar_height'] !== '') {
            echo chandelier_elated_dynamic_css('.eltd-top-bar', array('height' => $chandelier_elated_options['top_bar_height'].'px'));
            echo chandelier_elated_dynamic_css('.eltd-top-bar .eltd-logo-wrapper a', array('max-height' => $chandelier_elated_options['top_bar_height'].'px'));
        }

        if($chandelier_elated_options['top_bar_in_grid'] == 'yes') {
            $top_bar_grid_selector = '.eltd-top-bar .eltd-grid .eltd-vertical-align-containers';
            $top_bar_grid_styles = array();
            if($chandelier_elated_options['top_bar_grid_background_color'] !== '') {
                $grid_background_color    = $chandelier_elated_options['top_bar_grid_background_color'];
                $grid_background_transparency = 1;

                if(chandelier_elated_options()->getOptionValue('top_bar_grid_background_transparency')) {
                    $grid_background_transparency = chandelier_elated_options()->getOptionValue('top_bar_grid_background_transparency');
                }

                $grid_background_color = chandelier_elated_rgba_color($grid_background_color, $grid_background_transparency);
                $top_bar_grid_styles['background-color'] = $grid_background_color;
            }

            echo chandelier_elated_dynamic_css($top_bar_grid_selector, $top_bar_grid_styles);
        }

        $background_color = chandelier_elated_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();
        if($background_color !== '') {
            $background_transparency = 1;
            if(chandelier_elated_options()->getOptionValue('top_bar_background_transparency') !== '') {
               $background_transparency = chandelier_elated_options()->getOptionValue('top_bar_background_transparency');
            }

            $background_color = chandelier_elated_rgba_color($background_color, $background_transparency);
            $top_bar_styles['background-color'] = $background_color;
        }

        echo chandelier_elated_dynamic_css('.eltd-top-bar', $top_bar_styles);
    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_header_top_bar_styles');
}

if(!function_exists('chandelier_elated_header_standard_menu_area_styles')) {
    /**
     * Generates styles for header standard menu
     */
    function chandelier_elated_header_standard_menu_area_styles() {
        global $chandelier_elated_options;

        $menu_area_header_standard_styles = array();

        if($chandelier_elated_options['menu_area_background_color_header_standard'] !== '') {
            $menu_area_background_color        = $chandelier_elated_options['menu_area_background_color_header_standard'];
            $menu_area_background_transparency = 1;

            if($chandelier_elated_options['menu_area_background_transparency_header_standard'] !== '') {
                $menu_area_background_transparency = $chandelier_elated_options['menu_area_background_transparency_header_standard'];
            }

            $menu_area_header_standard_styles['background-color'] = chandelier_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($chandelier_elated_options['menu_area_height_header_standard'] !== '') {
            $max_height = intval(chandelier_elated_filter_px($chandelier_elated_options['menu_area_height_header_standard']) * 0.9).'px';
            echo chandelier_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_standard_styles['height'] = chandelier_elated_filter_px($chandelier_elated_options['menu_area_height_header_standard']).'px';

        }

        echo chandelier_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-menu-area', $menu_area_header_standard_styles);

        $menu_area_grid_header_standard_styles = array();

        if($chandelier_elated_options['menu_area_in_grid_header_standard'] == 'yes' && $chandelier_elated_options['menu_area_grid_background_color_header_standard'] !== '') {
            $menu_area_grid_background_color        = $chandelier_elated_options['menu_area_grid_background_color_header_standard'];
            $menu_area_grid_background_transparency = 1;

            if($chandelier_elated_options['menu_area_grid_background_transparency_header_standard'] !== '') {
                $menu_area_grid_background_transparency = $chandelier_elated_options['menu_area_grid_background_transparency_header_standard'];
            }

            $menu_area_grid_header_standard_styles['background-color'] = chandelier_elated_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);
        }

        echo chandelier_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-menu-area .eltd-grid .eltd-vertical-align-containers', $menu_area_grid_header_standard_styles);
    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_header_standard_menu_area_styles');
}

if(!function_exists('chandelier_elated_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function chandelier_elated_sticky_header_styles() {
        global $chandelier_elated_options;

        if($chandelier_elated_options['sticky_header_in_grid'] == 'yes' && $chandelier_elated_options['sticky_header_grid_background_color'] !== '') {
            $sticky_header_grid_background_color        = $chandelier_elated_options['sticky_header_grid_background_color'];
            $sticky_header_grid_background_transparency = 1;

            if($chandelier_elated_options['sticky_header_grid_transparency'] !== '') {
                $sticky_header_grid_background_transparency = $chandelier_elated_options['sticky_header_grid_transparency'];
            }

            echo chandelier_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-grid .eltd-vertical-align-containers', array('background-color' => chandelier_elated_rgba_color($sticky_header_grid_background_color, $sticky_header_grid_background_transparency)));
        }

        if($chandelier_elated_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $chandelier_elated_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($chandelier_elated_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $chandelier_elated_options['sticky_header_transparency'];
            }

            echo chandelier_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-sticky-holder', array('background-color' => chandelier_elated_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($chandelier_elated_options['sticky_header_height'] !== '') {
            $max_height = intval(chandelier_elated_filter_px($chandelier_elated_options['sticky_header_height']) * 0.9).'px';

            echo chandelier_elated_dynamic_css('.eltd-page-header .eltd-sticky-header', array('height' => $chandelier_elated_options['sticky_header_height'].'px'));
            echo chandelier_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-logo-wrapper a', array('max-height' => $max_height));
        }

    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_sticky_header_styles');
}

if(!function_exists('chandelier_elated_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function chandelier_elated_fixed_header_styles() {
        global $chandelier_elated_options;

        if($chandelier_elated_options['fixed_header_grid_background_color'] !== '') {

            $fixed_header_grid_background_color              = $chandelier_elated_options['fixed_header_grid_background_color'];
            $fixed_header_grid_background_color_transparency = 1;

            if($chandelier_elated_options['fixed_header_grid_transparency'] !== '') {
                $fixed_header_grid_background_color_transparency = $chandelier_elated_options['fixed_header_grid_transparency'];
            }

            echo chandelier_elated_dynamic_css('.eltd-header-type1 .eltd-fixed-wrapper.fixed .eltd-grid .eltd-vertical-align-containers,
                                    .eltd-header-type3 .eltd-fixed-wrapper.fixed .eltd-grid .eltd-vertical-align-containers',
                array('background-color' => chandelier_elated_rgba_color($fixed_header_grid_background_color, $fixed_header_grid_background_color_transparency)));
        }

        if($chandelier_elated_options['fixed_header_background_color'] !== '') {

            $fixed_header_background_color              = $chandelier_elated_options['fixed_header_background_color'];
            $fixed_header_background_color_transparency = 1;

            if($chandelier_elated_options['fixed_header_transparency'] !== '') {
                $fixed_header_background_color_transparency = $chandelier_elated_options['fixed_header_transparency'];
            }

            echo chandelier_elated_dynamic_css('.eltd-header-type1 .eltd-fixed-wrapper.fixed .eltd-menu-area,
                                    .eltd-header-type3 .eltd-fixed-wrapper.fixed .eltd-menu-area',
                array('background-color' => chandelier_elated_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
        }

    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_fixed_header_styles');
}