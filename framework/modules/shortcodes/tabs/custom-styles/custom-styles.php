<?php
if(!function_exists('chandelier_elated_tabs_typography_styles')){
	function chandelier_elated_tabs_typography_styles(){
		$selector = '.eltd-tabs .eltd-tabs-nav li a';
		$tabs_tipography_array = array();
		$font_family = chandelier_elated_options()->getOptionValue('tabs_font_family');
		
		if(chandelier_elated_is_font_option_valid($font_family)){
			$tabs_tipography_array['font-family'] = chandelier_elated_is_font_option_valid($font_family);
		}
		
		$text_transform = chandelier_elated_options()->getOptionValue('tabs_text_transform');
        if(!empty($text_transform)) {
            $tabs_tipography_array['text-transform'] = $text_transform;
        }

        $font_style = chandelier_elated_options()->getOptionValue('tabs_font_style');
        if(!empty($font_style)) {
            $tabs_tipography_array['font-style'] = $font_style;
        }

        $letter_spacing = chandelier_elated_options()->getOptionValue('tabs_letter_spacing');
        if($letter_spacing !== '') {
            $tabs_tipography_array['letter-spacing'] = chandelier_elated_filter_px($letter_spacing).'px';
        }

        $font_weight = chandelier_elated_options()->getOptionValue('tabs_font_weight');
        if(!empty($font_weight)) {
            $tabs_tipography_array['font-weight'] = $font_weight;
        }

        echo chandelier_elated_dynamic_css($selector, $tabs_tipography_array);
	}
	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_tabs_typography_styles');
}

if(!function_exists('chandelier_elated_tabs_inital_color_styles')){
	function chandelier_elated_tabs_inital_color_styles(){
		$selector = '.eltd-tabs .eltd-tabs-nav li a';
		$styles = array();
		
		if(chandelier_elated_options()->getOptionValue('tabs_color')) {
            $styles['color'] = chandelier_elated_options()->getOptionValue('tabs_color');
        }
		if(chandelier_elated_options()->getOptionValue('tabs_back_color')) {
            $styles['background-color'] = chandelier_elated_options()->getOptionValue('tabs_back_color');
        }
		if(chandelier_elated_options()->getOptionValue('tabs_border_color')) {
            $styles['border-color'] = chandelier_elated_options()->getOptionValue('tabs_border_color');
        }
		
		echo chandelier_elated_dynamic_css($selector, $styles);
	}
	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_tabs_inital_color_styles');
}
if(!function_exists('chandelier_elated_tabs_active_color_styles')){
	function chandelier_elated_tabs_active_color_styles(){
		$selector = '.eltd-tabs .eltd-tabs-nav li.ui-state-active a, .eltd-tabs .eltd-tabs-nav li.ui-state-hover a';
		$styles = array();
		
		if(chandelier_elated_options()->getOptionValue('tabs_color_active')) {
            $styles['color'] = chandelier_elated_options()->getOptionValue('tabs_color_active');
        }
		if(chandelier_elated_options()->getOptionValue('tabs_back_color_active')) {
            $styles['background-color'] = chandelier_elated_options()->getOptionValue('tabs_back_color_active');
        }
		if(chandelier_elated_options()->getOptionValue('tabs_border_color_active')) {
            $styles['border-color'] = chandelier_elated_options()->getOptionValue('tabs_border_color_active');
        }
		
		echo chandelier_elated_dynamic_css($selector, $styles);
	}
	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_tabs_active_color_styles');
}