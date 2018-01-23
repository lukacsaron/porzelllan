<?php

if(!function_exists('chandelier_elated_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function chandelier_elated_boxed_class($classes) {

        //is boxed layout turned on?
        if(chandelier_elated_options()->getOptionValue('boxed') == 'yes') {
            $classes[] = 'eltd-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'chandelier_elated_boxed_class');
}

if(!function_exists('chandelier_elated_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function chandelier_elated_theme_version_class($classes) {
        $current_theme = wp_get_theme();

        //is child theme activated?
        if($current_theme->parent()) {
            //add child theme version
            $classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

            //get parent theme
            $current_theme = $current_theme->parent();
        }

        if($current_theme->exists() && $current_theme->get('Version') != '') {
            $classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
        }

        return $classes;
    }

    add_filter('body_class', 'chandelier_elated_theme_version_class');
}

if(!function_exists('chandelier_elated_smooth_scroll_class')) {
    /**
     * Function that adds classes on body for smooth scroll
     */
    function chandelier_elated_smooth_scroll_class($classes) {

		$mac_os = strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh; Intel Mac OS X');

        //is smooth scroll enabled enabled and not Mac device?
        if(chandelier_elated_options()->getOptionValue('smooth_scroll') == 'yes' && $mac_os == false) {
            $classes[] = 'eltd-smooth-scroll';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'chandelier_elated_smooth_scroll_class');
}

if(!function_exists('chandelier_elated_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function chandelier_elated_smooth_page_transitions_class($classes) {

        if(chandelier_elated_options()->getOptionValue('smooth_page_transitions') == 'yes') {
            $classes[] = 'eltd-smooth-page-transitions';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'chandelier_elated_smooth_page_transitions_class');
}

if(!function_exists('chandelier_elated_elements_animation_on_touch_class')) {
    /**
     * Function that adds classes on body when touch is disabled on touch devices
     *
     * @param $classes array classes array
     *
     * @return array array with added classes
     */
    function chandelier_elated_elements_animation_on_touch_class($classes) {

        //check if current client is on mobile
        $isMobile = (bool) preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                                      '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                                      '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT']);

        //are animations turned off on touch and client is on mobile?
        if(chandelier_elated_options()->getOptionValue('elements_animation_on_touch') == "no" && $isMobile == true) {
            $classes[] = 'eltd-no-animation-on-touch';
        }

        return $classes;
    }

    add_filter('body_class', 'chandelier_elated_elements_animation_on_touch_class');
}

if(!function_exists('chandelier_elated_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function chandelier_elated_content_initial_width_body_class($classes) {

        if(chandelier_elated_options()->getOptionValue('initial_content_width')) {
            $classes[] = 'eltd-'.chandelier_elated_options()->getOptionValue('initial_content_width');
        }

        return $classes;
    }

    add_filter('body_class', 'chandelier_elated_content_initial_width_body_class');
}

if(!function_exists('chandelier_elated_set_blog_body_class')) {
    /**
     * Function that adds blog class to body if blog template, shortcodes or widgets are used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function chandelier_elated_set_blog_body_class($classes) {

        if(chandelier_elated_load_blog_assets()) {
            $classes[] = 'eltd-blog-installed';
        }

        return $classes;
    }

    add_filter('body_class', 'chandelier_elated_set_blog_body_class');
}


if(!function_exists('chandelier_elated_set_portfolio_single_info_follow_body_class')) {
    /**
     * Function that adds follow portfolio info class to body if sticky sidebar is enabled on portfolio single small images or small slider
     *
     * @param $classes array of body classes
     *
     * @return array with follow portfolio info class body class added
     */

    function chandelier_elated_set_portfolio_single_info_follow_body_class($classes) {

        if(is_singular('portfolio-item')){
            if(chandelier_elated_options()->getOptionValue('portfolio_single_sticky_sidebar') == 'yes'){
                $classes[] = 'eltd-follow-portfolio-info';
            }
        }


        return $classes;
    }

    add_filter('body_class', 'chandelier_elated_set_portfolio_single_info_follow_body_class');
}

if(!function_exists('chandelier_elated_set_header_transparency_body_class')){
	
	function chandelier_elated_set_header_transparency_body_class($classes){
		
		$id = chandelier_elated_get_page_id();
		$menu_area_transparent = '';
		$show_title_area = '';
		
		
		if(get_post_meta($id, 'eltd_menu_area_background_color_header_standard_meta', true) !== '' && get_post_meta($id, 'eltd_menu_area_background_transparency_header_standard_meta', true) !== '1'){
            $menu_area_transparent =  'transparent';				
        }elseif(chandelier_elated_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
			chandelier_elated_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') !== '1') {
			$menu_area_transparent =  'transparent';			
        } 
		
		if(get_post_meta($id, 'eltd_show_title_area_meta', true) == 'no'){
			$show_title_area =  'no';	
		}elseif(chandelier_elated_options()->getOptionValue('show_title_area') == 'no') {
            $show_title_area =  'no';	
        }
		
		if($menu_area_transparent == 'transparent' && $show_title_area == 'no'){
			$classes[] = 'eltd-transparent-header';
		}
		if(get_post_meta($id, 'eltd_menu_area_background_color_header_standard_meta', true) !== '' && get_post_meta($id, 'eltd_menu_area_background_transparency_header_standard_meta', true) == '1'){
            $classes[]  =  'eltd-transparency-off-per-page';				
        }
		
        return $classes;
	}
	
	add_filter('body_class', 'chandelier_elated_set_header_transparency_body_class');
}

if(!function_exists('chandelier_elated_set_shop_page_id')){
	
	function chandelier_elated_set_shop_page_id($classes){
		
		if(chandelier_elated_is_woocommerce_installed() && is_shop()){
			
			$id = chandelier_elated_get_page_id();
			$classes[] = 'page-id-'.$id;
			
		}
		
        return $classes;
	}
	
	add_filter('body_class', 'chandelier_elated_set_shop_page_id');
}