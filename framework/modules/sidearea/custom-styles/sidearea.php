<?php

if (!function_exists('chandelier_elated_side_area_slide_from_right_type_style')) {

	function chandelier_elated_side_area_slide_from_right_type_style()
	{

		if (chandelier_elated_options()->getOptionValue('side_area_type') == 'side-menu-slide-from-right') {

			if (chandelier_elated_options()->getOptionValue('side_area_width') !== '' && chandelier_elated_options()->getOptionValue('side_area_width') >= 30) {
				echo chandelier_elated_dynamic_css('.eltd-side-menu-slide-from-right .eltd-side-menu', array(
					'right' => chandelier_elated_options()->getOptionValue('side_area_width') . '%',
					'width' => chandelier_elated_options()->getOptionValue('side_area_width') . '%'
				));
			}

			if (chandelier_elated_options()->getOptionValue('side_area_content_overlay_color') !== '') {

				echo chandelier_elated_dynamic_css('.eltd-side-menu-slide-from-right .eltd-wrapper .eltd-cover', array(
					'background-color' => chandelier_elated_options()->getOptionValue('side_area_content_overlay_color')
				));

			}
			if (chandelier_elated_options()->getOptionValue('side_area_content_overlay_opacity') !== '') {

				echo chandelier_elated_dynamic_css('.eltd-side-menu-slide-from-right.eltd-right-side-menu-opened .eltd-wrapper .eltd-cover', array(
					'opacity' => chandelier_elated_options()->getOptionValue('side_area_content_overlay_opacity')
				));

			}
		}

	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_side_area_slide_from_right_type_style');

}

if (!function_exists('chandelier_elated_side_area_icon_color_styles')) {

	function chandelier_elated_side_area_icon_color_styles()
	{

		if (chandelier_elated_options()->getOptionValue('side_area_icon_font_size') !== '') {

			echo chandelier_elated_dynamic_css('a.eltd-side-menu-button-opener', array(
				'font-size' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_icon_font_size')) . 'px'
			));

			if (chandelier_elated_options()->getOptionValue('side_area_icon_font_size') > 30) {
				echo '@media only screen and (max-width: 480px) {
						a.eltd-side-menu-button-opener {
						font-size: 30px;
						}
					}';
			}

		}

	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_side_area_icon_color_styles');

}

if (!function_exists('chandelier_elated_side_area_icon_spacing_styles')) {

	function chandelier_elated_side_area_icon_spacing_styles()
	{
		$icon_spacing = array();

		if (chandelier_elated_options()->getOptionValue('side_area_icon_padding_left') !== '') {
			$icon_spacing['padding-left'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_icon_padding_left')) . 'px';
		}

		if (chandelier_elated_options()->getOptionValue('side_area_icon_padding_right') !== '') {
			$icon_spacing['padding-right'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_icon_padding_right')) . 'px';
		}

		if (chandelier_elated_options()->getOptionValue('side_area_icon_margin_left') !== '') {
			$icon_spacing['margin-left'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_icon_margin_left')) . 'px';
		}

		if (chandelier_elated_options()->getOptionValue('side_area_icon_margin_right') !== '') {
			$icon_spacing['margin-right'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_icon_margin_right')) . 'px';
		}

		if (!empty($icon_spacing)) {

			echo chandelier_elated_dynamic_css('a.eltd-side-menu-button-opener', $icon_spacing);

		}

	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_side_area_icon_spacing_styles');
}

if (!function_exists('chandelier_elated_side_area_icon_border_styles')) {

	function chandelier_elated_side_area_icon_border_styles()
	{
		if (chandelier_elated_options()->getOptionValue('side_area_icon_border_yesno') == 'yes') {

			$side_area_icon_border = array();

			if (chandelier_elated_options()->getOptionValue('side_area_icon_border_color') !== '') {
				$side_area_icon_border['border-color'] = chandelier_elated_options()->getOptionValue('side_area_icon_border_color');
			}

			if (chandelier_elated_options()->getOptionValue('side_area_icon_border_width') !== '') {
				$side_area_icon_border['border-width'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_icon_border_width')) . 'px';
			} else {
				$side_area_icon_border['border-width'] = '1px';
			}

			if (chandelier_elated_options()->getOptionValue('side_area_icon_border_radius') !== '') {
				$side_area_icon_border['border-radius'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_icon_border_radius')) . 'px';
			}

			if (chandelier_elated_options()->getOptionValue('side_area_icon_border_style') !== '') {
				$side_area_icon_border['border-style'] = chandelier_elated_options()->getOptionValue('side_area_icon_border_style');
			} else {
				$side_area_icon_border['border-style'] = 'solid';
			}

			if (!empty($side_area_icon_border)) {
				$side_area_icon_border['-webkit-transition'] = 'all 0.15s ease-out';
				$side_area_icon_border['transition'] = 'all 0.15s ease-out';
				echo chandelier_elated_dynamic_css('a.eltd-side-menu-button-opener', $side_area_icon_border);
			}

			if (chandelier_elated_options()->getOptionValue('a.eltd-side-menu-button-opener:hover') !== '') {
				$side_area_icon_border['border-color'] = chandelier_elated_options()->getOptionValue('side_area_icon_border_hover_color');
			}


		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_side_area_icon_border_styles');

}

if (!function_exists('chandelier_elated_side_area_alignment')) {

	function chandelier_elated_side_area_alignment()
	{

		if (chandelier_elated_options()->getOptionValue('side_area_aligment')) {

			echo chandelier_elated_dynamic_css('.eltd-side-menu-slide-from-right .eltd-side-menu, .eltd-side-menu-slide-with-content .eltd-side-menu, .eltd-side-area-uncovered-from-content .eltd-side-menu', array(
				'text-align' => chandelier_elated_options()->getOptionValue('side_area_aligment')
			));

		}

	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_side_area_alignment');

}

if (!function_exists('chandelier_elated_side_area_styles')) {

	function chandelier_elated_side_area_styles()
	{

		$side_area_styles = array();

		if (chandelier_elated_options()->getOptionValue('side_area_background_color') !== '') {
			$side_area_styles['background-color'] = chandelier_elated_options()->getOptionValue('side_area_background_color');
		}

		if (chandelier_elated_options()->getOptionValue('side_area_padding_top') !== '') {
			$side_area_styles['padding-top'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_padding_top')) . 'px';
		}

		if (chandelier_elated_options()->getOptionValue('side_area_padding_right') !== '') {
			$side_area_styles['padding-right'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_padding_right')) . 'px';
		}

		if (chandelier_elated_options()->getOptionValue('side_area_padding_bottom') !== '') {
			$side_area_styles['padding-bottom'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_padding_bottom')) . 'px';
		}

		if (chandelier_elated_options()->getOptionValue('side_area_padding_left') !== '') {
			$side_area_styles['padding-left'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_padding_left')) . 'px';
		}

		if (!empty($side_area_styles)) {
			echo chandelier_elated_dynamic_css('.eltd-side-menu', $side_area_styles);
		}

		if (chandelier_elated_options()->getOptionValue('side_area_close_icon') == 'dark') {
			echo chandelier_elated_dynamic_css('.eltd-side-menu a.eltd-close-side-menu span, .eltd-side-menu a.eltd-close-side-menu i', array(
				'color' => '#000000'
			));
		}

		if (chandelier_elated_options()->getOptionValue('side_area_close_icon_size') !== '') {
			echo chandelier_elated_dynamic_css('.eltd-side-menu a.eltd-close-side-menu', array(
				'height' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'padding' => 0,
			));
			echo chandelier_elated_dynamic_css('.eltd-side-menu a.eltd-close-side-menu span, .eltd-side-menu a.eltd-close-side-menu i', array(
				'font-size' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'height' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('side_area_close_icon_size')) . 'px',
			));
		}

	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_side_area_styles');

}