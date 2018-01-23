<?php

if (!function_exists('chandelier_elated_search_covers_header_style')) {

	function chandelier_elated_search_covers_header_style()
	{

		if (chandelier_elated_options()->getOptionValue('search_height') !== '') {
			echo chandelier_elated_dynamic_css('.eltd-search-slide-header-bottom.eltd-animated .eltd-form-holder-outer, .eltd-search-slide-header-bottom .eltd-form-holder-outer, .eltd-search-slide-header-bottom', array(
				'height' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('search_height')) . 'px'
			));
		}

	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_search_covers_header_style');

}

if (!function_exists('chandelier_elated_search_opener_icon_size')) {

	function chandelier_elated_search_opener_icon_size()
	{

		if (chandelier_elated_options()->getOptionValue('header_search_icon_size')) {
			echo chandelier_elated_dynamic_css('.eltd-search-opener', array(
				'font-size' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}

	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_search_opener_icon_size');

}

if (!function_exists('chandelier_elated_search_opener_spacing')) {

	function chandelier_elated_search_opener_spacing()
	{
		$spacing_styles = array();

		if (chandelier_elated_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if (chandelier_elated_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if (chandelier_elated_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if (chandelier_elated_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo chandelier_elated_dynamic_css('.eltd-search-opener', $spacing_styles);
		}

	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_search_opener_spacing');
}

?>
