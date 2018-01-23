<?php
namespace Chandelier\Modules\Separator;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

class SectionTitle implements ShortcodeInterface{

	private $base;

	public function __construct() {
		$this->base = 'eltd_section_title';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see eltd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map(
			array(
				'name' => 'Section Title',
				'base' => $this->getBase(),
				'category' => 'by ELATED',
				'icon' => 'icon-wpb-section-title extended-custom-icon',
				'params' => array(
					array(
						'type' => 'textfield',
						'param_name' => 'title',
						'heading' => 'Section Title',
						'description' => '',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'param_name' => 'subtitle',
						'heading' => 'Section Subtitle',
						'description' => '',
						'admin_label' => true
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'animate',
						'heading' => 'Animate on Appear',
						'description' => '',
						'value' => array(
							'Yes' => 'yes',
							'No' => 'no',
						),
						'admin_label' => true,
						'save_always' => true
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'alignment',
						'heading' => 'Alignment',
						'description' => '',
						'value' => array(
							'Center' => '',
							'Left' => 'left',
							'Right' => 'right'
						),
						'admin_label' => true,
						'group' => 'Design Options'
					),
					array(
						'type' => 'textfield',
						'param_name' => 'title_font_size',
						'heading' => 'Title Font Size',
						'description' => '',
						'admin_label' => true,
						'group' => 'Design Options'
					),
					array(
						'type' => 'colorpicker',
						'param_name' => 'title_color',
						'heading' => 'Title Color',
						'description' => '',
						'admin_label' => true,
						'group' => 'Design Options'
					),
					array(
						'type' => 'textfield',
						'param_name' => 'subtitle_font_size',
						'heading' => 'Subitle Font Size',
						'description' => '',
						'admin_label' => true,
						'group' => 'Design Options'
					),
					array(
						'type' => 'colorpicker',
						'param_name' => 'subtitle_color',
						'heading' => 'Subitle Color',
						'description' => '',
						'admin_label' => true,
						'group' => 'Design Options'
					)
				)
			)
		);

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'title' => '',
			'subtitle' => '',
			'animate' => 'yes',
			'alignment' => '',
			'title_font_size' => '',
			'title_color'	=> '',
			'subtitle_font_size' => '',
			'subtitle_color'	=> ''

		);

		$params = shortcode_atts($args, $atts);
		$params['section_title_holder_style'] = $this->getSectionHolderStyle($params);
		$params['section_title_style'] = $this->getSectionTitleStyle($params);
		$params['section_subtitle_style'] = $this->getSectionSubtitleStyle($params);
		$params['section_title_classes'] = $this->getSectionTitleClasses($params);

		$html = chandelier_elated_get_shortcode_module_template_part('templates/section-title', 'sectiontitle', '', $params);

		return $html;

	}

	/**
	 * Section Holder Styles
	 *
	 * @param $params
	 * @return array
	 */
	private function getSectionHolderStyle($params) {

		$holder_styles = array();

		$holder_styles[] = ($params['alignment'] !== '') ? 'text-align: ' . $params['alignment'] : 'text-align: center';

		return $holder_styles;

	}

	/**
	 * Title Styles
	 *
	 * @param $params
	 * @return array
	 */
	private function getSectionTitleStyle($params) {

		$title_styles = array();

		$title_styles[] = ($params['title_font_size'] !== '') ? 'font-size: ' . chandelier_elated_filter_px($params['title_font_size']) . 'px' : '';
		$title_styles[] = ($params['title_color'] !== '') ? 'color: ' . $params['title_color'] : '';

		return $title_styles;

	}

	/**
	 * Subtitle styles
	 *
	 * @param $params
	 * @return array
	 */
	private function getSectionSubtitleStyle($params) {

		$subtitle_styles = array();

		$subtitle_styles[] = ($params['subtitle_font_size'] !== '') ? 'font-size: ' . chandelier_elated_filter_px($params['subtitle_font_size']) . 'px' : '';
		$subtitle_styles[] = ($params['subtitle_color'] !== '') ? 'color: ' . $params['subtitle_color'] : '';

		return $subtitle_styles;

	}

	/**
	 * Section Title Classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getSectionTitleClasses($params) {

		$section_title_classes = array();

		if ($params['animate'] == 'yes') {
			$section_title_classes[] = 'animate';
		}

		return implode(' ',$section_title_classes);

	}

}