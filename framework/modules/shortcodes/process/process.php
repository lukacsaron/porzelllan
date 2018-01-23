<?php
namespace Chandelier\Modules\Process;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Process
 * @package Chandelier\Modules\Process
 */
class Process implements ShortcodeInterface {

	private $base;

	function __construct() {
		$this->base = 'eltd_process';
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

		vc_map(array(
			'name' => 'Process',
			'base' => $this->getBase(),
			'as_child' => array('only' => 'eltd_process_holder'),
			'content_element' => true,
			'category' => 'by ELATED',
			'icon' => 'icon-wpb-circle extended-custom-icon',
			'show_settings_on_create' => true,
			'params' => array_merge(
				chandelier_elated_icon_collections()->getVCParamsArray(),
				array(
					array(
						'type' => 'textfield',
						'param_name' => 'title',
						'heading' => 'Title',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'param_name' => 'text',
						'heading' => 'Text',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'param_name' => 'icon_size',
						'heading' => 'Icon Size',
						'group' => 'Design Group',
						'admin_label' => true
					)
				)
			)
		));

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
			'text' => '',
			'icon_size' => '38'
		);

		$args = array_merge($args, chandelier_elated_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);

		$params['icon'] = $this->getProcessIcon($params);

		$html = chandelier_elated_get_shortcode_module_template_part('templates/process', 'process', '', $params);

		return $html;

	}

	/**
	 * Get Icon
	 *
	 * @param $params
	 * @return mixed|string
	 */
	private function getProcessIcon($params) {

		$iconPack = $params['icon_pack'];
		$iconParam = chandelier_elated_icon_collections()->getIconCollectionParamNameByKey($iconPack);
		$icon = $params[$iconParam];

		$icon_atts = array(
			'icon_pack' => $iconPack,
			$iconParam => $icon,
			'custom_size' => $params['icon_size']
		);

		return chandelier_elated_execute_shortcode('eltd_icon', $icon_atts);

	}

}