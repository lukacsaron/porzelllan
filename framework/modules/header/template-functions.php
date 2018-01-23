<?php

use Chandelier\Modules\Header\Lib\HeaderFactory;

if(!function_exists('chandelier_elated_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines chandelier_elated_header_type_parameters filter
     */
    function chandelier_elated_get_header() {

        $header_type     = 'header-standard';
        $header_behavior = chandelier_elated_options()->getOptionValue('header_behaviour');

        extract(chandelier_elated_get_page_options());

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => chandelier_elated_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'show_sticky'        => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
                'menu_area_background_color' => $menu_area_background_color,
                'vertical_header_background_color' => $vertical_header_background_color,
                'vertical_header_opacity' => $vertical_header_opacity,
                'vertical_background_image' => $vertical_background_image
            );

            $parameters = apply_filters('chandelier_elated_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('chandelier_elated_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function chandelier_elated_get_header_top() {

        //generate column width class
        switch(chandelier_elated_options()->getOptionValue('top_bar_layout')) {
            case ('two-columns'):
                $column_widht_class = '50-50';
                break;
            case ('three-columns'):
                $column_widht_class = chandelier_elated_options()->getOptionValue('top_bar_column_widths');
                break;
        }

        $params = array(
            'column_widths'      => $column_widht_class,
            'show_widget_center' => chandelier_elated_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
            'show_header_top'    => chandelier_elated_options()->getOptionValue('top_bar') == 'yes' ? true : false,
            'top_bar_in_grid'    => chandelier_elated_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
        );

        $params = apply_filters('chandelier_elated_header_top_params', $params);

        chandelier_elated_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('chandelier_elated_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function chandelier_elated_get_logo($slug = '') {

        $header_type = 'header-standard';

        $slug = $slug !== '' ? $slug : $header_type;

        if($slug == 'sticky'){
            $logo_image = chandelier_elated_options()->getOptionValue('logo_image_sticky');
        }else{
            $logo_image = chandelier_elated_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = chandelier_elated_options()->getOptionValue('logo_image_dark');
        $logo_image_light = chandelier_elated_options()->getOptionValue('logo_image_light');


        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = chandelier_elated_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image'  => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
            'logo_styles' => $logo_styles
        );

        chandelier_elated_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('chandelier_elated_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function chandelier_elated_get_main_menu($additional_class = 'eltd-default-nav') {
        chandelier_elated_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('chandelier_elated_get_sticky_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function chandelier_elated_get_sticky_main_menu($additional_class = 'eltd-default-nav') {
        chandelier_elated_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('chandelier_elated_get_vertical_main_menu')) {
    /**
     * Loads vertical menu HTML
     */
    function chandelier_elated_get_vertical_main_menu() {
        chandelier_elated_get_module_template_part('templates/parts/vertical-navigation', 'header', '');
    }
}



if(!function_exists('chandelier_elated_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     */
    function chandelier_elated_get_sticky_header() {

        $parameters = array(
            'hide_logo'             => chandelier_elated_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'sticky_header_in_grid' => chandelier_elated_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
        );

        chandelier_elated_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
    }
}

if(!function_exists('chandelier_elated_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function chandelier_elated_get_mobile_header() {
        if(chandelier_elated_is_responsive_on()) {
            $header_type = 'header-standard';

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => chandelier_elated_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'menu_opener_icon'       => chandelier_elated_icon_collections()->getMobileMenuIcon(chandelier_elated_options()->getOptionValue('mobile_icon_pack'), true),
                'show_navigation_opener' => has_nav_menu('main-navigation')
            );

            chandelier_elated_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('chandelier_elated_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function chandelier_elated_get_mobile_logo($slug = '') {

        $header_type = 'header-standard';
        $slug = $slug !== '' ? $slug : $header_type;

        //check if mobile logo has been set and use that, else use normal logo
        if(chandelier_elated_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = chandelier_elated_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = chandelier_elated_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = chandelier_elated_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        chandelier_elated_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('chandelier_elated_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function chandelier_elated_get_mobile_nav() {

        $slug = 'header-standard';

        chandelier_elated_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}

if(!function_exists('chandelier_elated_get_page_options')) {
    /**
     * Gets options from page
     */
    function chandelier_elated_get_page_options() {

        $id = chandelier_elated_get_page_id();
        $page_options = array();
        $menu_area_background_color_rgba = '';
        $menu_area_background_color = '';
        $menu_area_background_transparency = '';
        $vertical_header_background_color = '';
        $vertical_header_opacity = '';
        $vertical_background_image = '';

        if(get_post_meta($id, 'eltd_menu_area_background_color_header_standard_meta', true) != '') {
            $menu_area_background_color = get_post_meta($id, 'eltd_menu_area_background_color_header_standard_meta', true);
        }

        if(get_post_meta($id, 'eltd_menu_area_background_transparency_header_standard_meta', true) != '') {
            $menu_area_background_transparency = get_post_meta($id, 'eltd_menu_area_background_transparency_header_standard_meta', true);
        }

        if(chandelier_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
            $menu_area_background_color_rgba = 'background-color:'.chandelier_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        $page_options['menu_area_background_color'] = $menu_area_background_color_rgba;
        $page_options['vertical_header_background_color'] = $vertical_header_background_color;
        $page_options['vertical_header_opacity'] = $vertical_header_opacity;
        $page_options['vertical_background_image'] = $vertical_background_image;

        return $page_options;
    }
}