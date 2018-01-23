<?php

if(!function_exists('chandelier_elated_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function chandelier_elated_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(chandelier_elated_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(chandelier_elated_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = chandelier_elated_options()->getOptionValue('mobile_header_background_color');
        }

        echo chandelier_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-header-inner', $mobile_header_styles);
    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_mobile_header_general_styles');
}

if(!function_exists('chandelier_elated_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function chandelier_elated_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(chandelier_elated_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = chandelier_elated_options()->getOptionValue('mobile_menu_background_color');
        }

        echo chandelier_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if(chandelier_elated_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = chandelier_elated_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(chandelier_elated_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = chandelier_elated_options()->getOptionValue('mobile_text_color');
        }

        if(chandelier_elated_is_font_option_valid(chandelier_elated_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = chandelier_elated_get_formatted_font_family(chandelier_elated_options()->getOptionValue('mobile_font_family'));
        }

        if(chandelier_elated_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('mobile_font_size')).'px';
        }

        if(chandelier_elated_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('mobile_line_height')).'px';
        }

        if(chandelier_elated_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = chandelier_elated_options()->getOptionValue('mobile_text_transform');
        }

        if(chandelier_elated_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = chandelier_elated_options()->getOptionValue('mobile_font_style');
        }

        if(chandelier_elated_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = chandelier_elated_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.eltd-mobile-header .eltd-mobile-nav a',
            '.eltd-mobile-header .eltd-mobile-nav h4'
        );

        echo chandelier_elated_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if(chandelier_elated_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = chandelier_elated_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.eltd-mobile-header .eltd-mobile-nav a:hover',
            '.eltd-mobile-header .eltd-mobile-nav h4:hover'
        );

        echo chandelier_elated_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_mobile_navigation_styles');
}

if(!function_exists('chandelier_elated_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function chandelier_elated_mobile_logo_styles() {
        if(chandelier_elated_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo chandelier_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-logo-wrapper a',
                array('height' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(chandelier_elated_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo chandelier_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-logo-wrapper a',
                array('height' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }

        if(chandelier_elated_options()->getOptionValue('mobile_header_height') !== '') {
            $max_height = intval(chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('mobile_header_height')) * 0.9).'px';
            echo chandelier_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-logo-wrapper a', array('max-height' => $max_height));
        }
    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_mobile_logo_styles');
}

if(!function_exists('chandelier_elated_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function chandelier_elated_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(chandelier_elated_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = chandelier_elated_options()->getOptionValue('mobile_icon_color');
        }

        if(chandelier_elated_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('mobile_icon_size')).'px';
        }

        echo chandelier_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-menu-opener a', $mobile_icon_styles);

        if(chandelier_elated_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo chandelier_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-menu-opener a:hover',
                array('color' => chandelier_elated_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_mobile_icon_styles');
}